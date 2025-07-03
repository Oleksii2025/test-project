<template>
    <aside class="hidden w-64 bg-gray-800 sm:block">
        <nav class="text-sm text-gray-300">
            <ul class="flex flex-col">
                <li class="px-4 py-2 text-xs uppercase tracking-wider text-gray-500 font-bold">Dashboard</li>
                <li>
                    <Disclosure v-slot="{ open }">
                        <DisclosureButton class="px-4 py-3 flex items-center w-full hover:bg-gray-700 cursor-pointer"
                                          :class="open ? 'bg-gray-700' : ''">
                            Tasks
                            <span class="ml-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" :class="open ? 'transform rotate-90' : ''">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </DisclosureButton>
                        <DisclosurePanel>
                            <ul>
                                <li>
                                    <Disclosure v-slot="{ open }">
                                        <DisclosureButton
                                            class="flex items-center w-full hover:bg-gray-700 cursor-pointer"
                                            :class="open ? 'bg-gray-700' : ''">
                                            <div class="pl-8 py-3 pr-4" @click="sendData(0, 'list')">Tasks list</div>
                                        </DisclosureButton>
                                    </Disclosure>
                                </li>
                                <li>
                                    <Disclosure v-slot="{ open }">
                                        <DisclosureButton
                                            class="pl-8 pr-4 py-3 flex items-center w-full hover:bg-gray-700 cursor-pointer"
                                            :class="open ? 'bg-gray-700' : ''">
                                            Filter by category
                                            <span class="ml-auto">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor"
                                                         :class="open ? 'transform rotate-90' : ''">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M9 5l7 7-7 7"/>
                                                    </svg>
                                                </span>
                                        </DisclosureButton>
                                        <DisclosurePanel>
                                            <ul>
                                                <li>
                                                    <Disclosure v-slot="{ open }">
                                                        <div v-for="(category, index) in categories"
                                                             class="flex items-center w-full hover:bg-gray-700 cursor-pointer"
                                                             :class="open ? 'bg-gray-700' : ''">
                                                            <div class="pl-10 pr-4 py-3 w-full"
                                                                 @click="sendData(category.id, 'category')">
                                                                {{ category.title }}
                                                            </div>
                                                        </div>
                                                    </Disclosure>
                                                </li>
                                            </ul>
                                        </DisclosurePanel>
                                    </Disclosure>
                                </li>
                                <li>
                                    <Disclosure v-slot="{ open }">
                                        <DisclosureButton
                                            class="pl-8 pr-4 py-3 flex items-center w-full hover:bg-gray-700 cursor-pointer"
                                            :class="open ? 'bg-gray-700' : ''">
                                            Filter by type
                                            <span class="ml-auto">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor"
                                                         :class="open ? 'transform rotate-90' : ''">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M9 5l7 7-7 7"/>
                                                    </svg>
                                                </span>
                                        </DisclosureButton>
                                        <DisclosurePanel>
                                            <ul>
                                                <li>
                                                    <Disclosure v-slot="{ open }">
                                                        <div v-for="(type, index) in types"
                                                             class="flex items-center w-full hover:bg-gray-700 cursor-pointer"
                                                             :class="open ? 'bg-gray-700' : ''">
                                                            <div class="pl-10 pr-4 py-3 w-full"
                                                                 @click="sendData(type.id, 'type')">{{ type.title }}
                                                            </div>
                                                        </div>
                                                    </Disclosure>
                                                </li>
                                            </ul>
                                        </DisclosurePanel>
                                    </Disclosure>
                                </li>
                                <li class="px-8 py-3 hover:bg-gray-700 cursor-pointer">
                                    <router-link :to="routes.createTask">
                                        Create Task
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
                              d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    <div v-on:click="logout">Sign out</div>
                </li>
            </ul>
        </nav>
    </aside>
</template>

<script>
import {Disclosure, DisclosureButton, DisclosurePanel} from '@headlessui/vue'
import axios from "axios";

export default {
    components: {
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
    },
    data() {
        return {
            routes: {
                home: '/',
                dashboard: '/dashboard',
            },
            categories: [],
            types: [],
        }
    },
    mounted() {
        this.getCategories();
        this.getTypes();
    },
    methods: {
        getCategories: function () {
            axios.get('/api/categories/list', {}).then(res => {
                this.categories = res.data.data;
            });
        },
        getTypes: function () {
            axios.get('/api/types/list', {}).then(res => {
                this.types = res.data.data;
            });
        },
        logout: function () {
            axios.post('/api/auth/logout', {}).then(res => {
                this.$store.commit('clearToken');
                this.$router.push({name: 'login'});
            });
        },
        sendData: function (id, title) {
            this.$emit('changeData', {'id': id, 'title': title});
            this.$router.push({name: 'dashboard'});
        }
    }
}
</script>
