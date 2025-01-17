<template>
  <section class="project-area bg-grey pt-115 pb-150 fix">
    <div class="common-shape-wrapper wow slideInRight animated">
      <div class="common-shape-inner"></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="section-title-wrapper mb-45">
            <h5 class="section-subtitle mb-20">{{ sectionSubTitle }}</h5>
            <h2 class="section-title">{{ sectionTitle }}</h2>
          </div>
        </div>
        <div class="col-md-4">
          <div class="lol text-md-end">
            <div class="project-button-prev slide-prev">
              <i class="fas fa-long-arrow-alt-left"></i>
            </div>
            <div class="project-button-next slide-next">
              <i class="fas fa-long-arrow-alt-right"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="project-active">
      <client-only>
        <Swiper
          :autoplay="{ delay: 3000, disableOnInteraction: false }"
          :loop="true"
          :modules="[Autoplay, Navigation]"
          :navigation="{
            nextEl: '.project-button-next',
            prevEl: '.project-button-prev',
          }"
          :breakpoints="breakpoints"
          :slides-per-view="1"
          :space-between="30"
        >
          <SwiperSlide v-for="item in projectContent" :key="item.id">
            <div class="kproject swiper-slide">
              <img :src="item.image" class="img-fluid" alt="project_img" />
              <div class="kproject-text">
                <div class="kproject-text-content">
                  <span>{{ item.category }}</span>
                  <h5 class="kproject-text-title">
                    <NuxtLink :to="item.titleUrl">{{ item.title }}</NuxtLink>
                  </h5>
                </div>
                <div class="kproject-text-icon">
                  <NuxtLink :to="item.projectLinkUrl" class="kproject-text-icon-arrow">
                    <i class="fas fa-long-arrow-alt-right"></i>
                  </NuxtLink>
                </div>
              </div>
            </div>
          </SwiperSlide>
        </Swiper>
      </client-only>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Autoplay, Navigation } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/navigation'

const sectionSubTitle = ref('Our recent work')
const sectionTitle = ref('Work showcase')
const projectContent = ref([
  {
    id: '1',
    image: '/img/project/project-img-1.jpg',
    category: 'Graphic',
    title: 'Fimlor Experience',
    titleUrl: '/projectdetails',
    projectLinkUrl: '/projectdetails',
  },
  {
    id: '2',
    image: '/img/project/project-img-2.jpg',
    category: 'Web Design',
    title: 'Using SWR React',
    titleUrl: '/projectdetails',
    projectLinkUrl: '/projectdetails',
  },
  {
    id: '3',
    image: '/img/project/project-img-3.jpg',
    category: 'Web Development',
    title: 'Incremental Static',
    titleUrl: '/projectdetails',
    projectLinkUrl: '/projectdetails',
  },
  {
    id: '4',
    image: '/img/project/project-img-4.jpg',
    category: 'Networking',
    title: 'Developer Decisions',
    titleUrl: '/projectdetails',
    projectLinkUrl: '/projectdetails',
  },
  {
    id: '5',
    image: '/img/project/project-img-1.jpg',
    category: 'Web Design',
    title: 'Process of Taking',
    titleUrl: '/projectdetails',
    projectLinkUrl: '/projectdetails',
  },
  {
    id: '6',
    image: '/img/project/project-img-2.jpg',
    category: 'Graphic',
    title: 'Interactive Learning',
    titleUrl: '/projectdetails',
    projectLinkUrl: '/projectdetails',
  },
  {
    id: '7',
    image: '/img/project/project-img-3.jpg',
    category: 'Web Development',
    title: 'Refactoring CSS',
    titleUrl: '/projectdetails',
    projectLinkUrl: '/projectdetails',
  },
])

const breakpoints = ref({
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
})
</script>

<style lang="scss" scoped></style>