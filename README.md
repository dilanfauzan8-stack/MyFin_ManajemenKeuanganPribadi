# 📌 MyFin — Aplikasi Manajemen Keuangan Pribadi
UTS Mata Kuliah **Pengembangan Web**  
Dosen Pengampu: **ABDUL MALIK, S.Kom., M.Cs.** & **HASRIANI, S.Kom., M.Kom**

---

## 👥 Kelompok 3 — Informatika
1. **Fauzan Azima** (Ketua)  
2. **Gefran**  
3. **Farida Nur Intan**  
4. **Fadhila Suardi**  
5. **Elysia Florean A.L**

---

# 📝 Deskripsi Proyek
**MyFin** adalah aplikasi web untuk mengelola keuangan pribadi.  
Fitur meliputi pencatatan pemasukan, pengeluaran, kategori transaksi, riwayat transaksi, serta pembuatan laporan PDF.

Dibuat sebagai pemenuhan **UTS Pengembangan Web**, dengan fokus pada implementasi:
- CRUD (Create, Read, Update, Delete)
- Login, Register, Session, Cookie “Remember Me”
- Role-Based Access (Admin & User)
- Responsive Web Design (Flexbox, Grid, Media Query)
- Validasi Form (Client & Server)
- GET & POST Method
- Export PDF menggunakan FPDF
- Dashboard + Grafik Canvas
- Pagination, Filter, Search

---

# 🚀 Fitur Aplikasi

### 🔐 Autentikasi
- Login
- Register
- Logout
- Session
- Cookies
- Middleware auth & admin

### 👥 Role Management
- **User**: Transaksi & Kategori  
- **Admin**: Kelola User (Tambah, Hapus, Reset Password)

### 💰 Manajemen Transaksi
- Tambah, Edit, Hapus
- Filter tanggal
- Searching
- Pagination

### 🗂 Manajemen Kategori
- Income
- Expense
- CRUD Lengkap

### 📊 Dashboard
- Total pemasukan
- Total pengeluaran
- Saldo akhir
- Grafik batang (Canvas API)
- UI modern & responsive

### 📄 Laporan PDF
- Rekap pendapatan
- Rekap pengeluaran
- Saldo akhir
- Detail transaksi
- Export PDF berdasarkan tanggal

---

# 📁 Struktur Folder Project

```
keuangan_pribadi/
│
├── app/
│   ├── config/
│   │     └── db.php
│   ├── middleware/
│   │     ├── auth.php
│   │     └── admin.php
│   ├── libraries/
│   │     └── fpdf.php
│   └── views/
│         └── templates/
│               ├── header.php
│               └── footer.php
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
│   ├── process_login.php
│   ├── process_register.php
│   └── logout.php
│
└── sql/
     └── keuangan_pribadi.sql
```

---

# ⚙️ Cara Menjalankan Aplikasi

### 1️⃣ Install XAMPP
Aktifkan **Apache** dan **MySQL**

### 2️⃣ Pindahkan project ke:
```
C:\xampp\htdocs\keuangan_pribadi\
```

### 3️⃣ Import Database
1. Buka phpMyAdmin  
2. Buat database `keuangan_pribadi`  
3. Import file `sql/keuangan_pribadi.sql`

### 4️⃣ Cek konfigurasi koneksi
File:
```
app/config/db.php
```

### 5️⃣ Jalankan:
```
http://localhost/keuangan_pribadi/public/login.php
```

---

# 🔑 Akun Demo

### 👮 Admin
- username: **admin**
- password: **admin123**

### 👤 User
- username: **user1**
- password: **123456**

---

# 🧩 Teknologi yang Digunakan
- PHP Native
- MySQL
- HTML5
- CSS3
- JavaScript (DOM & Canvas)
- FPDF
- XAMPP

---

# 🏁 Status Project
✔ CRUD Lengkap  
✔ Responsive Design  
✔ Session & Cookie  
✔ Export PDF  
✔ Dashboard  
✔ Admin & User Roles  
✔ Siap dikumpulkan UTS 🎉

---

# 🎓 Dibuat oleh Kelompok 3 — Informatika
Terima kasih 🙌  
Project ini dibuat untuk memenuhi UTS mata kuliah Pengembangan Web.
