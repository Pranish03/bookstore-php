# Bookstore PHP — E-Commerce Platform

![PHP Version](https://img.shields.io/badge/PHP-8.0+-blue.svg?style=for-the-badge)
![License](https://img.shields.io/badge/license-ISC-blue.svg?style=for-the-badge)

A full-featured e-commerce platform built with PHP for managing books, orders, and user accounts.

---

## Features

- **Admin Dashboard** – Manage books, users, and orders
- **User Authentication** – Secure login, registration, and profile management
- **Shopping Cart & Checkout** – Seamless experience with discount support
- **Search & Filtering** – Find books by title, author, or ISBN
- **Order Tracking** – Real-time order status updates
- **Responsive Design** – Mobile, tablet, and desktop ready

---

## Tech Stack

| Category | Technology |
|---|---|
| Language | PHP 8.0+ |
| Routing | AltoRouter |
| Database | MySQL via PDO |
| Frontend | Tailwind CSS |
| Auth | Session-based with password hashing |

---

## Installation

**Prerequisites:** PHP 8.0+, MySQL 5.7+, Composer, Node.js & npm, Apache/Nginx

```bash
# 1. Clone
git clone https://github.com/Pranish03/bookstore-php.git
cd bookstore-php

# 2. Install dependencies
composer install
npm install

# 3. Set up database
mysql -u root -p < schema/books.sql
mysql -u root -p < schema/carts.sql
mysql -u root -p < schema/orders.sql
mysql -u root -p < schema/users.sql

# 4. Start dev server
npm run dev
php -S localhost:8000 -t public
```

**Environment — create a `.env` file:**
```env
DB_HOST=localhost
DB_NAME=bookstore_db
DB_USER=root
DB_PASS=
DB_CHARSET=utf8mb4
```

Open [http://localhost:8000](http://localhost:8000).

> **Docker:** `docker-compose up -d` (requires `docker-compose.yml` configured for MySQL and PHP-FPM)

---

## Usage

**Admin Panel** — `/admin`
- Default credentials: `admin@example.com` / `password` *(update in `App/Models/User.php`)*

**User Routes**

| Route | Description |
|---|---|
| `/` | Browse books |
| `/register`, `/login` | Auth |
| `/cart/add` | Add to cart |
| `/checkout` | Checkout |
| `/orders` | View orders |

---

## Project Structure

```
bookstore-php/
├── App/
│   ├── Controllers/       # Business logic
│   ├── Models/            # Database interactions
│   ├── Middlewares/       # Auth & authorization
│   ├── Validation/        # Form validation
│   ├── Views/             # Templates (PHP + Tailwind)
│   └── Helpers/           # Utility functions
├── public/                # Static files
├── config/                # Configuration
├── routes/                # Route definitions
└── schema/                # Database schema
```

---

## Configuration

| Variable | Description |
|---|---|
| `DB_HOST` | MySQL host |
| `DB_NAME` | Database name |
| `DB_USER` | MySQL username |
| `DB_PASS` | MySQL password |

To customize the theme, edit `App/Views/global.css`.

---

## Roadmap

- [ ] Payment gateway (Stripe, PayPal)
- [ ] Multi-language & currency support
- [ ] Mobile app API
- [ ] Analytics dashboard

---

## License

[ISC License](LICENSE)
