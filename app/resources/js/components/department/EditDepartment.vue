<template>
    <div>
        <h3 class="text-center">Редактирование отдела</h3>
        <div class="row">
            <div class="col-md-6">
                <div v-if="this.validationErrors">
                    <div class="alert alert-danger my-1" v-for="validationErrorsGroup in this.validationErrors">
                        <div v-for="validationError in validationErrorsGroup">{{ validationError }}</div>
                    </div>
                </div>
                <form @submit.prevent="editDepartment">
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" class="form-control" v-model="department.name">
                    </div>
                    <router-link :to="{name: 'department'}" class="btn btn-secondary">Назад</router-link>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
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
    created() {
        this.axios
            .get(process.env.VUE_APP_API_URL + `department/${this.$route.params.id}`)
            .then((res) => {
                this.department = res.data;
            });
    },
    methods: {
        editDepartment() {
            this.axios
                .patch(process.env.VUE_APP_API_URL + `department/${this.$route.params.id}`, this.department)
                .then((res) => {
                    this.$router.push({name: 'department'})
                }).catch(error => (
                    this.validationErrors = error.response.data.errors
                ));
        }
    }
}
</script>
