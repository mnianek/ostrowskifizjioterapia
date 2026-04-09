# Minimum do pelnego bloga - checklista

Data: 2026-04-07

## 1. Bezpieczenstwo i publikacja (krytyczne)
- [x] Publiczna lista wpisow pokazuje tylko opublikowane posty (`is_published = true` lub `status = published`).
- [x] Publiczny podglad posta blokuje szkice (404 lub 403 dla nieopublikowanych).
- [x] Trasy tworzenia, edycji i usuwania postow sa chronione (`auth` + role/policy).
- [x] Akcje administracyjne (posty, komentarze, kategorie) sa dostepne tylko w panelu admin.
- [x] Walidacja formularzy jest kompletna (title, slug unique, content length, anty-spam).
- [x] Publiczne formularze maja rate limiting (komentarze, kontakt, newsletter).

## 2. Model tresci i workflow redakcyjny
- [x] Wpis ma: tytul, slug, lead, tresc, autora.
- [x] Kategorie istnieja i dzialaja.
- [x] Statusy redakcyjne sa spojne (`draft`, `published`, opcjonalnie `scheduled`).
- [x] Harmonogram publikacji (`published_at`) jest respektowany w listach i podgladzie.
- [x] Slugi sa unikalne i maja spojne zasady tworzenia.
- [x] Excerpt/meta description jest uzupelniony na potrzeby SEO.
- [x] Widoczne jest `updated_at` (lub prosty changelog) dla czytelnika.

## 3. Funkcje blogowe na froncie
- [x] Lista wpisow z paginacja.
- [x] Wyszukiwarka wpisow.
- [x] Sortowanie (najnowsze, popularne, komentarze).
- [x] Filtr po kategorii.
- [x] Widok pojedynczego wpisu.
- [x] Licznik wyswietlen.
- [x] Powiazane wpisy pod artykulem (minimum 3).
- [x] Strony bledow 404 i 500 zgodne ze stylem serwisu.
- [x] RSS feed (`/feed`).

## 4. Komentarze i spolecznosc
- [x] Dodawanie komentarzy i odpowiedzi.
- [x] Moderacja (pending i approved).
- [x] Lajki komentarzy (zalogowany + gosc).
- [x] Przypinanie komentarza.
- [x] Anty-spam dla komentarzy (honeypot/captcha/rate limit).
- [x] Zglaszanie komentarza (report) i usuwanie przez admina.
- [x] Krotkie zasady moderacji widoczne przy komentarzach.

## 5. SEO minimum
- [x] Dynamiczny `title` i `meta description` dla strony wpisu.
- [x] Canonical URL dla wpisow.
- [x] Open Graph i Twitter Card (title, description, image).
- [x] `sitemap.xml` dla wpisow i stron statycznych.
- [x] Poprawny `robots.txt` dla produkcji.
- [x] Dane strukturalne JSON-LD (`BlogPosting`).
- [x] Strategia SEO dla paginacji listy wpisow.

## 6. Performance i dostepnosc
- [x] Obrazy maja poprawne rozmiary i lazy loading.
- [x] Krytyczne zasoby (fonty, css, js) sa zoptymalizowane.
- [x] Lighthouse: sensowne minimum dla Performance, Accessibility i SEO.
- [x] Kontrast, focus states, alt i aria-label sa poprawne.
- [x] Core Web Vitals sa monitorowane po wdrozeniu.

## 7. Analityka i produkt
- [x] Analityka (Plausible/GA) z eventami dla CTA, komentarzy i newslettera.
- [x] Widocznosc najpopularniejszych tresci i zrodel ruchu.
- [x] Prosty dashboard KPI (odslony, CTR, newsletter conversion).

## 8. Zaufanie i legal
- [x] Strony: Polityka prywatnosci, Cookies, Kontakt, opcjonalnie Regulamin.
- [x] Zgody tam, gdzie sa wymagane prawnie.
- [x] Informacja o przetwarzaniu danych przy formularzach.

## 9. Niezawodnosc i operacje
- [x] Backup bazy i mediow (automatyczny) + test odtworzenia.
- [x] Logowanie bledow i alerty (np. Sentry/Flare).
- [x] Rozdzielone srodowiska local/staging/production.
- [x] Proces wdrozenia z minimalnym downtime.

