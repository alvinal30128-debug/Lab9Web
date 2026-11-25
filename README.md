# Lab9Web - Praktikum 9: PHP Modular

Praktikum Pemrograman Web: modularisasi program PHP (template, function, struktur direktori, dan routing sederhana), lalu diterapkan pada aplikasi CRUD database.

## Tujuan Project
- Memahami `include`, `require`, `include_once`, `require_once`.
- Membuat template (header/footer) yang dipakai bersama.
- Membuat function dengan parameter dan nilai kembalian.
- Menyusun struktur direktori modular dan routing berbasis parameter `page` dengan whitelist + halaman 404.
- Mengintegrasikan semuanya ke aplikasi CRUD pengguna.

## Kebutuhan Perangkat
- PHP >= 8.0 (ekstensi `pdo_mysql`, `mbstring`)
- MySQL / MariaDB
- Web server lokal (XAMPP / Laragon) atau PHP built-in server
- Browser dan editor kode (VS Code)

## Cara Menjalankan
1. Salin folder `Lab9Web` ke docroot (mis. `htdocs`).
2. Impor database: `mysql -u root < database.sql` (atau lewat phpMyAdmin).
3. Sesuaikan kredensial di `project/config/database.php` bila perlu.
4. Buka di browser:
   - Latihan template/function: `http://localhost/Lab9Web/lab9_php_modular/home.php`
   - Aplikasi CRUD modular: `http://localhost/Lab9Web/project/index.php`

## Struktur Direktori
```
Lab9Web/
├── README.md
├── database.sql
├── laporan/                 # laporan praktikum (docx)
├── screenshots/             # bukti pengujian
├── lab9_php_modular/        # latihan bagian C-E
│   ├── pesan.php, uji-include.php, uji-require.php
│   ├── header.php, footer.php, style.css
│   ├── home.php, about.php, profil.php, kontak.php
│   └── helpers.php, latihan-function.php, contoh-panggil.php
└── project/                 # aplikasi modular (bagian F-I)
    ├── index.php            # router
    ├── .htaccess            # opsional: URL ringkas
    ├── config/database.php
    ├── views/               # header, footer, dashboard, about, 404
    ├── helpers/functions.php
    ├── modules/user/        # list, add, edit, delete
    └── assets/css, assets/js
```

## Daftar Rute
| Parameter `page` | File | Keterangan |
|---|---|---|
| `dashboard` (default) | `views/dashboard.php` | Ringkasan data |
| `about` | `views/about.php` | Tentang aplikasi |
| `user/list` | `modules/user/list.php` | Daftar pengguna |
| `user/add` | `modules/user/add.php` | Tambah pengguna (POST) |
| `user/edit` | `modules/user/edit.php` | Ubah pengguna (`&id=`) |
| `user/delete` | `modules/user/delete.php` | Hapus pengguna (hanya POST) |
| selain di atas | `views/404.php` | Status HTTP 404 |

## Fitur Keamanan
- Whitelist rute (input `page` tidak pernah dipakai langsung sebagai path file).
- Prepared statement PDO, escaping output dengan `e()`.
- Operasi tambah/ubah/hapus lewat POST dengan token CSRF; hapus via GET ditolak.
- Detail error koneksi database tidak ditampilkan ke pengguna.

## Fitur Tambahan (Tantangan Mandiri)
- Menu aktif pada navigasi.
- Helper pesan flash sukses/gagal.
- `.htaccess` untuk URL ringkas (`/user/list`). Syarat: `mod_rewrite` aktif dan `AllowOverride All`.

## Langkah Praktikum
1. Menguji `include` vs `require` (file `pesan.php` diubah namanya).
2. Membuat template `header.php`/`footer.php` dan halaman Home, Tentang, Profil, Kontak.
3. Membuat function (`helpers.php`) dan memanggilnya dari dua halaman.
4. Menyusun direktori `project/` dan membuat router dengan whitelist + 404.
5. Refactor CRUD pengguna ke `modules/user/` dan menguji seluruh fitur.

Detail dan screenshot ada di `laporan/Laporan_Praktikum_9.docx`.

## Kendala dan Solusi
| Kendala | Solusi |
|---|---|
| `header()` redirect gagal karena output sudah dikirim | Gunakan `ob_start()` di `index.php` |
| Path CSS salah bila URL berubah | Helper `asset()` dengan `base_path()` |
| Function already declared | Gunakan `require_once` |
| Fungsi `mb_strlen` tidak ditemukan | Aktifkan ekstensi `mbstring` |
