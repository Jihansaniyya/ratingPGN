<p align="center">
  <img src="public/images/logoGASNET.png" alt="Gasnet Logo" width="200">
</p>

<h1 align="center">On-Site Customer Gasnet</h1>

<p align="center">
  Sistem Informasi Penilaian Kepuasan Pelanggan<br>
  <strong>PT Telemedia Dinamika Sarana - Divisi Gasnet</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat-square&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/License-MIT-green?style=flat-square" alt="License">
</p>

---

## Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Fitur Utama](#fitur-utama)
- [Teknologi](#teknologi)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Struktur Proyek](#struktur-proyek)
- [Panduan Penggunaan](#panduan-penggunaan)
- [Skema Database](#skema-database)
- [API Endpoints](#api-endpoints)
- [Akun Default](#akun-default)
- [Lisensi](#lisensi)

---

## Tentang Proyek

**On-Site Customer Gasnet** adalah aplikasi web internal yang dirancang untuk mengelola dan mendokumentasikan kegiatan kunjungan lapangan (on-site) ke pelanggan PT Telemedia Dinamika Sarana (Divisi Gasnet). Aplikasi ini mencakup pencatatan formulir kunjungan, pengelolaan data pelanggan, perangkat maintenance, serta penilaian kepuasan pelanggan secara digital.

Aplikasi ini menggantikan proses manual pencatatan formulir kunjungan berbasis kertas menjadi sistem digital yang terpusat, sehingga memudahkan pelacakan, pelaporan, dan analisis data kepuasan pelanggan.

---

## Fitur Utama

### Manajemen Formulir Kunjungan
- Pembuatan, pengeditan, dan penghapusan formulir kunjungan on-site.
- Pencatatan aktivitas kunjungan: Survey, Activation, Upgrade, Downgrade, Troubleshoot, dan Preventive Maintenance.
- Input keluhan pelanggan (complaint) dan tindakan yang dilakukan (action).
- Tanda tangan digital untuk Pihak Pertama (petugas) dan Pihak Kedua (pelanggan).

### Manajemen Pelanggan
- Pencarian pelanggan secara otomatis (autocomplete) berdasarkan nama atau CID.
- Penyimpanan data pelanggan meliputi: nama, alamat lengkap (provinsi, kota, kecamatan, kelurahan), layanan, kapasitas, kontak, dan email.

### Perangkat Maintenance
- Pencatatan perangkat yang di-maintenance pada setiap kunjungan.
- Dokumentasi foto produk dan keterangan perangkat.

### Penilaian Kepuasan (Assessment)
- Tiga skala penilaian: Sangat Puas, Puas, dan Tidak Puas.
- Visualisasi distribusi kepuasan melalui grafik doughnut pada dashboard.
- Statistik ringkasan secara real-time.

### Dashboard
- Ringkasan statistik: total formulir, total pengguna, distribusi penilaian.
- Grafik distribusi kepuasan pelanggan.
- Daftar formulir terbaru dengan akses cepat ke detail.

### Laporan dan Ekspor
- Laporan data kunjungan dengan filter berdasarkan periode dan penilaian.
- Ekspor laporan ke format CSV.
- Cetak laporan resmi dengan kop surat perusahaan.
- Ekspor formulir individual ke format PDF siap cetak.

### Manajemen Pengguna
- Dua peran pengguna: **Admin** dan **Petugas**.
- Admin dapat mengelola akun petugas (tambah, edit, hapus).
- Setiap pengguna dapat mengubah password masing-masing.

### Keamanan
- Autentikasi berbasis session dengan dukungan "Ingat Saya".
- Proteksi route berdasarkan peran pengguna (role-based access).
- Rate limiting pada form login dan endpoint API.
- CSRF protection pada seluruh form.

---

## Teknologi

| Komponen       | Teknologi                        |
|----------------|----------------------------------|
| Framework      | Laravel 12.x                     |
| Bahasa         | PHP 8.2+                         |
| Database       | MySQL 8.0                        |
| Frontend       | Blade Templates, Bootstrap 5.3   |
| Grafik         | Chart.js 4.x                     |
| Notifikasi     | SweetAlert2                      |
| Ikon           | Font Awesome 6.x                 |
| Animasi        | Animate.css                      |
| Build Tool     | Vite                             |
| Testing        | Pest PHP                         |

---

## Persyaratan Sistem

- PHP >= 8.2
- Composer >= 2.x
- MySQL >= 8.0
- Node.js >= 18.x
- NPM >= 9.x
- Ekstensi PHP yang diperlukan: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `gd`

---

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/ratingPGN.git
cd ratingPGN
```

### 2. Install Dependensi

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ratingpgn_app
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Buat Database

Buat database `ratingpgn_app` pada MySQL server:

```sql
CREATE DATABASE ratingpgn_app;
```

### 6. Jalankan Migrasi dan Seeder

```bash
php artisan migrate
php artisan db:seed
```

### 7. Build Asset Frontend

```bash
npm run build
```

### Instalasi Cepat (Alternatif)

Gunakan perintah Composer script yang telah disediakan:

```bash
composer run setup
```

Perintah ini secara otomatis menjalankan seluruh langkah instalasi: install dependensi, generate key, migrasi database, install NPM, dan build asset.

---

## Konfigurasi

### Session

Aplikasi menggunakan session berbasis database. Pastikan tabel `sessions` telah dibuat melalui migrasi:

```env
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

### Storage Link

Untuk menampilkan foto produk yang diunggah, buat symbolic link ke storage:

```bash
php artisan storage:link
```

---

## Menjalankan Aplikasi

### Mode Development

```bash
composer run dev
```

Perintah ini akan menjalankan tiga proses secara bersamaan:
- **Server**: `php artisan serve` (http://127.0.0.1:8000)
- **Queue**: `php artisan queue:listen`
- **Vite**: `npm run dev` (hot module replacement)

### Mode Manual

```bash
php artisan serve
```

Akses aplikasi melalui browser di `http://127.0.0.1:8000`.

---

## Struktur Proyek

```
ratingPGN/
|-- app/
|   |-- Http/
|   |   |-- Controllers/
|   |   |   |-- AuthController.php          # Autentikasi (login, logout, ubah password)
|   |   |   |-- DashboardController.php     # Halaman dashboard dan statistik
|   |   |   |-- OnSiteFormController.php    # CRUD formulir kunjungan on-site
|   |   |   |-- ReportController.php        # Laporan, cetak, dan ekspor CSV
|   |   |   |-- UserController.php          # Manajemen pengguna (admin)
|   |   |-- Middleware/
|   |       |-- AdminMiddleware.php         # Proteksi route khusus admin
|   |-- Models/
|       |-- Customer.php                    # Model pelanggan
|       |-- MaintenanceDevice.php           # Model perangkat maintenance
|       |-- OnSiteForm.php                  # Model formulir kunjungan
|       |-- User.php                        # Model pengguna
|-- database/
|   |-- migrations/                         # Skema tabel database
|   |-- seeders/
|       |-- DatabaseSeeder.php              # Data awal (admin & petugas)
|-- public/
|   |-- images/
|       |-- logoGASNET.png                  # Logo perusahaan
|       |-- backgound-loginGASNET.png       # Background halaman login
|-- resources/
|   |-- views/
|       |-- auth/
|       |   |-- login.blade.php             # Halaman login
|       |   |-- change-password.blade.php   # Halaman ubah password
|       |-- dashboard.blade.php             # Halaman dashboard
|       |-- forms/
|       |   |-- index.blade.php             # Daftar formulir
|       |   |-- create.blade.php            # Form pembuatan baru
|       |   |-- edit.blade.php              # Form pengeditan
|       |   |-- show.blade.php              # Detail formulir
|       |   |-- pdf.blade.php               # Template PDF formulir
|       |-- reports/
|       |   |-- index.blade.php             # Halaman laporan
|       |   |-- print.blade.php             # Template cetak laporan
|       |-- users/
|       |   |-- index.blade.php             # Daftar pengguna
|       |   |-- create.blade.php            # Form tambah pengguna
|       |   |-- edit.blade.php              # Form edit pengguna
|       |-- layouts/
|           |-- app.blade.php               # Layout utama dengan sidebar
|           |-- footer.blade.php            # Komponen footer
|-- routes/
    |-- web.php                             # Definisi seluruh route aplikasi
```

---

## Panduan Penggunaan

### Login

Akses halaman login melalui `http://127.0.0.1:8000/login`. Gunakan kredensial yang telah disediakan pada bagian [Akun Default](#akun-default).

### Membuat Formulir Kunjungan

1. Navigasi ke menu **Data Formulir** pada sidebar.
2. Klik tombol **Tambah Formulir**.
3. Cari pelanggan menggunakan kolom pencarian (autocomplete berdasarkan nama/CID).
4. Lengkapi data kunjungan: tanggal, lokasi, aktivitas, complaint, dan action.
5. Tambahkan perangkat maintenance jika diperlukan (beserta foto).
6. Pilih penilaian kepuasan: Tidak Puas, Puas, atau Sangat Puas.
7. Isi tanda tangan digital kedua pihak.
8. Simpan formulir.

### Mencetak atau Mengekspor Formulir

- Buka detail formulir, lalu pilih opsi **Cetak PDF** untuk mencetak formulir individual dengan kop surat perusahaan.
- Navigasi ke menu **Laporan** untuk melihat laporan keseluruhan, dengan opsi filter berdasarkan periode dan penilaian.
- Gunakan tombol **Export CSV** untuk mengunduh data dalam format spreadsheet.
- Gunakan tombol **Cetak** untuk membuka halaman cetak laporan resmi.

### Mengelola Pengguna (Khusus Admin)

1. Navigasi ke menu **Kelola Petugas** pada sidebar (hanya tersedia untuk admin).
2. Tambah, edit, atau hapus akun petugas sesuai kebutuhan.
3. Setiap pengguna memiliki peran: `admin` atau `petugas`.

---

## Skema Database

### Tabel `users`

| Kolom              | Tipe         | Keterangan                      |
|--------------------|--------------|---------------------------------|
| id                 | BIGINT (PK)  | Primary key auto-increment      |
| name               | VARCHAR      | Nama lengkap pengguna           |
| email              | VARCHAR      | Alamat email (unik)             |
| password           | VARCHAR      | Password (hashed)               |
| role               | VARCHAR      | Peran: `admin` atau `petugas`   |
| email_verified_at  | TIMESTAMP    | Waktu verifikasi email          |
| remember_token     | VARCHAR      | Token "Ingat Saya"              |
| created_at         | TIMESTAMP    | Waktu pembuatan                 |
| updated_at         | TIMESTAMP    | Waktu terakhir diperbarui       |

### Tabel `customers`

| Kolom              | Tipe         | Keterangan                      |
|--------------------|--------------|---------------------------------|
| cid                | VARCHAR (PK) | Customer ID (primary key)       |
| customer_name      | VARCHAR      | Nama pelanggan                  |
| provinsi           | VARCHAR      | Provinsi                        |
| kota_kabupaten     | VARCHAR      | Kota atau kabupaten             |
| kecamatan          | VARCHAR      | Kecamatan                       |
| kelurahan          | VARCHAR      | Kelurahan                       |
| alamat_lengkap     | TEXT         | Alamat lengkap                  |
| layanan_service    | VARCHAR      | Jenis layanan                   |
| kapasitas_capacity | VARCHAR      | Kapasitas layanan               |
| no_telp_pic        | VARCHAR      | Nomor telepon PIC               |
| email              | VARCHAR      | Alamat email pelanggan          |
| created_at         | TIMESTAMP    | Waktu pembuatan                 |
| updated_at         | TIMESTAMP    | Waktu terakhir diperbarui       |

### Tabel `on_site_forms`

| Kolom                          | Tipe         | Keterangan                                |
|--------------------------------|--------------|--------------------------------------------|
| id                             | BIGINT (PK)  | Primary key auto-increment                 |
| customer_cid                   | VARCHAR (FK) | Relasi ke tabel customers                  |
| user_id                        | BIGINT (FK)  | Relasi ke tabel users (petugas)            |
| activity_survey                | BOOLEAN      | Aktivitas: Survey                          |
| activity_activation            | BOOLEAN      | Aktivitas: Activation                      |
| activity_upgrade               | BOOLEAN      | Aktivitas: Upgrade                         |
| activity_downgrade             | BOOLEAN      | Aktivitas: Downgrade                       |
| activity_troubleshoot          | BOOLEAN      | Aktivitas: Troubleshoot                    |
| activity_preventive_maintenance| BOOLEAN      | Aktivitas: Preventive Maintenance          |
| complaint                      | TEXT         | Keluhan pelanggan                          |
| action                         | TEXT         | Tindakan yang dilakukan                    |
| assessment                     | VARCHAR      | Penilaian: `sangat_puas`, `puas`, `tidak_puas` |
| signature_first_party          | LONGTEXT     | Tanda tangan pihak pertama (base64)        |
| signature_second_party         | LONGTEXT     | Tanda tangan pihak kedua (base64)          |
| first_party_name               | VARCHAR      | Nama pihak pertama                         |
| second_party_name              | VARCHAR      | Nama pihak kedua                           |
| location                       | VARCHAR      | Lokasi kunjungan                           |
| form_date                      | DATE         | Tanggal kunjungan                          |
| created_at                     | TIMESTAMP    | Waktu pembuatan                            |
| updated_at                     | TIMESTAMP    | Waktu terakhir diperbarui                  |

### Tabel `maintenance_devices`

| Kolom           | Tipe         | Keterangan                          |
|-----------------|--------------|-------------------------------------|
| id              | BIGINT (PK)  | Primary key auto-increment          |
| on_site_form_id | BIGINT (FK)  | Relasi ke tabel on_site_forms       |
| device_name     | VARCHAR      | Nama perangkat                      |
| serial_number   | VARCHAR      | Nomor seri perangkat                |
| product_photo   | VARCHAR      | Path foto produk                    |
| keterangan      | TEXT         | Keterangan tambahan                 |
| created_at      | TIMESTAMP    | Waktu pembuatan                     |
| updated_at      | TIMESTAMP    | Waktu terakhir diperbarui           |

---

## API Endpoints

Berikut daftar endpoint internal yang digunakan oleh aplikasi. Seluruh endpoint memerlukan autentikasi.

### Autentikasi

| Method | URI               | Keterangan             |
|--------|-------------------|------------------------|
| GET    | `/login`          | Halaman login          |
| POST   | `/login`          | Proses login           |
| POST   | `/logout`         | Proses logout          |
| GET    | `/ubah-password`  | Halaman ubah password  |
| POST   | `/ubah-password`  | Proses ubah password   |

### Dashboard

| Method | URI          | Keterangan        |
|--------|--------------|--------------------|
| GET    | `/dashboard` | Halaman dashboard  |

### Formulir Kunjungan

| Method | URI                       | Keterangan                    |
|--------|---------------------------|-------------------------------|
| GET    | `/forms`                  | Daftar seluruh formulir       |
| GET    | `/forms/create`           | Form pembuatan baru           |
| POST   | `/forms`                  | Simpan formulir baru          |
| GET    | `/forms/{form}`           | Detail formulir               |
| GET    | `/forms/{form}/edit`      | Form pengeditan               |
| PUT    | `/forms/{form}`           | Update formulir               |
| DELETE | `/forms/{form}`           | Hapus formulir (admin only)   |
| GET    | `/forms/{form}/pdf`       | Ekspor PDF formulir           |

### Laporan

| Method | URI                | Keterangan                |
|--------|--------------------|---------------------------|
| GET    | `/laporan`         | Halaman laporan           |
| GET    | `/laporan/export`  | Ekspor CSV                |
| GET    | `/laporan/print`   | Cetak laporan             |

### Manajemen Pengguna (Admin)

| Method | URI                   | Keterangan              |
|--------|-----------------------|-------------------------|
| GET    | `/users`              | Daftar pengguna         |
| GET    | `/users/create`       | Form tambah pengguna    |
| POST   | `/users`              | Simpan pengguna baru    |
| GET    | `/users/{user}/edit`  | Form edit pengguna      |
| PUT    | `/users/{user}`       | Update pengguna         |
| DELETE | `/users/{user}`       | Hapus pengguna          |

### API Pencarian (Autocomplete)

| Method | URI                       | Keterangan                              |
|--------|---------------------------|-----------------------------------------|
| GET    | `/api/search/customers`   | Pencarian pelanggan (rate limited: 30/min) |
| GET    | `/api/search/users`       | Pencarian pengguna (rate limited: 30/min)  |

---

## Akun Default

Setelah menjalankan `php artisan db:seed`, tersedia dua akun berikut:

| Peran    | Email                   | Password      |
|----------|-------------------------|---------------|
| Admin    | admin@gasnet.co.id      | admin123      |
| Petugas  | petugas@gasnet.co.id    | petugas123    |

> **Penting**: Segera ubah password default setelah login pertama kali melalui menu **Ubah Password**.

---

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

<p align="center">
  <img src="public/images/logoGASNET.png" alt="Gasnet Logo" width="100"><br>
  <sub>PT Telemedia Dinamika Sarana - Divisi Gasnet</sub><br>
  <sub>Hak Cipta Dilindungi Undang-Undang</sub>
</p>
