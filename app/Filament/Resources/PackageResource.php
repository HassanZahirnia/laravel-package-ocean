<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Models\Package;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
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
                Forms\Components\TextInput::make('github')
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
                            };
                        },
                    ]),
                Forms\Components\TextInput::make('author')
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
                Forms\Components\TextInput::make('composer')
                    ->string()
                    ->live()
                    ->required(fn (Get $get): bool => empty($get('npm')))
                    ->minLength(2)
                    ->unique(ignoreRecord: true)
                    ->rules([
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) {
                            // Must be a valid composer package name: /^[a-z0-9]+(?:-[a-z0-9]+)*\/[a-z0-9]+(?:-[a-z0-9]+)*$/i
                            if (! preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*\/[a-z0-9]+(?:-[a-z0-9]+)*$/i', $value)) {
                                $fail('The :attribute must be a valid composer package name.');
                            }
                        },
                    ]),
                Forms\Components\TextInput::make('npm')
                    ->string()
                    ->live()
                    ->minLength(2)
                    ->required(fn (Get $get): bool => empty($get('composer')))
                    ->unique(ignoreRecord: true)
                    ->rules([
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) {
                            // Must be a valid npm package name: /^(?!-)(?!.*--)[a-zA-Z0-9_.-]+$/
                            if (! preg_match('/^(?!-)(?!.*--)[a-zA-Z0-9_.-]+$/', $value)) {
                                $fail('The :attribute must be a valid npm package name.');
                            }
                        },
                    ]),
                Forms\Components\TextInput::make('stars')
                    ->required()
                    ->minValue(0)
                    ->numeric(),
                Forms\Components\TagsInput::make('keywords')
                    ->required()
                    ->nestedRecursiveRules([
                        'string',
                        'distinct',
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) {
                            // Must be alphanumeric and single spaces and the following characters: - / .
                            if (! preg_match('/^(?!.* {2})[a-zA-Z0-9]+([ -\/\.]?[a-zA-Z0-9]+)*$/', $value)) {
                                $fail('The :attribute must contain only letters, numbers, single spaces, and the following characters: - / .');
                            }
                        },
                    ]),
                Forms\Components\DateTimePicker::make('first_release_at'),
                Forms\Components\DateTimePicker::make('latest_release_at'),
                Forms\Components\TagsInput::make('laravel_dependency_versions')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('package_type')
                    ->required(),
                Forms\Components\Toggle::make('paid_integration')
                    ->required(),
            ]);
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
                    ->toggleable(isToggledHiddenByDefault: true),
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
