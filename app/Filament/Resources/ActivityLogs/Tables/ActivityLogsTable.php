<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ActivityLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
                TextColumn::make('action')
                    ->label('Akcja')
                    ->badge()
                    ->sortable(),
                TextColumn::make('subject_type')
                    ->label('Model')
                    ->formatStateUsing(fn (string $state): string => class_basename($state))
                    ->badge()
                    ->sortable(),
                TextColumn::make('subject_id')
                    ->label('ID rekordu')
                    ->sortable(),
                TextColumn::make('causer.name')
                    ->label('Uzytkownik')
                    ->placeholder('guest')
                    ->sortable(),
                TextColumn::make('ip_address')
                    ->label('IP')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('properties')
                    ->label('Zmiany')
                    ->formatStateUsing(function (?array $state): string {
                        if (! is_array($state) || $state === []) {
                            return '-';
                        }

                        return json_encode($state, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '-';
                    })
                    ->wrap(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('action')
                    ->label('Akcja')
                    ->options([
                        'created' => 'created',
                        'updated' => 'updated',
                        'deleted' => 'deleted',
                        'approved' => 'approved',
                        'unapproved' => 'unapproved',
                        'pinned' => 'pinned',
                        'unpinned' => 'unpinned',
                        'publish_state_changed' => 'publish_state_changed',
                    ]),
                SelectFilter::make('subject_type')
                    ->label('Model')
                    ->options([
                        'App\\Models\\Post' => 'Post',
                        'App\\Models\\Comment' => 'Comment',
                    ]),
            ])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
