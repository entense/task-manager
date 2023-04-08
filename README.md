# Task Manager
Приложение с открытым API для создания задач и назначения их пользователям на Laravel
## Установка

- Склонировать проект на локальную машину, войти в папку проекта
```bash
git clone git@github.com:entense/task-manager.git
cd task-manager/
```
- Установить все зависимости приложения через
```bash
composer update
```
- Создать файл .env в корне проекта с содержимом из .env.example
```bash
cp .env.example .env
```
- Настроить подключение к базе данных и информацию о приложении в файле .env
```
APP_NAME=
APP_URL=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
- Установить ключ приложения
```bash
php artisan key:generate
```
- Запустить скрипт генерации таблиц базы данных
```bash
php artisan migrate
```
- Сгенерировать документацию swagger, она будет доступна по пути {APP_URL}/api/v1/documentation
```bash
php artisan l5-swagger:generate
```
- Создать пользователя или администратора с токеном
```bash
php artisan user:create
```
- Запустить веб-сервер
```bash
php artisan serve
```


