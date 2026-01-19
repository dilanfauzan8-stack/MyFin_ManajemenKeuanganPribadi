# MyFin — Aplikasi Manajemen Keuangan Pribadi

UAS Mata Kuliah **Pengembangan Web Berbasis API Sistem**

Dosen Pengampu: **ABDUL MALIK, S.Kom., M.Cs.** & **HASRIANI, S.Kom., M.Kom**

---

## Kelompok 3 — Informatika

1. **Fauzan Azima** (Ketua)
2. **Gefran**
3. **Farida Nur Intan**
4. **Fadhila Suardi**
5. **Elysia Florean A.L**

---

# Deskripsi Proyek

**MyFin** adalah aplikasi manajemen keuangan pribadi yang dikembangkan menggunakan arsitektur **client–server berbasis RESTful API**.
Proyek ini merupakan **pengembangan dari aplikasi web monolitik sebelumnya**, yang kemudian diperbarui dengan memisahkan **frontend (client)** dan **backend (API)**.

Frontend berfungsi sebagai antarmuka pengguna, sedangkan backend menyediakan layanan API untuk autentikasi dan pengelolaan data keuangan. Komunikasi antara frontend dan backend dilakukan menggunakan **HTTP request dan response JSON**.

Dibuat sebagai pemenuhan **UAS Pengembangan Web Berbasis API Sistem**, dengan fokus pada implementasi:

* RESTful API
* Komunikasi dua aplikasi web menggunakan API
* CRUD (Create, Read, Update, Delete) melalui endpoint API
* Autentikasi dan validasi data
* Integrasi frontend dan backend

---

# Fitur Aplikasi

### Autentikasi (Berbasis API)

* Login melalui API
* Token autentikasi sederhana
* Validasi input dan error handling

### Manajemen Transaksi (API)

* Tambah transaksi (POST)
* Ambil data transaksi (GET)
* Filter dan pencarian data
* Response JSON

### Manajemen Kategori

* Income & Expense
* CRUD melalui backend

### Dashboard

* Total pemasukan
* Total pengeluaran
* Saldo akhir
* Grafik batang (Canvas API)
* Tampilan responsif

### Laporan PDF

* Rekap pendapatan
* Rekap pengeluaran
* Saldo akhir
* Detail transaksi
* Export PDF menggunakan FPDF

---

# Konsep Komunikasi Dua Web

Pada sistem ini diterapkan konsep komunikasi dua web sebagai berikut:

* **Web Client (Frontend)** bertindak sebagai pengguna layanan
* **Web Server (Backend API)** menyediakan data dan logika bisnis
* Komunikasi dilakukan melalui RESTful API menggunakan HTTP Method dan JSON

Konsep ini disimulasikan dalam satu project.

---

# Struktur Folder Project

```
MyFin/
│
├── api/
│   ├── login.php            # Endpoint API autentikasi
│   └── transaksi.php       # Endpoint API transaksi
│
├── app/
│   ├── config/
│   │     └── db.php
│   ├── middleware/
│   │     ├── auth.php
│   │     └── admin.php
│   ├── libraries/
│   │     └── fpdf.php
│
├── public/
│   ├── assets/
│   │     ├── css/style.css
│   │     └── js/app.js
│   ├── admin/
│   ├── categories/
│   ├── transactions/
│   ├── reports/
│   ├── login.php
│   ├── register.php
│   ├── dashboard.php
│   └── logout.php
│
└── sql/
     └── keuangan_pribadi.sql
```

---

# Endpoint API

### Autentikasi

* POST `/api/login.php` — Login user

### Transaksi

* GET `/api/transaksi.php` — Mengambil data transaksi
* POST `/api/transaksi.php` — Menambah data transaksi

---

# Cara Menjalankan Aplikasi

### 1️⃣ Install XAMPP / Laragon

Aktifkan **Apache** dan **MySQL**

### 2️⃣ Pindahkan project ke:

```
C:\xampp\htdocs\MyFin\
```

### 3️⃣ Import Database

1. Buka phpMyAdmin
2. Buat database `keuangan_pribadi`
3. Import file `sql/keuangan_pribadi.sql`

### 4️⃣ Konfigurasi koneksi database

File:

```
app/config/db.php
```

### 5️⃣ Jalankan aplikasi

```
http://localhost/MyFin/public/login.php
```

---

# Teknologi yang Digunakan

* PHP Native
* RESTful API
* MySQL
* HTML5
* CSS3
* JavaScript (Fetch API & Canvas)
* FPDF
* XAMPP / Laragon

---

# Status Project

RESTful API
Client–Server Architecture
CRUD Berbasis API
Autentikasi & Validasi
Dashboard & Laporan PDF
Responsive Design

---

# Dibuat oleh Kelompok 3 — Informatika

Project ini dibuat untuk memenuhi **UAS Mata Kuliah Pengembangan Web Berbasis API Sistem**.

---
