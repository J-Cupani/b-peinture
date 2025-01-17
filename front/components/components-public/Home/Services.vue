<template>
  <section class="service-area pt-120 pb-130" :style="{ backgroundColor: '#252629' }">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-xl-5 col-lg-6">
          <div class="kservice-text mb-50" data-aos="fade-right" data-aos-duration="1000">
            <h5 class="kservice-text-subtitle mb-15">{{ subtitle }}</h5>
            <h2 class="kservice-text-title mb-40" v-html="title"></h2>
            <p class="mb-45">{{ description }}</p>
            <div class="kservice-author">
              <div class="kservice-author-img mr-30">
                <img src="/img/service/service-author.png" class="img-fluid" alt="author-img" />
              </div>
              <div class="kservice-author-sign">
                <span>{{ authorName }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6">
          <div class="row custom-mar-20" data-aos="fade-down" data-aos-duration="1000">
            <div class="col-sm-6 custom-pad-20" v-for="item in serviceBox" :key="item.title">
              <div class="kservice text-center mb-20">
                <div class="kservice-icon">
                  <i :class="item.f_icon"></i>
                </div>
                <div class="kservice-content">
                  <h5 class="kservice-content-title">
                    <NuxtLink :to="item.url">
                      <span v-html="item.serviceBoxTitle"></span>
                    </NuxtLink>
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const subtitle = ref('All Categories List');
const title = ref('The Services <br>We’re Offering');
const description = ref(
  'There are many variations of passages of lorem ipsum available but the majority have suffered alteration in some form by injected humour.'
);
const authorName = ref('Jessica Brown');

const serviceBox = ref([
  {
    serviceBoxTitle: 'Website <br>Development',
    url: '/servicedetails',
    f_icon: 'flaticon-stats',
  },
  {
    serviceBoxTitle: 'Graphic <br>Designing',
    url: '/servicedetails',
    f_icon: 'flaticon-digital-marketing',
  },
  {
    serviceBoxTitle: 'SEO & Content <br>writting',
    url: '/servicedetails',
    f_icon: 'flaticon-website',
  },
  {
    serviceBoxTitle: 'Digital <br>marketing',
    url: '/servicedetails',
    f_icon: 'flaticon-idea',
  },
]);
</script>

<style lang="scss" scoped></style>