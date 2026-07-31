# Laravel POS System

Aplikasi Point of Sale (POS) sederhana yang dibuat menggunakan **Laravel 12** dan **PostgreSQL** sebagai tugas praktik seleksi programmer.

## Tech Stack

- Laravel 12
- PHP 8.5.8
- PostgreSQL
- Blade
- Tailwind CSS
- Chart.js
- Breeze

---

## Fitur

### Authentication

- Login
- Register
- Logout

### Dashboard

- Grafik rekap penjualan
- Export laporan penjualan (CSV)

### Master Data

- CRUD Supplier
- CRUD Barang

### Transaksi

#### Pembelian

- Input pembelian barang
- Menambah stok otomatis
- Menghitung grand total otomatis

#### Penjualan

- Input penjualan barang
- Validasi stok
- Mengurangi stok otomatis
- Menghitung grand total otomatis

---

## Struktur Database

```
users

suppliers

products

purchases
└── purchase_items

sales
└── sale_items
```

Relasi:

- Supplier memiliki banyak Purchase
- Purchase memiliki satu Product (implementasi sederhana)
- Sale memiliki satu Product (implementasi sederhana)
- Product digunakan pada Purchase dan Sale

---

## Cara Menjalankan Project

### Clone Repository

```bash
git clone https://github.com/daffaqshal/laravel-pos-system.git
```

Masuk ke folder project

```bash
cd laravel-pos-system
```

Install dependency

```bash
composer install
```

Install dependency frontend

```bash
npm install
```

Copy file environment

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

---

## Konfigurasi Database

Edit file `.env`

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel_pos_system
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

---

## Migration Database

```bash
php artisan migrate
```

---

## Jalankan Project

Terminal pertama

```bash
php artisan serve
```

Terminal kedua

```bash
npm run dev
```

Buka browser

```
http://127.0.0.1:8000
```

---

## Akun Demo

Silakan melakukan registrasi melalui halaman Register.

Atau gunakan akun yang telah dibuat sebelumnya.

email : daffaaqshal04@gmail.com
pw : hornet2312

---
