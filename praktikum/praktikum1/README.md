# Lab7Web - Praktikum 1: PHP Framework (CodeIgniter 4)

## Tujuan
1. Memahami konsep dasar Framework.
2. Memahami konsep dasar MVC.
3. Membuat program sederhana menggunakan Framework CodeIgniter 4.

## Langkah-langkah

### 1. Persiapan
- Install XAMPP, aktifkan ekstensi PHP: `php-json`, `php-mysqlnd`, `php-xml`, `php-intl`
- Download CodeIgniter 4 dari https://codeigniter.com/download
- Ekstrak ke `htdocs/lab11_ci/ci4`

### 2. Aktifkan Mode Debugging
- Rename file `env` menjadi `.env`
- Ubah nilai `CI_ENVIRONMENT = development`

### 3. Struktur Direktori
```
ci4/
├── app/
│   ├── Config/
│   │   └── Routes.php       ← Konfigurasi routing
│   ├── Controllers/
│   │   ├── Home.php         ← Controller halaman utama
│   │   └── Page.php         ← Controller halaman statis
│   └── Views/
│       ├── template/
│       │   ├── header.php   ← Template header
│       │   └── footer.php   ← Template footer
│       ├── home.php
│       ├── about.php
│       ├── contact.php
│       └── faqs.php
└── public/
    └── style.css            ← File CSS layout
```

### 4. Routing
Routing didefinisikan di `app/Config/Routes.php`:
```php
$routes->get('/', 'Home::index');
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
```

### 5. Konsep MVC
- **Model** – Pemodelan data (database)
- **View** – Tampilan user interface (HTML/CSS)
- **Controller** – Logic proses yang menghubungkan Model dan View

### 6. Menjalankan Aplikasi
```bash
cd htdocs/lab11_ci/ci4
php spark serve
```
Buka browser: http://localhost:8080

### 7. Auto Routing
CodeIgniter mendukung auto routing. Method `tos()` pada `Page.php` dapat diakses di:
http://localhost:8080/page/tos

## Hasil
Semua halaman navigasi (Home, Artikel, About, Kontak) menampilkan layout yang seragam menggunakan template header dan footer.

## Screenshot
> Screenshot menyusul setelah praktikum dikerjakan di lokal.
