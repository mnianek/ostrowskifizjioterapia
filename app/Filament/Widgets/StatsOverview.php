<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Comments\CommentResource;
use App\Models\Comment;
use App\Models\NewsletterSubscriber;
use App\Models\Post;
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

        $publishedPosts = Post::query()
            ->where('status', 'published')
            ->count();

        $draftPosts = Post::query()
            ->where('status', 'draft')
            ->count();

        $ctaClicks = (int) (SiteStat::query()->where('key', 'cta_youtube_channel_clicks')->value('value') ?? 0);

        $newsletterSubmissions = (int) (SiteStat::query()->where('key', 'newsletter_submissions')->value('value') ?? 0);
        $newsletterNewSubscribers = (int) (SiteStat::query()->where('key', 'newsletter_new_subscribers')->value('value') ?? 0);

        $topSourceStat = SiteStat::query()
            ->where('key', 'like', 'source:%')
            ->orderByDesc('value')
            ->first();

        $topSource = $topSourceStat ? str_replace('source:', '', $topSourceStat->key) : 'brak danych';

        $newsletterConversion = $newsletterSubmissions > 0
            ? round(($newsletterNewSubscribers / $newsletterSubmissions) * 100, 1)
            : 0.0;

        $ctaCtr = $uniqueVisits > 0
            ? round(($ctaClicks / $uniqueVisits) * 100, 1)
            : 0.0;

        $subscribersCount = NewsletterSubscriber::query()->count();

        return [
            Stat::make('Unikalni Pacjenci', number_format((int) $uniqueVisits, 0, ',', ' '))
                ->description('Łączna liczba unikalnych sesji')
                ->descriptionIcon('heroicon-s-user-group')
                ->icon('heroicon-s-users')
                ->color('success'),
            Stat::make('Opublikowane wpisy', number_format($publishedPosts, 0, ',', ' '))
                ->description('Wpisy gotowe do prezentacji pacjentom')
                ->descriptionIcon('heroicon-s-document-text')
                ->icon('heroicon-s-newspaper')
                ->color('info'),
            Stat::make('Szkice wpisów', number_format($draftPosts, 0, ',', ' '))
                ->description('Wpisy oczekujące na publikację')
                ->descriptionIcon('heroicon-s-pencil-square')
                ->icon('heroicon-s-document')
                ->color('warning'),
            Stat::make('Komentarze do zatwierdzenia', (string) $pendingComments)
                ->description('Komentarze oczekujące na moderację')
                ->descriptionIcon('heroicon-s-chat-bubble-left-ellipsis')
                ->icon('heroicon-s-chat-bubble-left-right')
                ->url(CommentResource::getUrl('index', [
                    'tableFilters' => [
                        'is_approved' => ['value' => '0'],
                    ],
                ]))
                ->color('warning'),
            Stat::make('CTR CTA YouTube', number_format($ctaCtr, 1, ',', ' ').'%')
                ->description('Kliknięcia CTA / unikalne sesje')
                ->descriptionIcon('heroicon-s-cursor-arrow-rays')
                ->icon('heroicon-s-arrow-top-right-on-square')
                ->color('info'),
            Stat::make('Konwersja newslettera', number_format($newsletterConversion, 1, ',', ' ').'%')
                ->description(number_format($newsletterNewSubscribers, 0, ',', ' ').' nowych / '.number_format($newsletterSubmissions, 0, ',', ' ').' zapisów')
                ->descriptionIcon('heroicon-s-envelope')
                ->icon('heroicon-s-megaphone')
                ->color('success'),
            Stat::make('Top źródło ruchu', ucfirst($topSource))
                ->description($topSourceStat ? number_format((int) $topSourceStat->value, 0, ',', ' ').' sesji' : 'Brak zebranych danych')
                ->descriptionIcon('heroicon-s-globe-alt')
                ->icon('heroicon-s-chart-bar')
                ->color('gray'),
            Stat::make('Subskrybenci newslettera', number_format($subscribersCount, 0, ',', ' '))
                ->description('Aktualna liczba zapisanych osób')
                ->descriptionIcon('heroicon-s-user-plus')
                ->icon('heroicon-s-inbox-stack')
                ->color('primary'),
        ];
    }
}
