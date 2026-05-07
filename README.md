# Celebratory Canvas

Celebratory Canvas is a PHP and MySQL based wedding decoration booking platform. It allows customers to explore decoration themes, view galleries, book event decorations, and track their bookings. The system also includes vendor and admin panels for managing decorations, orders, users, vendors, and customer messages.

## Features

- Customer registration and login
- Vendor registration and login
- Admin login and dashboard
- Browse decoration categories:
  - Wedding
  - Engagement
  - Sangeet
  - Haldi
  - Mehendi
  - Reception
- Search, filter, and sort decorations by price
- View decoration details and similar decorations
- Book decorations with event and payment details
- Customer profile with booking history
- Vendor panel for adding and managing decorations
- Admin panel for managing:
  - Decorations
  - Orders
  - Users
  - Vendors
  - Contact messages
- Responsive UI with modern styling
- Image gallery and decoration showcase

## Tech Stack

- PHP
- MySQL
- HTML5
- CSS3
- Bootstrap
- JavaScript
- XAMPP / Apache

## Future Improvements

- Add online payment gateway integration
- Improve order status tracking
- Add email notifications
- Add vendor approval workflow
- Add customer reviews and ratings
- Improve security with stronger validation and role-based access control

  # How to Run the Project

## Requirements

* XAMPP
* PHP
* MySQL
* Web Browser

## Steps to Run

1. Clone the repository

```bash id="5bd2rr"
git clone https://github.com/Juhiiee/celebratory-canvas.git
```

2. Move the project folder to:

```text id="8x36gm"
C:\xampp\htdocs\
```

3. Start Apache and MySQL from XAMPP Control Panel.

4. Open phpMyAdmin and create a database named:

```text id="x8sg4w"
canvas
```

5. Import the `canvas.sql` file into the database.

6. Rename `.env.example` to `.env`

7. Open the project in browser:

```text id="x8jpn0"
http://localhost/celebratory-canvas
```

