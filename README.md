# Тестовое задание: Структура компании

Краткое описание задачи: Реализовать веб-приложение позволяющее управлять отделами и сотрудниками предприятия, а также просматривать их связи.

## Окружение

Для запуска требуется:
1. Docker compose
2. npm
3. Composer

## Установка и сборка

Клонирование проекта:
```
git clone git@github.com:maldinsky/laravel-company-structure-test-task.git
```

Перейти в папку с проектом и запустить:

```
docker-compose up --build
```

Перейти в папку app:
1. переименовать .example.env в .env, проверить правильность конфигурации.
2. выполнить команды:

```
composer install
npm install
npm run watch
```

Зайти в контейнер:

```
docker-compose exec php-fpm bash
```

И выполните команды:
```
php artisan key:generate
php artisan migrate
```