# Lab11Web_VueJS — Praktikum Web 2 (Praktikum 8–14)

> **Mata Kuliah:** Pemrograman Web 2  
> **Dosen:** Agung Nugroho (agung@pelitabangsa.ac.id)  
> **Universitas:** Universitas Pelita Bangsa, Bekasi  
> **Nama:** *(isi nama Anda)*  
> **NIM:** *(isi NIM Anda)*  
> **Kelas:** *(isi kelas Anda)*

---

## Daftar Isi

- [Gambaran Umum](#gambaran-umum)
- [Struktur Proyek](#struktur-proyek)
- [Cara Menjalankan](#cara-menjalankan)
- [Praktikum 8 — AJAX](#praktikum-8--ajax)
- [Praktikum 9 — AJAX Pagination & Search](#praktikum-9--ajax-pagination--search)
- [Praktikum 10 — REST API](#praktikum-10--rest-api)
- [Praktikum 11 — VueJS Dasar](#praktikum-11--vuejs-dasar)
- [Praktikum 12 — VueJS Komponen & Routing SPA](#praktikum-12--vuejs-komponen--routing-spa)
- [Praktikum 13 — Autentikasi & Navigation Guards](#praktikum-13--autentikasi--navigation-guards)
- [Praktikum 14 — Keamanan API, Token & Axios Interceptors](#praktikum-14--keamanan-api-token--axios-interceptors)
- [Kesimpulan](#kesimpulan)

---

## Gambaran Umum

Proyek ini adalah hasil rangkaian praktikum Pemrograman Web 2 yang membangun sistem manajemen artikel berbasis arsitektur **Backend API + Frontend SPA** secara bertahap:

| Layer    | Teknologi | Folder         |
|----------|-----------|----------------|
| Backend  | CodeIgniter 4 (PHP) | `lab7_php_ci/` |
| Frontend | VueJS 3 (CDN)      | `lab8_vuejs/`  |
| Database | MySQL (XAMPP)      | —              |

---

## Struktur Proyek

```
Lab11Web_VueJS/
│
├── lab7_php_ci/                   ← Backend CodeIgniter 4
│   └── app/
│       ├── Controllers/
│       │   ├── AjaxController.php     (Praktikum 8)
│       │   ├── Artikel.php            (Praktikum 9)
│       │   └── Api/
│       │       ├── Post.php           (Praktikum 10)
│       │       └── Auth.php           (Praktikum 13-14)
│       ├── Filters/
│       │   └── ApiAuthFilter.php      (Praktikum 14)
│       ├── Models/
│       │   ├── ArtikelModel.php
│       │   ├── KategoriModel.php
│       │   └── UserModel.php
│       ├── Views/
│       │   ├── ajax/index.php         (Praktikum 8)
│       │   └── artikel/admin_index.php (Praktikum 9)
│       └── Config/
│           ├── Routes.php             (Praktikum 10 & 14)
│           └── Filters.php            (Praktikum 14)
│
├── lab8_vuejs/                    ← Frontend VueJS SPA
│   ├── index.html                     (Praktikum 11-14)
│   └── assets/
│       ├── css/style.css
│       └── js/
│           ├── app.js                 (Router + Interceptors)
│           └── components/
│               ├── Home.js            (Praktikum 12)
│               ├── Artikel.js         (Praktikum 11-12)
│               ├── About.js           (Tugas Praktikum 12)
│               └── Login.js           (Praktikum 13)
│
└── README.md
```

---

## Cara Menjalankan

### Prasyarat
- XAMPP (Apache + MySQL aktif)
- Composer
- CodeIgniter 4 sudah terinstall di folder `lab7_php_ci`

### Langkah

1. **Clone repository** ke folder `htdocs` XAMPP:
   ```bash
   cd C:/xampp/htdocs
   git clone <url-repo> Lab11Web_VueJS
   ```

2. **Setup database** — jalankan SQL berikut di phpMyAdmin:
   ```sql
   CREATE DATABASE lab_ci4;
   USE lab_ci4;

   CREATE TABLE artikel (
     id INT AUTO_INCREMENT PRIMARY KEY,
     judul VARCHAR(200),
     isi TEXT,
     gambar VARCHAR(200),
     status TINYINT DEFAULT 0,
     slug VARCHAR(200),
     id_kategori INT
   );

   CREATE TABLE kategori (
     id_kategori INT AUTO_INCREMENT PRIMARY KEY,
     nama_kategori VARCHAR(100),
     slug_kategori VARCHAR(100)
   );

   CREATE TABLE user (
     id INT AUTO_INCREMENT PRIMARY KEY,
     username VARCHAR(100),
     password VARCHAR(255),
     token VARCHAR(255)
   );

   -- Contoh user (password: rahasia)
   INSERT INTO user (username, password) VALUES
   ('admin', '$2y$10$YourHashedPasswordHere');
   ```

   > **Catatan:** Generate hash password dengan `password_hash('rahasia', PASSWORD_DEFAULT)` di PHP.

3. **Konfigurasi database CI4** — edit `lab7_php_ci/app/Config/Database.php`:
   ```php
   'database' => 'lab_ci4',
   'username' => 'root',
   'password' => '',
   ```

4. **Akses aplikasi:**
   - Backend API : `http://localhost/Lab11Web_VueJS/lab7_php_ci/public/post`
   - Frontend SPA: `http://localhost/Lab11Web_VueJS/lab8_vuejs/`

---

## Praktikum 8 — AJAX

### Tujuan
Memahami konsep AJAX (Asynchronous JavaScript and XML) dan cara menggunakannya di CodeIgniter 4 dengan jQuery.

### Konsep
AJAX memungkinkan halaman web memperbarui sebagian konten **tanpa reload penuh**. Browser mengirim request HTTP ke server di balik layar, server merespons dengan JSON, lalu JavaScript memperbarui DOM.

### File yang Dibuat/Dimodifikasi
| File | Keterangan |
|------|------------|
| `app/Controllers/AjaxController.php` | Controller AJAX: `getData()` mengembalikan JSON, `delete()` menghapus data |
| `app/Views/ajax/index.php` | View dengan jQuery AJAX untuk load & hapus data tanpa reload |

### Cara Kerja
```
Browser (klik tombol)
  → jQuery $.ajax() → GET /ajax/getData
  → AjaxController::getData() → ArtikelModel::findAll()
  → Response JSON
  → jQuery render ke DOM (tanpa reload)
```

### Screenshot
> *(Tempel screenshot tampilan tabel data yang dimuat via AJAX di sini)*

---

## Praktikum 9 — AJAX Pagination & Search

### Tujuan
Implementasi pagination dan pencarian artikel secara dinamis menggunakan AJAX tanpa reload halaman.

### Konsep
- `isAJAX()` pada CI4 mendeteksi apakah request berasal dari XMLHttpRequest.
- Jika AJAX → kembalikan JSON; jika bukan → kembalikan view HTML.
- Pagination berbasis nomor halaman dikirim sebagai query parameter.

### File yang Dibuat/Dimodifikasi
| File | Keterangan |
|------|------------|
| `app/Controllers/Artikel.php` | Metode `admin_index()` ditambah logika AJAX + pagination + search |
| `app/Views/artikel/admin_index.php` | View dengan jQuery yang merender tabel & pagination dari JSON |

### Alur AJAX Pagination
```
User klik halaman 2
  → jQuery fetchData('/admin/artikel?page=2&q=...')
  → Artikel::admin_index() → paginate(10, page=2)
  → JSON {artikel:[...], pager:{links:[...]}}
  → renderArticles() + renderPagination()
  → DOM diperbarui (tanpa reload)
```

### Screenshot
> *(Tempel screenshot fitur pagination dan pencarian di sini)*

---

## Praktikum 10 — REST API

### Tujuan
Membuat RESTful API menggunakan `ResourceController` CodeIgniter 4 dan mengujinya dengan Postman.

### Konsep
REST API adalah antarmuka yang memungkinkan klien (frontend, mobile app, dll.) mengakses resource server menggunakan HTTP method standar: GET, POST, PUT, DELETE.

| HTTP Method | Endpoint         | Fungsi              |
|-------------|-----------------|---------------------|
| GET         | `/post`          | Ambil semua artikel |
| GET         | `/post/:id`      | Ambil 1 artikel     |
| POST        | `/post`          | Tambah artikel baru |
| PUT         | `/post/:id`      | Ubah artikel        |
| DELETE      | `/post/:id`      | Hapus artikel       |

### File yang Dibuat/Dimodifikasi
| File | Keterangan |
|------|------------|
| `app/Controllers/Api/Post.php` | REST Controller dengan 5 method CRUD |
| `app/Config/Routes.php` | `$routes->resource('post')` mendaftarkan semua endpoint sekaligus |

### Pengujian dengan Postman

**GET semua data:**
```
GET http://localhost/labci4/public/post
→ 200 OK, JSON array artikel
```

**POST tambah data:**
```
POST http://localhost/labci4/public/post
Body (x-www-form-urlencoded): judul=..., isi=...
→ 201 Created
```

**PUT ubah data:**
```
PUT http://localhost/labci4/public/post/2
Body: judul=..., isi=...
→ 200 OK
```

**DELETE hapus data:**
```
DELETE http://localhost/labci4/public/post/2
→ 200 OK
```

### Screenshot
> *(Tempel screenshot hasil pengujian Postman untuk setiap method di sini)*

---

## Praktikum 11 — VueJS Dasar

### Tujuan
Membangun antarmuka frontend menggunakan VueJS 3 untuk menampilkan dan memanipulasi data dari REST API CI4.

### Konsep
VueJS adalah framework JavaScript berbasis **reactive data binding**. Perubahan data otomatis tercermin di tampilan (DOM) tanpa manipulasi DOM manual.

### Fitur yang Diimplementasikan
- `v-for` — render list artikel dari API
- `v-if` — tampil/sembunyikan modal form
- `v-model` — two-way binding input form
- `axios.get/post/put/delete` — komunikasi ke REST API
- `mounted()` — load data saat komponen pertama kali ditampilkan

### Screenshot
> *(Tempel screenshot tampilan daftar artikel dan form modal di sini)*

---

## Praktikum 12 — VueJS Komponen & Routing SPA

### Tujuan
Memecah aplikasi menjadi komponen-komponen modular dan menerapkan Vue Router untuk navigasi tanpa reload.

### Konsep
- **Vue Components** — unit UI yang terisolasi dan dapat digunakan ulang (reusable).
- **Vue Router** — menangani perpindahan "halaman" di sisi klien tanpa request ke server. Inilah yang disebut **Single Page Application (SPA)**.

### Rute yang Didaftarkan
| Path       | Komponen | Keterangan              |
|------------|----------|-------------------------|
| `/`        | Home     | Halaman beranda         |
| `/artikel` | Artikel  | Kelola artikel (CRUD)   |
| `/about`   | About    | Profil pengembang       |
| `/login`   | Login    | Form login              |

### Cara Navigasi SPA
```html
<!-- Router-link tidak reload halaman, hanya update URL hash -->
<router-link to="/artikel">Kelola Artikel</router-link>

<!-- Komponen dirender di sini berdasarkan URL aktif -->
<router-view></router-view>
```

### Screenshot
> *(Tempel screenshot perpindahan antar halaman tanpa reload di sini)*

---

## Praktikum 13 — Autentikasi & Navigation Guards

### Tujuan
Implementasi sistem login dan proteksi halaman di sisi klien menggunakan Vue Router Navigation Guards.

### Konsep
**Navigation Guards** adalah "penjaga pintu" yang dieksekusi sebelum setiap navigasi rute. Digunakan untuk mengecek apakah pengguna boleh mengakses halaman tersebut.

```javascript
router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('isLoggedIn') === 'true';
    if (to.meta.requiresAuth && !isAuthenticated) {
        next('/login'); // Paksa ke halaman login
    } else {
        next(); // Izinkan akses
    }
});
```

### Alur Login
```
User isi form Login
  → axios.post('/auth/login', {username, password})
  → CI4 Auth::login() → cek database
  → Jika valid: kembalikan token
  → localStorage.setItem('userToken', token)
  → localStorage.setItem('isLoggedIn', 'true')
  → router.push('/artikel')
```

### Screenshot
> *(Tempel screenshot halaman login dan redirect ke /artikel setelah berhasil login)*

---

## Praktikum 14 — Keamanan API, Token & Axios Interceptors

### Tujuan
Mengamankan endpoint API di sisi server menggunakan CI4 Filters (Token-Based Authentication) dan mengotomatiskan pengiriman token dari frontend menggunakan Axios Interceptors.

### Konsep

#### Server-Side Security (CI4 Filter)
Filter `ApiAuthFilter` memeriksa setiap request ke endpoint yang dilindungi:
1. Apakah header `Authorization` ada?
2. Apakah formatnya `Bearer <token>`?
3. Jika tidak valid → tolak dengan HTTP 401 Unauthorized.

#### Client-Side Token Injection (Axios Interceptors)
Interceptor berfungsi sebagai "middleware" yang **mencegat setiap request keluar** dari VueJS dan menyuntikkan token secara otomatis ke header:

```javascript
axios.interceptors.request.use((config) => {
    const token = localStorage.getItem('userToken');
    if (token) {
        config.headers['Authorization'] = 'Bearer ' + token;
    }
    return config;
});
```

### File yang Dibuat/Dimodifikasi
| File | Keterangan |
|------|------------|
| `app/Filters/ApiAuthFilter.php` | Filter yang memeriksa token pada setiap request |
| `app/Config/Filters.php` | Mendaftarkan alias `apiauth` |
| `app/Config/Routes.php` | Menerapkan filter `apiauth` ke route POST/PUT/DELETE |
| `assets/js/app.js` | Axios interceptors request & response |

### Pengujian Keamanan

**Tanpa token (harus ditolak):**
```
POST http://localhost/labci4/public/post
(tanpa header Authorization)
→ 401 Unauthorized
{
  "status": 401,
  "error": 401,
  "messages": "Akses Ditolak. Token tidak ditemukan pada request!"
}
```

**Dengan token (harus berhasil):**
```
POST http://localhost/labci4/public/post
Header: Authorization: Bearer <token_dari_login>
Body: judul=..., isi=...
→ 201 Created
```

### Screenshot
> *(Tempel screenshot hasil 401 dari Postman saat tanpa token)*  
> *(Tempel screenshot tab Network browser yang menampilkan header Authorization: Bearer ...)*

---

## Kesimpulan

### Perbedaan Vue Router Navigation Guards vs CI4 Filters

| Aspek | Vue Router Navigation Guards | CodeIgniter 4 Filters |
|-------|-----------------------------|-----------------------|
| **Letak** | Sisi klien (browser) | Sisi server (PHP) |
| **Cara kerja** | Mencegah navigasi ke rute tertentu di browser | Mencegat HTTP request sebelum sampai ke controller |
| **Bisa dibobol?** | **Ya** — bisa dilewati dengan memanipulasi localStorage atau kode JS di browser | **Tidak** — berjalan di server, tidak bisa dimanipulasi dari luar |
| **Fungsi utama** | UX: mencegah pengguna melihat halaman yang salah | Security: mencegah akses ilegal langsung ke database via API |
| **Contoh skenario** | Redirect ke `/login` jika belum login | Tolak request POST tanpa token dengan 401 |

**Kesimpulan:** Keduanya saling melengkapi. Navigation Guards memberikan pengalaman pengguna yang baik di sisi klien, sedangkan CI4 Filters adalah **lapisan keamanan yang sesungguhnya** di sisi server yang tidak dapat ditembus tanpa token yang valid. Keamanan harus selalu diterapkan di **kedua sisi** agar sistem benar-benar aman.

---

*Dikerjakan sebagai bagian dari praktikum Pemrograman Web 2 — Universitas Pelita Bangsa*
