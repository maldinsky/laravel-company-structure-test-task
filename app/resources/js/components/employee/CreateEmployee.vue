<template>
    <div>
        <h3 class="text-center">Добавление сотрудника</h3>
        <div class="row">
            <div class="col-md-6">
                <div v-if="this.validationErrors">
                    <div class="alert alert-danger my-1" v-for="validationErrorsGroup in this.validationErrors">
                        <div v-for="validationError in validationErrorsGroup">{{ validationError }}</div>
                    </div>
                </div>
                <form @submit.prevent="addEmployee">
                    <div class="form-group">
                        <label>Имя</label>
                        <input type="text" class="form-control" v-model="employee.first_name">
                    </div>
                    <div class="form-group">
                        <label>Фамилия</label>
                        <input type="text" class="form-control" v-model="employee.last_name">
                    </div>
                    <div class="form-group">
                        <label>Отчество</label>
                        <input type="text" class="form-control" v-model="employee.middle_name">
                    </div>
                    <div class="form-group">
                        <label>Пол</label>
                        <select class="form-control" v-model="employee.sex">
                            <option value="">Не выбрано</option>
                            <option value="m">Мужской</option>
                            <option value="f">Женский</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Заработная плата</label>
                        <input type="text" class="form-control" v-model="employee.salary">
                    </div>
                    <div class="form-group">
                        <label>Отдел</label>
                        <div class="form-check" v-for="department in departments" :key="department.id">
                            <input class="form-check-input" type="checkbox" v-model="employee.departments" :value="department.id" :id="'checkbox-department-' + department.id">
                            <label class="form-check-label" :for="'checkbox-department-' + department.id">
                                {{ department.name }}
                            </label>
                        </div>
                    </div>
                    <router-link :to="{name: 'employee'}" class="btn btn-secondary">Назад</router-link>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            employee: {
                departments: []
            },
            departments: [],
            validationErrors: null,
        }
    },
    mounted() {
        this.getDepartments();
    },
    methods: {
        addEmployee() {
            this.axios
                .post(process.env.VUE_APP_API_URL + 'employee/', this.employee)
                .then(response => (
                    this.$router.push({name: 'employee'})
                ))
                .catch(error => (
                    this.validationErrors = error.response.data.errors
                ));
        },
        getDepartments() {
            this.axios
                .get(process.env.VUE_APP_API_URL + 'department/')
                .then(response => {
                    this.departments = response.data;
                });
        },
    }
}
</script>
