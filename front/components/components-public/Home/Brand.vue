<template>
    <div :class="brand_bg ? brand_bg : 'brand-area pt-100 pb-100'">
        <div class="container">
            <div class="brand-active">
                <client-only>
                    <swiper :modules="modules" :slides-per-view="1" :loop="true" :space-between="30"
                        :autoplay="{ delay: 3500, disableOnInteraction: false }" :breakpoints="{
                            320: {
                                slidesPerView: 1,
                            },
                            480: {
                                slidesPerView: 2,
                            },
                            550: {
                                slidesPerView: 3,
                            },
                            768: {
                                slidesPerView: 4,
                            },
                            1200: {
                                slidesPerView: 5,
                            }
                        }">
                        <swiper-slide v-for="item in brands" :key="item.id">
                            <div class="brand-wrapper">
                                <img :src="item.image" alt="image not found">
                            </div>
                        </swiper-slide>
                    </swiper>
                </client-only>
            </div>
        </div>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/swiper-bundle.css'


export default {
    name: 'swiper-slider2',
    props:{
        brand_bg: String
    },
    data() {
        return {
            brands: [{
                id: '1',
                image: '/img/brand/brand-1.png',
                url: '#',
            },
            {
                id: '2',
                image: '/img/brand/brand-2.png',
                url: '#',
            },
            {
                id: '3',
                image: '/img/brand/brand-3.png',
                url: '#',
            },
            {
                id: '4',
                image: '/img/brand/brand-4.png',
                url: '#',
            },
            {
                id: '5',
                image: '/img/brand/brand-5.png',
                url: '#',
            },
            {
                id: '6',
                image: '/img/brand/brand-1a.png',
                url: '#',
            }]
        }
    },
    components: {
      Swiper,
      SwiperSlide
   },
}
</script>

<style lang="scss" scoped></style>
