<template>
    <div class="container">

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

                <ul>
                    <li v-for="color in product.colors" :key="'product_color_' + color.id">
                        {{ color.name }}
                    </li>
                </ul>
            </div>
        </div>
        
    </div>
</template>

<script>
import { Hooper, Slide } from 'hooper';
import 'hooper/dist/hooper.css';

export default {
    data: function () {
        return {
            product: {},
            indexHooper: {
                itemsToShow: 1,
            },
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
    },
    components: {
        Hooper,
        Slide
    },
};
</script>