<template>
    <div>
        <h1>{{ product.name }}</h1>

        <div class="mb-3">
            <label class="form-label">Название</label>
            <input v-model="name" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Базовая цена</label>
            <input v-model="base_price" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Старая цена</label>
            <input v-model="old_price" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Описание</label>
            <textarea v-model="description" rows="5" class="form-control"></textarea>
        </div>

        <button @click="saveProduct(product.id)" class="btn btn-primary">Добавить</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                product: {},
                name: '',
                base_price: '',
                old_price: '',
                description: '',
            }
        },
        created() {
            axios
                .get(`/api/product/${this.$route.params.id}`)
                .then(response => (
                    this.product = response.data,
                    this.name = response.data.name,
                    this.base_price = response.data.base_price,
                    this.old_price = response.data.old_price,
                    this.description = response.data.description
                ));
        },
        methods: {
            saveProduct($id) {
                if(this.name.length > 0 && this.base_price.length > 0) {
                    axios
                    .post(`/api/product/${$id}/update`, { name: this.name, base_price: this.base_price, old_price: this.old_price, description: this.description })
                    .then(response => (
                        this.$router.push({name: 'Products' })
                    ))
                    .catch((error) => {
                        if(error.response) {
                            for(var key in error.response.data.errors){
                                console.log(key)
                                alert(key)
                            }
                        }
                    });
                } else {
                    alert('Заполните поля')
                }
            }
        },
        components: {
        }
    }
</script>