````md
# Laravel API Project

This is a simple Laravel API project with authentication and CRUD operations for **Companies** and **Contacts**. It uses **Laravel Sanctum** for API authentication.

---

## Table of Contents

- [Project Setup](#project-setup)
- [API Routes](#api-routes)
- [Example API Requests](#example-api-requests)
- [Repository](#repository)
- [Notes](#notes)

---

## Project Setup

Follow these steps to set up and run the project locally:

### 1. Clone the repository

```bash
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name
composer install
cp .env.example .env
````

### 2. Configure Database

Update the following in your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3. Run setup commands

```bash
php artisan key:generate
php artisan migrate
php artisan serve
```

The API will be available at:

```
http://127.0.0.1:8000
```

---

## API Routes & Example Requests

### Login (Get Sanctum Token)

```bash
curl -X POST http://127.0.0.1:8000/api/login \
-H "Content-Type: application/json" \
-d '{"email":"user@example.com","password":"password"}'
```

Example response:

```json
{
    "token": "your_sanctum_token_here"
}
```

---

### Create a Company (Authenticated)

```bash
curl -X POST http://127.0.0.1:8000/api/companies \
-H "Content-Type: application/json" \
-H "Authorization: Bearer your_sanctum_token_here" \
-d '{"name": "Acme Corp", "email": "info@acme.com"}'
```

---

### Get Contacts for a Company

```bash
curl -X GET http://127.0.0.1:8000/api/companies/1/contacts \
-H "Authorization: Bearer your_sanctum_token_here"
```

---

## Repository

```
https://github.com/your-username/your-repo-name
```

---

## Notes

* Ensure Laravel Sanctum is installed and configured.
* All protected routes require the `Authorization: Bearer <token>` header.
* Replace placeholder values (database name, credentials, repo link, token) with your actual values.

```
```
