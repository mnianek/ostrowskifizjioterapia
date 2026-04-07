<?php

namespace App\Filament\Resources\Comments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CommentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('content')
                    ->label('Treść')
                    ->limit(80)
                    ->searchable(),
                TextColumn::make('user_name')
                    ->label('Autor')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Data komentarza')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
                TextColumn::make('post.title')
                    ->label('Post')
                    ->searchable(),
                BadgeColumn::make('is_approved')
                    ->label('Status')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Zatwierdzony' : 'Oczekuje')
                    ->colors([
                        'success' => fn (bool $state): bool => $state,
                        'danger' => fn (bool $state): bool => ! $state,
                    ]),
            ])
            ->filters([
                TernaryFilter::make('is_approved')
                    ->label('Status moderacji')
                    ->placeholder('Wszystkie')
                    ->trueLabel('Zatwierdzone')
                    ->falseLabel('Do zatwierdzenia'),
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
}
