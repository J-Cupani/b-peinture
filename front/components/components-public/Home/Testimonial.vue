<template>
  <section :class="testSpace ? testSpace : 'testimonial-area pt-115 pb-85'">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title-wrapper text-center mb-45">
            <h5 class="section-subtitle mb-20">{{ sectionSubTitle }}</h5>
            <h2 class="section-title mb-35">{{ sectionTitle }}</h2>
          </div>
        </div>
      </div>

      <div class="testimonial-active">
        <client-only>
          <Swiper
            :modules="[Autoplay]"
            :slides-per-view="1"
            :loop="true"
            :space-between="30"
            :autoplay="{ delay: 3000, disableOnInteraction: false }"
            :breakpoints="breakpoints"
          >
            <SwiperSlide v-for="item in testimonialContent" :key="item.id">
              <div class="ktestimonial mb-30">
                <div class="ktestimonial-text">
                  <p>{{ item.description }}</p>
                </div>
                <div class="ktestimonial-author">
                  <div class="ktestimonial-author-img">
                    <img :src="item.image" class="img-fluid" alt="client_img" />
                  </div>
                  <div class="ktestimonial-author-text">
                    <h5 class="uppercase">{{ item.clientName }}</h5>
                    <span class="uppercase">{{ item.clientStatus }}</span>
                  </div>
                </div>
              </div>
            </SwiperSlide>
          </Swiper>
        </client-only>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Autoplay } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/autoplay'

// Props
defineProps({
  testSpace: String,
})

// Section data
const sectionSubTitle = ref('client testimonials')
const sectionTitle = ref('What they say?')
const testimonialContent = ref([
  {
    id: '1',
    image: '/img/testimonial/testimonial-img-1.jpg',
    description:
      'I was very impressed by the kimox service lorem ipsum is simply free text used by copy typing refreshing. Neque porro est qui dolorem ipsum.',
    clientName: 'Jessica Brown',
    clientStatus: 'Customer',
  },
  {
    id: '2',
    image: '/img/testimonial/testimonial-img-2.jpg',
    description:
      'Reliable accessible UI components: :focus styles, content sliders, dark mode, date pickers, navigation, modals, radio buttons Neque porro est qui.',
    clientName: 'Mike Hardson',
    clientStatus: 'Customer',
  },
  {
    id: '3',
    image: '/img/testimonial/testimonial-img-3.jpg',
    description:
      'Useful CSS tools for animations, border-radius, CSS shadows, cubic-bezier curves, easing gradients, filters, placeholders, CSS Grid.',
    clientName: 'Sarah Albert',
    clientStatus: 'Customer',
  },
  {
    id: '4',
    image: '/img/testimonial/testimonial-img-4.jpg',
    description:
      'I was very impressed by the kimox service lorem ipsum is simply free text used by copy typing refreshing. Neque porro est qui dolorem ipsum.',
    clientName: 'Melinda Brown',
    clientStatus: 'Customer',
  },
  {
    id: '5',
    image: '/img/testimonial/testimonial-img-5.jpg',
    description:
      'Core Web Vitals, CrUX, Lighthouse, performance budgets, CSS & JavaScript performance, assets optimizations, build optimizations.',
    clientName: 'Andrew Tye',
    clientStatus: 'Customer',
  },
])

// Breakpoints for Swiper
const breakpoints = computed(() => ({
  320: {
    slidesPerView: 1,
  },
  480: {
    slidesPerView: 1,
  },
  768: {
    slidesPerView: 2,
  },
  992: {
    slidesPerView: 2,
  },
  1200: {
    slidesPerView: 3,
  },
}))
</script>

<style lang="scss" scoped></style>