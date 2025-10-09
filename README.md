# ReadMoreBooks Library API (Backend)



## Overview
A RESTful backend API built with **Laravel 11** providing user authentication and persistent booklist storage for the ReadMoreBooks Library Angular app.

## Features
- User registration and authentication via Laravel Sanctum
- Persistent booklist storage per user
- Locally stored booklist for guest users
- SQLite database for lightweight deployment
- CORS and CSRF protection configured for production
- Deployed using Fly.io

---

## Tech Stack
- **Framework:** Laravel 11
- **Language:** PHP 8
- **Database:** SQLite (temporary in-memory for Fly.io)
- **Auth:** Laravel Sanctum
- **Deployment:** Fly.io

---

## Local Setup

### 1. Clone the repository
```bash
git clone https://github.com/betheducky/read-more-books-library-backend.git
cd read-more-books-library-backend
```

### 2. Install dependencies
```bash
composer install
```

### 3. Create and configure environment
```bash
cp .env.example .env
php artisan key:generate
```

Update .env:
```env
APP_URL=http://localhost:8000  // your local backend development server (copy URL from #5)
FRONTEND_URL=http://localhost:4200 // your local frontend development server
SESSION_DRIVER=file
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

### 4. Run migrations
```bash
php artisan migrate
```

### 5. Start the API server
```bash
php artisan serve
```

---

## Deployment (Fly.io)
The production API is hosted [here.](https://book-search-backend.fly.dev) Environment variables are configured through fly.toml.

---

## API Endpoints (Authenticated users only)

| Method   | Endpoint          | Description                 |
| -------- | ----------------- | --------------------------- |
| `POST`   | `/api/register`   | Register a new user         |
| `POST`   | `/api/login`      | Log in and start a session  |
| `GET`    | `/api/user`       | Get the authenticated user  |
| `POST`   | `/api/logout`     | Log out the user            |
| `GET`    | `/api/book-list`      | Get all saved books         |
| `POST`   | `/api/book-list`      | Add a book to the list      |
| `DELETE` | `/api/book-list/{id}` | Remove a book from the list |

---

## Database
This API uses SQLite for lightweight deployment.
⚠️ PLEASE NOTE: Due to limited scope of project, volume storage is not persistent. This database is subject to reset when the backend is updated and redeployed, and stored data may be lost.

---

## Roadmap (future updates and vision)
- Implement request throttling
- Enable password reset via email

