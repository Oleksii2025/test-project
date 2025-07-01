<template>
    <header class="flex justify-between bg-white border-b-2 px-4 sm:justify-end sm:px-6">
        <button class="sm:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <Menu as="div" class="relative">
            <MenuButton class="flex items-center space-x-2 px-2 py-3 text-sm hover:bg-gray-200 focus:outline-none">
                <span class="pl-5 text-base text-gray-700">{{ userName }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </MenuButton>
            <transition enter-active-class="transition ease-out duration-100"
                enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95">
                <MenuItems
                    class="origin-top-right absolute right-0 w-48 shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200 focus:outline-none">
                    <MenuItem v-slot="{ active }">
                    <div v-on:click="logout"
                        :class="[active ? 'bg-gray-200' : '', 'block px-4 py-2 text-sm text-gray-700']">Sign out
                    </div>
                    </MenuItem>
                </MenuItems>
            </transition>
        </Menu>
    </header>
</template>

<script>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
// import { mapActions, mapGetters } from "vuex";
import axios from 'axios'

export default {
    components: {
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
    },
    data() {
        return {
            userName: '',
        }
    },
    mounted() {
        // this.getUser();
    },
    computed: {
        // ...mapGetters([
        //     // 'ADMIN_USER'
        // ]),
    },
    methods: {
        // ...mapActions([
        //     // 'ADMIN_GET_USER',
        // ]),
        getUser: function () {
            // this.ADMIN_GET_USER().then(res => {
            //     this.userName = this.ADMIN_USER;
            // });
        },
        logout: function () {
            axios.post('/api/logout', {}).then(res => {
                this.$cookies.remove('user');
                this.$router.push({ name: 'login' });
            });
        }
    }
}
</script>
