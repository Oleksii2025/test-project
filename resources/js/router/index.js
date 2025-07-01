import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/pages/Home.vue';
import LoginComponent from '@/components/auth/LoginComponent.vue';
import RegisterComponent from '@/components/auth/RegisterComponent.vue';
import DashboardComponent from '@/components/DashboardComponent.vue';
import PageNotFoundComponent from '@/components/PageNotFoundComponent.vue';

const routes = [
    { path: '/', redirect: '/login', name: 'home', component: Home },
    { path: '/login', name: 'login', component: LoginComponent },
    { path: '/register', name: 'register', component: RegisterComponent },
    {
        path: "/dashboard",
        name: "dashboard",
        component: DashboardComponent,
        children: [
            // {
            //     path: "/list-users-management",
            //     name: "list-users-management",
            //     component: UsersManagement
            // },
            // {
            //     path: "/edit-users-management/:id",
            //     name: "EditUsersManagement",
            //     component: EditUsersManagement
            // },
            // {
            //     path: "/create-vacancies",
            //     name: "create-vacancies",
            //     component: CreateVacancies
            // },
            // {
            //     path: "/edit-vacancies/:id",
            //     name: "edit-vacancies",
            //     component: EditVacancies
            // },
            // {
            //     path: "/list-vacancies",
            //     name: "list-vacancies",
            //     component: ListVacancies,
            // },
            // {
            //     path: '/card',
            //     name: 'card',
            //     component: () => import('./components/Card.vue'),
            // },

        ]
    },
    { path: "/:pathMatch(.*)*", component: PageNotFoundComponent },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;