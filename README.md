# Gadgets92

![Gadgets92 Logo](img/logo/logo.png)

Gadgets92 is a comprehensive tech specifications platform that serves as a one-stop destination for viewing detailed technical specifications of consumer electronic products including smartphones, laptops, smartwatches, headsets, and televisions.

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Project Structure](#project-structure)
- [Admin Panel](#admin-panel)
- [User Features](#user-features)
- [Database](#database)
- [API Documentation](#api-documentation)
- [Contributing](#contributing)
- [License](#license)

## 🔍 Overview

Gadgets92 allows users to browse, search, and compare technical specifications of various electronic devices. The platform is designed to help consumers make informed purchasing decisions by providing comprehensive and up-to-date information about the latest gadgets in the market.

## ✨ Features

- **Product Categories**: Browse products by categories (Mobiles, Laptops, Watches, Televisions, Headsets)
- **Advanced Search**: Find products using various filters and specifications
- **Product Comparison**: Compare multiple products side by side
- **User Ratings**: View and submit product ratings
- **Upcoming Products**: Stay updated with soon-to-be-released gadgets
- **Latest Products**: Discover the newest products in the market
- **Responsive Design**: Optimized for both desktop and mobile devices
- **User Authentication**: Register, login, and manage your profile
- **Admin Panel**: Comprehensive backend for content management

## 🛠️ Tech Stack

- **Frontend**: HTML, CSS, JavaScript, Bootstrap 5, jQuery
- **Backend**: PHP
- **Database**: MySQL
- **Email**: PHPMailer
- **Dependencies Management**: Composer
- **Icons**: Font Awesome, Bootstrap Icons

## 💻 Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer
- Web server (Apache/Nginx)

### Setup Instructions

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/Gadgets92.git
   cd Gadgets92
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Database setup:
   - Create a MySQL database named `gadgets92`
   - Import the `gadgets92.sql` file to set up the database schema and sample data
   - Update database credentials in `dbcon.php` if needed:
     ```php
     $con = mysqli_connect('localhost', 'your_username', 'your_password', 'gadgets92', 3306);
     ```

4. Configure your web server to point to the project directory

5. Access the website:
   - Frontend: `http://localhost/Gadgets92/`
   - Admin Panel: `http://localhost/Gadgets92/admin/` (Default credentials: username: `admin`, password: `admin`)

## 📁 Project Structure

```
Gadgets92/
├── admin/                  # Admin panel files
│   ├── assets/             # Admin panel assets (CSS, JS)
│   ├── brands/             # Brand management
│   ├── functions/          # Admin utility functions
│   ├── inc/                # Admin includes (header, footer)
│   ├── products/           # Product management
│   ├── specs/              # Specifications management
│   └── index.php           # Admin dashboard
├── css/                    # Frontend CSS files
├── img/                    # Images and media files
├── inc/                    # Frontend includes (header, footer, functions)
├── js/                     # Frontend JavaScript files
├── mobiles/                # Mobile phones section
├── laptops/                # Laptops section
├── watches/                # Smartwatches section
├── televisions/            # TVs section
├── headsets/               # Headsets section
├── vendor/                 # Composer dependencies
├── .htaccess               # URL rewriting rules
├── composer.json           # Composer configuration
├── dbcon.php               # Database connection
├── gadgets92.sql           # Database schema and data
└── index.php               # Homepage
```

## 👨‍💼 Admin Panel

The admin panel provides a comprehensive interface for managing the website content:

- **Dashboard**: Overview of website statistics
- **User Management**: Manage admin users and roles
- **Products Management**: Add, edit, delete products across all categories
- **Brand Management**: Manage product brands
- **Specifications Management**: Manage detailed specifications for each product category

## 👥 User Features

- **Product Browsing**: Browse products by category, brand, or specifications
- **Product Finder**: Use advanced filters to find products matching specific criteria
- **Product Comparison**: Compare up to 4 products side by side
- **User Accounts**: Register, login, and manage profile
- **Ratings**: Submit and view product ratings
- **Search**: Search for products across all categories

## 🗄️ Database

The database structure includes the following main tables:

- `products`: Core product information
- `categories`: Product categories
- `brands`: Product brands
- `mobile_specs`: Specifications for mobile phones
- `laptop_specs`: Specifications for laptops
- `watch_specs`: Specifications for smartwatches
- `tv_specs`: Specifications for televisions
- `headset_specs`: Specifications for headsets
- `users`: User account information
- `admin_users`: Admin user information
- `user_reviews`: Product ratings and reviews

## 📚 API Documentation

The project includes several internal APIs for handling data:

- **Search API**: Handles live search functionality
- **Rating API**: Processes user ratings
- **Product Filtering API**: Handles advanced product filtering

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

---

© 2024 Gadgets92. All Rights Reserved.
