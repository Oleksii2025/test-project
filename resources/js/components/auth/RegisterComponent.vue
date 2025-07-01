<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <spinner-component v-if="loading"/>
        <div v-else class="max-w-md w-full">
            <h2 class="text-center text-2xl font-bold text-gray-800 mb-6">Sign up</h2>
            <br><br>
            <form class="space-y-4" @submit.prevent="">
                <div class="relative text-gray-400">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4H1m3 4H1m3 4H1m3 4H1m6.071.286a3.429 3.429 0 1 1 6.858 0M4 1h12a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Zm9 6.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                        </svg>
                    </span>
                    <input v-model="name" id="name" name="name" type="name" autocomplete="name" class="w-full py-4 text-sm text-gray-900 rounded-md pl-10 border border-gray-300
                            focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10"
                        placeholder="Name" />
                </div>
                <div class="relative text-gray-400">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <input v-model="email" id="email" name="email" type="email" autocomplete="email" class="w-full py-4 text-sm text-gray-900 rounded-md pl-10 border border-gray-300
                            focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10"
                        placeholder="Email address" />
                </div>
                <div class="relative text-gray-400">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>
                    <input v-model="password" id="password" name="password" type="password"
                        autocomplete="current-password"
                        class="w-full py-4 text-sm text-gray-900 rounded-md pl-10 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10"
                        placeholder="Password" />
                </div>
                <div class="relative text-gray-400">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>
                    <input v-model="password_confirmation" id="password_confirmation" name="password_confirmation"
                        type="password" autocomplete="current-password"
                        class="w-full py-4 text-sm text-gray-900 rounded-md pl-10 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10"
                        placeholder="password_confirmation" />
                </div>
                <br>
                <span v-if="error" style="" class="text-red-700">Incorrect email or password</span>
                <br><br>
                <div>
                    <button @click="register" type=""
                        class="group relative w-full flex justify-center py-4 px-6 border border-transparent font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign up
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            loading: true,
            error: false,
        };
    },
    mounted() {
        this.checkTocken();
    },
    methods: {
        async register() {
            try {
                const response = await axios.post('/api/auth/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                });
                this.loading = false;
                this.error = false;
                console.log(response.data);
                this.$router.push('/login');
            } catch (error) {
                this.error = true;
                this.loading = false;
            }
        },
        async checkTocken() {
            if(this.$store.state.token !== '') {
                try {
                    const response = await axios.post('/api/auth/check-tocken', this.$store.state.token);
                    this.loading = false;
                    this.$router.push('/dashboard');
                } catch (error) {
                    this.loading = false;
                    this.$store.commit('clearTocken');
                }
            } else {
                this.loading = false;
            }
        }
    }
};
</script>