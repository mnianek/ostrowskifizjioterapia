# Minimum do pelnego bloga - checklista

Data: 2026-04-07

## 1. Bezpieczenstwo i publikacja (krytyczne)
- [x] Publiczna lista wpisow pokazuje tylko opublikowane posty (`is_published = true` lub `status = published`).
- [x] Publiczny podglad posta blokuje szkice (404 lub 403 dla nieopublikowanych).
- [x] Trasy tworzenia, edycji i usuwania postow sa chronione (`auth` + role/policy).
- [ ] Akcje administracyjne (posty, komentarze, kategorie) sa dostepne tylko w panelu admin.
- [ ] Walidacja formularzy jest kompletna (title, slug unique, content length, anty-spam).
- [x] Publiczne formularze maja rate limiting (komentarze, kontakt, newsletter).

## 2. Model tresci i workflow redakcyjny
- [x] Wpis ma: tytul, slug, lead, tresc, autora.
- [x] Kategorie istnieja i dzialaja.
- [ ] Statusy redakcyjne sa spojne (`draft`, `published`, opcjonalnie `scheduled`).
- [ ] Harmonogram publikacji (`published_at`) jest respektowany w listach i podgladzie.
- [ ] Slugi sa unikalne i maja spojne zasady tworzenia.
- [ ] Excerpt/meta description jest uzupelniony na potrzeby SEO.
- [ ] Widoczne jest `updated_at` (lub prosty changelog) dla czytelnika.

## 3. Funkcje blogowe na froncie
- [x] Lista wpisow z paginacja.
- [x] Wyszukiwarka wpisow.
- [x] Sortowanie (najnowsze, popularne, komentarze).
- [x] Filtr po kategorii.
- [x] Widok pojedynczego wpisu.
- [x] Licznik wyswietlen.
- [x] Powiazane wpisy pod artykulem (minimum 3).
- [ ] Strony bledow 404 i 500 zgodne ze stylem serwisu.
- [x] RSS feed (`/feed`).

## 4. Komentarze i spolecznosc
- [x] Dodawanie komentarzy i odpowiedzi.
- [x] Moderacja (pending i approved).
- [x] Lajki komentarzy (zalogowany + gosc).
- [x] Przypinanie komentarza.
- [ ] Anty-spam dla komentarzy (honeypot/captcha/rate limit).
- [ ] Zglaszanie komentarza (report) i usuwanie przez admina.
- [ ] Krotkie zasady moderacji widoczne przy komentarzach.

## 5. SEO minimum
- [x] Dynamiczny `title` i `meta description` dla strony wpisu.
- [x] Canonical URL dla wpisow.
- [x] Open Graph i Twitter Card (title, description, image).
- [x] `sitemap.xml` dla wpisow i stron statycznych.
- [ ] Poprawny `robots.txt` dla produkcji.
- [x] Dane strukturalne JSON-LD (`BlogPosting`).
- [ ] Strategia SEO dla paginacji listy wpisow.

## 6. Performance i dostepnosc
- [ ] Obrazy maja poprawne rozmiary i lazy loading.
- [ ] Krytyczne zasoby (fonty, css, js) sa zoptymalizowane.
- [ ] Lighthouse: sensowne minimum dla Performance, Accessibility i SEO.
- [ ] Kontrast, focus states, alt i aria-label sa poprawne.
- [ ] Core Web Vitals sa monitorowane po wdrozeniu.

## 7. Analityka i produkt
- [ ] Analityka (Plausible/GA) z eventami dla CTA, komentarzy i newslettera.
- [ ] Widocznosc najpopularniejszych tresci i zrodel ruchu.
- [ ] Prosty dashboard KPI (odslony, CTR, newsletter conversion).

## 8. Zaufanie i legal
- [ ] Strony: Polityka prywatnosci, Cookies, Kontakt, opcjonalnie Regulamin.
- [ ] Zgody tam, gdzie sa wymagane prawnie.
- [ ] Informacja o przetwarzaniu danych przy formularzach.

## 9. Niezawodnosc i operacje
- [ ] Backup bazy i mediow (automatyczny) + test odtworzenia.
- [ ] Logowanie bledow i alerty (np. Sentry/Flare).
- [ ] Rozdzielone srodowiska local/staging/production.
- [ ] Proces wdrozenia z minimalnym downtime.

## 10. Testy (minimum jakosci)
- [x] Testy feature: lista opublikowanych, podglad opublikowanego, blokada szkicow.
- [ ] Testy uprawnien dla tworzenia/edycji/publikacji.
- [x] Testy komentarzy i lajkow sa juz obecne.
- [x] Testy SEO smoke (status, meta, canonical).
- [ ] Testy formularzy kontakt i newsletter.

## 11. Testy Pest (rozszerzenie)
- [ ] Testy unit dla modeli (mutatory, relacje, scope, walidacja).
- [ ] Testy feature dla publicznego bloga (lista, wpis, filtry, paginacja).
- [ ] Testy uprawnien (401/403/200) dla tworzenia i edycji tresci.
- [ ] Testy komentarzy: dodanie, odpowiedz, moderacja, like guest/user.
- [ ] Testy regresji dla krytycznych bugow (snapshoty lub reprodukcje).
- [ ] Pokrycie krytycznych sciezek min. 70% (`pest --coverage`).
- [ ] Uruchamianie rownolegle w CI (`pest --parallel`).

## 12. Laravel Pint (jakosc kodu)
- [x] Konfiguracja projektu w `pint.json`.
- [ ] `vendor/bin/pint` uruchamiany w CI przed merge.
- [ ] Hook pre-commit (opcjonalnie) wymusza formatowanie.
- [ ] Sprawdzanie tylko zmienionych plikow w szybkiej sciezce.
- [ ] Blokada merge przy bledach formatu.

## 13. SEO zaawansowane
- [ ] Dynamiczne OG image per wpis.
- [x] JSON-LD: BlogPosting + BreadcrumbList + Organization.
- [ ] Canonical dla paginacji i filtrow (strategia duplicate-content).
- [ ] Hreflang dla wersji jezykowych (jesli multi-lang).
- [ ] Internal linking: sekcja powiazanych wpisow + kontekstowe linki.
- [ ] Monitoring Search Console: crawlowanie, indeksacja, bledy.
- [ ] Audyt CWV i stale monitorowanie LCP/CLS/INP.

## 14. Prawdziwy dziennik zdarzen w Filamencie (audit trail)
- [x] Rejestracja zdarzen create/update/delete/publish/unpublish.
- [x] Zapisywane pola: kto, kiedy, co, stare->nowe, IP, user-agent.
- [x] Osobny Resource w Filamencie do przegladania logow.
- [x] Filtrowanie po modelu, uzytkowniku, akcji i zakresie dat.
- [x] Widok szczegolow zmiany (diff) dla pojedynczego wpisu.
- [x] Polityki dostepu: logi tylko dla admin/moderator/audytor.
- [ ] Retencja logow i archiwizacja.
- [x] Testy Pest potwierdzajace zapis logu po kazdej akcji admina.

## Status implementacji (2026-04-07)
- Wdrozone: publikacja/szkice, ochrona tras tworzenia wpisow, throttling formularzy, RSS, sitemap, SEO meta+OG+JSON-LD, powiazane wpisy, audit trail w Filamencie, nowe testy Pest, konfiguracja Pint i workflow quality.
- Pozostale elementy wymagaja dalszych iteracji (analityka zewnetrzna, monitoring CWV, legal pages, backup/ops i pelne pokrycie testami wszystkich scenariuszy).

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
