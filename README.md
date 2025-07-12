
# MeasureMate ✂️

MeasureMate is a tailor-focused SaaS platform designed to manage customer profiles, record measurements with version control, handle clothing orders, collaborate with a team, and provide customer-facing access to order history.

---

## 🚀 Features

### ✅ First Iteration
- Google Single Sign-On authentication
- Customer profile management
- Measurement tracking with revision history
  - Categories: Shirt, Trouser, Gown, Dress
  - Support for dynamic/custom measurement fields

### 🧩 Second Iteration
- Team management (multi-user support per business)
- Order management with timelines:
  - Order date, completion date, delivery date
  - Sample image uploads
  - Notes section (with WYSIWYG support)
- Business portal for customer order access
- Product catalog management

---

## 🛠️ Tech Stack

### Backend
- **Laravel 11** (PHP)
- **MySQL/PostgreSQL** (database)
- **Laravel Sanctum / Passport** (API authentication)
- **Spatie Media Library** (file/image uploads)
- **Laravel Socialite** (Google OAuth)

### Frontend (planned or optional)
- Next.js / React / Vue (you choose)
- Tailwind CSS
- shadcn/ui or Radix UI
- Axios or React Query (API interaction)

---

## ⚙️ Installation

### 1. Clone the repository
```bash
git clone https://github.com/yourusername/measuremate.git
cd measuremate
```

### 2. Install dependencies
```bash
composer install
```

### 3. Copy and configure `.env`
```bash
cp .env.example .env
php artisan key:generate
```

Configure your DB, Google credentials, and other environment variables.

### 4. Run migrations
```bash
php artisan migrate
```

### 5. (Optional) Seed the database
```bash
php artisan db:seed
```

### 6. Run the app
```bash
php artisan serve
```

---

## 📁 Folder Structure (Backend)

```
app/
├── Models/
│   ├── User.php
│   ├── Customer.php
│   ├── Measurement.php
│   ├── Order.php
│   └── Product.php
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Resources/
routes/
├── api.php
```

---

## 🔐 Authentication

This project uses **Google OAuth** for authentication via Laravel Socialite.

- Frontend redirects to `/auth/google`
- After successful login, access token is returned and used to authenticate API calls

---

## 📦 API Endpoints (Sample)

| Method | Endpoint                     | Description                         |
|--------|------------------------------|-------------------------------------|
| POST   | `/api/login/google`          | Google SSO login                    |
| GET    | `/api/customers`             | Get list of customers               |
| POST   | `/api/customers`             | Create new customer                 |
| POST   | `/api/measurements`          | Add new measurement (with revision) |
| GET    | `/api/orders/{id}`           | Get order details                   |

> Full API documentation coming soon with Swagger/Postman Collection.

---

## 🧪 Testing

```bash
php artisan test
```

---

## 🧑‍🤝‍🧑 Contributing

Contributions are welcome! Please open issues or submit pull requests.

---

## 📄 License

This project is open-source under the MIT License.

---

## ✨ Author

**Omotoso Eniola**  
Backend Developer — Laravel & PHP  
[Your LinkedIn or Portfolio]
