# Weather Alert API

## Installation & Setup

### Requirements
- PHP 8.1+
- Composer
- Laravel 11
- PostgreSQL
- Docker & Laravel Sail
- Node.js & npm (for frontend if applicable)

### Install dependencies
```bash
composer install
npm install 
```

### Copy environment variables
```bash
cp .env.example .env
```

### Configure the environment
Update the `.env` file with your database and Redis credentials.

Example:
```
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=weather_alerts
DB_USERNAME=sail
DB_PASSWORD=password

CACHE_DRIVER=redis
QUEUE_CONNECTION=sync

SANCTUM_STATEFUL_DOMAINS=localhost,127.0.0.1
SESSION_DRIVER=cookie
SESSION_DOMAIN=localhost
```

### Start Laravel Sail
```bash
./vendor/bin/sail up -d
```

### Generate application key
```bash
./vendor/bin/sail artisan key:generate
```

### Run database migrations and seed data
```bash
./vendor/bin/sail artisan migrate --seed
```

### Start the development server
```bash
./vendor/bin/sail artisan serve
```

## Authentication (Sanctum)

### Register a new user
**POST** `/api/register`
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password",
  "password_confirmation": "password"
}
```

### Login
**POST** `/api/login`
```json
{
  "email": "john@example.com",
  "password": "password"
}
```
Response:
```json
{
  "token": "your-auth-token"
}
```

### Logout
**POST** `/api/logout`
Headers:
```
Authorization: Bearer your-auth-token
```

### Get Authenticated User
**GET** `/api/user`
Headers:
```
Authorization: Bearer your-auth-token
```

## API Endpoints

### Weather Alert Endpoints

#### Create a Weather Alert
**POST** `/api/alerts`
```json
{
  "city": "New York",
  "precipitation_threshold": 5,
  "uv_threshold": 6
}
```
Headers:
```
Authorization: Bearer your-auth-token
```

#### Get All Alerts
**GET** `/api/alerts`
Headers:
```
Authorization: Bearer your-auth-token
```

## Deployment
1. Set up a production environment with PostgreSQL and Redis.
2. Configure environment variables (`.env`).
3. Run migrations:
   ```bash
   ./vendor/bin/sail artisan migrate

## Run test
php artisan test --filter WeatherAlertTest
