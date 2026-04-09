# FIZJOTERAPIA - Strona Gabinetu Fizjoterapii

Nowoczesna strona internetowa gabinetu fizjoterapii zbudowana z **Laravel 12**, **Filament 5** i **Tailwind CSS 4**. Projekt łączy responsywny front-end z zaawansowanym panelem administracyjnym dla zarządzania treścią, pacjentami i wpisami.

## 🎯 O Projekcie

Strona gabinetu fizjoterapii "Fizjoterapia - Modern Zen & Medical Excellence" oferuje:
- **Blog edukacyjny** z artykułami o fizjoterapii, profilaktyce i rehabilitacji
- **Sekcję YouTube** z materiałami edukacyjnymi dla pacjentów
- **Informacje o placówkach** z mapami i godzinami otwarcia
- **Formularz kontaktowy** do rezerwacji i zapytań
- **Newsletter** w stopce dla newsletter'owych subskrybentów
- **FAQ** z odpowiedziami na częste pytania pacjentów
- **System komentarzy** z moderacją przez administratora
- **Monitorowanie** popularności wpisów i sesji pacjentów

## 🛠 Stack Techniczny

| Technologia | Wersja | Zastosowanie |
|---|---|---|
| **PHP** | 8.4 | Backend |
| **Laravel** | 12 | Framework aplikacji |
| **Filament** | 5 | Panel administracyjny |
| **Tailwind CSS** | 4 | Utility-first CSS framework |
| **Alpine.js** | - | Interaktywność frontend'u |
| **Pest** | 4 | Testowanie automatyczne |
| **SQLite/MySQL** | - | Baza danych |
| **Vite** | - | Bundler dla JS/CSS |

## 📦 Główne Funkcjonalności

### 🌐 Front-end (Publiczny)
- **Strona główna** - Hero section, sekcja "O mnie", najnowsze wpisy
- **Blog** - Lista wpisów z filtrowaniem po kategoriach, wyszukiwarka, sortowanie
- **Strona YouTube** - Osadzone filmy edukacyjne
- **Strona Kontakt** - Formularz kontaktowy + lokalizacje gabinetów z mapami
- **Strona O mnie** - Biogram, specjalizacje, proces terapii
- **Komentarze** - System dyskusji pod wpisami z moderacją
- **Newsletter** - Subskrypcja w stopce
- **Dark Mode** - Przełącznik trybu jasny/ciemny
- **Responsive Design** - Mobile-first, optymalne na wszystkich urządzeniach
- **SEO** - Canonical tags, meta robots, structured data, performant images

### 🔐 Panel Administracyjny (Filament)
- **Wpisy** - Tworzenie, edycja, publikacja, media (zdjęcia/galerie)
- **Kategorie** - Organizacja wpisów
- **Filmy** - Zarządzanie materiałami YouTube
- **Placówki** - Informacje o lokalizacjach, godzinach, mapach
- **FAQ** - Zarządzanie pytaniami i odpowiedziami
- **Komentarze** - Moderacja komentarzy pacjentów
- **Wiadomości** - Wysłane formularz kontaktowe
- **Newsletter** - Lista subskrypcji
- **Użytkownicy** - Zarządzanie dostępem i uprawnieniami
- **Role i Permisje** - Kontrola dostępu do zasobów
- **Statystyki** - Dashboard z metrykami (unikalni pacjenci, popularne wpisy, pending komentarze)
- **Dziennik Zdarzeń** - Audyt zmian w systemie
- **Core Web Vitals** - Monitoring wydajności (LCP, CLS, INP)

### 📊 System Metryki
- **Unikalnych Sesji** - Tracking pacjentów
- **Views Count** - Popularność wpisów
- **Reading Time** - Szacunkowy czas czytania
- **Pending Comments** - Liczba komentarzy do zatwierdzenia
- **Core Web Vitals** - Monitoring LCP, CLS, INP

## 🚀 Instalacja

### Wymagania
- PHP 8.4+
- Composer
- Node.js 18+
- SQLite lub MySQL

### Krok po kroku

```bash
# Klonuj repozytorium
git clone https://github.com/mnianek/ostrowskifizjioterapia.git
cd blog-2

# Zainstaluj zależności PHP
composer install

# Zainstaluj zależności JavaScript
npm install

# Skopiuj plik .env
cp .env.example .env

# Wygeneruj klucz aplikacji
php artisan key:generate

# Migracja bazy danych
php artisan migrate

# Załaduj dane seed'a
php artisan db:seed

# Link do storage
php artisan storage:link

# Zainstaluj FrontendCMS
php artisan boost:install

# Build assets
npm run build
```

## 🏃 Uruchomienie

### Nie-produkcja (Development)

```bash
composer run dev
```

To uruchamia jednocześnie:
- Laravel dev server na `http://localhost:8000`
- Queue worker
- Log viewer
- Vite dev server

### Produkcja

```bash
# Build assets
npm run build

# Uruchom aplikację
php artisan serve

# Opcjonalnie - uruchom queue worker
php artisan queue:work
```

## 🧪 Testowanie

### Uruchom wszystkie testy
```bash
php artisan test
```

### Testy Feature (integracyjne)
```bash
php artisan test tests/Feature
```

### Testy Unit
```bash
php artisan test tests/Unit
```

### Coverage Report
```bash
php artisan test --coverage
```

### Znane Testy
- ✅ 56 Feature tests
- ✅ 5 Unit tests
- ✅ 226+ assertions
- ✅ 100% passing

## 🎨 Konfiguracja Design Systemu

### Kolory (Tailwind Config)
```javascript
// Primary: Sky Blue (#0ea5e9)
// Secondary: Sage Green (#7d9d85)
// Text: Ink (#1a1a1a) / Paper (#f9f7f2)
// Accents: Rose, Amber, Emerald
```

