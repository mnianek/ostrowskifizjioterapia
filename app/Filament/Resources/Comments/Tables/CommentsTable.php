<?php

namespace App\Filament\Resources\Comments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
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
                ToggleColumn::make('is_approved')
                    ->label('Zatwierdzony'),
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
