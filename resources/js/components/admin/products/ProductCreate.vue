<template>
    <div>
        <h1>Новый товар</h1>

        <div class="mb-3">
            <label class="form-label">Название</label>
            <input v-model="name" type="text" class="form-control">
        </div>

        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Базовая цена</label>
                    <input v-model="base_price" type="text" class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Старая цена</label>
                    <input v-model="old_price" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Стиль</label>
            <select v-model="style" class="form-select">
                <option v-for="stylesItem in styles" :value="stylesItem.id" :key="'stylesItem_' + stylesItem.id">
                    {{ stylesItem.name }}
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Тип</label>
            <select v-model="type" class="form-select">
                <option v-for="typesItem in types" :value="typesItem.id" :key="'typesItem_' + typesItem.id">
                    {{ typesItem.name }}
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Производитель</label>
            <select v-model="manufacturer" class="form-select">
                <option v-for="manufacturersItem in manufacturers" :value="manufacturersItem.id" :key="'manufacturersItem_' + manufacturersItem.id">
                    {{ manufacturersItem.name }}
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Конструкция</label>
            <select v-model="construct" class="form-select">
                <option v-for="constructsItem in constructs" :value="constructsItem.id" :key="'constructsItem_' + constructsItem.id">
                    {{ constructsItem.name }}
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Покрытие</label>
            <select v-model="surface" class="form-select">
                <option v-for="surfacesItem in surfaces" :value="surfacesItem.id" :key="'surfacesItem_' + surfacesItem.id">
                    {{ surfacesItem.name }}
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Изготовление</label>
            <select v-model="production" class="form-select">
                <option v-for="productionsItem in productions" :value="productionsItem.id" :key="'productionsItem_' + productionsItem.id">
                    {{ productionsItem.name }}
                </option>
            </select>
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

                styles: [],
                style: '',

                types: [],
                type: '',

                productions: [],
                production: '',

                surfaces: [],
                surface: '',

                manufacturers: [],
                manufacturer: '',

                constructs: [],
                construct: '',
            }
        },
        created() {
            axios
                .get('/api/styles')
                .then(response => (
                    this.styles = response.data
                ));
            axios
                .get('/api/types')
                .then(response => (
                    this.types = response.data
                ));
            axios
                .get('/api/manufacturers')
                .then(response => (
                    this.manufacturers = response.data
                ));
            axios
                .get('/api/constructs')
                .then(response => (
                    this.constructs = response.data
                ));
            axios
                .get('/api/surfaces')
                .then(response => (
                    this.surfaces = response.data
                ));
            axios
                .get('/api/productions')
                .then(response => (
                    this.productions = response.data
                ));
        },
        methods: {
            saveProduct() {
                if(this.name.length > 0 && this.base_price.length > 0) {
                    axios
                    .post(`/api/products`, {
                            name: this.name,
                            base_price: this.base_price,
                            old_price: this.old_price,
                            description: this.description,
                            manufacturer: this.manufacturer,
                            surface: this.surface,
                            production: this.production,
                            type: this.type,
                            construct: this.construct,
                            style: this.style
                        })
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