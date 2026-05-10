# **Bookstore PHP - Modern E-Commerce Bookstore Platform**

![GitHub Stars](https://img.shields.io/github/stars/Pranish03/bookstore-php?style=for-the-badge)
![PHP Version](https://img.shields.io/badge/PHP-8.0+-blue.svg?style=for-the-badge)
![License](https://img.shields.io/badge/license-ISC-blue.svg?style=for-the-badge)
![Build Status](https://img.shields.io/github/actions/workflow/status/Pranish03/bookstore-php/ci.yml?branch=main&style=for-the-badge)

---

## 🚀 **Overview**

**Bookstore PHP** is a **modern, full-featured e-commerce platform** built with PHP, designed specifically for bookstores. It provides a **complete solution** for managing books, handling customer orders, and managing user accounts—all with a sleek, responsive interface.

### **Key Features**
✅ **Admin Dashboard** – Manage books, users, and orders with ease
✅ **User Authentication** – Secure login, registration, and profile management
✅ **Shopping Cart & Checkout** – Seamless shopping experience with discounts
✅ **Search & Filtering** – Find books by title, author, or ISBN
✅ **Order Tracking** – Real-time order status updates
✅ **Responsive Design** – Works on mobile, tablet, and desktop
✅ **Modern UI** – Built with **Tailwind CSS** for a polished look
✅ **Database Integration** – Uses **MySQL** for efficient data management

### **Who is this for?**
- **Bookstore owners** looking for a **ready-to-deploy** solution
- **Developers** who want a **customizable e-commerce framework**
- **Students & hobbyists** learning PHP and MVC architecture

---

## 🛠️ **Tech Stack**

| Category       | Technologies Used                     |
|---------------|--------------------------------------|
| **Language**  | PHP 8.0+                             |
| **Framework** | AltoRouter (for routing)             |
| **Database**  | MySQL (with PDO for security)        |
| **Frontend**  | Tailwind CSS (for styling)           |
| **Authentication** | Session-based with password hashing |
| **Validation** | Custom PHP validators               |
| **Deployment** | Works with any PHP-compatible server |

---

## 📦 **Installation**

### **Prerequisites**
Before installing, ensure you have:
- **PHP 8.0+** installed
- **MySQL 5.7+** (or MariaDB)
- **Composer** for dependency management
- **Node.js & npm** (for Tailwind CSS)
- **Web server** (Apache/Nginx)

---

### **Quick Start**

#### **1. Clone the Repository**
```bash
git clone https://github.com/Pranish03/bookstore-php.git
cd bookstore-php
```

#### **2. Install Dependencies**
```bash
composer install
npm install
```

#### **3. Set Up the Database**
Run the following SQL scripts to create the required tables:
```bash
# Create the database
mysql -u root -p < schema/books.sql
mysql -u root -p < schema/carts.sql
mysql -u root -p < schema/orders.sql
mysql -u root -p < schema/users.sql
```

#### **4. Configure Environment Variables**
Create a `.env` file in the root directory and set your database credentials:
```env
DB_HOST=localhost
DB_NAME=bookstore_db
DB_USER=root
DB_PASS=
DB_CHARSET=utf8mb4
```

#### **5. Run Tailwind CSS (for Frontend)**
```bash
npm run dev
```
*(This will watch for changes and rebuild CSS in real-time.)*

#### **6. Start the Development Server**
```bash
php -S localhost:8000 -t public
```
Now, open **[http://localhost:8000](http://localhost:8000)** in your browser!

---

### **Alternative: Using Docker (Optional)**
If you prefer Docker, you can set it up with:
```bash
docker-compose up -d
```
*(Ensure you have `docker-compose.yml` configured for MySQL and PHP-FPM.)*

---

## 🎯 **Usage**

### **Admin Panel**
- **Access:** `/admin`
- **Default Admin Credentials:**
  - **Email:** `admin@example.com`
  - **Password:** `password` *(Change this in `App/Models/User.php`)*

### **User Features**
- **Register & Login** (`/register`, `/login`)
- **Browse Books** (`/`)
- **Add to Cart** (`/cart/add`)
- **Checkout** (`/checkout`)
- **View Orders** (`/orders`)

---

### **Example: Adding a Book (Admin)**
```php
// In BooksController.php (create method)
$validator = new BookValidator();
if (!$validator->validate($_POST, $_FILES, true)) {
    $_SESSION['errors'] = $validator->errors();
    $this->redirect('/admin/books/create');
}

$data = $validator->validated();
$image = $_FILES['image'];
$ext = pathinfo($image['name'], PATHINFO_EXTENSION);
$filename = uniqid('book_', true) . '.' . $ext;
$uploadPath = __DIR__ . '/../../public/uploads/books/' . $filename;

if (!move_uploaded_file($image['tmp_name'], $uploadPath)) {
    $_SESSION['errors']['image'] = 'Failed to upload image.';
    $this->redirect('/admin/books/create');
}

$data['image'] = 'uploads/books/' . $filename;
$this->book->create($data);
$_SESSION['success'] = 'Book added successfully.';
$this->redirect('/admin/books');
```

---

### **Example: Searching for Books**
```php
// In PageController.php (search method)
$query = trim($_GET['q'] ?? '');
if (empty($query)) {
    $this->redirect('/');
}

$books = $this->book->search($query);
$this->view('page.search', compact('books', 'query'));
```

---

## 📁 **Project Structure**

```
bookstore-php/
├── App/
│   ├── Controllers/       # Business logic
│   ├── Models/            # Database interactions
│   ├── Middlewares/       # Authentication & authorization
│   ├── Validation/        # Form validation
│   ├── Views/             # Templates (PHP + Tailwind)
│   │   ├── admin/          # Admin views
│   │   ├── page/           # Public views
│   │   └── components/     # Reusable UI components
│   └── Helpers/           # Utility functions
├── public/                # Static files (CSS, JS, images)
├── config/                # Configuration files
├── routes/                # Route definitions
├── schema/                # Database schema
├── .gitignore             # Ignored files
├── composer.json          # PHP dependencies
├── package.json           # Frontend dependencies
└── README.md              # This file!
```

---

## 🔧 **Configuration**

### **Environment Variables**
| Variable      | Description                          |
|--------------|--------------------------------------|
| `DB_HOST`    | MySQL host (default: `localhost`)    |
| `DB_NAME`    | Database name (default: `bookstore_db`) |
| `DB_USER`    | MySQL username (default: `root`)     |
| `DB_PASS`    | MySQL password (leave empty if none) |

### **Customization Options**
- **Change the theme:** Modify `App/Views/global.css`
- **Add new features:** Extend controllers & models
- **Change admin credentials:** Update `App/Models/User.php`

---

## 🤝 **Contributing**

We welcome contributions! Here’s how you can help:

### **1. Fork the Repository**
```bash
git clone https://github.com/yourusername/bookstore-php.git
cd bookstore-php
```

### **2. Create a Feature Branch**
```bash
git checkout -b feature/your-feature
```

### **3. Make Your Changes**
- Follow **PSR-12** coding standards
- Write **clear commit messages**
- Add **tests** if applicable

### **4. Submit a Pull Request**
- Explain your changes in the PR description
- Reference any related issues

---

## 📝 **License**

This project is licensed under the **ISC License** – a permissive open-source license.

---

## 👥 **Authors & Contributors**

👤 **Pranish03** – Initial development
🤝 **Open to contributions!** – Help improve this project.

---

## 🐛 **Issues & Support**

### **Reporting Issues**
- Open a **GitHub Issue** with:
  - Clear description of the problem
  - Steps to reproduce
  - Expected vs. actual behavior

### **Getting Help**
- **Discussions:** [GitHub Discussions](https://github.com/Pranish03/bookstore-php/discussions)
- **Community:** Join our **PHP e-commerce** Slack channel

---

## 🗺️ **Roadmap**

### **Planned Features**
- [ ] **Payment Gateway Integration** (Stripe, PayPal)
- [ ] **Multi-language & currency support**
- [ ] **API for mobile apps**
- [ ] **Advanced analytics dashboard**

### **Known Issues**
- [ ] Some edge cases in cart persistence
- [ ] Mobile checkout optimization

---

## **Final Notes**

This **Bookstore PHP** project is a **fully functional e-commerce platform** ready for deployment. Whether you're a **bookstore owner** or a **developer**, this project provides a **solid foundation** for building a **scalable online bookstore**.

🚀 **Star this repo** if you found it useful! 🚀

---
**Happy coding!** 💻📚
