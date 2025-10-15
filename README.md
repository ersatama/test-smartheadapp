# 🧠 SmartHead Feedback System

Приложение для обработки заявок пользователей, созданное на **Laravel 12 (PHP 8.4)**.  
Система предоставляет публичный **виджет обратной связи**, API для заявок и административную панель для управления тикетами.

---

## 🚀 Основные возможности

- **Публичный виджет обратной связи** — встраивается через `<iframe>`  
  → `/widget`
- **REST API для заявок**
  - `POST /api/tickets` — создание заявки
  - `GET /api/tickets/statistics` — статистика по тикетам
- **Административная панель**
  - Просмотр и фильтрация заявок
  - Обновление статуса тикетов (`PATCH /admin/tickets/{id}/status`)
- **Аутентификация и роли** через `spatie/laravel-permission`
- **Swagger-документация API**
- **Docker-окружение (PHP + Nginx + MySQL)**
- **Автоматические миграции и сиды** при первом запуске

---

## 🧩 Архитектура и принятые решения

### 1️⃣ Разделение на слои (SOLID)
Проект разделён на логические уровни:
- **Controllers** — только HTTP-логика  
- **Services** — бизнес-правила [CQRS service pattern](https://ru.wikipedia.org/wiki/CQRS)
- **Repositories** — слой доступа к данным  
- **Resources** — API-ответы  
- **Requests** — валидация входных данных  

Такое разделение повышает тестируемость и масштабируемость.

---

### 2️⃣ Laravel как ядро
Laravel выбран благодаря:
- выразительному синтаксису  
- встроенному DI-контейнеру  
- простому маршрутизации  
- мощному ORM (Eloquent)  
- удобной системе валидации  
- готовым инструментам для тестирования  

---

### 3️⃣ Spatie Laravel Permission
Используется [spatie/laravel-permission](https://github.com/spatie/laravel-permission)  
для управления ролями и правами доступа.

- Роли: `manager`, `admin`
- Middleware: `role`, `permission`, `role_or_permission`

> 🔒 Повышает безопасность и устраняет дублирование логики проверки ролей.

---

### 4️⃣ Spatie Media Library
Используется [spatie/laravel-medialibrary](https://github.com/spatie/laravel-medialibrary)  
для загрузки файлов, прикреплённых к тикетам.

> 📎 Упрощает работу с файлами через Eloquent, поддерживает ресайз и удаление.

---

### 5️⃣ Swagger (L5 Swagger)
Добавлена Swagger-документация для REST API.  
Доступна по адресу: [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)

> 🧾 Упрощает тестирование и интеграцию API с внешними системами.

---

### 6️⃣ Ограничение частоты отправки заявок
Реализовано ограничение — не более **одной заявки в сутки**
с одного `email` или `phone`.  
Проверка выполняется в сервисе `TicketCommandService`.

---

### 7️⃣ Docker-инфраструктура
Полностью контейнеризированное окружение.

**Сервисы:**
- `app` — PHP 8.4 FPM + Composer  
- `mysql` — MySQL 8.0  
- `nginx` — веб-сервер  

**Файлы:**
```
Dockerfile
docker-compose.yml
docker/nginx/default.conf
docker/entrypoint.sh
```

**entrypoint.sh:**
```bash
if [ ! -f .env ]; then cp .env.example .env; fi
php artisan key:generate
php artisan migrate --seed --force
exec php-fpm
```

📦 При первом запуске:
- создаётся `.env`
- генерируется ключ
- выполняются миграции и сиды
- создаётся `admin@example.com / password`

---

## 🧰 Технический стек

| Компонент | Версия | Назначение |
|------------|--------|------------|
| PHP | 8.4    | Основной язык |
| Laravel | 12.x   | Бэкенд-фреймворк |
| MySQL | 8.0    | База данных |
| Nginx | latest | Веб-сервер |
| Composer | 2.x    | Управление зависимостями |
| Spatie Media Library | ^11.15 | Работа с файлами |
| Spatie Permission | ^6.21  | Роли и права |
| Swagger (L5) | latest | API документация |
| PHPUnit | ^10    | Тестирование |

---

## ⚙️ Запуск через Docker

```bash
git clone https://github.com/yourname/smartheadapp.git
cd smartheadapp
docker compose up -d --build
```

После запуска:
- Laravel инициализируется автоматически
- Приложение доступно по адресу [http://localhost:8000](http://localhost:8000)
- Swagger — [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)

---

## 🔑 Данные администратора

```
Email: admin@example.com
Password: password
```

---

## 🧪 Тестирование

Запуск unit/feature-тестов:

```bash
docker compose exec app php artisan test
```

---

## 📂 Структура проекта

```
app/
 ├── Http/
 │   ├── Controllers/
 │   │   ├── Api/
 │   │   ├── Admin/
 │   │   ├── Swagger/
 │   │   └── WidgetController.php
 │   ├── Requests/
 │   ├── Resources/
 │   └── Middleware/
 ├── Services/
 ├── Repositories/
 ├── Models/
 └── Providers/
```

---

## 🧱 Особенности реализации

- Код оформлен по **PSR-12** (через Laravel Pint)
- Все запросы валидируются через **Form Requests**
- Использован шаблон **Repository + Service**
- Покрыт **Feature-тестами**: API, виджет, админка
- Автоматический деплой и миграции через Docker Entrypoint

---

## 🧾 How to Deploy (Production)

1. Настроить `.env` с параметрами продакшена  
2. Собрать контейнер:
   ```bash
   docker compose -f docker-compose.prod.yml up -d --build
   ```
3. Выполнить миграции:
   ```bash
   docker compose exec app php artisan migrate --force
   ```
4. Проверить доступность на `https://your-domain.com`

---

