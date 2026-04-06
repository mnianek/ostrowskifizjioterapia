<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Category;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('PostEditorTabs')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Treść')
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (?string $state, Set $set, Get $get, string $operation): void {
                                        if (blank($state)) {
                                            return;
                                        }

                                        if (($operation === 'create') || blank($get('slug'))) {
                                            $set('slug', Str::slug($state));
                                        }
                                    })
                                    ->maxLength(255),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->dehydrated()
                                    ->maxLength(255),
                                TextInput::make('author')
                                    ->required()
                                    ->maxLength(255),
                                Select::make('category_id')
                                    ->label('Kategoria')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(Category::class, 'name'),
                                    ]),
                                Textarea::make('excerpt')
                                    ->label('Krótki opis')
                                    ->rows(4)
                                    ->columnSpanFull(),
                                RichEditor::make('content')
                                    ->required()
                                    ->columnSpanFull(),
                            ])->columns(2),
                        Tab::make('Media')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('featured_image')
                                    ->label('Zdjęcie wpisu')
                                    ->collection('featured_image')
                                    ->image()
                                    ->imageEditor()
                                    ->columnSpanFull(),
                            ])->columns(1),
                        Tab::make('Publikacja')
                            ->schema([
                                ToggleButtons::make('status')
                                    ->label('Status')
                                    ->options([
                                        'draft' => 'Szkic',
                                        'published' => 'Opublikowany',
                                    ])
                                    ->colors([
                                        'draft' => 'gray',
                                        'published' => 'success',
                                    ])
                                    ->inline()
                                    ->default('draft')
                                    ->required(),
                                DatePicker::make('published_at')
                                    ->label('Data publikacji')
                                    ->native(false)
                                    ->displayFormat('d.m.Y'),
                            ])->columns(1),
                    ]),
            ]);
    }
}
