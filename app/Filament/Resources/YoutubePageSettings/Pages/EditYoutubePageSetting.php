<?php

namespace App\Filament\Resources\YoutubePageSettings\Pages;

use App\Filament\Resources\YoutubePageSettings\YoutubePageSettingResource;
use Filament\Resources\Pages\EditRecord;

class EditYoutubePageSetting extends EditRecord
{
    protected static string $resource = YoutubePageSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }
}
