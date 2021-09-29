<template>
    <div>
        <h1>Новый товар</h1>

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

        <button @click="saveProduct()" class="btn btn-primary">Добавить</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                base_price: '',
                old_price: '',
                description: '',
            }
        },
        created() {
            
        },
        methods: {
            saveProduct() {
                if(this.name.length > 0 && this.base_price.length > 0) {
                    axios
                    .post(`/api/products`, { name: this.name, base_price: this.base_price, old_price: this.old_price, description: this.description })
                    .then(response => (
                        this.$router.push({name: 'Зкщвгсеы' })
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