<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link">Главная</router-link>
                    <router-link :to="{name: 'department'}" class="nav-item nav-link">Отделы</router-link>
                    <router-link :to="{name: 'employee'}" class="nav-item nav-link">Сотрудники</router-link>
                </div>
            </div>
        </nav>

        <router-view></router-view>
    </div>
</template>

<script>
    export default {}
</script>
