# Kyensobola.work MVP

An East African jobs, gigs and skills marketplace built with plain PHP, MySQL, HTML, CSS and JavaScript.

## Requirements
- PHP 8.1+
- MySQL 5.7+/MariaDB
- Apache hosting
- PDO MySQL enabled

## Installation
1. Create a MySQL database or import `database/kyensobola.sql` using phpMyAdmin.
2. Open `config/database.php`.
3. Replace:
   - `YOUR_DB_USER`
   - `YOUR_DB_PASSWORD`
   - database name/host if necessary.
4. Upload the contents of this folder to your hosting public directory.
5. Make sure `images/profiles/` is writable by PHP.
6. Open `index.php`.

## Important launch changes
- Change the contact email in `contact.php`.
- Add your real WhatsApp number.
- Create an admin account by changing a user's `role` from `user` to `admin` in phpMyAdmin.
- Add HTTPS/SSL.
- Configure backups.
- Add email verification, password reset, moderation, reviews, messaging and payment features before a large public launch.

## Current MVP features
- Registration/login/logout
- User profiles
- Profile photo upload
- East African country/city fields
- Skills and categories
- Talent search
- Job/gig search
- Job posting
- Job applications
- Simple dashboard
- Basic admin overview
- Responsive mobile design
