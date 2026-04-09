# Operations runbook

## Environments

Use three separate environments with independent variables and databases:
- local: APP_ENV=local, APP_DEBUG=true
- staging: APP_ENV=staging, APP_DEBUG=false
- production: APP_ENV=production, APP_DEBUG=false

Minimum environment separation checklist:
- separate DATABASE_URL / DB_* credentials per environment
- separate APP_KEY per environment
- separate LOG_SLACK_WEBHOOK_URL per environment
- separate BACKUP_ARCHIVE_PASSWORD per environment

## Backup automation

This project uses `spatie/laravel-backup`.

Scheduled commands are configured in `routes/console.php`:
- `backup:run --only-db --disable-notifications` (02:45)
- `backup:run --only-files --disable-notifications` (03:00)
- `backup:clean` (03:20)
- `backup:monitor` (03:30)

Manual run:

```bash
php artisan backup:run
```

Verify latest archive contains SQL dump:

```bash
php artisan backup:verify-latest
```

## Restore test procedure

1. Download latest backup archive from configured disk (`local` or object storage).
2. Unzip archive to temporary directory.
3. Restore database dump (`.sql` or `.sql.gz`) to restore target.
4. Restore uploaded media from archive (`storage/app/public`).
5. Run smoke checks:

```bash
php artisan migrate:status
php artisan test tests/Feature/BlogPublicationAndSeoTest.php
php artisan test tests/Feature/WebVitalsMonitoringTest.php
```

## Error logging and alerts

Use `LOG_CHANNEL=stack` with `LOG_STACK=single,slack` in staging/production.

Required variables:
- LOG_SLACK_WEBHOOK_URL
- LOG_LEVEL=error (recommended for production)

## Minimal-downtime deployment (Railway)

Recommended rollout sequence:
1. Build image and run `composer install --no-dev --optimize-autoloader`.
2. Run migrations with force:

```bash
php artisan migrate --force
```

3. Clear and warm caches:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

4. Health check `/up` before switching traffic.

## Search Console and CWV monitoring

Set up Google Search Console for production domain and monitor:
- indexing coverage
- crawl anomalies
- sitemap status

Core Web Vitals are collected by frontend (`web-vitals`) and persisted through `/web-vitals` endpoint.
Use saved metrics (`web_vital_metrics`) for weekly LCP/CLS/INP trend review.

## Lighthouse baseline

Use Lighthouse CI in CI/CD for regression checks on key routes:
- /
- /blog
- /blog/{slug}

Recommended thresholds:
- Performance >= 80
- Accessibility >= 90
- SEO >= 90
