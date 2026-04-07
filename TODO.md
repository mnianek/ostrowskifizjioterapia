com# TODO - Przebudowa bloga do strony gabinetu fizjoterapii

## Faza 1: Model danych i migracje (blokuje dalsze kroki)
- [x] Dodać migrację `categories` oraz kolumnę `category_id` w `posts` (1 wpis -> 1 kategoria, FK + indeks).
- [x] Dodać migrację rozszerzającą `posts` o `excerpt`, `published_at`, `image_path` (zachować kompatybilność z istniejącym `photo` na czas przejściowy).
- [x] Dodać migracje `videos` (`title`, `url`, `description`) i `locations` (`name`, `address`, `map_link`, `hours`).
- [x] Uzupełnić modele i relacje Eloquent: Post belongsTo Category; Category hasMany Post; niezależne modele Video i Location.

## Faza 2: Filament 5 (zależy od Fazy 1)
- [x] Rozszerzyć PostResource formularzami w Tabs (np. Podstawowe/Publikacja/Media/SEO), dodać wybór kategorii i nowe pola wpisu.
- [x] Dodać Resources dla Category, Video, Location (form + table + pages List/Create/Edit), korzystając z auto-discovery panelu.
- [x] Zaktualizować kolumny tabeli Post w Filament (kategoria, data publikacji, status publikacji).
- [x] Hotfix: dodać obsługę pola `status` (Szkic/Opublikowany) w modelu, migracji oraz formularzu/tabeli PostResource z kolorami.

## Faza 3: Routing i kontrolery (zależy od Faz 1-2; część równoległa z Fazą 4)
- [x] Zdefiniować trasy nazwane: `/` (`home`), `/blog` (`posts.index`), `/o-mnie` (`pages.about`), `/youtube` (`pages.youtube`), `/kontakt` (`pages.contact`).
- [x] Dodać/rozszerzyć kontrolery: HomeController (hero + latest posts), PostController (lista pozioma + filtrowanie kategorią), PageController (about/youtube/contact).
- [x] Zapewnić, że YouTube pobiera Video i konwertuje URL YouTube do formatu embed przy renderowaniu.
- [x] Zapewnić, że Kontakt pobiera Location i renderuje listę + iframe mapy na podstawie map_link.

## Faza 4: Widoki Blade + Tailwind 4 (zależy od Fazy 3)
- [x] Utworzyć wspólny layout: ciemny pasek nawigacji, biały tekst, logo, aktywne linki i spójny footer.
- [x] Zbudować Home: Hero (nagłówek, zdjęcie, CTA), sekcja O mnie, sekcja Najnowsze wpisy (dynamiczna).
- [x] Przebudować Blog: układ horyzontalny kart (obraz po lewej, treść po prawej), błękitne akcenty `#3498db` dla linków/dat, filtr kategorii.
- [x] Dodać strony About/YouTube/Contact zgodnie z przeznaczeniem i jednolitym stylem gabinetu.

## Faza 5: Weryfikacja i porządki
- [x] Uruchomić migracje, sprawdzić integralność FK i formularze admina.
- [x] Zweryfikować responsywność (mobile/desktop), nawigację oraz osadzanie YouTube i mapy.
- [x] Przejść przez podstawowe testy feature/manual: listy, szczegóły wpisu, filtrowanie, CRUD w Filament.

## Decyzje projektowe
- [x] Relacja kategorii: jeden wpis ma jedną kategorię (`posts.category_id`).
- [x] URL YouTube: zapisujemy pełny URL i konwertujemy go do embed podczas renderowania.
- [x] Kontakt: lista gabinetów + iframe mapy z `map_link`.

## Zakres
- [x] In scope: przebudowa publicznego frontu, danych i admina Filament pod stronę gabinetu.
- [x] Out of scope: integracje z zewnętrznym API, system rezerwacji online i rozbudowany SEO schema.

## Faza 6: Analityka i Optymalizacja
- [x] Implementacja licznika unikalnych sesji (Middleware).
- [x] System śledzenia popularności postów (views_count).
- [x] Widget statystyk w panelu administratora.
- [x] Widget Top 5 najpopularniejszych postów na Dashboardzie Filament.
- [x] Auto-slug w formularzu PostResource (reaktywne `title` -> `slug`).
- [x] System komentarzy z moderacją admina.

## Faza 7: Dodatkowe funkcje w filamencie
- [x] Integracja Spatie Media Library w PostResource (upload obrazu przez media collection).
- [x] Ustandaryzowane ikony i kolejność nawigacji zasobów Filament (Posts, Categories, Videos, Locations, Comments).
- [x] Konfiguracja Global Search dla Post, Video i Location (w tym wyszukiwanie po `city`).

## Faza 8: Frontend i wyszukiwanie
- [x] Czas czytania postów.
- [x] Polska lokalizacja dat.
- [x] Wyszukiwarka i zaawansowane filtrowanie (Popularne/Komentowane).

## Faza 9: Upgrade filamentu
- [x] Szczegóły wyników dla Post, Location i Comment.
- [x] Grupowanie wyników przez etykiety modeli (Blog, Placówki, Dyskusje).
- [x] Akcje kontekstowe w wynikach: podgląd posta na stronie i zatwierdzanie komentarzy.
- [x] Miniaturki zdjęć wpisów w wynikach global search.
- [x] Limit wyników global search zwiększony do 10.

- [x] Branding panelu: Sky primary, zwijany sidebar desktop, pełna szerokość treści, sekcje w formularzach, striped tabela postów, badge statusu komentarzy i kolorowe karty statystyk.

## Faza 10: UX i UI bloga
- [x] Błękitna paginacja Tailwind.
- [x] Nawigacja Breadcrumbs.
- [x] Przełącznik Dark Mode (Słońce/Księżyc).

## Faza 11: Kontakt, FAQ i Newsletter
- [x] Formularz kontaktowy i panel zapytań.
- [x] Sekcja FAQ z akordeonem Alpine.js.
- [x] Newsletter w stopce strony.

## Faza 12: Redesign publicznego UI (SaaS)
- [x] Setup design system: tokeny kolorów i typografii w `resources/css/app.css` oraz konfiguracja motywu w `tailwind.config.js`.
- [x] Utworzenie reużywalnych komponentów Blade UI (`button`, `section`, `feature-card`, `testimonial-card`, `badge`, `input`, `textarea`).
- [x] Przebudowa globalnego layoutu publicznego (`resources/views/components/layout.blade.php`) o nowe fonty, tła gradientowe i spójną estetykę light/dark.
- [x] Przebudowa nawigacji (`resources/views/partials/navigation.blade.php`): sticky navbar, glass effect, mobile menu (Alpine.js), ulepszone stany aktywne.
- [x] Przebudowa stopki (`resources/views/partials/footer.blade.php`) z sekcjami linków, newsletterem i komponentami UI.
- [x] Przebudowa strony głównej (`resources/views/pages/home.blade.php`): Hero z CTA, Features Grid, Testimonials/Social Proof, sekcje blog/FAQ i końcowe CTA.
- [x] Walidacja zmian frontendu: build Vite zakończony sukcesem po wdrożeniu redesignu.