<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Faq::create([
            'question' => 'Jakie zabiegi oferujecie?',
            'answer' => 'Prowadzimy kompleksową opiekę fizjoterapeutyczną obejmującą terapię manualną, ćwiczenia wzmacniające, zabiegi fizykoterapeutyczne, masaż leczniczy oraz rehabilitację pourazową i pooperacyjną. Wszystkie zabiegi dostosowujemy indywidualnie do potrzeb każdego pacjenta.',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        Faq::create([
            'question' => 'Ile trwa typowa sesja rehabilitacji?',
            'answer' => 'Standardowa sesja trwa 60 minut. Czas jest elastyczny i dostosowywany do rodzaju problemu oraz etapu leczenia. Pierwsza wizyta diagnostyczna może trwać do 90 minut, aby dokładnie zbadać kondycję zdrowotną pacjenta.',
            'is_active' => true,
            'sort_order' => 3,
        ]);
    }
}
