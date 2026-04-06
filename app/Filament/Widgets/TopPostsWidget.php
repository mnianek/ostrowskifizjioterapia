<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Posts\PostResource;
use App\Models\Post;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class TopPostsWidget extends TableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->heading('Najpopularniejsze artykuły')
            ->query(
                Post::query()
                    ->with('category')
                    ->orderByDesc('views_count')
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('title')
                    ->label('Tytuł')
                    ->searchable()
                    ->url(fn (Post $record): string => PostResource::getUrl('edit', ['record' => $record])),
                TextColumn::make('category.name')
                    ->label('Kategoria')
                    ->placeholder('Bez kategorii'),
                TextColumn::make('views_count')
                    ->label('Wyświetlenia')
                    ->icon('heroicon-s-eye')
                    ->color('info')
                    ->sortable(),
            ])
            ->defaultSort('views_count', 'desc')
            ->paginated(false);
    }
}
