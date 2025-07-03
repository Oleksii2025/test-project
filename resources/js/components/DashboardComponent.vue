<template>
    <spinner-component v-if="loading"/>
    <div v-else class="flex min-h-screen">
        <sidebar-component @changeData="changeData"/>
        <div class="flex flex-col flex-grow bg-gray-200">
            <header-component />
            <tasks-list-component :data="data" class="min-w-small w-1/2"></tasks-list-component>
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
import TasksListComponent from './Tasks/TasksListComponent.vue';

export default {
    components: {
        SidebarComponent,
        HeaderComponent,
        FooterComponent,
        SpinnerComponent,
        TasksListComponent,
    },
    data() {
        return {
            loading: true,
            data: {
                id: 0,
                title: 'list',
            }
        }
    },
    mounted() {
        this.checkToken();
    },
    methods: {
        async checkToken() {
            if(this.$store.state.token !== '') {
                try {
                    const response = await axios.post('/api/auth/check-token', this.$store.state.token);
                    this.loading = false;
             } catch (error) {
                this.loading = false;
                this.$store.commit('clearToken');
            }
            } else {
                this.loading = false;
                this.$router.push('/login');
            }
        },
        changeData: function(params) {
            this.data = params;
        }
    }
}
</script>
