<?php

namespace App\Filament\Resources\Packages;

use App\Filament\Resources\Packages\Pages\CreatePackage;
use App\Filament\Resources\Packages\Pages\EditPackage;
use App\Filament\Resources\Packages\Pages\ListPackages;
use App\Models\Category;
use App\Models\Package;
use Closure;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('github')
                    ->prefixIcon('icon-github')
                    ->autocomplete(false)
                    ->columnSpanFull()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->minLength(19)
                    ->startsWith('https://github.com/')
                    ->url()
                    ->suffixAction(
                        Action::make('Generate With Ai')
                            ->icon('heroicon-m-sparkles')
                            ->color('primary')
                            ->action(function (Get $get, Set $set) {
                                $githubUrl = $get('github');

                                if (blank($githubUrl)) {
                                    Notification::make()
                                        ->title('GitHub URL Required')
                                        ->body('Please enter a GitHub URL first.')
                                        ->danger()
                                        ->send();

                                    return;
                                }

                                try {
                                    // 1) Fetch metadata & AI suggestion
                                    $metadata = getGithubPackageMetadata($githubUrl);
                                    $ai = aiGeneratePackageFormFields($metadata);

                                    // 2) Name
                                    if (! empty($ai['name'])) {
                                        $set('name', $ai['name']);
                                    }

                                    // 3) Description
                                    if (! empty($ai['description'])) {
                                        $set('description', $ai['description']);
                                    }

                                    // 4) Composer + author (composer-based packages)
                                    if (! empty($ai['composer'])) {
                                        $set('composer', $ai['composer']);
                                        $set('author', str($ai['composer'])->before('/')->trim());
                                    }

                                    // 5) Category (string -> category_id)
                                    if (! empty($ai['category'])) {
                                        $categoryId = Category::query()
                                            ->where('name', $ai['category'])
                                            ->value('id');

                                        if ($categoryId) {
                                            $set('category_id', $categoryId);
                                        }
                                    }

                                    // 6) Package type
                                    if (! empty($ai['package_type'])) {
                                        $set('package_type', $ai['package_type']);
                                    }

                                    // 7) NPM package name
                                    if (! empty($ai['npm'])) {
                                        $set('npm', $ai['npm']);
                                    }

                                    // 8) Author fallback for non-composer packages
                                    $currentAuthor = $get('author');
                                    if (blank($currentAuthor) && ! empty($metadata['owner'])) {
                                        $set('author', $metadata['owner']);
                                    }

                                    Notification::make()
                                        ->title('Success!')
                                        ->body('Package details generated successfully with AI.')
                                        ->success()
                                        ->send();
                                } catch (\Exception $e) {
                                    Notification::make()
                                        ->title('Generation Failed')
                                        ->body('Failed to generate package details: '.$e->getMessage())
                                        ->danger()
                                        ->send();
                                }
                            })
                    )
                    ->rules([
                        function () {
                            return function (string $attribute, $value, Closure $fail) {
                                // Must be a valid Github URL
                                if (! preg_match('/^https:\/\/github\.com\/[a-zA-Z0-9\-_]+\/[a-zA-Z0-9\-_.]+$/i', $value)) {
                                    $fail('The :attribute must be a valid Github URL.');
                                }

                                // Must be healthy Github repository
                                if (! isGithubRepositoryHealthy(extractRepoFromGithubUrl($value))) {
                                    $fail('The :attribute must be a healthy Github repository.');
                                }
                            };
                        },
                    ]),
                TextInput::make('name')
                    ->prefixIcon('icon-name')
                    ->live(debounce: 500)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('name', str($state)->headline()))
                    ->autocomplete(false)
                    ->required()
                    ->minLength(2)
                    ->maxLength(40)
                    ->rules([
                        function () {
                            return function (string $attribute, $value, Closure $fail) {
                                // Must contain only letters, numbers, spaces, and the following characters: - + ( ) &
                                if (! preg_match('/^(?!.*[\-\+\(\)&]{2})[0-9a-zA-Z\-\+\(\)&]+(\s[0-9a-zA-Z\-\+\(\)&]+)*$/', $value)) {
                                    $fail('The :attribute must contain only letters, numbers, spaces, and the following characters: - + ( ) &.');
                                }
                                // Must not contain multiple spaces between words
                                if (preg_match('/\s{2,}/', $value)) {
                                    $fail('The :attribute must not contain multiple spaces between words.');
                                }
                                // Each word in the name should be capitalized except
                                // when the word starts with i18 or,
                                // a single lower case letter followed by a upper case letter
                                if (! preg_match('/^(?!.*\bi18\b)\b([a-z][A-Z][a-zA-Z0-9+\-()&]*|[A-Z][a-zA-Z0-9+\-()&]*|i18[a-zA-Z0-9+\-()&]*)\b(?:\s+([a-z][A-Z][a-zA-Z0-9+\-()&]*|[A-Z][a-zA-Z0-9+\-()&]*|i18[a-zA-Z0-9+\-()&]*))*$/', $value)) {
                                    $fail('The :attribute must start with a capital letter, except for words starting with i18 or a single lowercase letter followed by an uppercase letter.');
                                }

                            };
                        },
                    ]),
                TextInput::make('description')
                    ->prefixIcon('heroicon-o-chat-bubble-bottom-center-text')
                    ->live(debounce: 500)
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $description = $set('description', str($state)->ucfirst()->trim());

                        return $set('description', str($description)->endsWith('.') ? $description : $description.'.');
                    })
                    ->autocomplete(false)
                    ->columnSpan(2)
                    ->required()
                    ->minLength(5)
                    ->maxLength(100)
                    ->endsWith('.')
                    ->rules([
                        function () {
                            return function (string $attribute, $value, Closure $fail) {
                                // Must start with a capitalized letter
                                if (! preg_match('/^[A-Z]/', $value)) {
                                    $fail('The :attribute must start with a capital letter.');
                                }

                                // Must start with a letter
                                if (! preg_match('/^[a-zA-Z]/', $value)) {
                                    $fail('The :attribute must start with a letter.');
                                }

                                // Must not contain multiple spaces between words
                                if (preg_match('/\s{2,}/', $value)) {
                                    $fail('The :attribute must not contain multiple spaces between words.');
                                }
                            };
                        },
                    ]),
                Select::make('category_id')
                    ->prefixIcon('icon-category')
                    ->required()
                    ->searchable(['name'])
                    ->relationship(name: 'category', titleAttribute: 'name')
                    ->preload(),
                Select::make('package_type')
                    ->required()
                    ->live(debounce: 500)
                    ->options([
                        'laravel-package' => 'Laravel Package',
                        'php-package' => 'PHP Package',
                        'npm-package' => 'NPM Package',
                        'mac-app' => 'Mac App',
                        'windows-app' => 'Windows App',
                        'all-operating-systems-app' => 'All Operating Systems App',
                        'ide-extension' => 'IDE Extension',
                    ])
                    ->default('laravel-package'),
                TagsInput::make('keywords')
                    ->prefixIcon('heroicon-o-tag')
                    ->nullable()
                    ->nestedRecursiveRules([
                        'string',
                        'distinct',
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                            // Must be alphanumeric and single spaces and the following characters: - / .
                            if (! preg_match('/^(?!.* {2})[a-zA-Z0-9]+([ -\/\.]?[a-zA-Z0-9]+)*$/', $value)) {
                                $fail('The :attribute must contain only letters, numbers, single spaces, and the following characters: - / .');
                            }

                            // Keywords must not be used in name and description
                            $name = $get('name');
                            $description = $get('description');
                            if (preg_match("/\b{$value}\b/i", $name) || preg_match("/\b{$value}\b/i", $description)) {
                                $fail('The :attribute must not be used in name and description.');
                            }
                        },
                    ]),
                TextInput::make('composer')
                    ->prefixIcon('icon-composer')
                    ->autocomplete(false)
                    ->live(debounce: 500)
                    // When composer changes, extract the author from it and set it on the author field
                    // So for example spatie/opening-hours will set spatie on the author field
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('author', str($state)->before('/')->trim()))
                    ->required(fn (Get $get): bool => in_array($get('package_type'), ['php-package', 'laravel-package']))
                    ->minLength(2)
                    ->unique(ignoreRecord: true)
                    ->rules([
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                            // Must be a valid composer package name: /^[a-z0-9]+(?:-[a-z0-9]+)*\/[a-z0-9]+(?:-[a-z0-9]+)*$/i
                            if (! preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*\/[a-z0-9]+(?:-[a-z0-9]+)*$/i', $value)) {
                                $fail('The :attribute must be a valid composer package name.');
                            }

                            // If package_type is "npm-package", then composer must be null
                            if ($get('package_type') === 'npm-package') {
                                $fail('The :attribute must be null if package_type is "npm-package".');
                            }

                            // If package_type is "php-package" or "laravel-package", then composer must not be null
                            if (in_array($get('package_type'), ['php-package', 'laravel-package']) && empty($value)) {
                                $fail('The :attribute must not be null if package_type is "php-package" or "laravel-package".');
                            }
                        },
                    ]),
                TextInput::make('npm')
                    ->prefixIcon('icon-npm')
                    ->autocomplete(false)
                    ->live(debounce: 500)
                    ->minLength(2)
                    ->required(fn (Get $get): bool => $get('package_type') === 'npm-package')
                    ->unique(ignoreRecord: true)
                    ->rules([
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                            // Must be a valid npm package name: /^(?!-)(?!.*--)[a-zA-Z0-9_.-]+$/
                            if (! preg_match('/^(?!-)(?!.*--)[a-zA-Z0-9_.-]+$/', $value)) {
                                $fail('The :attribute must be a valid npm package name.');
                            }

                            // If package_type is "php-package" or "laravel-package", then npm must be null
                            if (in_array($get('package_type'), ['php-package', 'laravel-package'])) {
                                $fail('The :attribute must be null if package_type is "php-package" or "laravel-package".');
                            }

                            // If package_type is "npm-package", then npm must not be null
                            if ($get('package_type') === 'npm-package' && empty($value)) {
                                $fail('The :attribute must not be null if package_type is "npm-package".');
                            }
                        },
                    ]),
                TextInput::make('author')
                    ->prefixIcon('icon-programmer')
                    ->autocomplete(false)
                    ->required()
                    ->minLength(2)
                    ->rules([
                        function () {
                            return function (string $attribute, $value, Closure $fail) {
                                // Must contain only letters, numbers, and the following characters: -
                                if (! preg_match('/^[0-9a-zA-Z\-]+$/i', $value)) {
                                    $fail('The :attribute must contain only letters, numbers, and the following characters: -.');
                                }
                            };
                        },
                    ]),
                Toggle::make('paid_integration')
                    ->inline(false)
                    ->onIcon('heroicon-o-currency-dollar')
                    ->required(),
                Section::make('Composer & NPM & Github Data')
                    ->description('This section is automatically filled when you click the "Fetch All Data" button.')
                    ->columnSpanFull()
                    ->headerActions([
                        Action::make('Fetch All Data')
                            ->icon('heroicon-m-arrow-path')
                            ->color('success')
                            ->disabled(fn (Get $get): bool => empty($get('github')))
                            ->action(function (Get $get, Set $set) {
                                $githubUrl = $get('github');

                                if (blank($githubUrl)) {
                                    Notification::make()
                                        ->title('GitHub URL Required')
                                        ->body('Please enter a GitHub URL first.')
                                        ->danger()
                                        ->send();

                                    return;
                                }

                                try {
                                    // 1) Fetch metadata & AI suggestion (hitting GitHub API once)
                                    $metadata = getGithubPackageMetadata($githubUrl);
                                    $ai = aiGeneratePackageFormFields($metadata);

                                    // 2) Set AI-generated fields if not already set
                                    if (empty($get('name')) && ! empty($ai['name'])) {
                                        $set('name', $ai['name']);
                                    }

                                    if (empty($get('description')) && ! empty($ai['description'])) {
                                        $set('description', $ai['description']);
                                    }

                                    if (empty($get('composer')) && ! empty($ai['composer'])) {
                                        $set('composer', $ai['composer']);
                                        $set('author', str($ai['composer'])->before('/')->trim());
                                    }

                                    if (empty($get('category_id')) && ! empty($ai['category'])) {
                                        $categoryId = Category::query()
                                            ->where('name', $ai['category'])
                                            ->value('id');

                                        if ($categoryId) {
                                            $set('category_id', $categoryId);
                                        }
                                    }

                                    if (empty($get('package_type')) && ! empty($ai['package_type'])) {
                                        $set('package_type', $ai['package_type']);
                                    }

                                    if (empty($get('npm')) && ! empty($ai['npm'])) {
                                        $set('npm', $ai['npm']);
                                    }

                                    if (empty($get('author')) && ! empty($metadata['owner'])) {
                                        $set('author', $metadata['owner']);
                                    }

                                    // 3) Fetch package-specific data (Packagist/NPM)
                                    $composer = $get('composer');
                                    $npm = $get('npm');

                                    if (! empty($composer)) {
                                        $packagistData = getPackagistData($composer);
                                        $set('first_release_at', $packagistData['first_release_at']);
                                        $set('latest_release_at', $packagistData['latest_release_at']);
                                        $set('laravel_dependency_versions', $packagistData['laravel_dependency_versions']);
                                    } elseif (! empty($npm)) {
                                        $npmData = getNpmData($npm);
                                        $set('first_release_at', $npmData['first_release_at']);
                                        $set('latest_release_at', $npmData['latest_release_at']);
                                    }

                                    // 4) Fetch GitHub stars
                                    $set('stars', fetchGithubStars($githubUrl));

                                    Notification::make()
                                        ->title('Success!')
                                        ->body('All package data fetched and fields populated successfully.')
                                        ->success()
                                        ->send();
                                } catch (\Exception $e) {
                                    Notification::make()
                                        ->title('Fetch Failed')
                                        ->body('Failed to fetch package data: '.$e->getMessage())
                                        ->danger()
                                        ->send();
                                }
                            }),
                    ])
                    ->schema([
                        TagsInput::make('laravel_dependency_versions')
                            ->prefixIcon('icon-laravel')
                            ->columnSpanFull()
                            ->nestedRecursiveRules([
                                'string',
                                'distinct',
                                fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) {
                                    $isValidVersionConstraint = isValidVersionConstraint($value);

                                    // Must be a valid laravel version
                                    if (! $isValidVersionConstraint) {
                                        $fail('The :attribute constraint is not valid');
                                    }

                                    // Must not be a wildcard (*)
                                    if (preg_match('/\*/', $value) && ! $isValidVersionConstraint) {
                                        $fail('The :attribute must not be a wildcard (*).');
                                    }
                                },
                            ])
                            ->rules([
                                fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) {
                                    // At least one of the dependencies must be compatible with laravel active versions unless the value is empty
                                    $dependencies = $value;
                                    if (! empty($dependencies) && ! isCompatibleWithLaravelActiveVersions($dependencies)) {
                                        $fail('At least one of the dependencies must be compatible with laravel active versions.');
                                    }

                                },
                            ]),
                        TextInput::make('stars')
                            ->prefixIcon('heroicon-o-star')
                            ->autocomplete(false)
                            ->required()
                            ->minValue(0)
                            ->default(0)
                            ->numeric(),
                        DateTimePicker::make('first_release_at'),
                        DateTimePicker::make('latest_release_at'),
                    ])
                    ->columnSpanFull(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->weight(FontWeight::Bold)
                    ->description(fn (Package $record) => $record->getAuthorAndNameFromGithub()),
                TextColumn::make('author')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->searchable(),
                TextColumn::make('composer')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('npm')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('stars')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('first_release_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('latest_release_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('package_type')
                    ->searchable(isIndividual: true)
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => str($state)->headline()),
                IconColumn::make('paid_integration')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPackages::route('/'),
            'create' => CreatePackage::route('/create'),
            'edit' => EditPackage::route('/{record}/edit'),
        ];
    }
}
