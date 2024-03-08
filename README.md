# Laravel Services API

This is a RESTful API project built with Laravel for managing services in a company.

## Getting Started

### Prerequisites

Before you begin, ensure you have the following installed on your machine:

- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- Database (MySQL)

### Installation

1. **Clone the repository:**

    ```bash
    git clone  https://github.com/ismailastighfar/Company-Services-Rest-API.git
    ```

2. **Navigate to the project directory:**

    ```bash
    cd services-api
    ```

3. **Install dependencies:**

    ```bash
    composer install
    ```

4. **configure your database:**

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE={DB_NAME}
    DB_USERNAME={USERNAME}
    DB_PASSWORD={PASSWORD}
    ```

    Update the `.env` file with your database connection details.

5. **Run migrations and seeders:**

    ```bash
    php artisan migrate --seed
    ```

### Running the Application

```bash
php artisan serve
```

## Usage

### Accessing Swagger API Documentation

To explore and test the API, follow these steps:

1. Visit [http://127.0.0.1:8000/api/documentation](http://127.0.0.1:8000/api/documentation) in your web browser.

2. Click on the "Authorize" button.

3. Enter your Bearer Api Key.

4. Explore and test the API using Swagger UI.
