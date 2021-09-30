<template>
    <div>
        <h1>{{ product.name }}</h1>

        <div class="row">
            <div class="col-12 col-md-4">
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

                <button @click="saveProduct(product.id)" class="btn btn-primary">Сохранить</button>
            </div>
            <div class="col-12 col-md-8">

                <table class="table table-striped table-hover">
                    <tbody>
                        <tr v-for="product_color in product.colors" :key="'product_color_' + product_color.id">
                            <td>
                                <img :src="product_color.image" style="width: auto; height:50px;"/>
                            </td>
                            <td>
                                {{ product_color.name }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <file-pond
                    name="new_color_image"
                    ref="new_color_image"
                    label-idle="Выбрать картинку..."
                    allow-multiple="false"
                    accepted-file-types="image/jpeg, image/png"
                    server="/api/product/add_color_image_upload"
                    v-bind:files="color_filepond_files"
                />
                <div class="mb-3">
                    <label class="form-label">Цвет</label>
                    <input v-model="new_color_name" type="text" class="form-control">
                </div>
                <button @click="saveColor(product.id)">Добавить цвет</button>
            </div>
        </div>

    </div>
</template>

<script>
    import vueFilePond from "vue-filepond";

    import "filepond/dist/filepond.min.css";

    import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

    import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
    import FilePondPluginImagePreview from "filepond-plugin-image-preview";

    const FilePond = vueFilePond(
        FilePondPluginFileValidateType,
        FilePondPluginImagePreview
    );

    export default {
        data() {
            return {
                product: {},
                name: '',
                base_price: '',
                old_price: '',
                description: '',

                new_color_name: '',
                new_color_price: '',
                new_color_image: '',
                color_filepond_files: [],

            }
        },
        created() {
            this.getProductInfo()
        },
        methods: {
            getProductInfo() {
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
            },
            saveColor($id) {
                this.new_color_image = document.getElementsByName("new_color_image")[0].value
                if(this.new_color_name.length) {
                    axios
                    .post(`/api/product/${$id}/add_color`, { color_name: this.new_color_name, color_price: this.new_color_price, color_image: this.new_color_image })
                    .then(response => (
                        this.getProductInfo()
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
            },
        },
        components: {
            FilePond,
        }
    }
</script>