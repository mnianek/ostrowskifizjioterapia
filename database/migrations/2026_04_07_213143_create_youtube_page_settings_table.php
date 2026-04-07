<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('youtube_page_settings', function (Blueprint $table): void {
            $table->id();
            $table->string('channel_name');
            $table->string('channel_url');
            $table->string('hero_kicker')->default('Kanał edukacyjny');
            $table->string('hero_title');
            $table->text('hero_description');
            $table->string('cta_label')->default('Otwórz kanał');
            $table->string('section_title')->default('Najnowsze filmy');
            $table->text('section_description');
            $table->timestamps();
        });

        DB::table('youtube_page_settings')->insert([
            'channel_name' => 'Kanał YouTube',
            'channel_url' => 'https://www.youtube.com/@ostrowskifizjoterapia',
            'hero_kicker' => 'Kanał edukacyjny',
            'hero_title' => 'Filmy na YouTube',
            'hero_description' => 'Materiały wideo z ćwiczeniami, edukacją i praktycznymi wskazówkami dla pacjentów.',
            'cta_label' => 'Otwórz kanał',
            'section_title' => 'Najnowsze filmy',
            'section_description' => 'Wybrane materiały wideo, które możesz od razu obejrzeć poniżej.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('youtube_page_settings');
    }
};
