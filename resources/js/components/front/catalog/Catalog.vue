<template>
    <div class="container">
        <div class="row">
            <div v-for="product in products" :key="'product_' + product.id" class="col-12 col-md-4">
                <div>{{ product.name }}</div>
                <div>{{ product.base_price }} ₽</div>
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