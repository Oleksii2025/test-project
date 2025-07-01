<template>
    <aside class="hidden w-64 bg-gray-800 sm:block">
        <nav class="text-sm text-gray-300">
            <ul class="flex flex-col">
                <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">Section</li>
                <router-link v-slot="{ isExactActive, href, navigate }" :to="routes.dashboard" custom>
                    <li class="px-4 cursor-pointer"
                        :class="[isExactActive ? 'bg-gray-500 text-gray-800' : 'hover:bg-gray-700']">
                        <div class="py-3 flex items-center" @click="navigate">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </div>
                    </li>
                </router-link>

                <li>
                    <Disclosure v-slot="{ open }" :default-open="isUserManagementActive">
                        <DisclosureButton class="px-4 py-3 flex items-center w-full hover:bg-gray-700"
                            :class="open ? 'bg-gray-700' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            User Management
                            <span class="ml-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" :class="open ? 'transform rotate-90' : ''">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </DisclosureButton>
                        <DisclosurePanel>
                            <ul>
                                <li>
                                    <Disclosure v-slot="{ open }" :default-open="isUserActive">
                                        <DisclosureButton
                                            class="pl-8 pr-4 py-3 flex items-center w-full hover:bg-gray-700"
                                            :class="open ? 'bg-gray-700' : ''">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                                viewBox="0 0 16 16">
                                                <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                            </svg>
                                            Users
                                            <span class="ml-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor"
                                                    :class="open ? 'transform rotate-90' : ''">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </span>
                                        </DisclosureButton>
                                        <DisclosurePanel>
                                            <ul>
                                                <!-- <router-link :to="routes.listUsersManagement">
                                                    <li
                                                            class="pl-12"
                                                            :class="[isExactActive ? 'bg-gray-500 text-gray-800' : 'hover:bg-gray-700']"
                                                    >
                                                        <div class="py-3 flex items-center"
                                                             @click="navigate">
                                                            <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-5 w-5"
                                                                    fill="currentColor"
                                                                    viewBox="0 0 16 16"
                                                            >
                                                                <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                                            </svg>
                                                            Users List
                                                        </div>
                                                    </li>
                                                </router-link> -->
                                                Users List
                                            </ul>
                                        </DisclosurePanel>
                                    </Disclosure>
                                </li>
                            </ul>
                        </DisclosurePanel>
                    </Disclosure>
                </li>
                <li>
                    <Disclosure v-slot="{ open }" :default-open="isUserManagementActive">
                        <DisclosureButton class="px-4 py-3 flex items-center w-full hover:bg-gray-700"
                            :class="open ? 'bg-gray-700' : ''">
                            <i class="fas fa-briefcase mr-2" style="font-size: 20px"></i>
                            Vacancies
                            <span class="ml-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" :class="open ? 'transform rotate-90' : ''">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </DisclosureButton>
                        <DisclosurePanel>
                            <ul>
                                <li>
                                    <Disclosure v-slot="{ open }" :default-open="isUserActive">
                                        <DisclosureButton
                                            class="pl-8 pr-4 py-3 flex items-center w-full hover:bg-gray-700"
                                            :class="open ? 'bg-gray-700' : ''">
                                            <router-link :to="routes.listVacancies">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                                </svg>
                                                Vacancies list
                                            </router-link>
                                        </DisclosureButton>
                                    </Disclosure>
                                </li>
                                <li class="px-8 hover:bg-gray-700">
                                    <router-link :to="routes.createVacancies">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                            viewBox="0 0 16 16">
                                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                        </svg>
                                        Create Vacancies
                                    </router-link>
                                </li>
                            </ul>
                        </DisclosurePanel>
                    </Disclosure>
                </li>
                <li class="px-4 cursor-pointer hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    <div v-on:click="logout">Sign out</div>
                    <!--          </router-link>-->
                </li>
            </ul>
        </nav>
    </aside>
</template>

<script>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
// import { mapActions, mapGetters } from "vuex";
import axios from "axios";
// import { sanitizeLink, sanitizeLinks } from "../helpers/XssFunctions/sanitizeUrlFunction";

export default {
    components: {
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
    },
    props: {
        // entities: {
        //     type: Object
        // }
    },
    data() {
        return {
            userName: '',
            // sanitizeUrl: require("@braintree/sanitize-url").sanitizeUrl,
            routes: {
                home: '/',
                dashboard: '/dashboard',
                listVacancies: '/list-vacancies',
                createVacancies: '/create-vacancies',
                listUsersManagement: '/list-users-management',
            },
        }
    },

    setup() {
        // const route = useRoute()

        // const isUserManagementActive = computed(() => {
        //     const names = ['user-list', 'user-detail', 'roles', 'permissions']

        //     return names.includes(route.name)
        // })

        // const isUserActive = computed(() => {
        //     const names = ['user-list', 'user-detail']

        //     return names.includes(route.name)
        // })

        // return {
        //     route,
        //     isUserManagementActive,
        //     isUserActive,
        // }
    },
    mounted() {
        // this.getUser();
        // sanitizeLinks(this.routes);
    },
    computed: {
        // ...mapGetters([
        //     'ADMIN_USER'
        // ]),
    },
    methods: {
        // ...mapActions([
        //     'ADMIN_GET_USER',
        // ]),
        // getUser: function () {
        //     this.ADMIN_GET_USER().then(res => {
        //         this.userName = this.ADMIN_USER;
        //     });
        // },
        logout: function () {
            axios.post('/api/auth/logout', {}).then(res => {
                // this.$cookies.remove('user');
                this.$store.commit('clearTocken');
                this.$router.push({ name: 'login' });
            });
        }
    }
}
</script>
