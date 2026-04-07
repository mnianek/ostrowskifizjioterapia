<?php

namespace App\Filament\Resources\YoutubePageSettings;

use App\Filament\Resources\YoutubePageSettings\Pages\EditYoutubePageSetting;
use App\Filament\Resources\YoutubePageSettings\Pages\ListYoutubePageSettings;
use App\Filament\Resources\YoutubePageSettings\Schemas\YoutubePageSettingForm;
use App\Filament\Resources\YoutubePageSettings\Tables\YoutubePageSettingsTable;
use App\Models\YoutubePageSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class YoutubePageSettingResource extends Resource
{
    protected static ?string $model = YoutubePageSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPlayCircle;

    protected static string|\UnitEnum|null $navigationGroup = 'Strony i multimedia';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'hero_title';

    public static function getModelLabel(): string
    {
        return 'ustawienie strony YouTube';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Ustawienia strony YouTube';
    }

    public static function form(Schema $schema): Schema
    {
        return YoutubePageSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return YoutubePageSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListYoutubePageSettings::route('/'),
            'edit' => EditYoutubePageSetting::route('/{record}/edit'),
        ];
    }
}
