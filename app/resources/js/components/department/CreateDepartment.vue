<template>
    <div>
        <h3 class="text-center">Добавление отдела</h3>
        <div class="row">
            <div class="col-md-6">
                <div v-if="this.validationErrors">
                    <div class="alert alert-danger my-1" v-for="validationErrorsGroup in this.validationErrors">
                        <div v-for="validationError in validationErrorsGroup">{{ validationError }}</div>
                    </div>
                </div>
                <form @submit.prevent="addDepartment">
                    <div class="form-group">
                        <label>Название отдела</label>
                        <input type="text" class="form-control" v-model="department.name">
                    </div>
                    <router-link :to="{name: 'department'}" class="btn btn-secondary">Назад</router-link>
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
            department: {},
            validationErrors: null,
        }
    },
    methods: {
        addDepartment() {
            this.axios
                .post(process.env.VUE_APP_API_URL + 'department/', this.department)
                .then(response => (
                    this.$router.push({name: 'department'})
                ))
                .catch(error => (
                    this.validationErrors = error.response.data.errors
                ));
        }
    }
}
</script>
