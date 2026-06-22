# 📰 Portal Berita – Pemrograman Web 2
> Laporan Praktikum Pemrograman Web 2 | Framework CodeIgniter 4 + VueJS  
> Universitas Pelita Bangsa, Bekasi | Dosen: Agung Nugroho | T.A. 2024/2025

---
## Nama : Ananda Friezy Eka Cahya
## NIM : 312410151
## I241A
## 📋 Daftar Isi

| No | Praktikum | Topik |
|----|-----------|-------|
| 1  | [Praktikum 1](#praktikum-1--dasar-mvc--routing) | Dasar MVC & Routing |
| 2  | [Praktikum 2](#praktikum-2--crud-data-artikel) | CRUD Data Artikel |
| 3  | [Praktikum 3](#praktikum-3--view-layout--view-cell) | View Layout & View Cell |
| 4  | [Praktikum 4](#praktikum-4--modul-login--auth-filter) | Modul Login & Auth Filter |
| 5  | [Praktikum 5](#praktikum-5--pagination--pencarian) | Pagination & Pencarian |
| 6  | [Praktikum 6](#praktikum-6--relasi-tabel--query-builder) | Relasi Tabel & Query Builder |
| 7  | [Praktikum 7](#praktikum-7--upload-file-gambar) | Upload File Gambar |
| 8  | [Praktikum 8](#praktikum-8--ajax) | AJAX |
| 9  | [Praktikum 9](#praktikum-9--ajax-pagination--search) | AJAX Pagination & Search |
| 10 | [Praktikum 10](#praktikum-10--restful-api) | RESTful API |
| 11 | [Praktikum 11](#praktikum-11--vuejs-frontend-framework) | VueJS Frontend Framework |
| 12 | [Praktikum 12](#praktikum-12--vuejs-komponen--routing-spa) | VueJS Komponen & Routing (SPA) |
| 13 | [Praktikum 13](#praktikum-13--autentikasi-login-spa-vuejs) | Autentikasi Login SPA VueJS |
| 14 | [Praktikum 14](#praktikum-14--keamanan-api--token-auth) | Keamanan API & Token Auth |

---

## 🛠️ Teknologi yang Digunakan

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.x-EF4223?logo=codeigniter&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?logo=mysql&logoColor=white)
![VueJS](https://img.shields.io/badge/Vue.js-3.x-4FC08D?logo=vue.js&logoColor=white)
![jQuery](https://img.shields.io/badge/jQuery-3.6-0769AD?logo=jquery&logoColor=white)
![Axios](https://img.shields.io/badge/Axios-1.x-5A29E4?logo=axios&logoColor=white)

---

## ⚙️ Persyaratan Sistem

- PHP >= 8.0
- MySQL / MariaDB
- XAMPP (Apache + MySQL)
- Composer
- Node.js (opsional, untuk tooling)
- Postman (untuk testing API)

---

## 🚀 Cara Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/<username>/<nama-repo>.git
cd <nama-repo>
```

### 2. Konfigurasi Environment
```bash
# Salin file env
cp env .env

# Aktifkan mode development
# Edit .env, ubah:
CI_ENVIRONMENT = development
```

### 3. Konfigurasi Database
Edit file `.env`:
```
database.default.hostname = localhost
database.default.database = lab_ci4
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

### 4. Buat Database & Jalankan Migrasi
```sql
CREATE DATABASE lab_ci4;
```
```bash
php spark db:seed UserSeeder
```

### 5. Jalankan Server
```bash
php spark serve
```
Buka browser: `http://localhost:8080`

---

## 📁 Struktur Direktori

```
lab_ci4/
├── app/
│   ├── Controllers/
│   │   ├── Artikel.php
│   │   ├── Page.php
│   │   ├── User.php
│   │   ├── AjaxController.php
│   │   └── Api/
│   │       ├── Post.php
│   │       └── Auth.php
│   ├── Models/
│   │   ├── ArtikelModel.php
│   │   ├── UserModel.php
│   │   └── KategoriModel.php
│   ├── Views/
│   │   ├── layout/
│   │   │   └── main.php
│   │   ├── template/
│   │   │   ├── header.php
│   │   │   └── footer.php
│   │   ├── artikel/
│   │   │   ├── index.php
│   │   │   ├── detail.php
│   │   │   ├── admin_index.php
│   │   │   ├── form_add.php
│   │   │   └── form_edit.php
│   │   ├── user/
│   │   │   └── login.php
│   │   ├── components/
│   │   │   └── artikel_terkini.php
│   │   └── ajax/
│   │       └── index.php
│   ├── Cells/
│   │   └── ArtikelTerkini.php
│   ├── Filters/
│   │   ├── Auth.php
│   │   └── ApiAuthFilter.php
│   └── Config/
│       ├── Routes.php
│       └── Filters.php
├── public/
│   ├── index.php
│   ├── style.css
│   ├── gambar/
│   └── assets/
│       └── js/
│           └── jquery-3.6.0.min.js
├── lab8_vuejs/          ← Aplikasi VueJS SPA
│   ├── index.html
│   └── assets/
│       ├── css/
│       │   └── style.css
│       └── js/
│           ├── app.js
│           └── components/
│               ├── Home.js
│               ├── Artikel.js
│               ├── Login.js
│               └── About.js
├── .env
└── spark
```

---

## 📚 Detail Praktikum

### Praktikum 1 – Dasar MVC & Routing

**Tujuan:** Memahami konsep MVC dan membuat routing dasar menggunakan CodeIgniter 4.

**Konsep Utama:**
- **Model** – mengelola data & logika bisnis
- **View** – menampilkan antarmuka pengguna
- **Controller** – menghubungkan Model dan View

**Fitur yang Dibangun:**
- Instalasi & konfigurasi CI4
- Routing manual dan auto-routing
- Controller `Page` (about, contact, faqs)
- Template layout dengan `header.php` & `footer.php`

---

### Praktikum 2 – CRUD Data Artikel

**Tujuan:** Membuat aplikasi CRUD lengkap untuk data artikel.

**Skema Database:**
```sql
CREATE TABLE artikel (
    id      INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul   VARCHAR(200) NOT NULL,
    isi     TEXT,
    gambar  VARCHAR(200),
    status  TINYINT(1) DEFAULT 0,
    slug    VARCHAR(200)
);
```

**Fitur yang Dibangun:**
- `ArtikelModel` dengan CRUD bawaan CI4
- Halaman daftar artikel (publik)
- Halaman detail artikel berdasarkan slug
- Panel admin: tambah, edit, hapus artikel

---

### Praktikum 3 – View Layout & View Cell

**Tujuan:** Mengelola tampilan secara terpusat dengan Layout dan komponen modular dengan View Cell.

**Perbandingan:**

| Aspek | Include (Parsial) | View Layout |
|-------|-------------------|-------------|
| Pendekatan | Memasukkan potongan file | View anak `extend` template induk |
| Maintainability | Update banyak file | Cukup update satu file layout |

**Fitur yang Dibangun:**
- Layout utama `app/Views/layout/main.php`
- `extend()`, `section()`, `endSection()`
- Class `ArtikelTerkini` sebagai View Cell (widget sidebar)

---

### Praktikum 4 – Modul Login & Auth Filter

**Tujuan:** Mengamankan halaman admin dengan sistem login dan Filter CI4.

**Alur Login:**
```
Akses /admin → Filter cek session → Belum login → Redirect /user/login
                                  → Sudah login → Lanjut ke Controller
```

**Fitur yang Dibangun:**
- Tabel `user` dengan password ter-hash (`password_hash`)
- `UserModel` dan Controller `User`
- Auth Filter sebagai middleware proteksi
- Database Seeder untuk data user awal
- Fitur logout (hancurkan session)

---

### Praktikum 5 – Pagination & Pencarian

**Tujuan:** Memecah tampilan data menjadi beberapa halaman dan menambahkan fitur pencarian.

**Implementasi Kunci:**
```php
// Pagination + Search dalam satu method
$artikel = $model->like('judul', $q)->paginate(10);
$pager   = $model->pager;
```

**Fitur yang Dibangun:**
- Pagination 10 artikel per halaman
- Form pencarian berdasarkan judul
- Parameter search dipertahankan saat ganti halaman (`pager->only(['q'])`)

---

### Praktikum 6 – Relasi Tabel & Query Builder

**Tujuan:** Mengimplementasikan relasi One-to-Many antara kategori dan artikel.

**Diagram Relasi:**
```
kategori (1) ──────── (Many) artikel
id_kategori (PK)      id_kategori (FK)
```

**Fitur yang Dibangun:**
- Tabel `kategori` + foreign key pada `artikel`
- `KategoriModel`
- Query JOIN menggunakan Query Builder CI4
- Filter artikel berdasarkan dropdown kategori di admin

---

### Praktikum 7 – Upload File Gambar

**Tujuan:** Mengimplementasikan fitur upload gambar pada form artikel.

**Alur Upload:**
```
Form (enctype multipart) → getFile() → move() → simpan nama ke DB → tampilkan via base_url
```

**Validasi File (Best Practice):**
```php
'gambar' => 'uploaded[gambar]|is_image[gambar]|max_size[gambar,2048]'
```

**Pertimbangan Keamanan:**

| Risiko | Mitigasi |
|--------|----------|
| Upload file berbahaya | Validasi MIME & ekstensi |
| Nama file konflik | Gunakan `$file->store()` |
| File terlalu besar | Validasi `max_size` |

---

### Praktikum 8 – AJAX

**Tujuan:** Memperbarui data tanpa reload halaman menggunakan AJAX dan jQuery.

**Cara Kerja AJAX:**
```
Event → JS Request (GET/POST) → Server Proses → Response JSON → Update DOM
```

**Fitur yang Dibangun:**
- `AjaxController` dengan endpoint `getData()` dan `delete()`
- jQuery AJAX untuk load, tambah, ubah, dan hapus data

---

### Praktikum 9 – AJAX Pagination & Search

**Tujuan:** Menggabungkan pagination dan pencarian secara asynchronous.

**Fitur yang Dibangun:**
- Backend mendeteksi `isAJAX()` dan mengembalikan JSON
- Frontend merender tabel artikel dan link pagination secara dinamis
- Search + filter kategori tanpa reload halaman
- Indikator loading saat data diambil

---

### Praktikum 10 – RESTful API

**Tujuan:** Membuat REST API yang dapat dikonsumsi oleh client manapun.

**Endpoint API:**

| Method | URL | Fungsi |
|--------|-----|--------|
| GET | `/post` | Ambil semua artikel |
| GET | `/post/{id}` | Ambil artikel by ID |
| POST | `/post` | Tambah artikel baru |
| PUT | `/post/{id}` | Update artikel |
| DELETE | `/post/{id}` | Hapus artikel |

Routing cukup dengan satu baris:
```php
$routes->resource("post");
```

---

### Praktikum 11 – VueJS Frontend Framework

**Tujuan:** Membangun frontend interaktif yang mengkonsumsi REST API menggunakan VueJS 3.

**Fitur yang Dibangun:**
- Load data artikel dari API menggunakan Axios
- Form modal untuk tambah dan edit artikel
- Hapus artikel dengan konfirmasi

---

### Praktikum 12 – VueJS Komponen & Routing (SPA)

**Tujuan:** Membangun Single Page Application (SPA) dengan Vue Router.

**Struktur Komponen:**
```
index.html
└── #app
    ├── <nav> (router-link)
    └── <router-view>
        ├── Home.js     → path: "/"
        ├── Artikel.js  → path: "/artikel"
        └── About.js    → path: "/about"
```

**Fitur yang Dibangun:**
- Vue Router dengan `createWebHashHistory`
- Navigasi SPA tanpa hard-reload browser
- Halaman About dengan profil mahasiswa

---

### Praktikum 13 – Autentikasi Login SPA VueJS

**Tujuan:** Mengamankan halaman SPA dengan login dan Navigation Guards.

**Alur Autentikasi:**
```
Login → Terima Token → Simpan di localStorage
     → Akses /artikel → Navigation Guard cek isLoggedIn
                       → Belum login → Redirect /login
```

**Fitur yang Dibangun:**
- Komponen `Login.js` dengan form login
- `localStorage` untuk simpan token dan status login
- `router.beforeEach()` sebagai Navigation Guard
- Tombol Logout kondisional di navbar

---

### Praktikum 14 – Keamanan API & Token Auth

**Tujuan:** Mengamankan endpoint API di sisi server dan mengotomatiskan pengiriman token di frontend.

**Arsitektur Keamanan End-to-End:**
```
[VueJS] Login → Terima Token → localStorage
              ↓
[Axios Interceptor] Suntikkan Header: Authorization: Bearer <token>
              ↓
[CI4 ApiAuthFilter] Validasi token → Izinkan / Tolak (401)
```

**Perbandingan Client-Side vs Server-Side Security:**

| Aspek | Vue Router Guards | CI4 Filters |
|-------|-------------------|-------------|
| Lokasi | Browser (Client) | Server |
| Perlindungan | Tampilan/halaman | Endpoint API & data |
| Dapat Dibobol? | Ya (via DevTools) | Tidak |
| Tujuan | UX – cegah akses halaman | Keamanan nyata – cegah akses data |

---

## 🗄️ Skema Database Lengkap

```sql
-- Tabel Artikel
CREATE TABLE artikel (
    id           INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul        VARCHAR(200) NOT NULL,
    isi          TEXT,
    gambar       VARCHAR(200),
    status       TINYINT(1) DEFAULT 0,
    slug         VARCHAR(200),
    id_kategori  INT(11),
    CONSTRAINT fk_kategori_artikel FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
);

-- Tabel Kategori
CREATE TABLE kategori (
    id_kategori   INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    slug_kategori VARCHAR(100)
);

-- Tabel User
CREATE TABLE user (
    id           INT(11) AUTO_INCREMENT PRIMARY KEY,
    username     VARCHAR(200) NOT NULL,
    useremail    VARCHAR(200),
    userpassword VARCHAR(200)
);
```

---

## 👤 Akun Default

| Field | Value |
|-------|-------|
| Email | `admin@email.com` |
| Password | `admin123` |

> Password disimpan dalam format hash menggunakan `password_hash()`.

---

## 📝 Lisensi

Proyek ini dibuat untuk keperluan akademis – Praktikum Pemrograman Web 2  
**Universitas Pelita Bangsa, Bekasi** © 2024/2025
