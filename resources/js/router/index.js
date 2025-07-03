import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/pages/Home.vue';
import LoginComponent from '@/components/Auth/LoginComponent.vue';
import RegisterComponent from '@/components/Auth/RegisterComponent.vue';
import DashboardComponent from '@/components/DashboardComponent.vue';
import CreateTaskComponent from '@/components/Tasks/CreateTaskComponent.vue';
import EditTaskComponent from '@/components/Tasks/EditTaskComponent.vue';
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
            {
                path: "/create-task",
                name: "create-task",
                component: CreateTaskComponent,
            },
            {
                path: "/edit-task/:id",
                name: "edit-task",
                component: EditTaskComponent,
            },
        ]
    },
    { path: "/:pathMatch(.*)*", component: PageNotFoundComponent },
];

const router = createRouter({
    history: createWebHistory('/'),
    routes,
});

export default router;
