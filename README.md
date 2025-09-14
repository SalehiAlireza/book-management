# مدیریت کتابخانه با Laravel


## ویژگی‌ها

- مدیریت کاربران (Users): ثبت، مشاهده، ویرایش و حذف  
- مدیریت دسته‌بندی‌ها (Categories): ایجاد، ویرایش، حذف و مشاهده دسته‌بندی‌ها  
- مدیریت کتاب‌ها (Books): ثبت کتاب جدید، ویرایش، حذف و مشاهده کتاب‌ها  
- مدیریت امانت‌ها (Loans): امانت گرفتن و برگشت کتاب با بررسی موجودی و وضعیت (`borrowed`, `returned`, `late`)  
- API Resource برای خروجی JSON تمیز و سازماندهی شده  
- Factory و Seeder برای تولید داده‌های تستی و سریع  

---

## نصب و راه‌اندازی
- PHP 8.1 یا بالاتر  
- Composer  
- MySQL یا MariaDB  
- Git  

git clone https://github.com/SalehiAlireza/book-management.git

cd book-management

composer install


اطلاعات دیتابیس خود را در .env تنظیم کنید
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_db
DB_USERNAME=root
DB_PASSWORD=your_password


php artisan key:generate

php artisan migrate:fresh --seed

داده‌های تستی شامل:
۵ دسته‌بندی
۲۰ کتاب
۱۰ کاربر
۳۰ امانت