## 10. Testy (minimum jakosci)
- [x] Testy feature: lista opublikowanych, podglad opublikowanego, blokada szkicow.
- [x] Testy uprawnien dla tworzenia/edycji/publikacji.
- [x] Testy komentarzy i lajkow sa juz obecne.
- [x] Testy SEO smoke (status, meta, canonical).
- [x] Testy formularzy kontakt i newsletter.

## 11. Testy Pest (rozszerzenie)
- [x] Testy unit dla modeli (mutatory, relacje, scope, walidacja).
- [x] Testy feature dla publicznego bloga (lista, wpis, filtry, paginacja).
- [x] Testy uprawnien (401/403/200) dla tworzenia i edycji tresci.
- [x] Testy komentarzy: dodanie, odpowiedz, moderacja, like guest/user.
- [x] Testy regresji dla krytycznych bugow (snapshoty lub reprodukcje).
- [x] Pokrycie krytycznych sciezek min. 70% (`pest --coverage`).
- [x] Uruchamianie rownolegle w CI (`pest --parallel`).

## 12. Laravel Pint (jakosc kodu)
- [x] Konfiguracja projektu w `pint.json`.
- [x] `vendor/bin/pint` uruchamiany w CI przed merge.
- [x] Hook pre-commit (opcjonalnie) wymusza formatowanie.
- [x] Sprawdzanie tylko zmienionych plikow w szybkiej sciezce.
- [x] Blokada merge przy bledach formatu.

## 13. SEO zaawansowane
- [x] Dynamiczne OG image per wpis.
- [x] JSON-LD: BlogPosting + BreadcrumbList + Organization.
- [x] Canonical dla paginacji i filtrow (strategia duplicate-content).
- [x] Hreflang dla wersji jezykowych (jesli multi-lang).
- [x] Internal linking: sekcja powiazanych wpisow + kontekstowe linki.
- [x] Monitoring Search Console: crawlowanie, indeksacja, bledy.
- [x] Audyt CWV i stale monitorowanie LCP/CLS/INP.

## 14. Prawdziwy dziennik zdarzen w Filamencie (audit trail)
- [x] Rejestracja zdarzen create/update/delete/publish/unpublish.
- [x] Zapisywane pola: kto, kiedy, co, stare->nowe, IP, user-agent.
- [x] Osobny Resource w Filamencie do przegladania logow.
- [x] Filtrowanie po modelu, uzytkowniku, akcji i zakresie dat.
- [x] Widok szczegolow zmiany (diff) dla pojedynczego wpisu.
- [x] Polityki dostepu: logi tylko dla admin/moderator/audytor.
- [x] Retencja logow i archiwizacja.
- [x] Testy Pest potwierdzajace zapis logu po kazdej akcji admina.

## Status implementacji (2026-04-09)
- Wdrozone: publikacja/szkice, ochrona tras tworzenia wpisow, throttling formularzy, RSS, sitemap, SEO meta+OG+JSON-LD, dynamiczne OG image, hreflang, canonical duplicate-content, monitoring CWV (LCP/CLS/INP), Lighthouse CI, backup automatyczny, runbook operacyjny, testy regresji i unit modeli oraz gate pokrycia 70%.
- Checklista minimum jest domknieta w calosci; dalsze iteracje moga rozszerzac funkcje ponad zakres minimum.

## Priorytet wdrozenia
1. Ograniczyc publiczne posty do opublikowanych i zablokowac szkice.
2. Zabezpieczyc publiczne trasy tworzenia wpisow (`auth` + role/policy).
3. Dodac SEO minimum: title, description, canonical, OG, sitemap.
4. Dodac anty-spam i rate limiting dla komentarzy oraz formularzy.
5. Dodac RSS i sekcje powiazanych wpisow.

## Notatka o ostatnich zmianach UI (logo)
- Wdrozone logo z `public/images` z rozdzialem na motyw jasny i ciemny.
- Dostosowany navbar, aby logo bylo wieksze wizualnie bez stalego zwiekszania wysokosci paska.
- Branding osadzony jako reuzywalny komponent Blade.
