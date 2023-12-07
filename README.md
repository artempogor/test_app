# Тестовое задание

### Для запуска приложения в терминале выполните команду `./vendor/bin/sail up`
### Сконфигурируйте env. `cp .env.example .env`
### В контейнере `new-application_laravel.test_1` выполните команду `php artisan migrate`
### Статически анализатор можно запустить в контейнере командой в терминале `vendor/bin/phpstan analyse app`
### Тестирование эндпоинтов можно производить из клиента в папке [http](http), файл [test.http](http%2Ftest.http) предварительно определить переменные в [http-client.env.json](http%2Fhttp-client.env.json)