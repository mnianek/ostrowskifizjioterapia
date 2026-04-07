<?php

namespace App\Filament\Resources\NewsletterSubscribers\Pages;

use App\Filament\Resources\NewsletterSubscribers\NewsletterSubscriberResource;
use App\Models\NewsletterSubscriber;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListNewsletterSubscribers extends ListRecords
{
    protected static string $resource = NewsletterSubscriberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportCsv')
                ->label('Eksport CSV')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('gray')
                ->action(function () {
                    $fileName = 'newsletter-subscribers-'.now()->format('Y-m-d-His').'.csv';

                    return response()->streamDownload(function (): void {
                        $output = fopen('php://output', 'w');

                        fputcsv($output, ['email', 'created_at']);

                        NewsletterSubscriber::query()
                            ->orderBy('email')
                            ->chunk(500, function ($subscribers) use ($output): void {
                                foreach ($subscribers as $subscriber) {
                                    fputcsv($output, [
                                        $subscriber->email,
                                        $subscriber->created_at?->format('d.m.Y H:i'),
                                    ]);
                                }
                            });

                        fclose($output);
                    }, $fileName, [
                        'Content-Type' => 'text/csv; charset=UTF-8',
                    ]);
                }),
        ];
    }
}
