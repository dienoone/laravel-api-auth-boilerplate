# Laravel API Authentication Boilerplate

**Production-Ready REST API with User Authentication & Social Login**

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11-red.svg?style=for-the-badge&logo=laravel&logoColor=white" />
  <img src="https://img.shields.io/badge/PHP-8.2-blue.svg?style=for-the-badge&logo=php&logoColor=white" />
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" />
  <img src="https://img.shields.io/badge/Laravel%20Sanctum-API%20Auth-green.svg?style=for-the-badge&logo=laravel&logoColor=white" />
</p>

---

## Description

**Laravel API Authentication Boilerplate** is a robust, production-ready foundation for building RESTful APIs with comprehensive user authentication and social login capabilities. Built with **Laravel 11** and **PHP 8.2**, it provides a complete authentication system including traditional email/password registration and login, social authentication via multiple providers (Google, GitHub, Facebook), and secure token-based authorization using **Laravel Sanctum**.

The boilerplate implements best practices such as the **Service + Repository pattern** for clean architecture, **Data Transfer Objects (DTOs)** for type-safe data handling, and **API Resources** for consistent JSON response formatting. It includes proper exception handling, validation, and structured error responses. This foundation is perfect for developers who need a jump-start on authentication and authorization without building from scratch.

---

## Features

### Authentication

- **Email/Password Registration** — User account creation with validation
- **Email/Password Login** — Secure credential-based authentication
- **Social Authentication** — Login via Google, GitHub, Facebook, and other providers
- **Token-Based Authorization** — Laravel Sanctum for secure API access
- **Token Management** — Logout with token revocation
- **User Profile** — Retrieve and manage authenticated user information
- **Social Account Linking** — Connect multiple social providers to a single account

### User Management

- User registration and profile management
- Social account association and management
- Authentication state tracking
- Personal access token creation and revocation

### Security Features

- Password hashing and validation
- HTTP-only cookie support for token storage
- CORS-ready configuration
- API exception handling with structured error responses
- Request validation with Form Requests
- Database-agnostic migrations

---

## Tech Stack

| Area           | Technologies                              |
| -------------- | ----------------------------------------- |
| Backend        | Laravel 11, PHP 8.2, MySQL 8              |
| Authentication | Laravel Sanctum (Token-based API auth)    |
| API            | RESTful JSON — Service/Repository pattern |
| Data Transfer  | DTOs (Data Transfer Objects)              |
| Validation     | Laravel Form Requests                     |
| Testing        | PHPUnit, Pest                             |

---

## Architecture

### Layer Overview

| Layer             | Responsibility                                    |
| ----------------- | ------------------------------------------------- |
| **Request**       | Hits API controller                               |
| **Controller**    | Validates input via Form Request, calls Service   |
| **Service**       | Business logic — calls Repository, enforces rules |
| **Repository**    | All Eloquent queries — implements Interface       |
| **Model**         | Relationships, casts, scopes, accessors           |
| **Authorization** | Token-based access control with Sanctum           |

### Key Design Decisions

- **Service + Repository pattern with Contracts** — all database access goes through repositories.
- **No logic in controllers** — controllers only validate and delegate to services.
- **DTOs for data transfer** — strongly typed data objects between layers.
- **All bindings registered in `AppServiceProvider`** — swap implementations without touching controllers.
- **Form Request validation** — centralized request validation logic.
- **API Resources** — consistent JSON response formatting across all endpoints.
- **Exception handling** — centralized API exception handler with structured error responses.

---

## 📡 API Reference

All API routes are prefixed with `/api/v1`. Protected routes require:

```
Authorization: Bearer {sanctum_token}
```

### Authentication

| Method | Endpoint                  | Auth      | Description                      |
| ------ | ------------------------- | --------- | -------------------------------- |
| POST   | `/auth/register`          | Public    | Register with email and password |
| POST   | `/auth/login`             | Public    | Login and receive API token      |
| POST   | `/auth/logout`            | Protected | Logout and revoke token          |
| GET    | `/auth/me`                | Protected | Get authenticated user profile   |
| POST   | `/auth/social/{provider}` | Public    | Login via social provider        |

### Social Accounts

| Method | Endpoint                        | Auth      | Description                    |
| ------ | ------------------------------- | --------- | ------------------------------ |
| GET    | `/auth/social-accounts`         | Protected | List connected social accounts |
| POST   | `/auth/social-accounts/connect` | Protected | Connect new social account     |
| DELETE | `/auth/social-accounts/{id}`    | Protected | Disconnect social account      |

