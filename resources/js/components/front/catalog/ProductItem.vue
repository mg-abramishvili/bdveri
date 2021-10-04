<template>
    <div class="product-item-page">

        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="ProductColorHooper_wrapper">
                        <div class="stickers">
                            <div v-if="product.hit == true" class="sticker sticker_hit">Хит</div>
                            <div v-if="product.special == true" class="sticker sticker_special">Акция</div>
                            <div v-if="product.sale == true" class="sticker sticker_sale">Распродажа</div>
                            <div v-if="product.discount == true" class="sticker sticker_discount">Скидка</div>
                        </div>

                        <button @click.prevent="slidePrev" class="hooper_nav_button hooper_nav_button_prev"></button>
                        <button @click.prevent="slideNext" class="hooper_nav_button hooper_nav_button_next"></button>

                        <hooper ref="ProductColorHooper" :settings="ProductColorHooper" class="ProductColorHooper">
                            <slide v-for="(color, index) in product.colors" :key="'product_color_' + color.id" class="product-colors-slide" v-bind:style="{ 'background-image': 'url(' + color.image + ')' }"></slide>
                        </hooper>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="row">
                        <div class="col-12 col-md-9">
                            <h1 class="mt-0 mb-0">{{ product.name }}</h1>

                            <div class="rating mb-2">
                                <div class="star star-full"></div>
                                <div class="star star-full"></div>
                                <div class="star star-full"></div>
                                <div class="star star-full"></div>
                                <div class="star star-half"></div>
                                <div class="score">11 отзывов</div>
                            </div>

                            <div class="row align-items-center mb-2">
                                <div class="col-12 col-md-12">
                                    <span class="color_size_label">Цвет:</span>
                                </div>
                                <div class="col-12 col-md-12">
                                    <ul class="product-colors-list">
                                        <li v-for="(color, index) in product.colors" :key="'product_color_' + color.id">
                                            <button @click="chooseColor(index, color.id, color.name, color.price)" :id="'product_color_' + color.id" class="product-color-button">
                                                {{ color.name }}
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-12 col-md-12">
                                    <span class="color_size_label">Размер:</span>
                                </div>
                                <div class="col-12 col-md-12">
                                    <ul class="product-sizes-list">
                                        <li v-for="(size, index) in product.sizes" :key="'product_size_' + size.id">
                                            <button @click="chooseSize(index, size.id, size.name, size.price)" :id="'product_size_' + size.id" class="product-size-button">
                                                {{ size.name }}
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="price my-2">
                                <del v-if="product.old_price">{{ product.old_price }} <i style="font-style: normal; color: #b3b3b7; font-weight: 400;">₽</i></del><br/>
                                {{ price }} <i style="font-style: normal; color: #b3b3b7; font-weight: 400;">₽</i>
                            </div>

                            <button class="btn-standard">В корзину</button>
                        </div>

                        <div class="col-12 col-md-3">
                            <div class="product-info-buttons">
                                <button @click="open_gdekupit_modal()">
                                    <img src="/img/ico-location.svg" />
                                    <span>Где купить?</span>
                                </button>
                                <div v-if="modal_gdekupit" class="modal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Где купить?</h5>
                                                <button @click="close_gdekupit_modal()" type="button" class="btn-close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Где купить текст.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <button @click="open_kakoplatit_modal()">
                                    <img src="/img/ico-card.svg" />
                                    <span>Как оплатить?</span>
                                </button>
                                <div v-if="modal_kakoplatit" class="modal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Как оплатить?</h5>
                                                <button @click="close_kakoplatit_modal()" type="button" class="btn-close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Оплата текст.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <button @click="open_zamer_modal()">
                                    <img src="/img/ico-size.svg" />
                                    <span>Заказать замер</span>
                                </button>
                                <div v-if="modal_zamer" class="modal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Заказать замер</h5>
                                                <button @click="close_zamer_modal()" type="button" class="btn-close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Замер текст.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <button @click="open_zvonok_modal()">
                                    <img src="/img/ico-alarm.svg" />
                                    <span>Обратный звонок</span>
                                </button>
                                <div v-if="modal_zvonok" class="modal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Обратный звонок</h5>
                                                <button @click="close_zvonok_modal()" type="button" class="btn-close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Звонок текст.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="description">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <h2 class="mb-2">Описание</h2>
                    </div>
                    <div class="col-12 col-md-8">
                        {{ product.description }}
                    </div>
                </div>
            </div>
        </div>

        <div class="table-description">
            <div class="container">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" @click="selectTab('pills-tech')" id="pills-tech_link" type="button" role="tab">Характеристики</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" @click="selectTab('pills-reviews')" id="pills-reviews_link" type="button" role="tab">Отзывы</button>
                    </li>
                </ul>
            </div>
            <div class="tab-content bg-light">
                <div class="tab-pane fade show active" id="pills-tech" role="tabpanel">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <h2 class="mb-2">Характеристики</h2>
                            </div>
                            <div class="col-12 col-md-8">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Производитель</td>
                                            <td>
                                                <template v-for="manufacturer in product.manufacturers">
                                                    {{ manufacturer.name }}
                                                </template>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Стиль</td>
                                            <td>
                                                <template v-for="style in product.styles">
                                                    {{ style.name }}
                                                </template>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Тип</td>
                                            <td>
                                                <template v-for="type in product.types">
                                                    {{ type.name }}
                                                </template>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Конструкция</td>
                                            <td>
                                                <template v-for="construct in product.constructs">
                                                    {{ construct.name }}
                                                </template>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Покрытие</td>
                                            <td>
                                                <template v-for="surface in product.surfaces">
                                                    {{ surface.name }}
                                                </template>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-reviews" role="tabpanel">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <h2 class="mb-2">Отзывы</h2>
                            </div>
                            <div class="col-12 col-md-8">
                                Здесь будут отзывы.
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
import { Hooper, Slide } from 'hooper';
import 'hooper/dist/hooper.css';

