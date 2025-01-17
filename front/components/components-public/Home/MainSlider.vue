<template>
  <section class="slider-area fix position-relative">
    <div class="slider-active">
      <client-only>
        <Swiper
          :autoplay="{ delay: 3000, disableOnInteraction: false }"
          :loop="true"
          :modules="[EffectFade, Autoplay]"
          effect="fade"
          :slides-per-view="1"
          :space-between="30"
        >
          <SwiperSlide v-for="item in sliders" :key="item.id">
            <div class="single-slider slider-height">
              <div class="slide-bg" :style="{ backgroundImage: `url(${item.image})` }"></div>
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="kslider z-index">
                      <h5 class="kslider--subtitle mb-25">{{ item.subtitle }}</h5>
                      <h2 class="kslider--title mb-40" v-html="item.title"></h2>
                      <div class="kslider--btn">
                        <NuxtLink :to="item.url" class="theme-btn">{{ item.button }}</NuxtLink>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="slide-shape shape-1"><img :src="item.shape1" class="img-fluid" alt="shape-img" /></div>
              <div class="slide-shape shape-2"><img :src="item.shape2" class="img-fluid" alt="shape-img" /></div>
            </div>
          </SwiperSlide>
        </Swiper>
      </client-only>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Pagination, EffectFade, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';

const sliders = ref([
  {
    id: '1',
    image: '/img/slider/slider-1.jpg',
    subtitle: 'Welcome to digital agency',
    title: 'Web Design <br>Agency',
    button: 'Discover more',
    url: '/about',
    shape1: '/img/slider/slider-shape-1.png',
    shape2: '/img/slider/slider-shape-2.png',
  },
  {
    id: '2',
    image: '/img/slider/slider-2.jpg',
    subtitle: 'Welcome to digital agency',
    title: 'Marketing <br>Agency',
    button: 'Discover more',
    url: '/about',
    shape1: '/img/slider/slider-shape-1.png',
    shape2: '/img/slider/slider-shape-2.png',
  },
  {
    id: '3',
    image: '/img/slider/slider-3.jpg',
    subtitle: 'Welcome to digital agency',
    title: 'App Design <br>Agency',
    button: 'Discover more',
    url: '/about',
    shape1: '/img/slider/slider-shape-1.png',
    shape2: '/img/slider/slider-shape-2.png',
  },
]);
</script>

<style lang="scss" scoped>
</style>