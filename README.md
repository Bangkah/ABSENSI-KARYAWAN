# **Absensi App - by Muhammad Dhiyaul Atha**

Aplikasi Absensi berbasis **Laravel 10** dengan fitur **absensi masuk dan pulang** menggunakan **QRCode** atau **input manual**, serta sistem manajemen pengguna dan kehadiran yang lengkap.

---

## ✨ Fitur Utama

- ✅ CRUD Jabatan / Posisi
- ✅ Manajemen Pengguna (Admin, Operator, Pegawai)
- ✅ CRUD Hari Libur
- ✅ Sistem Absensi Masuk & Pulang (QR Code / Manual)
- ✅ Riwayat Absensi 30 Hari Terakhir
- ✅ Permintaan dan Persetujuan Izin
- ✅ Laporan Karyawan Tidak Hadir
- ✅ Export Laporan ke **Excel** & **CSV**
- ✅ Role Based Access Control (RBAC)
- ✅ Tabel interaktif dengan **Livewire PowerGrid**

---

## 🛠 Cara Instalasi di Localhost (Linux / Windows / Mac)

### ✅ Persyaratan

- PHP >= 8.1
- Composer
- Git
- MySQL / MariaDB

### 📥 Langkah Instalasi

```bash
# Clone repository
git clone https://github.com/Bangkah/ABSENSI-KARYAWAN.git
cd ABSENSI-KARYAWAN

# Install semua dependency
composer install

# Copy file environment
cp .env.example .env

# Ubah konfigurasi database di file .env:
# DB_DATABASE=absensi_karyawan
# DB_USERNAME=root
# DB_PASSWORD=

# Generate APP_KEY
php artisan key:generate

# Migrasi dan seeding database
php artisan migrate --seed

# Jalankan server lokal
php artisan serve
```

Setelah server berjalan, buka browser dan akses:

```
http://localhost:8000
```

---
<br>

 
 ## 📁 Struktur Folder Penting

| Path                                | Deskripsi                              |
|-------------------------------------|----------------------------------------|
| `app/Http/Controllers/`             | Logika Controller Laravel              |
| `resources/views/`                  | Tampilan Blade (Frontend)              |
| `routes/web.php`                    | Routing Aplikasi                       |
| `public/js/home/qrcode.js`          | QR Code Scanner JavaScript             |
| `database/seeders/`                 | Seeder Data Awal (Akun & Jabatan)      |

---

## 👨‍💻 Developer

**Muhammad Dhiyaul Atha**  
GitHub: [https://github.com/Bangkah](https://github.com/Bangkah)

---

## 🔒 Lisensi

Proyek ini dikembangkan untuk pembelajaran dan pengembangan pribadi. Silakan fork dan modifikasi sesuai kebutuhan.
