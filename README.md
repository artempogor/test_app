# Тестовое задание:

- Написать CRUD для создания новостей
Read - открыты для всех
Create, Update, Delete - закрыты авторизацией
- Авторизация JWT
- Регистрация

Требования:

1. Код должен быть оформлен с учетом PSR
2. Все значения должны быть строготипизированны, как принимаемые так и отдаваемые.
3. Контроллеры "тонкие" вся бизнеслогика в сервисе, работа с моделью через репозиторий.
4. Код должен быть статически понятен и описан. Использование одного из статанализаторов.
-------------------------------------------------------------------------------------------------------------------------
Помимо тестового задания реализую в проекте паттерны, пробую что то новое
-------------------------------------------------------------------------------------------------------------------------
### Для запуска приложения в терминале выполните команду `./vendor/bin/sail up`
### Сконфигурируйте env. `cp .env.example .env`
### В контейнере `new-application_laravel.test_1` выполните команду `php artisan migrate`
### Статически анализатор можно запустить в контейнере командой в терминале `vendor/bin/phpstan analyse app`
### Тестирование эндпоинтов можно производить из клиента в папке [http](http), файл [test.http](http%2Ftest.http) предварительно определить переменные в [http-client.env.json](http%2Fhttp-client.env.json) или с помощью swagger 
### Тестирование демонстарации паттернов можно производить из клиента в папке [http](http), файл [test-pattern.http](http%2Ftest-pattern.http)
### http-test - `php artisan migrate --env=testing`,`php artisan test --env=testing`, описание также приведенно в веб-интерфейсе
