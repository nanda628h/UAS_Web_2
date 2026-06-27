-- ============================================================
-- DATABASE SETUP - Lab7Web (Praktikum 2 s/d 6)
-- Jalankan query ini di phpMyAdmin atau MySQL CLI
-- ============================================================

-- Buat database
CREATE DATABASE IF NOT EXISTS lab_ci4;
USE lab_ci4;

-- ============================================================
-- Praktikum 2: Tabel Artikel
-- ============================================================
CREATE TABLE IF NOT EXISTS artikel (
    id          INT(11)      AUTO_INCREMENT,
    judul       VARCHAR(200) NOT NULL,
    isi         TEXT,
    gambar      VARCHAR(200),
    status      TINYINT(1)   DEFAULT 0,
    slug        VARCHAR(200),
    id_kategori INT(11),
    PRIMARY KEY (id)
);

-- ============================================================
-- Praktikum 4: Tabel User
-- ============================================================
CREATE TABLE IF NOT EXISTS user (
    id           INT(11)      AUTO_INCREMENT,
    username     VARCHAR(200) NOT NULL,
    useremail    VARCHAR(200),
    userpassword VARCHAR(200),
    PRIMARY KEY (id)
);

-- ============================================================
-- Praktikum 6: Tabel Kategori
-- ============================================================
CREATE TABLE IF NOT EXISTS kategori (
    id_kategori   INT(11)      AUTO_INCREMENT,
    nama_kategori VARCHAR(100) NOT NULL,
    slug_kategori VARCHAR(100),
    PRIMARY KEY (id_kategori)
);

-- Foreign key artikel -> kategori
ALTER TABLE artikel
    ADD CONSTRAINT fk_kategori_artikel
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
    ON DELETE SET NULL ON UPDATE CASCADE;

-- ============================================================
-- Data dummy artikel (Praktikum 2)
-- ============================================================
INSERT INTO artikel (judul, isi, slug) VALUES
('Artikel pertama',
 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an.',
 'artikel-pertama'),
('Artikel kedua',
 'Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi.',
 'artikel-kedua');

-- ============================================================
-- Data dummy kategori (Praktikum 6)
-- ============================================================
INSERT INTO kategori (nama_kategori, slug_kategori) VALUES
('Teknologi', 'teknologi'),
('Pendidikan', 'pendidikan'),
('Kesehatan',  'kesehatan');

-- ============================================================
-- Data user admin (Praktikum 4)
-- Password: admin123
-- Atau jalankan: php spark db:seed UserSeeder
-- ============================================================
INSERT INTO user (username, useremail, userpassword) VALUES
('admin', 'admin@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
-- password di atas adalah hash dari "password"
-- Gunakan php spark db:seed UserSeeder untuk password "admin123"
