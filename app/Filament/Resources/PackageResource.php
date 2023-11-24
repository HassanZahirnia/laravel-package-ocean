<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Models\Package;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->autocomplete(false)
                    ->required()
                    ->string()
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
                Forms\Components\TextInput::make('description')
                    ->autocomplete(false)
                    ->columnSpan(2)
                    ->required()
                    ->string()
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
                Forms\Components\Select::make('category_id')
                    ->required()
                    ->searchable(['name'])
                    ->relationship(name: 'category', titleAttribute: 'name')
                    ->preload(),
                Forms\Components\Select::make('package_type')
                    ->required()
                    ->options([
                        'laravel-package' => 'Laravel Package',
                        'php-package' => 'PHP Package',
                        'npm-package' => 'NPM Package',
                        'mac-app' => 'Mac App',
                        'windows-app' => 'Windows App',
                        'all-operating-systems-app' => 'All Operating Systems App',
                        'ide-extension' => 'IDE Extension',
                    ])
                    ->default('laravel-package')
                    ->rules([
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                            // If npm is not null, then package_type must be "npm-package"
                            if (! empty($get('npm')) && $value !== 'npm-package') {
                                $fail('The :attribute must be "npm-package" if npm is not null.');
                            }

                            // If composer is not null, then package_type must be "php-package" or "laravel-package"
                            if (! empty($get('composer')) && ! in_array($value, ['php-package', 'laravel-package'])) {
                                $fail('The :attribute must be "php-package" or "laravel-package" if composer is not null.');
                            }
                        },
                    ]),
                Forms\Components\TextInput::make('author')
                    ->autocomplete(false)
                    ->required()
                    ->string()
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
                Forms\Components\TextInput::make('github')
                    ->autocomplete(false)
                    ->columnSpan(2)
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->minLength(19)
                    ->startsWith('https://github.com/')
                    ->url()
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
                Forms\Components\TagsInput::make('keywords')
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
                Forms\Components\TextInput::make('composer')
                    ->autocomplete(false)
                    ->string()
                    ->live()
                    ->required(fn (Get $get): bool => empty($get('npm')))
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
                Forms\Components\TextInput::make('npm')
                    ->autocomplete(false)
                    ->string()
                    ->live()
                    ->minLength(2)
                    ->required(fn (Get $get): bool => empty($get('composer')))
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
                Forms\Components\Toggle::make('paid_integration')
                    ->inline(false)
                    ->onIcon('heroicon-o-currency-dollar')
                    ->required(),
                Section::make('Data')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TagsInput::make('laravel_dependency_versions')
                            ->columnSpanFull()
                            ->nestedRecursiveRules([
                                'string',
                                'distinct',
                                fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) {
                                    // Must not be a wildcard (*)
                                    if (preg_match('/\*/', $value)) {
                                        $fail('The :attribute must not be a wildcard (*).');
                                    }

                                    // Must be a valid laravel version
                                    if (! isValidVersionConstraint($value)) {
                                        $fail('The :attribute constraint is not valid');
                                    }
                                },
                            ]),
                        Forms\Components\TextInput::make('stars')
                            ->autocomplete(false)
                            ->required()
                            ->minValue(0)
                            ->default(0)
                            ->numeric(),
                        Forms\Components\DateTimePicker::make('first_release_at'),
                        Forms\Components\DateTimePicker::make('latest_release_at'),
                        Actions::make([
                            Action::make('Fetch All Data')
                                ->icon('heroicon-m-arrow-path')
                                ->color('success')
                                ->disabled(fn (Get $get): bool => (empty($get('composer')) && empty($get('npm'))) || empty($get('github')))
                                ->action(function (Set $set, $state) {
                                    if (! empty($state['composer'])) {
                                        $packagistData = getPackagistData($state['composer']);
                                        $set('first_release_at', $packagistData['first_release_at']);
                                        $set('latest_release_at', $packagistData['latest_release_at']);
                                        $set('laravel_dependency_versions', $packagistData['laravel_dependency_versions']);
                                    } elseif (! empty($state['npm'])) {
                                        $npmData = getNpmData($state['npm']);
                                        $set('first_release_at', $npmData['first_release_at']);
                                        $set('latest_release_at', $npmData['latest_release_at']);
                                    }

                                    $set('stars', fetchGithubStars($state['github']));
                                }),
                        ])->columnSpanFull(),
                    ]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight(FontWeight::Bold)
                    ->description(fn (Package $record) => $record->getAuthorAndNameFromGithub()),
                Tables\Columns\TextColumn::make('author')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('composer')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('npm')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('stars')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('first_release_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('latest_release_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('package_type')
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => str($state)->headline()),
                Tables\Columns\IconColumn::make('paid_integration')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
