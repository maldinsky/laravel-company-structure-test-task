<template>
    <div>
        <h2 class="text-center">Список отделов</h2>
        <div class="my-3">
            <router-link :to="{name: 'department.create'}" class="btn btn-success">Добавить</router-link>
        </div>
        <div v-if="this.errors">
            <div class="alert alert-danger my-1" v-for="error in this.errors">
                <div>{{ error }}</div>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Название отдела</th>
                <th>Количество сотрудников отдела</th>
                <th>Максимальная заработная плата</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="department in departments" :key="department.id">
                <td>{{ department.name }}</td>
                <td>{{ department.employees_count }}</td>
                <td>{{ department.employees_max_salary }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'department.edit', params: { id: department.id }}" class="btn btn-success">Изменить</router-link>
                        <button class="btn btn-danger" @click="deleteDepartment(department.id)">Удалить</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            departments: [],
            errors: null,
        }
    },
    created() {
        this.axios
            .get(process.env.VUE_APP_API_URL + 'department/')
            .then(response => {
                this.departments = response.data;
            });
    },
    methods: {
        deleteDepartment(id) {
            this.errors = null;

            this.axios
                .delete(process.env.VUE_APP_API_URL + `department/${id}`)
                .then(response => {
                    let i = this.departments.map(data => data.id).indexOf(id);
                    this.departments.splice(i, 1)
                })
                .catch(error => (
                    this.errors = error.response.data.errors
                ));
        }
    }
}
</script>
