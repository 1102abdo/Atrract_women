# Attract Women API

This is the backend API for the **Attract Women** mobile application, built with **Laravel**. It supports user authentication, social login, posts, comments, and user management.

## 📦 Tech Stack

- Laravel 12
- MySQL
- Laravel Sanctum for API authentication
- Laravel Socialite for social login (Google)

---

## 🚀 Getting Started

### 1. Clone the project

```bash
git clone https://github.com/1102abdo/Atrract_women
cd attract_women

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

👤 Admin Access
The admin user is already created in the database. Credentials will be provided privately if needed.

📂 Folder Structure (Important APIs)
app/Http/Controllers/Api/AuthController.php → Handles registration & login

app/Http/Controllers/SocialAuthController.php → Social login

app/Http/Controllers/Api/PostController.php → Posts CRUD

app/Http/Controllers/Api/CommentController.php → Comments

app/Helpers/ApiResponse.php → Standardized response formatting

📌 Notes
All responses use the ApiResponse::sendResponse() format.

Middleware auth:sanctum is applied where authentication is required.


