# 🎓 KU Student Management System

A web-based Student Management System built for Kathmandu University using Laravel and MySQL. This system is designed to efficiently manage student data, programs, courses, and admission processes.

## 🛠️ Technologies Used

- **Laravel (PHP Framework)**
- **MySQL (Database)**
- **Blade (Laravel Templating Engine)**
- **HTML, CSS, JavaScript**

---

## 🚀 Features

- Student Registration and Management  
- Program and Course Assignment  
- Admission Form Handling  
- Admin Filtering and Search  
- Dashboard for Program Statistics  
- Role-based Access (Admin, Staff)  
- Exportable Reports and Student Lists  

---

## 📁 Project Structure

ku-student-management/
├── app/
├── bootstrap/
├── config/
├── database/
│ ├── migrations/
│ └── seeders/
├── public/
├── resources/
│ ├── views/
│ └── css/js/
├── routes/
│ └── web.php
├── .env
└── README.md

yaml
Copy
Edit

---

## ⚙️ Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/Swornim-FENG/Student-Management-System-DM-DW/tree/master
cd ku-student-management

2. Install Dependencies

composer install
npm install && npm run dev

3. Generate Application Key

php artisan key:generate

4. Run Migrations and Seeders

php artisan migrate --seed

5. Start Development Server

php artisan serve
Open your browser and go to: http://127.0.0.1:8000

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
