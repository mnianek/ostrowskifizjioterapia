<?php

namespace App\Filament\Resources\YoutubePageSettings\Pages;

use App\Filament\Resources\YoutubePageSettings\YoutubePageSettingResource;
use Filament\Resources\Pages\ListRecords;

class ListYoutubePageSettings extends ListRecords
{
    protected static string $resource = YoutubePageSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}