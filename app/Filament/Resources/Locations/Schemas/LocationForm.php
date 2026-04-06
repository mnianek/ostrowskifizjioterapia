<?php

namespace App\Filament\Resources\Locations\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('city')
                    ->label('Miasto')
                    ->maxLength(255),
                TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                TextInput::make('map_link')
                    ->required()
                    ->url()
                    ->maxLength(255),
                Textarea::make('hours')
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }
}
