<?php

namespace App\Filament\Resources\YoutubePageSettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class YoutubePageSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hero_title')
                    ->label('Nagłówek')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('channel_name')
                    ->label('Kanał')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('channel_url')
                    ->label('Adres URL')
                    ->copyable()
                    ->limit(45),
                TextColumn::make('updated_at')
                    ->label('Zaktualizowano')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}