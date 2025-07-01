<template>
    <spinner-component v-if="loading"/>
    <div v-else class="flex min-h-screen">
        <sidebar-component />

        <div class="flex flex-col flex-grow bg-gray-200">
            <header-component />
            <!-- <div class="grid grid-cols-3 gap-4 pl-8 flex justify-center text-center">
                <cards v-for="(data, index) in dataCard" :data="data" @res="res" class="min-w-small w-1/2"></cards>
            </div> -->
            <div class="mb-auto">
                <router-view />
            </div>

            <footer-component />
        </div>
    </div>
</template>

<script>
import SidebarComponent from './layouts/SidebarComponent.vue'
import HeaderComponent from './layouts/HeaderComponent.vue'
import FooterComponent from './layouts/FooterComponent.vue'
import SpinnerComponent from './Helpers/SpinnerComponent.vue';
// import Cards from './Card'
// import { mapActions, mapGetters } from "vuex";

export default {
    components: {
        // Cards,
        SidebarComponent,
        HeaderComponent,
        FooterComponent,
        SpinnerComponent,
    },
    data() {
        return {
            loading: true,
        }
    },
    mounted() {
        this.checkTocken();
    },
    computed: {
        // ...mapGetters([
        //     // 'ADMIN_ENTITIES'
        // ]),
    },
    methods: {
        // ...mapActions([
        //     // 'ADMIN_GET_ENTITIES',
        //     // 'ADMIN_ENTITIES',
        // ]),
        async checkTocken() {
            if(this.$store.state.token !== '') {
                try {
                    const response = await axios.post('/api/auth/check-tocken', this.$store.state.token);
                    this.loading = false;
             } catch (error) {
                this.loading = false;
                this.$store.commit(clearTocken);
            }
            } else {
                this.loading = false;
                this.$router.push('/login');
            }
        }
    }
}
</script>
