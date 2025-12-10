# 🚀 Tugas Teknis: Sistem Manajemen Tugas (Task Management System)

Aplikasi berbasis Laravel ini dibuat untuk memenuhi persyaratan *Technical Test* dan mencakup fungsionalitas CRUD (Create, Read, Update, Delete) lengkap untuk Proyek dan Tugas, serta fitur analisis data (Analytics).

## Fitur Utama

Aplikasi ini berhasil mengimplementasikan semua poin yang diminta dalam tes:

* **CRUD Lengkap:** Manajemen Projects dan Tasks.
* **Progress Project (2c):** Menghitung persentase Task Done dengan Progress Bar.
* **Status Task:** Status diterjemahkan dari angka (1, 4) menjadi label (`Todo`, `Done`, dll.).
* **Project Bermasalah (2e):** Penandaan Project jika ada **Overdue Task** (> 0) **DAN** **Progress** (< 50%).
* **Statistik (2d):** Laporan Task Selesai per Bulan/Tahun.
* **Sinkronisasi Status:** Status Project otomatis berubah menjadi "Done" jika semua Tasks di dalamnya selesai (100% Progress).

---

## Persyaratan Sistem

Pastikan Anda memiliki lingkungan pengembangan berikut:

1.  **PHP:** Versi 8.1 atau yang lebih baru.
2.  **Composer:** Manajer dependensi PHP.
3.  **XAMPP/Laragon:** Untuk server web (Apache) dan database (MySQL/MariaDB).

    **Catatan Penting Konfigurasi Database:**
    Proyek ini dikonfigurasi khusus untuk berjalan pada **Port MySQL: 3307**. Anda harus menyesuaikan konfigurasi XAMPP/Laragon Anda.

## ⚙️ Langkah-Langkah Instalasi (Running Project)

### 1. Clone Repository

```bash
git clone https://github.com/riritriana/technical-test-bumiDataPlaza.git
cd technical-test-bumiDataPlaza
```

### 2. Instal Dependensi
Instal semua paket yang diperlukan (Laravel Framework):

```bash
composer install
```
### 3. Konfigurasi Environment dan Key
Buat file .env dan buat kunci enkripsi aplikasi:

```bash
cp .env.example .env
php artisan key:generate
```
### 4. Konfigurasi Koneksi Database
Buka file .env dan pastikan konfigurasi Port 3307 sudah benar:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307  # HARUS 3307 AGAR KONEKSI BERJALAN
DB_DATABASE=itplaza_tasks 
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Database dan Migrasi
1. Start XAMPP/MySQL: Pastikan MySQL/MariaDB berjalan di Port 3307.
2. Jalankan migrasi untuk membuat tabel projects dan tasks:

```bash
php artisan migrate
```

### 6. Jalankan Server Lokal
Jalankan server pengembangan Laravel:

```bash
php artisan serve
```

## 7. Akses Aplikasi
Aplikasi sekarang dapat diakses melalui browser Anda:
[http://127.0.0.1:8000/]

## 🔗 Rute Penting untuk Pengujian

| Deskripsi | Rute |
| :--- | :--- |
| **Daftar Projects** | `/projects` |
| **Daftar Tasks** | `/tasks` |
| **Statistik (Laporan 2d)** | `/reports/monthly-done` |
