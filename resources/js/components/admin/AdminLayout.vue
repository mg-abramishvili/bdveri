<template>
    <div>
        <header>
            <nav class="navbar navbar-expand-md navbar-light bg-light mb-4">
                <div class="container">
                    <router-link :to="{name: 'Products'}" class="navbar-brand">Админка</router-link>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav me-auto mb-2 mb-md-0">
                            <li class="nav-item">
                                <router-link :to="{name: 'Products'}" class="nav-link">Каталог</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name: 'TempFiles'}" class="nav-link">Файлы</router-link>
                            </li>
                        </ul>
                        <div class="d-flex">
                            <router-link :to="{name: 'Home'}" class="nav-link">Фронт</router-link>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container">
            <router-view :key="$route.path"></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        created() {
        },
        methods: {
        },
        components: {
        }
    }
</script>