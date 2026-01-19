MyFin — Aplikasi Manajemen Keuangan Pribadi
UAS Mata Kuliah Pengembangan Web Berbasis API Sistem
Dosen Pengampu: **ABDUL MALIK, S.Kom., M.Cs.** & **HASRIANI, S.Kom., M.Kom**

---

##  Kelompok 3 — Informatika
1. **Fauzan Azima** (Ketua)  
2. **Gefran**  
3. **Farida Nur Intan**  
4. **Fadhila Suardi**  
5. **Elysia Florean A.L**

DESKRIPSI PROYEK

MyFin adalah aplikasi manajemen keuangan pribadi yang dikembangkan menggunakan pendekatan **client–server berbasis RESTful API**.
Proyek ini merupakan pengembangan dari aplikasi web monolitik sebelumnya, di mana seluruh proses berada dalam satu sistem, kemudian dikembangkan dengan memisahkan **frontend (client)** dan **backend (API)**.

Frontend berfungsi sebagai antarmuka pengguna, sedangkan backend menyediakan layanan API untuk autentikasi dan pengelolaan data transaksi. Komunikasi data dilakukan menggunakan **HTTP request** dan **response JSON**.

---

TUJUAN PENGEMBANGAN

* Menerapkan konsep komunikasi antar sistem web menggunakan API
* Memisahkan logika bisnis dan tampilan
* Mengimplementasikan RESTful API
* Mengelola data keuangan secara terstruktur
* Meningkatkan modularitas dan keamanan sistem

---

ARSITEKTUR SISTEM

User
↓
Frontend Web (Client)
↓ HTTP Request (GET / POST)
Backend REST API
↓
Database MySQL
↓ JSON Response
↓
Frontend Web

Frontend tidak berkomunikasi langsung dengan database. Seluruh proses data dilakukan melalui API.

---

KONSEP KOMUNIKASI DUA WEB

Pada sistem ini, komunikasi dua web disimulasikan sebagai berikut:

* Frontend Web bertindak sebagai **client / consumer API**
* Backend Web bertindak sebagai **server / provider API**
* Komunikasi dilakukan menggunakan HTTP method dan format data JSON

Pendekatan ini mencerminkan konsep integrasi antar sistem web modern.

---

TEKNOLOGI YANG DIGUNAKAN

Backend (API):

* PHP Native
* RESTful API
* JSON Response
* HTTP Method: GET, POST
* Autentikasi Token Sederhana
* MySQL

Frontend (Client):

* HTML5
* CSS3
* JavaScript (Fetch API)

Tools Pendukung:

* Postman
* Git & GitHub
* XAMPP / Laragon

---

STRUKTUR FOLDER PROJECT

MyFin/
│
├── api/
│   ├── login.php          (Endpoint API autentikasi user)
│   └── transaksi.php     (Endpoint API transaksi keuangan)
│
├── app/
│   ├── config/
│   │     └── db.php
│   ├── middleware/
│   │     ├── auth.php
│   │     └── admin.php
│   └── libraries/
│         └── fpdf.php
│
├── public/
│   ├── assets/
│   ├── admin/
│   ├── categories/
│   ├── transactions/
│   ├── reports/
│   ├── login.php
│   ├── register.php
│   ├── dashboard.php
│   └── logout.php
│
├── sql/
│   └── keuangan_pribadi.sql
│
└── README.md

---

ENDPOINT API

Autentikasi
POST /api/login.php — Login user

Transaksi
GET /api/transaksi.php — Mengambil data transaksi
POST /api/transaksi.php — Menambah data transaksi

---

AUTENTIKASI & KEAMANAN

* Login dilakukan melalui API
* API mengembalikan token sederhana
* Token digunakan untuk mengakses endpoint transaksi
* Validasi input dan error handling diterapkan pada API

---

CONTOH RESPONSE API

Status: true
Message: Berhasil
Data: []

---

FITUR SISTEM

* Login dan autentikasi berbasis API
* Manajemen transaksi keuangan (CRUD)
* Manajemen kategori
* Dashboard keuangan
* Validasi data dan error handling
* Komunikasi client–server menggunakan API


Proyek ini dibuat untuk memenuhi tugas **Pengembangan Web Berbasis API Sistem**.
Konsep komunikasi dua web diimplementasikan secara konseptual dan disimulasikan dalam satu project untuk memudahkan pengembangan dan pengujian.
