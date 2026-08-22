# PKKMB Universitas Narotama 2026

Website resmi pendukung kegiatan **Pengenalan Kehidupan Kampus bagi Mahasiswa Baru (PKKMB) Universitas Narotama 2026** dengan identitas visual:

> **CineAction — Mahakarya Garda Depan, Mengukir Dampak untuk Negeri**

Aplikasi menyediakan halaman informasi publik serta dashboard berbasis peran untuk peserta, admin, dan superadmin. Sistem dibangun di atas backend Laravel yang sudah tersedia, kemudian dikembangkan kembali pada sisi antarmuka, pengelolaan data, dan keamanan aplikasi.

## Fitur Utama

### Halaman publik

- Landing page PKKMB 2026 bertema CineAction.
- Informasi pengenalan PKKMB.
- Pedoman kegiatan.
- Informasi seragam.
- Jadwal kegiatan.
- Susunan panitia.
- Berita dan pengumuman.
- Halaman login peserta dan administrator.

### Dashboard peserta

- Ringkasan tugas dan presensi.
- Informasi profil peserta.
- Presensi menggunakan QR Code.
- Daftar dan pengumpulan tugas.
- Pembaruan data profil sendiri.

### Dashboard admin dan superadmin

- Dashboard statistik kegiatan.
- Pengelolaan akun peserta dan administrator.
- Pengelolaan kelompok dan posisi pengguna.
- Pengelolaan tugas dan data pengumpulan.
- Pengelolaan jadwal serta sesi presensi.
- Pemindaian dan validasi QR Code.
- Pengelolaan berita, ketentuan, dan pelanggaran.
- Rekap hasil peserta.
- Ekspor data ke Excel dan CSV.
- Pemilihan serta penghapusan beberapa data sekaligus.
- Pagination dengan pilihan 10, 20, 50, dan 100 data.

## Hak Akses

| Peran | Hak akses |
| --- | --- |
| Peserta | Mengakses dashboard peserta, profil sendiri, presensi, dan tugas. |
| Admin | Mengakses modul operasional PKKMB yang diberikan kepada panitia. |
| Superadmin | Mengelola seluruh modul administratif, akun, kelompok, posisi, presensi, tugas, dan hasil. |
| Guest | Mengakses halaman publik dan halaman login. |

## Teknologi

- Laravel 10
- PHP 8.3 direkomendasikan
- MySQL
- Blade Template
- Livewire 2
- Laravel Sanctum
- Tailwind CSS 3
- Alpine.js 3
- Laravel Mix 6
- Livewire PowerGrid
- Simple QR Code
- Maatwebsite Excel
- SweetAlert2

> Walaupun `composer.json` mendeklarasikan PHP `^8.1`, versi dependensi yang terkunci saat ini membutuhkan PHP 8.2 atau lebih baru. Pengembangan proyek ini menggunakan PHP 8.3.23.

## Persyaratan Sistem

Pastikan perangkat sudah memiliki:

- PHP 8.2 atau lebih baru (PHP 8.3 direkomendasikan).
- Composer.
- Node.js dan npm.
- MySQL atau MariaDB.
- Git.
- Ekstensi PHP yang diperlukan Laravel dan package QR/Excel.

## Instalasi Lokal

### 1. Clone repository

```bash
git clone https://github.com/Doells/pkkmb-narotama-2026.git
cd pkkmb-narotama-2026
```

### 2. Instal dependensi PHP

```bash
composer install
```

### 3. Buat konfigurasi environment

Windows:

```powershell
Copy-Item .env.example .env
```

Linux/macOS:

```bash
cp .env.example .env
```

Buat application key:

```bash
php artisan key:generate
```

### 4. Atur environment lokal

Sesuaikan `.env` untuk pengembangan melalui HTTP localhost:

