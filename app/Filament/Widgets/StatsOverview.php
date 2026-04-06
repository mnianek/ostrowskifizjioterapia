<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Comments\CommentResource;
use App\Models\Comment;
use App\Models\SiteStat;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $uniqueVisits = SiteStat::query()
            ->where('key', 'unique_visits')
            ->value('value') ?? 0;

        $pendingComments = Comment::query()
            ->where('is_approved', false)
            ->count();

        return [
            Stat::make('Unikalni Pacjenci', number_format((int) $uniqueVisits, 0, ',', ' '))
                ->description('Łączna liczba unikalnych sesji')
                ->descriptionIcon('heroicon-s-user-group')
                ->icon('heroicon-s-users')
                ->color('primary'),
            Stat::make('Komentarze do zatwierdzenia', (string) $pendingComments)
                ->description('Komentarze oczekujące na moderację')
                ->descriptionIcon('heroicon-s-chat-bubble-left-ellipsis')
                ->icon('heroicon-s-chat-bubble-left-right')
                ->url(CommentResource::getUrl('index', [
                    'tableFilters' => [
                        'is_approved' => ['value' => '0'],
                    ],
                ]))
                ->color($pendingComments > 0 ? 'danger' : 'success'),
        ];
    }
}
