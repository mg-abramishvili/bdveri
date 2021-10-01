<template>
    <div class="container product-item-page">

        <div class="row">
            <div class="col-12 col-md-3">
                <div class="ProductColorHooper_wrapper">
                    <button @click.prevent="slidePrev" class="hooper_nav_button hooper_nav_button_prev"></button>
                    <button @click.prevent="slideNext" class="hooper_nav_button hooper_nav_button_next"></button>

                    <hooper ref="ProductColorHooper" :settings="ProductColorHooper">
                        <slide v-for="color in product.colors" :key="'product_color_' + color.id" class="product-colors-slide" v-bind:style="{ 'background-image': 'url(' + color.image + ')' }"></slide>
                    </hooper>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <h1>{{ product.name }}</h1>

                <div class="row product-info-buttons">
                    <div class="col-6 col-md-3">
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
                    </div>
                    <div class="col-6 col-md-3">
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
                    </div>
                    <div class="col-6 col-md-3">
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
                    </div>
                    <div class="col-6 col-md-3">
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

                <ul>
                    <li v-for="color in product.colors" :key="'product_color_' + color.id">
                        {{ color.name }}
                    </li>
                </ul>

                <div class="price my-4">
                    <del style="font-weight: normal;">{{ product.old_price }} ₽</del>
                    {{ product.base_price }} ₽
                </div>

                <button class="btn-standard">В корзину</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                {{ product.description }}
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
            ProductColorHooper: {
                itemsToShow: 1,
            },

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
                    this.product = response.data
                ));
        },
    methods: {
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
    },
    components: {
        Hooper,
        Slide
    },
};
</script>