# Luna - Laravel API Project

## 1. Clone & Preparing
```
cd project_folder
git clone https://github.com/vdetman/luna.git .
composer install
```

## 2. ENV
```
cp .env.example .env
```
- DB_HOST=db
- API_TOKENS=SomeSecureTokenWhichWillBeUsedByApi

## 3. Docker

### Сборка
```
docker compose up -d
```

### Миграции
```
docker compose run --rm app sh -c "php artisan migrate"
```

### Заполнить тестовыми данными
```
docker compose run --rm app sh -c "php artisan migrate --seed"
```

### Если нужно перезаполнить тестовыми данными
```
docker compose run --rm app sh -c "php artisan migrate:fresh --seed"
```

Welcome to http://localhost:8080/api/documentation
