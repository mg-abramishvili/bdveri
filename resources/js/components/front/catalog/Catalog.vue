<template>
    <div class="container">
        <div class="row">
            <div v-for="product in products" :key="'product_' + product.id" class="col-12 col-md-4">
                <router-link :to="{ name: 'ProductItem', params: { id: product.id } }">
                    <div>{{ product.name }}</div>
                    <div>{{ product.base_price }} ₽</div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            products: [],
        };
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
    },
};
</script>