### Komponenty UI
- `x-ui.button` - Przyciski (primary, secondary, quiet)
- `x-ui.input` - Pola tekstowe z validacją
- `x-ui.textarea` - Obszary tekstu
- `x-ui.badge` - Odznaki statusu
- `x-ui.card` - Karty treści
- `x-ui.section` - Sekcje strony

## 📁 Struktura Projektu

```
blog-2/
├── app/
│   ├── Filament/              # Panel administracyjny
│   │   ├── Resources/         # Zasoby (Post, Category, itp)
│   │   ├── Pages/             # Strony (Dashboard)
│   │   └── Widgets/           # Widgety (Stats)
│   ├── Http/
│   │   ├── Controllers/       # Kontrolery publiczne
│   │   ├── Requests/          # Form requests
│   │   └── Middleware/        # Middleware
│   ├── Models/                # Eloquent modele
│   ├── Policies/              # Authorization policies
│   ├── Services/              # Business logic
│   └── Observers/             # Model observers
├── resources/
│   ├── views/                 # Szablony Blade
│   │   ├── pages/             # Publiczne strony
│   │   ├── posts/             # Strony wpisów
│   │   ├── components/        # Komponenty Blade
│   │   └── partials/          # Części (nav, footer)
│   ├── css/
│   │   └── app.css            # Design system + Tailwind
│   └── js/
│       └── app.js             # Główny JS bundle
├── database/
│   ├── migrations/            # Migracje bazy
│   ├── seeders/               # Seed'y danych
│   └── factories/             # Model factories
├── routes/
│   ├── web.php                # Publiczne trasy
│   └── console.php            # Artisan commands
├── tests/
│   ├── Feature/               # Testy integracyjne
│   └── Unit/                  # Testy jednostkowe
└── config/
    ├── app.php
    ├── database.php
    ├── filament-shield.php
    └── ...                   # Inne konfiguracje
```

## 🔐 Domyślne Dane Logowania (Development)

**Panel Administracyjny:** `/panel`

```
Email: jczerniecki@icloud.com
Hasło: password123
Rola: super_admin (pełny dostęp)
```

**Testowy Użytkownik:**
```
Email: test@example.com
Hasło: password (Laravel default)
```

## 📝 Seed'y Danych

Baza zawiera:
- **5 FAQ** - Pytania i odpowiedzi o usługach
- **3 Filmy YouTube** - Materiały edukacyjne
- **2 Placówki** - Lokalizacje gabinetu
- **1 Użytkownik Admin** - jczerniecki@icloud.com
- **108 Permisji** - Kontrola dostępu do zasobów

Załaduj seed'y:
```bash
php artisan db:seed
# lub
php artisan migrate:fresh --seed  # Reset + seed
```

## ✏️ Formatowanie Kodu

### Pint (PHP formatter)
```bash
# Format pojedynczego pliku
vendor/bin/pint app/Models/Post.php

# Format całego katalogu
vendor/bin/pint

# Dry-run (pokazuje zmiany bez modyfikacji)
vendor/bin/pint --test
```

### Pre-commit Hook
```bash
git config core.hooksPath .githooks
chmod +x .githooks/pre-commit
```

## 🔄 Git Workflow

```bash
# Utwórz feature branch
git checkout -b feature/nowa-funkcja

# Pracuj nad kodem
# ...

# Stage zmiany
git add .

# Commit (hook automatycznie formatuje PHP)
git commit -m "Dodaj nową funkcję"

# Push do GitHub
git push origin feature/nowa-funkcja
```

## 📊 Monitoring i Analityka

### Core Web Vitals
- **LCP** (Largest Contentful Paint) < 2.5s
- **CLS** (Cumulative Layout Shift) < 0.1
- **INP** (Interaction to Next Paint) < 200ms

### Metryki Sesji
- Unikalnych pacjentów (sesji)
- Najpopularniejszych wpisów
- Średniego czasu czytania

```bash
# Pobierz Core Web Vitals
GET /api/vitals

# Wyślij metryki
POST /api/vitals
```

## 🚀 Deployment

### Hosting (Production)
```bash
# SSH do serwera
ssh user@server.com

# Klonuj/Pull latest code
git clone ... / git pull origin main

# Zainstaluj zależności
composer install --no-dev
npm install --production

# Build assets
npm run build

# Cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migracja bazy
php artisan migrate --force

# Restart aplikacji
systemctl restart laravel-app
php-fpm restart
```

### Zmienne Środowiskowe
```bash
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=fizjoterapia_db
DB_USERNAME=root
DB_PASSWORD=***
MAIL_DRIVER=smtp
```

## 🐛 Deploy Troubleshooting

**Błędy permisji:**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data /path/to/app
```

**Cache stary:**
```bash
php artisan cache:clear
php artisan view:clear
npm run build  # !important
```

**Błędy migracji:**
```bash
php artisan migrate:rollback
php artisan migrate --force
```

## 📚 Dokumentacja

- **Laravel**: https://laravel.com/docs
- **Filament**: https://filamentphp.com
- **Tailwind**: https://tailwindcss.com
- **Pest**: https://pestphp.com

## 👥 Autorzy

- **Projektant/Developer**: Jan Czerniecki

## 📄 Licencja

MIT License - patrz [LICENSE](LICENSE)

## 🤝 Wsparcie

Zgłaszaj błędy poprzez GitHub Issues: 
https://github.com/mnianek/ostrowskifizjioterapia/issues

---

**Ostatnia aktualizacja:** 10 kwietnia 2026  
**Wersja:** 1.0.0 (Minimum Feature Complete)

