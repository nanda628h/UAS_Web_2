/**
 * assets/js/app.js
 * ================
 * Praktikum 11 : Inisialisasi Vue, load data dari REST API
 * Praktikum 12 : Vue Router + Komponen + Navigation
 * Praktikum 13 : Navigation Guards (Client-Side Security)
 * Praktikum 14 : Axios Interceptors (Server-Side Token Injection)
 */

const { createApp }                    = Vue;
const { createRouter, createWebHashHistory } = VueRouter;

// Sesuaikan URL ini dengan project CI4 Anda
const apiUrl = 'http://localhost/labci4/public';

// =========================================================================
// PRAKTIKUM 14: AXIOS INTERCEPTORS — Penyuntik Token Otomatis
// =========================================================================

// REQUEST interceptor: tambahkan Authorization header ke setiap request keluar
axios.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('userToken');
        if (token) {
            config.headers['Authorization'] = 'Bearer ' + token;
        }
        return config;
    },
    (error) => Promise.reject(error)
);

// RESPONSE interceptor: tangkap error 401 secara global
axios.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response && error.response.status === 401) {
            alert('Sesi Anda telah berakhir atau Token tidak sah. Silakan login kembali.');
            localStorage.clear();
            window.location.href = '#/login';
            window.location.reload();
        }
        return Promise.reject(error);
    }
);

// =========================================================================
// PRAKTIKUM 12: DEFINISI RUTE (URL → Komponen)
// =========================================================================
const routes = [
    { path: '/',        component: Home  },
    { path: '/about',   component: About },
    { path: '/login',   component: Login },
    {
        path: '/artikel',
        component: Artikel,
        // Praktikum 13: Tandai rute ini membutuhkan autentikasi
        meta: { requiresAuth: true },
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

// =========================================================================
// PRAKTIKUM 13: NAVIGATION GUARDS — Client-Side Security
// Mencegah akses ke halaman yang requiresAuth tanpa login
// =========================================================================
router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('isLoggedIn') === 'true';

    if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
        alert('Akses Ditolak! Anda harus login terlebih dahulu.');
        next('/login');
    } else {
        next();
    }
});

// =========================================================================
// PRAKTIKUM 11-12: INISIALISASI ROOT APPLICATION VUEJS
// =========================================================================
const app = createApp({
    data() {
        return {
            isLoggedIn: false,
        };
    },
    mounted() {
        // Sinkronisasi status login dari localStorage saat aplikasi dimuat
        this.isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    },
    methods: {
        logout() {
            if (confirm('Apakah Anda yakin ingin keluar aplikasi?')) {
                localStorage.clear();
                this.isLoggedIn = false;
                this.$router.push('/');
            }
        },
    },
});

app.use(router);
app.mount('#app');
