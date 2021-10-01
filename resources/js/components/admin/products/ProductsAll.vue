<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-md-4">
                <h1 class="mt-0 mb-0">Каталог</h1>
            </div>
            <div class="col-12 col-md-4" style="position: relative;">
                <input v-model="search" type="text" class="form-control" placeholder="Поиск по названию">
                <button @click="clearSearch()" v-if="search.length > 0" class="admin-search-clear">&times;</button>
            </div>
            <div class="col-12 col-md-4 text-end">
                <router-link :to="{ name: 'ProductCreate' }" class="btn btn-primary">Добавить товар</router-link>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <table v-if="filteredProducts && filteredProducts.length > 0" class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Товар</th>
                            <th>Базовая цена</th>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in filteredProducts" :key="'product_' + product.id">
                            <td>
                                {{ product.name }}
                            </td>
                            <td>
                                {{ product.base_price }} ₽
                            </td>
                            <td style="text-align: right;">
                                <router-link :to="{ name: 'ProductEdit', params: { id: product.id }}" class="btn btn-sm btn-outline-primary">Изменить</router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p v-else class="mb-0">Ничего не найдено &#128532;</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
                search: '',
            }
        },
        created() {
            axios
                .get('/api/products')
                .then(response => (
                    this.products = response.data
                ));
        },
        methods: {
            clearSearch() {
                this.search = ''
            }
        },
        computed: {
            filteredProducts() {
                return this.products.filter(product => {
                    return product.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
                })
            }
        },
        components: {
        }
    }
</script>