```env
APP_NAME="PKKMB Narotama 2026"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pkkmb
DB_USERNAME=root
DB_PASSWORD=

SESSION_SECURE_COOKIE=false
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

Jangan menggunakan konfigurasi debug tersebut pada server produksi.

### 5. Siapkan database

Buat database MySQL, kemudian jalankan:

```bash
php artisan migrate --seed
```

Gunakan perintah tersebut hanya pada database baru. Jangan menjalankan migration atau seeder secara sembarangan pada database yang sudah berisi data kegiatan.

### 6. Buat symbolic link penyimpanan

```bash
php artisan storage:link
```

### 7. Instal dan build frontend

```bash
npm install
npm run dev
```

Untuk build production:

```bash
npm run prod
```

### 8. Jalankan aplikasi

```bash
php artisan serve
```

Buka:

```text
http://127.0.0.1:8000
```

## Konfigurasi Produksi

Gunakan konfigurasi berikut saat aplikasi diakses melalui HTTPS:

```env
APP_ENV=production
APP_DEBUG=false
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

Setelah konfigurasi berubah, bersihkan dan bangun ulang cache:

```bash
php artisan optimize:clear
php artisan config:cache
php artisan view:cache
npm run prod
```

Pastikan document root web server diarahkan ke folder `public`, bukan root repository.

## Keamanan

Penguatan keamanan yang telah diterapkan meliputi:

- Endpoint dashboard API dilindungi Laravel Sanctum.
- Pembatasan percobaan login menggunakan rate limiter.
- Otorisasi berbasis role peserta, admin, dan superadmin.
- Pencegahan perubahan profil milik pengguna lain.
- Validasi QR Code serta penanganan data QR yang tidak valid.
- Operasi penghapusan data menggunakan method HTTP `DELETE`.
- Perlindungan CSRF pada form dan request web.
- Security headers (`nosniff`, `SAMEORIGIN`, Referrer Policy, dan Permissions Policy).
- Cookie session aman untuk koneksi HTTPS.
- Informasi sensitif tidak dicatat pada log autentikasi.

Sebelum deployment, jalankan:

```bash
composer audit --locked
npm audit
```

Jangan menjalankan `npm audit fix --force` tanpa meninjau perubahan dependensinya.

## Verifikasi Pengembangan

```bash
composer dump-autoload
php artisan optimize:clear
php artisan route:list
php artisan view:cache
npm run dev
```

Pengujian akses yang disarankan:

- Guest tidak dapat membaca API dashboard.
- Peserta tidak dapat membuka modul administrator.
- Peserta hanya dapat mengubah profilnya sendiri.
- Admin hanya dapat membuka modul operasional yang diizinkan.
- Superadmin dapat mengelola seluruh modul administratif.
- QR Code tidak valid tidak menghasilkan stack trace atau HTTP 500.

## Keamanan Repository

File berikut tidak boleh dimasukkan ke Git:

```text
.env
.env.example2
vendor/
node_modules/
storage/logs/*.log
*.sql
*.zip
patches.diff
```

Gunakan `.env.example` hanya sebagai template tanpa password, token, atau application key aktif.

## Struktur Utama

```text
app/                    Controller, model, middleware, Livewire, dan service
config/                 Konfigurasi Laravel
database/               Migration, factory, dan seeder
public/                 Entry point dan aset publik
resources/              Blade, CSS, dan JavaScript sumber
routes/                 Route web dan API
storage/                Log, cache, dan penyimpanan aplikasi
tests/                  Pengujian aplikasi
```

## Atribusi

Backend awal aplikasi dikembangkan berdasarkan proyek **Absensi App** oleh [muhammadpauzi](https://github.com/muhammadpauzi/absensi-app), kemudian disesuaikan dan dikembangkan untuk kebutuhan PKKMB Universitas Narotama 2026, termasuk desain CineAction, pengelolaan data, perbaikan fitur, responsivitas, dan security hardening.

Pastikan ketentuan lisensi serta atribusi source awal tetap dipatuhi sebelum repository diubah menjadi publik.

## Catatan

- Jangan mencantumkan NIM atau password akun pada README maupun source code.
- Gunakan data dummy ketika melakukan pengujian tambah, edit, atau hapus.
- Repository sebaiknya tetap privat apabila masih memuat aset atau informasi internal kegiatan.

---

**PKKMB Universitas Narotama 2026**  
*CineAction — Mahakarya Garda Depan, Mengukir Dampak untuk Negeri*

**CopyRight**

© 2026 - Irsyadulloh Ramadhan B.N