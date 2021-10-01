<template>
    <div>
        <h1 class="mt-0 mb-4">{{ product.name }}</h1>

        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
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
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Цвет</th>
                                    <th style="text-align: right;">Цена</th>
                                    <th style="text-align: right;">
                                        <button @click="modal_add_new_color = true" class="btn btn-sm btn-primary">Добавить цвет</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product_color in product.colors" :key="'product_color_' + product_color.id">
                                    <td style="width: 100px; text-align: center;">
                                        <img :src="product_color.image" style="width: auto; height:50px;"/>
                                    </td>
                                    <td>
                                        {{ product_color.name }}
                                    </td>
                                    <td style="text-align: right;">
                                        <template v-if="product_color.price">
                                            {{ product_color.price }} ₽
                                        </template>
                                    </td>
                                    <td style="text-align: right;">
                                        <button @click="EditColor(product_color.id), edit_color_id = product_color.id" class="btn btn-sm btn-outline-secondary">Изменить</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div v-if="modal_add_new_color" class="modal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Новый цвет</h5>
                                        <button @click="close_add_color_modal()" type="button" class="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <file-pond
                                            name="new_color_image"
                                            ref="new_color_image"
                                            label-idle="Выбрать картинку..."
                                            v-bind:allow-multiple="false"
                                            accepted-file-types="image/jpeg, image/png"
                                            server="/api/product/add_color_image_upload"
                                            v-bind:files="color_filepond_files"
                                        />
                                        <div class="mb-3">
                                            <label class="form-label">Цвет</label>
                                            <input v-model="new_color_name" type="text" class="form-control">
                                        </div>
                                        <button @click="saveColor(product.id)" class="btn btn-primary">Добавить цвет</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-if="modal_edit_color" class="modal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Изменить цвет</h5>
                                        <button @click="close_edit_color_modal()" type="button" class="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <file-pond
                                            name="edit_color_image"
                                            ref="edit_color_image"
                                            label-idle="Выбрать картинку..."
                                            v-bind:allow-multiple="false"
                                            accepted-file-types="image/jpeg, image/png"
                                            :server="server"
                                            v-bind:files="color_filepond_files_edit"
                                        />
                                        <div class="row mb-4">
                                            <div class="col-8">
                                                <label class="form-label">Цвет</label>
                                                <input v-model="edit_color_name" type="text" class="form-control">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">Цена</label>
                                                <input v-model="edit_color_price" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <button @click="updateColor(edit_color_id)" class="btn btn-primary">Сохранить</button>
                                            <button @click="deleteColor(edit_color_id)" class="btn btn-outline-danger">Удалить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div v-if="modal_bg" class="modal-backdrop fade show"></div>
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

                modal_bg: false,

                modal_add_new_color: false,
                new_color_name: '',
                new_color_price: '',
                new_color_image: '',
                color_filepond_files: [],
                
                modal_edit_color: false,
                edit_color_id: '',
                edit_color_name: '',
                edit_color_price: '',
                edit_color_image: '',
                color_filepond_files_edit: [
                    {
                        source: '1',
                        options: {
                            type: 'local',
                        }
                    }
                ],

                server: {
                    remove(filename, load) {
                        load('1');
                    },
                    process(fieldName, file, metadata, load, error, progress, abort, transfer, options) {
                        const formData = new FormData();
                        formData.append(fieldName, file, file.name);
                        const request = new XMLHttpRequest();
                        request.open('POST', '/api/product/add_color_image_upload');
                        request.upload.onprogress = (e) => {
                            progress(e.lengthComputable, e.loaded, e.total);
                        };
                        request.onload = function () {
                            if (request.status >= 200 && request.status < 300) {
                                load(request.responseText);
                            } else {
                                error('oh no');
                            }
                        };
                        request.send(formData);
                        return {
                            abort: () => {
                                request.abort();
                                abort();
                            },
                        };
                    },
                    load(source, load, error, progress, abort, headers) {
                        var myRequest = new Request(source);
                        fetch(myRequest).then(function(response) {
                            response.blob().then(function(myBlob) {
                                load(myBlob)
                            });
                        });
                    },
                },
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
                if(this.new_color_name.length && this.new_color_image) {
                    axios
                    .post(`/api/product/${$id}/add_color`, { color_name: this.new_color_name, color_price: this.new_color_price, color_image: this.new_color_image })
                    .then(response => (
                        this.getProductInfo(),
                        this.close_add_color_modal()
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
            EditColor(id) {
                this.modal_edit_color = true
                this.modal_bg = true
                axios
                .get(`/api/color/${id}`)
                .then(response => (
                    this.edit_color_name = response.data.name,
                    this.edit_color_price = response.data.price,
                    this.color_filepond_files_edit = [
                        {
                            source: response.data.image,
                            options: {
                                type: 'local',
                            }
                        }
                    ]
                ));
            },
            updateColor(id) {
                this.edit_color_image = document.getElementsByName("edit_color_image")[0].value
                if(this.edit_color_name.length && this.edit_color_image.length) {
                    axios
                    .post(`/api/color/${id}/update`, { color_name: this.edit_color_name, color_price: this.edit_color_price, color_image: this.edit_color_image })
                    .then(response => (
                        this.getProductInfo(),
                        this.close_edit_color_modal()
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
            deleteColor(id) {
                if (confirm("Точно удалить?")) {
                    axios
                        .get(`/api/color/${id}/delete`)
                        .then(response => (
                            this.getProductInfo(),
                            this.close_edit_color_modal()
                        ))
                }
            },
            close_add_color_modal() {
                this.modal_add_new_color = false,
                this.modal_bg = false,
                this.new_color_name = '',
                this.new_color_price = '',
                this.new_color_image = '',
                this.color_filepond_files = []
            },
            close_edit_color_modal() {
                this.modal_edit_color = false,
                this.modal_bg = false,
                this.edit_color_name = '',
                this.edit_color_price = '',
                this.edit_color_image = '',
                this.color_filepond_files_edit = []
            },
        },
        components: {
            FilePond,
        }
    }
</script>