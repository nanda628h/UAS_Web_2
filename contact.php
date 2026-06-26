<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPA Frontend VueJS & Vue Router</title>
    <!-- Praktikum 11: Library VueJS dan Axios via CDN -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <!-- Praktikum 12: Tambah Vue Router -->
    <script src="https://unpkg.com/vue-router@4/dist/vue-router.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div id="app">
        <header>
            <h1>Aplikasi Panel Single Page (SPA)</h1>
            <!-- Praktikum 12: Navigasi menggunakan router-link (tidak reload halaman) -->
            <nav class="nav-menu">
                <router-link to="/">Beranda</router-link> |
                <router-link to="/artikel" v-if="isLoggedIn">Kelola Artikel</router-link> |
                <router-link to="/about">About</router-link> |
                <!-- Praktikum 13: Tampilkan tombol Login/Logout secara kondisional -->
                <router-link to="/login" v-if="!isLoggedIn">Login</router-link>
                <a href="#" v-if="isLoggedIn" @click.prevent="logout">Logout</a>
            </nav>
        </header>

        <main style="margin-top: 20px;">
            <!-- Praktikum 12: Tempat komponen halaman dirender -->
            <router-view></router-view>
        </main>
    </div>

    <!-- Praktikum 12: Load komponen sebelum app.js -->
    <script src="assets/js/components/Home.js"></script>
    <script src="assets/js/components/Artikel.js"></script>
    <script src="assets/js/components/About.js"></script>
    <script src="assets/js/components/Login.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>
