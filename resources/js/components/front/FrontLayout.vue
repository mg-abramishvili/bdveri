<template>
    <div>
        <header>
            <nav class="navbar navbar-expand-md navbar-light bg-light mb-4">
                <div class="container">
                    <a class="navbar-brand" href="#">БашДвери</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav me-auto mb-2 mb-md-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled">Disabled</a>
                            </li>
                        </ul>
                        <div class="d-flex">
                            <router-link :to="{name: 'Products'}" class="nav-link">Админка</router-link>
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