<template>
    <div>
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <h1>Каталог</h1>
            </div>
            <div class="col-12 col-md-6 text-end">
                <router-link :to="{ name: 'ProductCreate' }" class="btn btn-primary">Добавить товар</router-link>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Товар</th>
                    <th>Базовая цена</th>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="'product_' + product.id">
                    <td>
                        {{ product.name }}
                    </td>
                    <td>
                        {{ product.base_price }} ₽
                    </td>
                    <td style="text-align: right;">
                        <router-link :to="{ name: 'ProductEdit', params: { id: product.id }}" class="btn btn-sm btn-warning">Изменить</router-link>
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
                products: [],
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
        },
        components: {
        }
    }
</script>