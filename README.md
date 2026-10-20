# 🏨 Luxe Hotel & Dine

**A Modern Hotel, Room Showcase & Online Food Ordering Website**

Luxe Hotel & Dine is a hospitality website designed to provide visitors with an elegant online experience for exploring hotel services, browsing rooms, ordering food, creating accounts, and sharing customer reviews. Built with HTML, CSS, JavaScript, PHP, and MySQL, the project combines a visually appealing frontend with database-backed functionality.

---

## 📌 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
- [Technology Stack](#-technology-stack)
- [Project Structure](#-project-structure)
- [Getting Started](#-getting-started)
- [Database Configuration](#-database-configuration)
- [How to Use](#-how-to-use)
- [Security Notes](#-security-notes)
- [Limitations](#-limitations)
- [Future Enhancements](#-future-enhancements)
- [Contributing](#-contributing)
- [License](#-license)
- [Author](#-author)

---

## 📖 Overview

Luxe Hotel & Dine is a web-based hospitality project that brings hotel information and food-ordering functionality together in one place.

The website allows visitors to explore hotel rooms, discover food options, register for an account, log in, submit food orders, and provide feedback through a review form.

The project uses a PHP backend and MySQL database to process and store supported user submissions.

### 🎯 Project Objectives

- Create a professional and user-friendly hotel website.
- Showcase hotel rooms, services, and food offerings.
- Provide user registration and login functionality.
- Enable customers to submit food orders online.
- Collect customer reviews and ratings.
- Store application data in a MySQL database.
- Demonstrate frontend and backend integration using PHP.

---

## ✨ Features

### 🏠 Website & Navigation
- Attractive homepage and hero section.
- Navigation across multiple website pages.
- Hotel information and service highlights.
- Gallery and team sections.
- Responsive styling and visual animations.

### 🛏️ Hotel & Room Showcase
- Dedicated room listing page.
- Multiple room detail pages.
- Hotel and accommodation imagery.
- Room information presented through dedicated pages.

### 🍽️ Food & Dining
- Food listing and discovery pages.
- Dedicated burger section.
- Online food-order form.
- Customer and delivery information collection.
- Order processing through PHP and MySQL.

### 👤 User Authentication
- User registration.
- Login functionality.
- Password hashing for stored passwords.
- PHP session-based login state.
- Server-side input validation.

### 💳 Payment Form
- Dedicated payment page.
- Collection of billing and payment form information.
- PHP-based payment record processing.
- Storage of the last four card digits rather than the full card number, as documented in the implementation.

**Note:** The payment form is not a substitute for a real payment gateway. Successful form submission does not necessarily mean a real financial transaction has occurred.

### ⭐ Customer Reviews
- Customer review submission form.
- Rating and feedback collection.
- Database-backed review storage.

---

## 🛠️ Technology Stack

| Technology | Purpose |
|---|---|
| HTML5 | Website structure |
| CSS3 | Styling, layouts and animations |
| JavaScript | Client-side interactions and form handling |
| PHP | Backend processing and validation |
| MySQL | Database and persistent data storage |
| Apache | Local web server |
| XAMPP | Local development environment |
| Font Awesome | Icons and visual elements |

---

## 📂 Project Structure

```text
240431108/
│
├── index.html
├── about.html
├── room.html
├── room-1.html
├── room-2.html
├── room-3.html
├── room-4.html
├── room-5.html
├── room-6.html
├── room-7.html
├── room-8.html
│
├── order.html
├── payment.html
├── login.html
├── sign-up.html
├── review.html
│
├── galary.html
├── team.html
├── popular.html
├── our_food.html
├── burger.html
│
├── css/
│   ├── shared.css
│   ├── style.css
│   ├── animations.css
│   ├── room.css
│   ├── order.css
│   ├── payment.css
│   ├── login.css
│   └── ...
│
├── image/
│   └── Website images and visual assets
│
├── hotel photo/
│   └── Hotel and room photographs
│
├── php/
│   ├── db_connect.php
│   ├── register.php
│   ├── login.php
│   ├── order.php
│   ├── payment.php
│   ├── review.php
│   ├── luxe_hotel.sql
│   │
│   └── database/
│       ├── create_database.php
│       ├── create_users_table.php
│       ├── create_orders_table.php
│       ├── create_payments_table.php
│       ├── create_reviews_table.php
│       ├── create_bookings_table.php
│       ├── setup_all_tables.php
│       └── food_website_full_import.sql
│
├── five-hotel/
│   └── Additional hotel template assets
│
└── PROJECT_DOCUMENTATION.txt
```

*Note: This is a representative structure. Additional CSS files, images, assets, and configuration files are present in the project.*

---

## 🚀 Getting Started

Follow these instructions to run the project locally.

### Prerequisites

Install the following software:

- [XAMPP](https://www.apachefriends.org/)
- A modern web browser
- A code editor such as [Visual Studio Code](https://code.visualstudio.com/)

Basic knowledge of HTML, PHP, and MySQL is recommended.

### 1. Clone or Download the Project

Clone the repository:

```bash
git clone <YOUR_REPOSITORY_URL>
```

Alternatively, download the project ZIP and extract it.

### 2. Move the Project to XAMPP

Copy the project folder into the XAMPP web root:

```text
C:\xampp\htdocs\240431108\
```

Make sure that `index.html` is directly inside the project folder.

### 3. Start Apache and MySQL

1. Open the XAMPP Control Panel.
2. Start **Apache**.
3. Start **MySQL**.

Both services should be running before continuing.

### 4. Create the Database

Open phpMyAdmin:

```text
http://localhost/phpmyadmin/
```

Import the database schema using the following file from the project:

```text
php/database/food_website_full_import.sql
```

Steps:

1. Open phpMyAdmin.
2. Select the **Import** tab.
3. Choose `food_website_full_import.sql`.
4. Click **Import** or **Go**.
5. Confirm that the `food_website` database and its tables have been created.

The SQL file is intended to create the database and its supported tables.

### 5. Configure the Database Connection

Open:

```text
php/db_connect.php
```

The current configuration uses the following local settings:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'food_website');
```

These values match a typical default XAMPP installation. Update them if your MySQL username, password, or database name differs.

**Important:** Do not use default development credentials in a production deployment.

### 6. Run the Website

Open the following URL in your browser:

```text
http://localhost/240431108/
```

You can now navigate through the website and test its available pages and forms.

**Important:** Do not open the HTML files directly using the `file://` protocol when testing PHP functionality. PHP scripts must run through a PHP-enabled web server.

---

## 🗄️ Database Configuration

The application uses MySQL to store supported application data.

### Main Database Tables

| Table | Purpose |
|---|---|
| `users` | User registration and account information |
| `orders` | Food-order information |
| `payments` | Submitted payment and billing records |
| `reviews` | Customer ratings and feedback |
| `bookings` | Booking-related table definition |

The active database connection in `php/db_connect.php` uses the database name `food_website`.

### Backend Workflow

The general data-processing flow is:

```text
User Interface
      ↓
HTML Form / JavaScript
      ↓
PHP Backend Endpoint
      ↓
Input Validation
      ↓
MySQL Database
      ↓
Response to the Website
```

The frontend communicates with PHP endpoints using form handling and JavaScript `fetch()` requests where implemented.

---

## 💻 How to Use

Once the website is running locally:

1. Open the homepage to explore the website.
2. Navigate to the About section to learn about the hotel.
3. Browse available room pages.
4. Explore food and dining sections.
5. Create an account through the registration page.
6. Log in through the login page.
7. Submit a food order using the order form.
8. Test the payment form workflow.
9. Submit a review or rating.

The availability of backend operations depends on a correctly configured PHP server and MySQL database.

---

## 🔐 Security Notes

Security is important when developing applications that handle user information.

The current implementation includes password hashing and session-based authentication. Payment records are documented as storing only the last four card digits rather than the complete card number.

Before deploying this project publicly, consider the following improvements:

- Use prepared statements for every database query involving user input.
- Validate and sanitize input on the server.
- Configure secure session cookies and session regeneration.
- Add CSRF protection to sensitive forms.
- Use HTTPS in production.
- Avoid storing sensitive payment information directly.
- Integrate a trusted payment provider for real transactions.
- Move database credentials into environment-based configuration.
- Add rate limiting and stronger authentication protections.
- Restrict access to database setup scripts and diagnostic endpoints.

The existing security features should not be interpreted as a guarantee that the application is production-ready.

---

## ⚠️ Limitations

The current project is primarily a website with selected database-backed workflows.

- No complete administrative dashboard is implemented.
- A full room availability and reservation workflow is not implemented.
- A real payment gateway is not integrated.
- Order tracking and delivery status management are not implemented.
- Password recovery functionality is not implemented.
- Role-based access control is not implemented.
- Production deployment and scalability require additional work.

---

## 🔮 Future Enhancements

Potential improvements include:

- [ ] Admin dashboard for managing users, rooms, and orders.
- [ ] Complete room booking and availability checking.
- [ ] Real payment gateway integration.
- [ ] Order status and delivery tracking.
- [ ] Email or SMS notifications.
- [ ] Password reset and email verification.
- [ ] Improved mobile responsiveness and accessibility.
- [ ] Advanced search and filtering.
- [ ] Automated testing and deployment.
- [ ] Production-grade security and error handling.

---

## 🤝 Contributing

Contributions and suggestions are welcome.

To contribute:

1. Fork the repository.
2. Create a new feature branch.
3. Make your changes.
4. Test the relevant website pages and backend workflows.
5. Submit a pull request describing your improvements.

Please keep changes organized and document any database or configuration updates.

---

## 📄 License

No explicit open-source license is specified in the supplied project files.

Before redistributing or reusing this project, add an appropriate `LICENSE` file and verify that you have permission to distribute all included images, fonts, templates, and other third-party assets.

---

## 👨‍💻 Author

**Luxe Hotel & Dine — Web Development Project**

Developed as a hospitality website project using HTML, CSS, JavaScript, PHP, and MySQL.

For questions, suggestions, or collaboration, please open an issue in the repository.

---

⭐ **If you find this project useful, consider giving the repository a star!**

