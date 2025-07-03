<template>
    <div class="w-full">
        <div>
            <form class="flex flex-col justify-between items-start px-24 py-4 min-h-custom-screen">
                <fieldset class="flex flex-col w-1/2 mt-1">
                    <label class="mb-2 mt-4">Title</label>
                    <input class="mb-2 mt-2 p-2 bg-white form-input rounded " v-model="fields.title" type="text"
                           required>
                </fieldset>
                <fieldset class="flex flex-col w-1/2 mt-1">
                    <label class="mb-2 mt-4">Description</label>
                    <textarea class="mb-2 mt-2 p-2 bg-white w-full form-input rounded" v-model="fields.description"
                              type="text" required></textarea>
                </fieldset>
                <fieldset class="flex flex-col w-1/2 mt-1">
                    <label class="mb-2 mt-4">Extra data title</label>
                    <input class="mb-2 mt-2 p-2 bg-white form-input min-w-middle rounded" v-model="extra_data_title"
                           type="text" required>
                    <label class="mb-2 mt-4">Extra data description</label>
                    <textarea class="mb-2 mt-2 p-2 bg-white form-input min-w-middle rounded"
                              v-model="extra_data_description" type="text" required></textarea>
                </fieldset>
                <fieldset class="flex flex-col w-1/2 mt-1">
                    <label class="mb-2 mt-4">Due date</label>
                    <input class="mb-2 mt-2 p-2 bg-white form-input min-w-middle rounded" v-model="fields.due_date"
                           type="date" required>
                </fieldset>
                <fieldset class="flex flex-col w-1/2 mt-1">
                    <label class="mb-2 mt-4">Category</label>
                    <select class="mb-2 mt-2 p-2 bg-white form-input min-w-middle rounded" v-model="fields.category_id"
                            type="text">
                        <option v-for="(category, key) in categories" :value="category.id">{{ category.title }}</option>
                    </select>
                </fieldset>
                <fieldset class="flex flex-col w-1/2 mt-1">
                    <label class="mb-2 mt-4">Type</label>
                    <select class="mb-2 mt-2 p-2 bg-white form-input min-w-middle rounded" v-model="fields.type_id"
                            type="text">
                        <option v-for="(type, key) in types" :value="type.id">{{ type.title }}</option>
                    </select>
                </fieldset>
                <div class="flex justify-end items-end mt-8 w-1/2">
                    <input class="form-input px-11 py-1 max-w-sm rounded text-lg text-white bg-cyan-500 cursor-pointer"
                           type="submit" value="Save" v-on:click="save">
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
                title: '',
                description: '',
                extra_data: [],
                due_date: '',
                category_id: '',
                type_id: '',
            },
            extra_data_title: '',
            extra_data_description: '',
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
        save: function (e) {
            e.preventDefault();
            const key = this.extra_data_title;
            const extra_data = {};
            extra_data[key] = this.extra_data_description;
            axios.post('/api/tasks/create', {
                title: this.fields.title,
                description: this.fields.description,
                extra_data: extra_data,
                due_date: this.fields.due_date,
                category_id: this.fields.category_id,
                type_id: this.fields.type_id,
            }).then()
                .catch()
                .finally(() => (
                    this.$router.push({name: 'dashboard'})
                ))
        }
    }
}
</script>
