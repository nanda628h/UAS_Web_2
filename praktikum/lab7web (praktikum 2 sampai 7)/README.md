# Lab7Web - Praktikum 2 s/d 7 (CodeIgniter 4)

Repository ini berisi kelanjutan dari Praktikum 1, mencakup Praktikum 2 hingga 7.

---

## Daftar Praktikum

| Praktikum | Topik |
|-----------|-------|
| 2 | Framework Lanjutan - CRUD |
| 3 | View Layout & View Cell |
| 4 | Modul Login (Auth & Filter) |
| 5 | Pagination & Pencarian |
| 6 | Relasi Tabel & Query Builder |
| 7 | Upload File Gambar |

---

## Cara Setup

### 1. Install CodeIgniter 4
- Download dari https://codeigniter.com/download
- Extract ke `htdocs/lab11_ci/ci4`
- Copy semua isi folder ini ke dalam folder `ci4/` (merge)

### 2. Konfigurasi Environment
```bash
# Rename env menjadi .env
cp env .env
```
Isi `.env` sudah otomatis terkonfigurasi untuk `lab_ci4`.

### 3. Setup Database
Jalankan file `database_setup.sql` di phpMyAdmin atau MySQL CLI:
```sql
source database_setup.sql;
```

### 4. Buat User Admin
```bash
php spark db:seed UserSeeder
```
Login: `admin@email.com` / password: `admin123`

### 5. Jalankan Aplikasi
```bash
php spark serve
```
Buka: http://localhost:8080

---

## Struktur File yang Ditambahkan

```
app/
├── Cells/
│   └── ArtikelTerkini.php       ← Praktikum 3 - View Cell
├── Controllers/
│   ├── Home.php
│   ├── Page.php
│   ├── Artikel.php              ← Praktikum 2,5,6,7
│   └── User.php                 ← Praktikum 4
├── Filters/
│   └── Auth.php                 ← Praktikum 4
├── Models/
│   ├── ArtikelModel.php         ← Praktikum 2,6
│   ├── KategoriModel.php        ← Praktikum 6
│   └── UserModel.php            ← Praktikum 4
├── Database/Seeds/
│   └── UserSeeder.php           ← Praktikum 4
├── Config/
│   ├── Routes.php
│   └── Filters.php
└── Views/
    ├── layout/main.php          ← Praktikum 3 - View Layout
    ├── components/
    │   └── artikel_terkini.php  ← Praktikum 3 - View Cell
    ├── template/
    │   ├── header.php
    │   ├── footer.php
    │   ├── admin_header.php
    │   └── admin_footer.php
    ├── artikel/
    │   ├── index.php
    │   ├── detail.php
    │   ├── admin_index.php      ← Praktikum 5 pagination+search
    │   ├── form_add.php         ← Praktikum 7 upload gambar
    │   └── form_edit.php
    └── user/
        └── login.php            ← Praktikum 4
public/
├── style.css
└── gambar/                      ← Folder upload gambar (Praktikum 7)
```

---

## Penjelasan Per Praktikum

### Praktikum 2 - CRUD
- Model `ArtikelModel` untuk interaksi database tabel `artikel`
- Controller `Artikel` dengan method: `index`, `view`, `admin_index`, `add`, `edit`, `delete`
- View untuk daftar, detail, form tambah, dan form edit artikel

### Praktikum 3 - View Layout & View Cell
- `app/Views/layout/main.php` sebagai layout utama dengan `renderSection`
- View menggunakan `extend` dan `section` untuk memanfaatkan layout
- `ArtikelTerkini` View Cell menampilkan 5 artikel terbaru di sidebar

### Praktikum 4 - Modul Login
- Tabel `user` dengan password yang di-hash menggunakan `password_hash()`
- Filter `Auth` memproteksi semua route `/admin/*`
- Session digunakan untuk menyimpan status login
- Login: `admin@email.com` / `admin123`

### Praktikum 5 - Pagination & Pencarian
- `admin_index` mendukung pencarian by judul (`LIKE`)
- Pagination manual 10 data per halaman
- Filter kategori tersedia di form pencarian

### Praktikum 6 - Relasi Tabel & Query Builder
- Tabel `kategori` dengan relasi One-to-Many ke `artikel`
- `getArtikelDenganKategori()` menggunakan JOIN untuk mengambil nama kategori
- Form tambah/edit artikel dilengkapi dropdown pilihan kategori

### Praktikum 7 - Upload File Gambar
- Form tambah artikel menggunakan `enctype="multipart/form-data"`
- File gambar disimpan di `public/gambar/`
- Nama file disimpan di kolom `gambar` pada tabel `artikel`
