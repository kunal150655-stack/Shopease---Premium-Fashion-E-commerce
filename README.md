# Shopease — Fashion e-commerce starter

A beginner-friendly PHP + MySQL storefront inspired by the uploaded premium fashion reference.

## Features
- Responsive editorial-style homepage and category browsing
- Product details and product listings
- Session-based shopping bag with quantity updates/removal
- Customer registration and login (passwords are securely hashed)
- Checkout with Cash on Delivery demo flow and order history
- Admin product create, edit, hide and delete screens
- MySQL schema and sample products

## Run locally (XAMPP)
1. Install and open XAMPP. Start **Apache** and **MySQL**.
2. Copy the `shopease` folder into `C:/xampp/htdocs/`.
3. Open `http://localhost/phpmyadmin`, create/import the database by importing `database.sql`.
4. Check `config.php` and update the MySQL username/password if needed.
5. Open `http://localhost/shopease/`.

## Create an admin account
1. Register normally through the website.
2. In phpMyAdmin, open the `shopease` database and run:
   ```sql
   UPDATE users SET role='admin' WHERE email='your-email@example.com';
   ```
3. Sign out and sign back in. The Admin link will appear in the header.

## Notes before publishing
- This is a learning/demo project. Checkout records orders but does not process online payments.
- Replace sample image URLs and contact details with assets and business information you own.
- Add CSRF protection, stock validation, server-side rate limiting, secure HTTPS configuration, and a proper payment provider before production use.
- Use a strong database password and do not publish production credentials.
