# Luna - Laravel API Project

Laravel API проект с Docker конфигурацией для разработки.

## Важно
В .env:
- DB_HOST=db
- API_TOKENS=SomeSecureTokenWhichWillBeUsedByApi

## Старт Docker

### 1. Сборка
```
docker compose up -d
```

### 2. Миграции
```
docker compose run --rm app sh -c "php artisan migrate"
```

### 3. Заполнить тестовыми данными
```
docker compose run --rm app sh -c "php artisan migrate --seed"
```

### 3.1. Перезаполнить тестовыми данными
```
docker compose run --rm app sh -c "php artisan migrate:fresh --seed"
```
