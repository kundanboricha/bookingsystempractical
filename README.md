# 🗓️ Booking System Practical

A practical Laravel-based booking system that supports full-day, half-day, and custom time bookings with conflict prevention logic, sleek UI, and smooth setup.

---

## 🔧 Tech Stack

- ⚙️ **Laravel** (Backend)
- 🐬 **MySQL** (Database)
- 🎨 **Blade** (Templating)
- 💨 **Tailwind CSS** (Styling)

---

## ✅ Features

- 📋 **Booking Form** with Full Day, Half Day, and Custom options  
- 🔄 **Dynamic Fields** — form fields auto-update based on booking type  
- 🔐 **Overlap Prevention Logic**:
  - **Full Day**: Blocks all other bookings on that day  
  - **Half Day**: Blocks conflicting half-day or custom slots  
  - **Custom**: Blocks any overlapping time range  
- 📈 **Indexing for Performance** — optimized DB schema for MySQL  
- ⚠️ **Validation with Real-time Feedback** in the UI  
- 💌 **Email Notifications** (configured via `.env`)

---

## 🚀 Installation & Setup

```bash
git clone https://github.com/kundanboricha/bookingsystempractical.git
cd bookingsystempractical
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
npm install
npm run dev

---

##  📧 Mail Configuration

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="Booking System"



Let me know if you want me to help create this file in your local repo or guide you through pushing it to GitHub.
