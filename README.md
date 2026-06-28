# Stock Management System — Full Developer Documentation

> **Repository:** [Anco-Sam-Franco-B/stock-managements](https://github.com/Anco-Sam-Franco-B/stock-managements)
> **Stack:** PHP · HTML · CSS
> **Purpose:** Track stock-in, stock-out, and remaining inventory items

---

## Table of Contents

1. [Project Overview](#1-project-overview)
2. [Tech Stack & Requirements](#2-tech-stack--requirements)
3. [Repository Structure](#3-repository-structure)
4. [Installation & Setup](#4-installation--setup)
5. [Database Schema](#5-database-schema)
6. [Core Features](#6-core-features)
7. [Page/Module Reference](#7-pagemodule-reference)
8. [How It Works — Data Flow](#8-how-it-works--data-flow)
9. [How to Use the System](#9-how-to-use-the-system)
10. [Extending the System](#10-extending-the-system)
11. [Common Issues & Fixes](#11-common-issues--fixes)
12. [Contributing Guide](#12-contributing-guide)
13. [License](#13-license)

---

## 1. Project Overview

The **Stock Management System** is a web-based inventory application built with PHP, HTML, and CSS. It enables businesses, warehouses, or individuals to:

- Record items **coming into** stock (Stock In)
- Record items **going out** of stock (Stock Out)
- View the **current remaining** quantity for each item in real time
- Keep a simple, clear audit trail of all stock movements

This is a self-hosted, file-based PHP application that runs on any standard LAMP/WAMP/XAMPP server — no special infrastructure is required.

---

## 2. Tech Stack & Requirements

| Layer        | Technology          |
|--------------|---------------------|
| Backend      | PHP 7.4+            |
| Frontend     | HTML5, CSS3         |
| Database     | MySQL / MariaDB     |
| Server       | Apache (via XAMPP, WAMP, LAMP, or similar) |

### Minimum Requirements

- PHP >= 7.4
- MySQL >= 5.7 or MariaDB >= 10.3
- Apache web server with `mod_rewrite` enabled
- A local development environment such as:
  - [XAMPP](https://www.apachefriends.org/) (Windows/macOS/Linux)
  - [WAMP](https://www.wampserver.com/) (Windows)
  - [LAMP Stack](https://ubuntu.com/server/docs/lamp-applications) (Linux)
  - [Laragon](https://laragon.org/) (Windows)

---

## 3. Repository Structure

```
stock-managements/
│
├── stock management/          # Main application folder
│   ├── index.php              # Dashboard / landing page
│   ├── stock_in.php           # Form and logic for adding stock
│   ├── stock_out.php          # Form and logic for removing stock
│   ├── view_stock.php         # Displays current stock levels
│   ├── db.php (or config.php) # Database connection configuration
│   ├── css/                   # Stylesheets (83.1% of codebase)
│   │   └── style.css
│   └── (other PHP modules)
│
└── README.md                  # Brief project description
```

> **Note:** The `css/` folder accounts for the majority of the codebase (83.1%), with PHP making up 16.8%, indicating a UI-focused project with relatively simple backend logic.

---

## 4. Installation & Setup

### Step 1 — Clone the Repository

```bash
git clone https://github.com/Anco-Sam-Franco-B/stock-managements.git
```

### Step 2 — Move to Server Root

Copy the `stock management` folder to your web server's document root:

| Environment | Path |
|-------------|------|
| XAMPP       | `C:/xampp/htdocs/stock-management/` |
| WAMP        | `C:/wamp64/www/stock-management/` |
| Linux LAMP  | `/var/www/html/stock-management/` |

### Step 3 — Create the Database

1. Open **phpMyAdmin** (usually at `http://localhost/phpmyadmin`)
2. Create a new database, e.g., `stock_db`
3. Import the SQL file if one is provided, or create the tables manually (see [Database Schema](#5-database-schema) below)

### Step 4 — Configure the Database Connection

Open the database configuration file (likely `db.php` or `config.php`) and update your credentials:

```php
<?php
$host     = "localhost";
$user     = "root";        // your MySQL username
$password = "";            // your MySQL password (blank by default in XAMPP)
$database = "stock_db";   // the database name you created

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

### Step 5 — Launch the App

Start Apache and MySQL in your environment, then open your browser:

```
http://localhost/stock-management/
```

---

## 5. Database Schema

Based on the system's described functionality (stock in, stock out, remaining stock), the expected database tables are:

### Table: `items`

Stores the master list of inventory items.

```sql
CREATE TABLE items (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    item_name   VARCHAR(150)   NOT NULL,
    category    VARCHAR(100)   DEFAULT NULL,
    unit        VARCHAR(50)    DEFAULT NULL,   -- e.g., kg, pcs, liters
    created_at  TIMESTAMP      DEFAULT CURRENT_TIMESTAMP
);
```

### Table: `stock_in`

Records all incoming stock transactions.

```sql
CREATE TABLE stock_in (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    item_id     INT            NOT NULL,
    quantity    INT            NOT NULL,
    date_in     DATE           NOT NULL,
    remarks     TEXT           DEFAULT NULL,
    created_at  TIMESTAMP      DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (item_id) REFERENCES items(id)
);
```

### Table: `stock_out`

Records all outgoing stock transactions.

```sql
CREATE TABLE stock_out (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    item_id     INT            NOT NULL,
    quantity    INT            NOT NULL,
    date_out    DATE           NOT NULL,
    remarks     TEXT           DEFAULT NULL,
    created_at  TIMESTAMP      DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (item_id) REFERENCES items(id)
);
```

### Remaining Stock — Calculated View

Remaining stock is computed dynamically using:

```sql
SELECT
    i.id,
    i.item_name,
    COALESCE(SUM(si.quantity), 0) AS total_in,
    COALESCE(SUM(so.quantity), 0) AS total_out,
    COALESCE(SUM(si.quantity), 0) - COALESCE(SUM(so.quantity), 0) AS remaining
FROM items i
LEFT JOIN stock_in  si ON i.id = si.item_id
LEFT JOIN stock_out so ON i.id = so.item_id
GROUP BY i.id, i.item_name;
```

---

## 6. Core Features

| Feature             | Description |
|---------------------|-------------|
| **Stock In**        | Add new stock arrivals for any item with quantity and date |
| **Stock Out**       | Record stock dispatched or consumed |
| **Remaining Stock** | Automatically calculated: `Total In − Total Out` |
| **Item Management** | Add and manage inventory item names/categories |
| **Dashboard**       | Overview of all items and their current stock levels |

---

## 7. Page/Module Reference

### `index.php` — Dashboard
- Displays a summary table of all items and their remaining stock
- Entry point of the application

### `stock_in.php` — Record Incoming Stock
- Form to select an item, enter quantity, and the date
- On submit: inserts a new row into `stock_in` table

### `stock_out.php` — Record Outgoing Stock
- Form to select an item, enter quantity, and the date
- On submit: inserts a new row into `stock_out` table
- Optionally validates that outgoing quantity does not exceed remaining stock

### `view_stock.php` — View Current Stock
- Runs the remaining-stock query (see above)
- Displays a table with columns: Item Name, Total In, Total Out, Remaining

### `db.php` / `config.php` — Database Connection
- Included by all other pages via `require_once`
- Centralizes database credentials

---

## 8. How It Works — Data Flow

```
User Action
    │
    ├── Stock In Form ──► INSERT into stock_in table
    │
    ├── Stock Out Form ─► INSERT into stock_out table
    │
    └── View Stock ─────► SELECT with JOIN & SUM
                              │
                              └── Remaining = SUM(stock_in) - SUM(stock_out)
                                  Displayed in the dashboard table
```

All database interactions use **MySQLi** (the `mysqli_*` functions in PHP). No ORM or framework is used — it is plain procedural PHP.

---

## 9. How to Use the System

### Adding a New Item

1. Navigate to the item management page (e.g., `add_item.php` or via the dashboard)
2. Enter the item name, category, and unit of measurement
3. Click **Save**

### Recording Stock In

1. Go to **Stock In** from the navigation
2. Select the item from the dropdown
3. Enter the quantity and date received
4. Optionally add remarks
5. Click **Submit** — the entry is saved and the remaining stock updates automatically

### Recording Stock Out

1. Go to **Stock Out** from the navigation
2. Select the item from the dropdown
3. Enter the quantity and date of dispatch
4. Optionally add remarks
5. Click **Submit** — the remaining stock decreases automatically

### Checking Stock Levels

1. Go to **View Stock** or the Dashboard
2. All items are listed with their **Total In**, **Total Out**, and **Remaining** columns
3. Items with low or zero stock can be identified immediately

---

## 10. Extending the System

Here are practical features you can add to enhance the project:

### A. User Authentication (Login System)

Add a `users` table and session-based login:

```php
// login.php
session_start();
if ($_POST['username'] === 'admin' && $_POST['password'] === password_verify(...)) {
    $_SESSION['logged_in'] = true;
    header('Location: index.php');
}
```

Protect all pages by adding at the top:

```php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}
```

### B. Low Stock Alerts

Add a threshold column to the `items` table:

```sql
ALTER TABLE items ADD COLUMN min_stock INT DEFAULT 10;
```

Then highlight items in red on the dashboard:

```php
if ($remaining <= $row['min_stock']) {
    echo '<tr class="low-stock">';
}
```

### C. Export to CSV / PDF

Add a download button that outputs stock data:

```php
// export.php
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="stock_report.csv"');
$output = fopen('php://output', 'w');
fputcsv($output, ['Item', 'Total In', 'Total Out', 'Remaining']);
// ... loop and fputcsv for each row
```

### D. Search & Filter

Add a search bar to `view_stock.php`:

```php
$search = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';
$sql = "SELECT ... WHERE i.item_name LIKE '%$search%'";
```

### E. Responsive Design with Bootstrap

Replace the custom CSS with Bootstrap for a mobile-friendly UI:

```html
<link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
```

Convert existing tables to Bootstrap table classes:

```html
<table class="table table-striped table-hover table-bordered">
```

### F. Stock History / Audit Log

Add a dedicated history page showing all stock movements sorted by date:

```sql
SELECT 'IN' AS type, item_id, quantity, date_in AS date, remarks
FROM stock_in
UNION ALL
SELECT 'OUT', item_id, quantity, date_out, remarks
FROM stock_out
ORDER BY date DESC;
```

### G. REST API Endpoint

Expose stock data as JSON for integration with other apps:

```php
// api/stock.php
header('Content-Type: application/json');
require_once '../db.php';
$result = mysqli_query($conn, "SELECT ... remaining stock query ...");
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
echo json_encode($data);
```

---

## 11. Common Issues & Fixes

| Problem | Cause | Fix |
|--------|-------|-----|
| Blank page / white screen | PHP error hidden | Enable errors: `error_reporting(E_ALL); ini_set('display_errors', 1);` |
| "Connection failed" error | Wrong DB credentials | Check `db.php` — verify host, user, password, DB name |
| Stock goes negative | No validation on stock out | Add a check: if `$qty > $remaining`, show an error instead of inserting |
| Form submits but nothing saves | Missing `name` attribute on inputs | Ensure all `<input>` and `<select>` tags have `name="..."` |
| CSS not loading | Wrong relative path | Use `<?php echo $_SERVER['DOCUMENT_ROOT']; ?>` or adjust relative paths |
| Page not found (404) | Folder name has a space | Rename `stock management` to `stock-management` and update URLs |

> **Tip on the folder name:** The repository contains a folder called `stock management` (with a space). This can cause issues in URLs. Rename it to `stock-management` or `stock_management` for best compatibility.

---

## 12. Contributing Guide

Contributions are welcome! Here's how to get started:

### Fork & Clone

```bash
git clone https://github.com/YOUR-USERNAME/stock-managements.git
cd stock-managements
```

### Create a Feature Branch

```bash
git checkout -b feature/add-login-system
```

### Make Your Changes

Follow these conventions:
- Use `snake_case` for PHP variable and function names
- Keep PHP and HTML separated where possible (avoid mixing heavy logic in view files)
- Comment your SQL queries
- Test locally with XAMPP/WAMP before pushing

### Submit a Pull Request

```bash
git add .
git commit -m "feat: add session-based login system"
git push origin feature/add-login-system
```

Then open a Pull Request on GitHub against the `main` branch.

---

## 13. License

This project does not currently specify a license. If you intend to use it in production or contribute, consider adding an open-source license:

- **MIT License** — permissive, recommended for open projects
- **GPL v3** — requires derivative works to also be open-source

To add a license, create a `LICENSE` file in the repository root and select a template from [choosealicense.com](https://choosealicense.com).

---

*Documentation generated from the public repository at [github.com/Anco-Sam-Franco-B/stock-managements](https://github.com/Anco-Sam-Franco-B/stock-managements). Last updated: June 2026.*
