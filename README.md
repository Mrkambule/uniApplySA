# Centralized University Application Support (PHP + MySQL)

A lightweight PHP & MySQL web app to help South African matriculants apply to universities and find bursaries—featuring curated links, bursary filters, step-by-step guidance, checklists, embedded tutorials, and a simple FAQ chatbot.

## Requirements
- PHP 8.0+ with PDO MySQL extension
- MySQL 5.7+ / MariaDB 10.4+
- A local server stack like XAMPP/Laragon/MAMP
- Enable `mod_rewrite` optional (not required)

## Setup (Local)
1. Create a new MySQL database (e.g. `university_app`).
2. Import `database.sql` into your database.
3. Copy `public/config.sample.php` to `public/config.php` and update DB credentials.
4. Put the `public` folder inside your web root (e.g., `htdocs/university_app`).
5. Visit `http://localhost/university_app/` in your browser.

### Default Admin
- Email: `admin@example.com`
- Password: `Admin@123`

> Change this after login via the Profile section (top-right).

## Structure
```
/public
  index.php, universities.php, bursaries.php, guidance.php, checklist.php,
  tutorials.php, chatbot.php, login.php, register.php, logout.php
  /admin (basic CRUD for institutions, bursaries, FAQ)
  /assets (style.css, scripts.js)
  /api (chatbot_api.php, checklist_api.php)
/inc (db.php, auth.php, functions.php, header.php, footer.php, nav.php, csrf.php)
database.sql
```

## Notes
- This is intentionally simple and self-contained (no frameworks).
- Chatbot uses keyword matching on `faq` table.
- Bursary and university filters are server-side with prepared statements.
- Checklist is linked to a signed-in user; demo supports guest checklist via session too.
- YouTube embeds are configurable in `tutorials.php`.

## Security Checklist (do in production)
- Use HTTPS
- Change default admin credentials immediately
- Configure proper file permissions (e.g., `644` files, `755` directories)
- Keep PHP updated
- Use a real mailer (PHPMailer) if you add password resets
