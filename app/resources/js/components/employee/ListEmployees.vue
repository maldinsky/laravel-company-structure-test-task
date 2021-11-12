<template>
    <div>
        <h2 class="text-center">Список сотрудников</h2>
        <div class="my-3">
            <router-link :to="{name: 'employee.create'}" class="btn btn-success">Добавить</router-link>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Отчество</th>
                <th>Пол</th>
                <th>Заработная плата</th>
                <th>Отделы</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="employee in employees" :key="employee.id">
                <td>{{ employee.first_name }}</td>
                <td>{{ employee.last_name }}</td>
                <td>{{ employee.middle_name }}</td>
                <td>{{ employee.sex }}</td>
                <td>{{ employee.salary }}</td>
                <td>{{ getDepartmentsNames(employee.departments) }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'employee.edit', params: { id: employee.id }}" class="btn btn-success">Изменить</router-link>
                        <button class="btn btn-danger" @click="deleteEmployee(employee.id)">Удалить</button>
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
            employees: []
        }
    },
    created() {
        this.axios
            .get(process.env.VUE_APP_API_URL + 'employee/')
            .then(response => {
                this.employees = response.data;
            });
    },
    methods: {
        deleteEmployee(id) {
            this.axios
                .delete(process.env.VUE_APP_API_URL + `employee/${id}`)
                .then(response => {
                    let i = this.employees.map(data => data.id).indexOf(id);
                    this.employees.splice(i, 1)
                });
        },
        getDepartmentsNames(departments) {
            return departments.map(e => e.name).join(', ');
        },
    }
}
</script>
