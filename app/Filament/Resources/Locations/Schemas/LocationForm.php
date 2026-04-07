<?php

namespace App\Filament\Resources\Locations\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dane placówki')
                    ->icon('heroicon-o-building-office')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nazwa')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('city')
                            ->label('Miasto')
                            ->maxLength(255),
                        TextInput::make('address')
                            ->label('Ulica i numer')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('map_link')
                            ->label('Link do mapy')
                            ->required()
                            ->url()
                            ->maxLength(255),
                        Textarea::make('hours')
                            ->label('Godziny')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
