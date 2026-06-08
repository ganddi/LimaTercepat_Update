# Lima Tercepat — Employee Leaderboard

Sistem aplikasi web berbasis Laravel 12 untuk menampilkan peringkat "Lima Tercepat" kehadiran karyawan. Data kinerja, nama, dan peringkat ditarik secara *real-time* dari Google Spreadsheet menggunakan Google Sheets API.

## 🚀 Fitur Utama

- **Integrasi Google Sheets API**: Menarik data langsung dari Google Spreadsheet menggunakan autentikasi *Service Account* tanpa memerlukan basis data lokal (database-less).
- **Keamanan Akses (Authentication)**: Dilengkapi dengan sistem login berbasis sesi kustom menggunakan *middleware* `CheckAdminSession` untuk melindungi privasi data karyawan dari akses publik.
- **Proteksi XSS Berbasis Input**: Sanitasi data input dan output berlapis menggunakan `strip_tags()` dan `preg_match()` untuk mencegah injeksi kode HTML/JavaScript berbahaya dari kolaborator Spreadsheet.
- **Penanganan Galat Aman (*Secure Error Handling*)**: Menyembunyikan pesan galat teknis dari pengguna akhir untuk menghindari *Information Disclosure*. Seluruh log teknis dicatat secara internal.

---

## 📋 Prasyarat Sistem

- PHP >= 8.2
- Composer 2.x
- Web Server lokal (Laragon, XAMPP, atau Laravel Valet/Sail)
- Kredensial **Google Cloud Service Account** (file `google-access.json`)
- Google Spreadsheet yang telah dibagikan (*shared*) ke email *Service Account*.

---

## ⚙️ Panduan Instalasi

1. **Klon repositori ini:**
   ```bash
   git clone https://github.com/ganddi/LimaTercepat_Update.git
   cd LimaTercepat
   ```

2. **Instal dependensi PHP:**
   ```bash
   composer install
   ```

3. **Persiapkan berkas Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Keamanan Tambahan di `.env`**:
   Untuk lingkungan produksi, sangat disarankan mengubah setelan berikut:
   ```ini
   APP_ENV=production
   APP_DEBUG=false
   SESSION_DRIVER=file
   ```

5. **Siapkan Kredensial Google Sheets API:**
   - Dapatkan file JSON Service Account dari Google Cloud Platform.
   - Ganti namanya menjadi `google-access.json`.
   - Letakkan file tersebut di dalam folder `storage/app/`.
   - Buka Google Spreadsheet sumber data Anda, klik "Share", dan tambahkan alamat email *Service Account* Anda sebagai "Viewer".

---

## 🖥️ Menjalankan Aplikasi

Jika Anda menggunakan lingkungan Laragon, aplikasi dapat diakses secara otomatis melalui URL lokal Anda, misalnya: `http://limatercepat.test`.

Atau menggunakan *built-in server* dari Laravel:
```bash
php artisan serve
```
Kemudian akses melalui *browser* di `http://localhost:8000`.

---

## 🔐 Kredensial Default

Karena sistem ini didesain untuk lingkungan internal dengan arsitektur tanpa *database* (*database-less*), kredensial login disimpan secara langsung pada *Controller*.

- **Username**: `admin`
- **Password**: `admin123`

*(Anda dapat mengubah kombinasi ini di dalam berkas `app/Http/Controllers/AuthController.php`)*

---

## 🛡️ Laporan Keamanan (Tugas Akhir/Skripsi)
Pengembangan fitur keamanan di repositori ini disertai dengan penyusunan **Dokumen Laporan Keamanan Sistem**. Laporan lengkap mencakup Bab I (Pendahuluan) hingga Bab V (Kesimpulan) yang mendokumentasikan analisis kerentanan dan langkah mitigasinya.
