# myForum

A simple, old-school forum website built during college using PHP and MySQL. This project demonstrates a lightweight discussion board implemented with classic LAMP-stack techniques (plain PHP, procedural or minimal MVC, and MySQL) — no frameworks, no fancy JS front-end, just server-rendered pages and basic styling.

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Configuration](#configuration)
- [Usage](#usage)
- [Security Notes & Improvements](#security-notes--improvements)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)
- [Acknowledgements](#acknowledgements)

---

## Overview

myForum is a small forum web application I created while in college to learn server-side web development. It covers basic forum functionality: user registration and login, creating threads, posting replies, and browsing topics. It was intentionally kept simple to focus on core concepts like routing, form handling, session management, and relational data modeling.

---

## Features

- User registration and login
- Create, view, edit, and delete threads (depending on permissions)
- Post replies to threads
- Basic user profile page
- Pagination for thread lists (if implemented)
- Simple server-side validation and session management

> Note: Exact feature availability depends on the code in the repo — treat this README as a guide and adapt paths/names to match your project structure.

---

## Tech Stack

- PHP (vanilla / old-school style)
- MySQL / MariaDB
- HTML, CSS (minimal)
- Apache or any PHP-capable web server (XAMPP, MAMP, LAMP)

---

## Prerequisites

- PHP 7.x or 8.x installed
- MySQL or MariaDB
- A local server environment such as XAMPP, MAMP, WAMP, or a LAMP server
- Basic CLI or phpMyAdmin access to import SQL

---

## Installation

1. Clone the repository to your web root (for example, htdocs in XAMPP):
   - git clone https://github.com/piyushv080/myForum.git

2. Start your server stack (Apache + MySQL).

3. Create the database and import the schema (see Database Setup below).

4. Configure database connection details in the project (see Configuration).

5. Open the site in your browser:
   - http://localhost/myForum/ (adjust path to where you placed the project)

---

## Database Setup

1. Create a new database (example name: `myforum_db`).

2. Import the SQL schema. If there's a SQL file in the repo (for example `database.sql`, `schema.sql`, or `myforum.sql`), import it using phpMyAdmin or the mysql CLI:

   - Using mysql CLI:
     mysql -u root -p myforum_db < path/to/myforum.sql

3. Typical tables you should expect (examples — adapt to actual schema):
   - `users` (id, username, email, password_hash, created_at, ...)
   - `threads` (id, user_id, title, body, created_at, ...)
   - `posts` (id, thread_id, user_id, body, created_at, ...)
   - `categories` (optional)
   - `sessions`, `likes`, etc. (optional)

If the repository does not include a SQL export, create the tables manually or use the provided admin/setup script if one exists.

---

## Configuration

Locate the file that holds DB credentials. Common filenames: `config.php`, `db.php`, `connection.php`. Update the values to match your local environment:

Example (replace with your actual file's variables):

```php
<?php
// config.php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'myforum_db';
?>
```

After saving the correct credentials, the application should be able to connect to the database.

---

## Running Locally

- Place the project folder in your server's document root (e.g., C:\xampp\htdocs\myForum).
- Start Apache and MySQL from XAMPP/MAMP.
- Navigate to http://localhost/myForum/ in your browser.

If you see errors, enable PHP error display (only for development) or check your webserver logs.

---

## Usage

- Register a new account (if registration is enabled).
- Create a new thread/topic.
- Post replies and browse other users' threads.
- Admin functionality (if present) may allow moderating or deleting posts.

---

## Security Notes & Improvements

This project was a college exercise and uses older practices. Before using it in production or sharing with others, consider these improvements:

- Use prepared statements or parameterized queries (PDO or mysqli with prepared statements) to prevent SQL injection.
- Store passwords using password_hash() and verify with password_verify().
- Implement CSRF tokens for form submissions.
- Sanitize and escape output to prevent XSS.
- Use HTTPS in production.
- Implement rate limiting and input validation.
- Replace deprecated PHP functions if present and upgrade to supported PHP version.

---

## Troubleshooting

- "Cannot connect to database": Check DB credentials and that MySQL is running.
- Blank pages or PHP errors: Enable error reporting in PHP (display_errors = On) for development.
- 404 errors: Confirm the project is in the correct document root and that URLs match the file structure.

---

## Contributing

This repo represents a personal college project. If you'd like to contribute, please:

1. Fork the project.
2. Create a branch for your feature or bugfix.
3. Submit a pull request with a clear description.

If you want me to add a CONTRIBUTING.md, tests, or modernize the codebase (move to PDO, MVC, or use a framework), tell me which direction you prefer.

---

## License

If you want to license this project, consider adding a LICENSE file. A common choice is the MIT License for small projects. If you prefer, I can add an MIT license file for you.

---

## Acknowledgements

Built as a learning project during college. Thanks to tutorials and community examples that helped shape the design.

---

If you want, I can:
- Add a sample `config.example.php` to the repo,
- Generate a SQL export based on your current schema,
- Or modernize the code (migrate to PDO, add prepared statements and password hashing) — tell me which you'd like and I'll prepare the changes.
