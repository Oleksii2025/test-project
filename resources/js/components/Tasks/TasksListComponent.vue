<template>
    <div v-if="show" class="flex justify-between px-4 mt-4 sm:px-8">
        <h2 class="text-2xl text-gray-600">Tasks List</h2>
    </div>
    <div v-if="show" class="p-4 mt-8 sm:px-8 sm:py-4">
        <div class="p-4 bg-white rounded">
            <div class="flex justify-end">
                <div>
                    <div>
                        <div @click="redirectPage('create-task')"
                             class="flex items-center bg-green-500 p-2 text-white rounded text-sm hover:bg-green-600 cursor-pointer">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 mr-1"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>

                            Create New
                        </div>
                    </div>
                </div>
            </div>
            <spinner-component v-if="loading"/>
            <table v-else class="w-full mt-2 text-gray-500">
                <thead class="border-b">
                <tr>
                    <th class="p-2 text-left text-gray-600">
                        #
                    </th>
                    <th class="text-left text-gray-600">Title</th>
                    <th class="text-left text-gray-600">Task status</th>
                    <th class="text-left text-gray-600">Due date</th>

                    <th class="text-right text-gray-600">ACTIONS</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                <tr v-for="(task, index) in tasks" :key="task.id">
                    <td class="p-2">
                        {{ index + 1 }}
                    </td>
                    <td class="flex items-center py-4">
                        <div class="">
                            <div class="text-gray-600 font-bolder">
                                <div
                                   class="text-blue-600 font-bolder">{{ task.title }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>{{ task.task_status === '0' ? 'open' : 'done' }}</td>
                    <td>{{ task.due_date }}</td>

                    <td class="text-right">
                        <Menu as="div" class="relative inline-block text-left">
                            <div>
                                <MenuButton
                                    class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white
                                        rounded-md bg-gray-500 hover:bg-gray-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                                >
                                    Actions
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 ml-2 -mr-1 text-violet-200 hover:text-violet-100"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </MenuButton>
                            </div>

                            <transition
                                enter-active-class="transition duration-100 ease-out"
                                enter-from-class="transform scale-95 opacity-0"
                                enter-to-class="transform scale-100 opacity-100"
                                leave-active-class="transition duration-75 ease-in"
                                leave-from-class="transform scale-100 opacity-100"
                                leave-to-class="transform scale-95 opacity-0"
                            >
                                <MenuItems
                                    class="absolute right-0 w-32 mt-1 origin-top-right bg-white divide-y divide-gray-100
                                        rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50 focus:outline-none"
                                >
                                    <div class="px-1 py-1">
                                        <MenuItem v-slot="{ active }">
                                            <button
                                                :class="[
                                                    active ? 'bg-gray-400 text-white' : 'text-gray-900',
                                                    'group flex rounded-md items-center w-full px-2 py-2 text-sm',
                                                ]"
                                            >
                                                <div @click="redirectPage(`edit-task/${task.id}`)"
                                                     class="cursor-pointer" :class="[
                                                        active ? 'bg-gray-400 text-white' : 'text-gray-900',
                                                        'group flex rounded-md items-center w-full  text-sm',
                                                    ]">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 h-5 mr-2 text-violet-400"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                                        />
                                                    </svg>
                                                    Edit / Show
                                                </div>
                                            </button>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <button
                                                class="cursor-pointer"
                                                :class="[
                                                    active ? 'bg-red-400 text-white' : 'text-gray-900',
                                                    'group flex rounded-md items-center w-full px-2 py-2 text-sm',
                                                ]"
                                                v-on:click="deleteTask(task.id)">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 h-5 mr-2 text-violet-400"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                    />
                                                </svg>
                                                Delete
                                            </button>
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import {Menu, MenuButton, MenuItems, MenuItem} from '@headlessui/vue'
import SpinnerComponent from "@/components/Helpers/SpinnerComponent.vue";

export default {
    components: {
        SpinnerComponent,
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
    },
    props: {
        data: Object
    },
    data() {
        return {
            tasks: [],
            loading: true,
            show: true,
        }
    },
    mounted() {
        this.getTasks();
        this.checkRoute();
    },
    methods: {
        getTasks: function () {
            this.loading = true;
            axios.post(`/api/tasks/list`, this.data).then(res => {
                this.tasks = res.data.data;
                this.loading = false;
            });
        },
        editTask: function (id) {

            this.$router.push(`/edit-task/${id}`);
        },
        deleteTask: function (id) {
            axios.get(`/api/tasks/delete/${id}`).then(res => {
                this.getTasks();
            });
        },
        redirectPage: function (route) {
            this.show = false;
            this.$router.push(route);
        },
        checkRoute: function () {
            this.$route.name == 'dashboard' ? this.show = true : this.show = false;
        }
    },
    watch: {
        data: {
            handler(newValue, oldValue) {
                this.show = true;
                if (newValue != oldValue) {
                    this.data.id = newValue.id;
                    this.data.title = newValue.title;
                    this.getTasks();
                }
            },
            deep: true
        }
    }
}
</script>
