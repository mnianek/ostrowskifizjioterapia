<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubePageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_name',
        'channel_url',
        'hero_kicker',
        'hero_title',
        'hero_description',
        'cta_label',
        'section_title',
        'section_description',
    ];

    public static function defaults(): array
    {
        return [
            'channel_name' => 'Kanał YouTube',
            'channel_url' => 'https://www.youtube.com/@ostrowskifizjoterapia',
            'hero_kicker' => 'Kanał edukacyjny',
            'hero_title' => 'Filmy na YouTube',
            'hero_description' => 'Materiały wideo z ćwiczeniami, edukacją i praktycznymi wskazówkami dla pacjentów.',
            'cta_label' => 'Otwórz kanał',
            'section_title' => 'Najnowsze filmy',
            'section_description' => 'Wybrane materiały wideo, które możesz od razu obejrzeć poniżej.',
        ];
    }

    public static function current(): self
    {
        return static::query()->first() ?? new static(static::defaults());
    }
}
