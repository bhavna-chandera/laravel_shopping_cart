# laravel_shopping_cart 🛒

A full-featured web application built with Laravel that includes both User Panel and Admin Panel for managing the system efficiently.

---
## 🛠 Tech Stack

- Backend: Laravel
- Frontend: Blade
- Database: MySQL
- Authentication: Laravel Auth Breeze
- Server: Apache / XAMPP

---

## 🚀 Features

<table>
<tr>
<th>👤 User Panel</th>
<th>🛠 Admin Panel</th>
</tr>

<tr>
<td>

- User Registration & Login  
- Dashboard
- Products with Swipe Btns
- wishlist Functionality
- Cart Functionality
- Order History
- Order Rating & Review   
- Quantity Update Easily
- Addresses Page
- ...etc

</td>

<td>

- Admin Authentication  
- Dashboard Analytics
- Data Visualization [Graphs] 
- Top Products Analysis
- Manage Users  
- Manage Products (CRUD)  
- Order Management
- Rating & Review Management 
- ...etc  

</td>
</tr>
</table>

---

## ⚙️ Database Setup

After cloning the project, run the following command inside the project directory to create the database tables:

### php artisan migrate

---

## 🔐 Admin Login Credentials (For Testing)
  
<table>
<tr>
<th>👤 User</th>
<th>🛠 Admin</th>
</tr>

<tr>
<td>

- Email: admin@gmail.com 
- Password: adminadmin  

</td>

<td>

- Email: user@gmail.com 
- Password: useruser
  
</td>
</tr>
</table>

---

## 📸 Application Screenshots

### 👤 Auth
![Auth Page](screenshots/register.png)
![Auth Page](screenshots/login.png)


### 👤 User Panel

#### Dashboard Page
![Dashboard Page](screenshots/user_dashboard.png)

#### Product Listing
![Product Listing](screenshots/user_products.png)

#### Product Details
![Product Details](screenshots/user_productdetails.png)

#### Wishlisted Items
![Wishlisted Items](screenshots/user_wishlisted.png)

#### Cart Page
![Cart Page](screenshots/user_carts.png)

#### Orders Page
![Orders Page](screenshots/user_orders.png)

#### Checkout Page
![Checkout Page](screenshots/user_checkout.png)

#### Address Page
![address Page](screenshots/user_addr.png)

#### Profile Page
![profile Page](screenshots/user_profile1.png)
![profile Page](screenshots/user_profile2.png)

---

### 🛠📊 Admin Panel

#### Admin Dashboard
![Admin Dashboard](screenshots/admin_dash.png)

#### Admin Dashboard Analysis
![Admin Dashboard Analysis](screenshots/admin_register.png)
![Admin Dashboard Analysis](screenshots/admin_posts.png)
![Admin Dashboard Analysis](screenshots/admin_orders.png)
![Admin Dashboard Analysis](screenshots/admin_m_users.png)
![Admin Dashboard Analysis](screenshots/admin_view1.png)
![Admin Dashboard Analysis](screenshots/admin_view2.png)
![Admin Dashboard Analysis](screenshots/admin_view3.png)
![Admin Dashboard Analysis](screenshots/admin_ord_sta.png)

#### User Management
![User Management](screenshots/admin_all_user.png)

#### Product Management
![Product Management](screenshots/admin_all_prods.png)

#### Order Management
![Order Management](screenshots/admin_all_orders.png)

#### Rating & Review Management
![Rating & Review Management](screenshots/admin_all_rates.png)

---

# 🚀 Laravel Project Installation Guide

Follow the steps below to set up and run this Laravel project locally.

---

## 📌 Prerequisites

Make sure you have the following installed on your system:

- PHP (>= 8.x)
- Composer
- MySQL
- Node.js & NPM
- Git

---

## Step 1: Clone the Repository

```bash
git clone https://github.com/bhavna-chandera/laravel_shopping_cart.git

cd laravel_shopping_cart
```
---
## Step 2: Install PHP Dependencies

```bash
composer install
```
## Step 3: Create Environment File

```bash
cp .env.example .env
```
## Step 4: Generate Application Key

```bash
php artisan key:generate
```
## Step 5: Configure Database
Open the .env file and update the following database credentials:

```bash
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
Now create a database in phpMyAdmin (or MySQL) with the same name.

## Step 6: Run Migrations

```bash
php artisan migrate
```

## Step 7: Install Frontend Dependencies

```bash
npm install
```

## Step 8: Compile Assets

For development:
```bash
npm run dev
```
For production:
```bash
npm run build
```

## Step 9: Start the Development Server

```bash
php artisan serve
```
Visit the application at:
http://127.0.0.1:8000

---
---

### ✅ INSTALLATION COMPLETED ✅
---
---


