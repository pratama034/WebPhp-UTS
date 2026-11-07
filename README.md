# KosManager - Sistem Manajemen & Portal Pencarian Kos Mahasiswa

Aplikasi web berbasis **PHP 8 Native (MVC)** dengan arsitektur bersih, *Strict Types*, *PDO MySQL*, autentikasi berbasis session, proteksi CSRF, serta antarmuka modern menggunakan Tailwind CSS.

---

## 🚀 Fitur Utama

### 1. Sisi Publik (Pencari Kos / Mahasiswa)
- **Katalog Kos & Kamar:** Menampilkan daftar kos terverifikasi dengan foto, harga sewa, fasilitas, dan status ketersediaan kamar.
- **Pencarian & Filter Interaktif:** Filter berdasarkan kata kunci nama/lokasi, rentang anggaran (budget), ketersediaan kamar kosong, dan pintasan area kampus (UB, UM, UIN, Polinema).
- **Detail Properti & Kamar:** Informasi detail kos, fasilitas kamar, peta lokasi, serta daftar kamar kosong vs terisi.
- **Janji Survei & Kontak WhatsApp Langsung:** Modal otomatis yang menyusun format pesan WhatsApp langsung ke pemilik kos tanpa calo.

### 2. Sisi Admin (Pengelola Kos)
- **Autentikasi Aman:** Sistem login admin terkunci dengan enkripsi `password_verify` (Bcrypt) dan proteksi session timeout.
- **Proteksi CSRF (Cross-Site Request Forgery):** Setiap mutasi data (POST form) dilindungi oleh token CSRF unik berbasis waktu-konstan (`hash_equals`).
- **Dashboard Ringkasan:** Statistik kamar terisi, kamar kosong, total properti, dan daftar penghuni terbaru.
- **CRUD Manajemen Kos:** Tambah, edit, dan kelola informasi publik properti kos.
- **CRUD Manajemen Kamar:** Pengelolaan nomor kamar, tipe kamar, tarif bulanan, serta sinkronisasi status ketersediaan.
- **CRUD Manajemen Penghuni:** Fitur *Check-in* dan *Checkout* penghuni yang secara otomatis menyinkronkan ketersediaan kamar dengan **Transaksi Database Atomik (ACID)**.
- **Flash Messages:** Notifikasi alert sukses/gagal otomatis setelah setiap aksi CRUD.

---

## 🛠️ Prasyarat & Teknologi
- **PHP:** >= 8.1 / 8.2 (dengan ekstensi `pdo_mysql` aktif)
- **Web Server:** Apache (XAMPP) dengan modul `mod_rewrite` aktif
- **Database:** MySQL / MariaDB
- **Frontend:** Tailwind CSS, Google Fonts (Plus Jakarta Sans), Material Symbols

---

## 📦 Panduan Instalasi & Menjalankan

1. **Clone Repository ini:**
   ```bash
   git clone https://github.com/pratama034/WebPhp-UTS.git KostManager
   ```
   *Pastikan folder diletakkan di dalam direktori `htdocs` XAMPP Anda (misal: `C:\xampp\htdocs\KostManager`).*

2. **Setup Database:**
   - Buka **phpMyAdmin** (`http://localhost/phpmyadmin/`).
   - Buat database baru bernama: `kostmanager`.
   - Buka menu **SQL** dan jalankan isi file `database/schema.sql` lalu `database/seeder.sql`.

3. **Jalankan Aplikasi:**
   - Buka **XAMPP Control Panel** dan aktifkan modul **Apache** dan **MySQL**.
   - Buka browser dan akses:
     - Halaman Utama: `http://localhost/KostManager/`
     - Login Admin: `http://localhost/KostManager/login`

---

## 🔐 Akun Default Admin (Pengelola)
- **Username:** `admin`
- **Password:** `admin123`