export default {
    data: function () {
        return {
            product: {},
            price: '',
            ProductColorHooper: {
                itemsToShow: 1,
                transition: 250,
                wheelControl: false,
            },
            modal_bg: false,
            modal_gdekupit: false,
            modal_kakoplatit: false,
            modal_zamer: false,
            modal_zvonok: false,
        };
    },
    created() {
            axios
                .get(`/api/product/${this.$route.params.id}`)
                .then(response => (
                    this.product = response.data,
                    this.price = this.product.base_price
                ));
        },
    methods: {
        chooseColor(index, id, name, price) {
            if (price && parseInt(price) > parseInt(this.product.base_price)) {
                this.price = price
            } else {
                this.price = this.product.base_price
            }

            this.$refs.ProductColorHooper.slideTo(index);
            
            var color_btns = document.querySelectorAll(".product-color-button");
            for (var i = 0; i < color_btns.length; i++) {
                color_btns[i].classList.remove('product-color-button_active')
            }
            document.getElementById('product_color_' + id).classList.add('product-color-button_active')
        },
        chooseSize(index, id, name, price) {
            if (price && parseInt(price) > parseInt(this.product.base_price)) {
                this.price = price
            } else {
                this.price = this.product.base_price
            }
            
            var size_btns = document.querySelectorAll(".product-size-button");
            for (var i = 0; i < size_btns.length; i++) {
                size_btns[i].classList.remove('product-size-button_active')
            }
            document.getElementById('product_size_' + id).classList.add('product-size-button_active')
        },
        slidePrev() {
            this.$refs.ProductColorHooper.slidePrev();
        },
        slideNext() {
            this.$refs.ProductColorHooper.slideNext();
        },
        open_gdekupit_modal() {
            this.modal_gdekupit = true
            this.modal_bg = true
        },
        close_gdekupit_modal() {
            this.modal_gdekupit = false
            this.modal_bg = false
        },
        open_kakoplatit_modal() {
            this.modal_kakoplatit = true
            this.modal_bg = true
        },
        close_kakoplatit_modal() {
            this.modal_kakoplatit = false
            this.modal_bg = false
        },
        open_zamer_modal() {
            this.modal_zamer = true
            this.modal_bg = true
        },
        close_zamer_modal() {
            this.modal_zamer = false
            this.modal_bg = false
        },
        open_zvonok_modal() {
            this.modal_zvonok = true
            this.modal_bg = true
        },
        close_zvonok_modal() {
            this.modal_zvonok = false
            this.modal_bg = false
        },
        selectTab(selected_tab) {
            var tabs_btns = document.querySelectorAll(".table-description .nav-link");
            for (var i = 0; i < tabs_btns.length; i++) {
                tabs_btns[i].classList.remove('active')
            }
            document.getElementById(selected_tab + '_link').classList.add('active')

            var tabs = document.querySelectorAll(".table-description .tab-pane");
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove('active')
                tabs[i].classList.remove('show')
            }
            document.getElementById(selected_tab).classList.add('active')
            document.getElementById(selected_tab).classList.add('show')
        }
    },
    components: {
        Hooper,
        Slide
    },
};
</script>