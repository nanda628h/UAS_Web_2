/**
 * Praktikum 13: Komponen halaman Login
 * Mengirim kredensial ke endpoint /auth/login dan menyimpan token ke localStorage.
 */
const Login = {
    template: `
        <div class="home-container" style="max-width:400px; margin:0 auto;">
            <h2>Login</h2>
            <p v-if="errorMsg" style="color:red;">{{ errorMsg }}</p>
            <div>
                <input type="text" v-model="username" placeholder="Username"
                    style="width:100%; margin-bottom:10px; padding:8px; box-sizing:border-box;">
            </div>
            <div>
                <input type="password" v-model="password" placeholder="Password"
                    style="width:100%; margin-bottom:10px; padding:8px; box-sizing:border-box;">
            </div>
            <button id="btnSimpan" @click="doLogin" :disabled="loading">
                {{ loading ? 'Memproses...' : 'Login' }}
            </button>
        </div>
    `,
    data() {
        return {
            username: '',
            password: '',
            errorMsg: '',
            loading:  false,
        };
    },
    methods: {
        doLogin() {
            this.loading  = true;
            this.errorMsg = '';

            const params = new URLSearchParams();
            params.append('username', this.username);
            params.append('password', this.password);

            axios.post(apiUrl + '/auth/login', params)
                .then(response => {
                    const data = response.data;
                    // Simpan status login dan token ke localStorage
                    localStorage.setItem('isLoggedIn', 'true');
                    localStorage.setItem('userToken', data.data.token);
                    localStorage.setItem('username', data.data.username);

                    // Perbarui state root Vue dan pindah ke halaman artikel
                    this.$root.isLoggedIn = true;
                    this.$router.push('/artikel');
                })
                .catch(error => {
                    this.errorMsg = error.response?.data?.messages || 'Login gagal. Periksa kembali username dan password.';
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
