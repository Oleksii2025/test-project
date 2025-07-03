<template>
    <div class="w-full">
        <div>
            <form class="flex flex-col justify-between items-start px-24 py-4 min-h-custom-screen">
                <fieldset class="flex flex-col w-1/2 mt-1">
                    <label class="mb-2 mt-4">Title</label>
                    <input class="mb-2 mt-2 p-2 bg-white form-input rounded " v-model="fields.title" type="text" required>
                </fieldset>
                <fieldset class="flex flex-col w-1/2 mt-1">
                    <label class="mb-2 mt-4">Description</label>
                    <textarea class="mb-2 mt-2 p-2 bg-white w-full form-input rounded" v-model="fields.description" type="text" required></textarea>
                </fieldset>
                <fieldset class="flex flex-col w-1/2 mt-1">
                    <label class="mb-2 mt-4">Extra data title</label>
                    <input class="mb-2 mt-2 p-2 bg-white form-input min-w-middle rounded" v-model="extra_data_title" type="text" required>
                    <label class="mb-2 mt-4">Extra data description</label>
                    <textarea class="mb-2 mt-2 p-2 bg-white form-input min-w-middle rounded" v-model="extra_data_description" type="text" required></textarea>
                </fieldset>
                <fieldset class="flex flex-col w-1/2 mt-1">
                    <label class="mb-2 mt-4">Status</label>
                    <select class="mb-2 mt-2 p-2 bg-white form-input min-w-middle rounded" v-model="fields.task_status" >
                        <option value="0">In Progress</option>
                        <option value="1">Done</option>
                    </select>
                </fieldset>
                <fieldset class="flex flex-col w-1/2 mt-1">
                    <label class="mb-2 mt-4">Due date</label>
                    <input class="mb-2 mt-2 p-2 bg-white form-input min-w-middle rounded" v-model="fields.due_date" type="date" required>
                </fieldset>
                <fieldset class="flex flex-col w-1/2 mt-1">
                    <label class="mb-2 mt-4">Category</label>
                    <select class="mb-2 mt-2 p-2 bg-white form-input min-w-middle rounded" v-model="current_category_id">
                        <option v-for="(category, key) in categories" :value="current_category_id">{{category.title}}</option>
                    </select>
                </fieldset>
                <fieldset class="flex flex-col w-1/2 mt-1">
                    <label class="mb-2 mt-4">Type</label>
                    <select class="mb-2 mt-2 p-2 bg-white form-input min-w-middle rounded" v-model="current_type_id">
                        <option v-for="(type, key) in types" :value="current_type_id">{{type.title}}</option>
                    </select>
                </fieldset>
                <div class="flex justify-end items-end mt-8 w-1/2">
                    <input class="form-input px-11 py-1 max-w-sm rounded text-lg text-white bg-cyan-500 cursor-pointer" type="submit" value="Save" v-on:click="save">
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import SpinnerComponent from "@/components/Helpers/SpinnerComponent.vue";

export default {
    components: {
        SpinnerComponent,
    },
    props: {
        data: Object
    },
    data() {
        return {
            tasks: [],
            loading: true,
            fields: {
                id:'',
                title: '',
                description: '',
                extra_data: [],
                task_status: '',
                due_date: '',
                category_id: '',
                type_id: '',
            },
            current_category_id: '',
            current_type_id: '',
            extra_data_title: '',
            extra_data_description: '',
            categories: [],
            types: [],
        }
    },
    mounted() {
        this.getCategories();
        this.getTypes();
        this.getTask();
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
        getTask: function () {
            axios.get(`/api/tasks/show/${this.getSegment()}` ).then(res => {
                this.fields.id = res.data.data.id;
                this.fields.title = res.data.data.title;
                this.fields.description = res.data.data.description;
                this.fields.extra_data = JSON.parse(res.data.data.extra_data);
                for(const [key, val] of Object.entries(this.fields.extra_data)) {
                    this.extra_data_title = key;
                    this.extra_data_description = val;
                }
                this.fields.task_status = res.data.data.task_status;
                this.fields.due_date = res.data.data.due_date;
                this.current_category_id = res.data.data.categories[0].id;
                this.current_type_id = res.data.data.types[0].id;
            });
        },
        save: function (e) {
            e.preventDefault();
            const key = this.extra_data_title;
            const extra_data = {};
            extra_data[key] = this.extra_data_description;
            axios.post('/api/tasks/edit', {
                id: this.fields.id,
                title: this.fields.title,
                description: this.fields.description,
                extra_data: extra_data,
                task_status: this.fields.task_status,
                due_date: this.fields.due_date,
                category_id: this.current_category_id,
                type_id: this.current_type_id,
            }).then()
                .catch()
                .finally(() => (
                    this.$router.push({name: 'dashboard'})
                ))
        },
        getSegment(){
            let path = window.location.pathname;
            let segments = path.split("/");
            return segments.pop();
        } ,
    }
}
</script>
