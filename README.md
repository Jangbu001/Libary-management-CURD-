# 📚 Venus Library Management System

A modern, web-based Library Management System developed as a **Standard XII Science Project** for Venus National College. This application provides a full CRUD (Create, Read, Update, Delete) interface for managing book inventories.



## 🚀 Features
* **Inventory Dashboard**: View all registered books in a clean, responsive table.
* **Search Functionality**: Real-time search by Book Title or Author.
* **Dynamic Modals**: Register and Edit books without leaving the page using smooth UI transitions.
* **SVG Integration**: Modern iconography for Edit and Delete actions.
* **Mobile Responsive**: Fully optimized for tablets and mobile devices.

## 🛠️ Tech Stack
* **Frontend**: HTML5, CSS3 (Custom Variables & Flexbox), JavaScript (ES6)
* **Backend**: PHP 8.x
* **Database**: MySQL
* **Icons**: Custom SVG

## 📥 Installation

1.  **Clone the Repository**:
    ```bash
    git clone [https://github.com/Jangbu001/Libary-management-CURD.git](https://github.com/Jangbu001/Libary-management-CURD.git)
    ```
2.  **Setup Database**:
    * Open PHPMyAdmin.
    * Create a database named `libary_management`.
    * Import the provided SQL file (if available) or create a table named `books` with columns: `id`, `title`, `author`, `email`, `phone`, `address`, `isbn`.

    * ```bash
-- 1. Create the database 

CREATE DATABASE IF NOT EXISTS library_management; 
USE libary_management; 


-- 2. Create the table with a 4-digit formatted ID 

CREATE TABLE books ( 
    id INT(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, 
    title VARCHAR(255) NOT NULL, 
    author VARCHAR(100) NOT NULL, 
    email VARCHAR(200) NOT NULL, 
    phone VARCHAR(20) NULL, 
    address VARCHAR(255) NULL, 
    isbn VARCHAR(50) NOT NULL UNIQUE, 
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY (id) 

); 


-- 3. Insert sample data 

INSERT INTO books (title, author, email, phone, address, isbn) 
VALUES 

('Muna Madan', 'Laxmi Prasad Devkota', 'info@sajhaprakashan.com.np', '9841234567', 'Pulchowk, Lalitpur', '978-9937-1'), 
('Seto Bagh', 'Diamond Shumsher Rana', 'diamond.shumsher@nepal.com', '9851012345', 'Thamel, Kathmandu', '978-9937-2'), 
('Palpasa Café', 'Narayan Wagle', 'narayan.wagle@kantipur.com', '9803334444', 'Baneshwor, Kathmandu', '978-9937-3'), 
('Karnali Blues', 'Buddhisagar', 'buddhisagar@writer.com.np', '9812223334', 'Maitighar, Kathmandu', '978-9937-4'); ```

3.  **Configure Connection**:
    * Ensure your database credentials in `index.php` (and other files) match your local environment (usually `root` and no password).
4.  **Run**:
    * Move the folder to your XAMPP `htdocs` directory and visit `http://localhost/Libary-management-CURD`.

---
© 2025 | Academic Portfolio Project