---

## Getting Started

### Requirements

- PHP 8.2+
- MySQL 8 or PostgreSQL
- Composer
- Node.js (for frontend assets)

### Installation

```bash
# Clone the repository
git clone https://github.com/yourusername/laravel-api-auth-boilerplate.git
cd laravel-api-auth-boilerplate

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Create environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed
```

### Environment Variables

| Variable                   | Value                 |
| -------------------------- | --------------------- |
| `APP_URL`                  | http://localhost:8000 |
| `DB_CONNECTION`            | mysql                 |
| `DB_HOST`                  | 127.0.0.1             |
| `DB_PORT`                  | 3306                  |
| `DB_DATABASE`              | laravel_auth          |
| `DB_USERNAME`              | root                  |
| `DB_PASSWORD`              | password              |
| `SANCTUM_STATEFUL_DOMAINS` | localhost:3000        |

### Social Provider Configuration (Optional)

Add to `.env` to enable social authentication:

```
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret

GITHUB_CLIENT_ID=your_client_id
GITHUB_CLIENT_SECRET=your_client_secret

FACEBOOK_CLIENT_ID=your_client_id
FACEBOOK_CLIENT_SECRET=your_client_secret
```

### Running Locally

**Terminal 1 — Laravel Server**

```bash
php artisan serve
```

**Terminal 2 — Queue (optional)**

```bash
php artisan queue:work
```

**Terminal 3 — Vite (for frontend assets)**

```bash
npm run dev
```

---

## 📁 Project Structure

```
app/
├── Contracts/                 # Service & Repository interfaces
│   ├── Repositories/
│   └── Services/
├── DTOs/                      # Data Transfer Objects
│   └── Auth/
├── Exceptions/                # Custom exception handlers
│   └── ApiExceptionHandler.php
├── Helpers/                   # Helper functions
├── Http/
│   ├── Controllers/           # API controllers
│   ├── Requests/              # Form request validation
│   ├── Resources/             # API JSON response formatting
│   └── Middleware/            # Auth, CORS middleware
├── Models/                    # Eloquent models (User, SocialAccount)
├── Repositories/              # Repository implementations
├── Services/                  # Business logic services
├── Traits/                    # Shared traits (ApiResponse, HasUser)
└── Providers/                 # Service providers & bindings

database/
├── migrations/                # Database schema
├── factories/                 # Model factories for testing
└── seeders/                   # Database seeders

routes/
├── api.php                    # API routes
├── web.php                    # Web routes
├── console.php                # Console commands
└── Api/
    └── V1/                    # V1 API routes

tests/
├── Feature/                   # API endpoint tests
└── Unit/                      # Unit tests

config/
├── app.php                    # App configuration
├── auth.php                   # Authentication settings
├── database.php               # Database configuration
└── sanctum.php                # Sanctum configuration
```

---

## 🧪 Seed Data

Run `php artisan db:seed` to populate the database with sample data:

| Data      | Details                      |
| --------- | ---------------------------- |
| **User**  | user@example.com / password  |
| **Admin** | admin@example.com / password |

---

## 🔐 Authentication Flow

### Email/Password Login

```
1. POST /api/v1/auth/register (create account)
2. POST /api/v1/auth/login (exchange credentials for token)
3. Store token in Authorization header: "Bearer {token}"
4. All subsequent requests include the token
5. POST /api/v1/auth/logout (revoke token)
```

### Social Login

```
1. Redirect user to /api/v1/auth/social/{provider}
2. Provider redirects back with authorization code
3. Exchange code for user profile and create/update User record
4. Generate Sanctum token and return to client
5. Client stores token for authenticated requests
```

---

## 🧪 Testing

Run the test suite:

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/Auth/LoginTest.php

# Run with coverage
php artisan test --coverage
```

---

## Common Tasks

### Register New User

```http
POST /api/v1/auth/register
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "secure_password",
  "password_confirmation": "secure_password"
}
```

### Login

```http
POST /api/v1/auth/login
Content-Type: application/json

{
  "email": "john@example.com",
  "password": "secure_password"
}

# Response
{
  "data": {
    "user": { ... },
    "token": "1|abcdef..."
  }
}
```

### Access Protected Route

```http
GET /api/v1/auth/me
Authorization: Bearer 1|abcdef...
```

---

## Contributing

Contributions are welcome! Please read our contribution guidelines and submit pull requests to our repository.
