<?php

namespace App\Filament\Resources\YoutubePageSettings\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
 use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class YoutubePageSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero strony')
                    ->description('Treści widoczne na górze podstrony YouTube.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('channel_name')
                            ->label('Nazwa kanału')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('channel_url')
                            ->label('Adres kanału')
                            ->required()
                            ->url()
                            ->maxLength(255),
                        TextInput::make('hero_kicker')
                            ->label('Tekst nad nagłówkiem')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('hero_title')
                            ->label('Nagłówek')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('hero_description')
                            ->label('Opis hero')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        TextInput::make('cta_label')
                            ->label('Etykieta przycisku')
                            ->required()
                            ->maxLength(255),
                    ]),
                Section::make('Sekcja filmów')
                    ->description('Nagłówki i opis sekcji z materiałami wideo.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('section_title')
                            ->label('Tytuł sekcji')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('section_description')
                            ->label('Opis sekcji')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}