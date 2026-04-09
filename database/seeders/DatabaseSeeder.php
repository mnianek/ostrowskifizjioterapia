<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Location;
use App\Models\User;
use App\Models\Video;
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

        Faq::create([
            'question' => 'Czy potrzebuję skierowania od lekarza?',
            'answer' => 'W Polsce możesz skorzystać z usług fizjoterapeuty zarówno z, jak i bez skierowania. Skierowanie wymagane jest tylko do refundowanych przez NFZ usług. Na wizytę prywatną zapraszamy pacjentów bez skierowania. Rekomendujemy jednak konsultację z lekarzem przed rozpoczęciem terapii.',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        Faq::create([
            'question' => 'Jak przebiegać będzie moja pierwsza wizyta?',
            'answer' => 'Pierwsza wizyta to spotkanie diagnostyczne, podczas którego poznamy Ci się lepiej poznamy, szczegółowo zbadamy problem, przeprowadzamy testy funkcjonalne oraz omówimy plan terapii. Fizjoterapeuta opowie Ci o przyczynach dolegliwości i zaproponuje dostosowany do Ciebie schemat leczenia. Czas: około 90 minut.',
            'is_active' => true,
            'sort_order' => 5,
        ]);

        Video::create([
            'title' => 'Mobilizacja barku - technika manualna',
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'description' => 'Demonstracja profesjonalnej techniki mobilizacji stawu barkowego dla pacjentów z ograniczonym zakresem ruchu.',
        ]);

        Video::create([
            'title' => 'Ćwiczenia stabilizacyjne kregosłupa',
            'url' => 'https://www.youtube.com/watch?v=9bBny7K1-s0',
            'description' => 'Zestaw ćwiczeń do wzmacniania mięśni głębokich stabilizujących kregosłup w warunkach domowych.',
        ]);

        Video::create([
            'title' => 'Oddech przeponowy - klucz do regeneracji',
            'url' => 'https://www.youtube.com/watch?v=ZXsQAXx_ao0',
            'description' => 'Nauczę Cię techniki prawidłowego oddychania, która wspomaga regenerację i zmniejsza napięcie mięśni.',
        ]);

        Location::create([
            'name' => 'Gabinet Centrum',
            'address' => 'ul. Zdrowa 10, 31-999 Kraków',
            'city' => 'Kraków',
            'map_link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2561.123456!2d19.949!3d50.064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTDCsDAzJzUwLjMiTiAxOcKwNTYnNDIuOCJF!5e0!3m2!1spl!2spl!4v1234567890',
            'hours' => "Poniedziałek-Piątek: 8:00–18:00\nSobota: 9:00–13:00\nNiedziela: zamknięte",
        ]);

        Location::create([
            'name' => 'Gabinet Północ',
            'address' => 'ul. Sprawności 5, 31-888 Kraków',
            'city' => 'Kraków',
            'map_link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2561.654321!2d19.934!3d50.082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTDCsDA0JzU1LjAiTiAxOcKwNTYnMDUuNCJF!5e0!3m2!1spl!2spl!4v0987654321',
            'hours' => "Poniedziałek-Piątek: 9:00–17:00\nSobota: 10:00–14:00\nNiedziela: zamknięte",
        ]);
    }
}
