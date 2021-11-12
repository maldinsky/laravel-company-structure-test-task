<template>
    <div>
        <h2 class="text-center">Таблица сотрудников и отделов</h2>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th></th>
                <th v-for="department in departments" :key="department.id">{{ department.name }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="employee in employees" :key="employee.id">
                <td>{{ employee.first_name }} {{ employee.last_name }}</td>
                <td v-for="department in departments" :key="department.id">
                    <span v-if="isInDepartment(employee.departments, department.id)">&times;</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        console.log(process.env.VUE_APP_API_URL);
        return {
            departments: [],
            employees: []
        }
    },
    created() {
        this.axios
            .get(process.env.VUE_APP_API_URL + 'employee/')
            .then(response => {
                this.employees = response.data;
            });

        this.axios
            .get(process.env.VUE_APP_API_URL + 'department/')
            .then(response => {
                this.departments = response.data;
            });
    },
    methods: {
        isInDepartment(employeeDepartments, department){
            return employeeDepartments.filter(n => n.id === department).length !== 0;
        }
    }
}
</script>
