<!-- layouts/public.vue -->
<template>
  <slot></slot>
</template>

<script setup>
import feather from "feather-icons"
import AOS from "aos"

onMounted(() => {

  window.addEventListener("scroll", function () {
    var header = document.querySelector(".header--sticky")
    if (window.scrollY > 250) {
      header?.classList.add("sticky")
    } else {
      header?.classList.remove("sticky")
    }
  });
  AOS.init()

  feather?.replace()
})

watch(() => useRoute().path, () => {
    feather?.replace()
  }
)

useHead({
  link: [
    // {
    //   rel: 'stylesheet',
    //   href: '/assets/css/vendor/bootstrap.min.css',
    //   media: 'all', // Charger immédiatement pour éviter le blocage de rendu
    // },
    // {
    //   rel: 'stylesheet',
    //   href: '/assets/css/slick.min.css',
    //   media: 'print', // Charger en différé
    //   onload: "this.media='all'",
    // },
    // {
    //   rel: 'stylesheet',
    //   href: '/assets/css/slick-theme.min.css',
    //   media: 'print',
    //   onload: "this.media='all'",
    // },
    // {
    //   rel: 'stylesheet',
    //   href: '/assets/css/vendor/aos.css',
    //   media: 'print',
    //   onload: "this.media='all'",
    // },
    // {
    //   rel: 'stylesheet',
    //   href: '/assets/css/plugins/feature.css',
    //   media: 'print',
    //   onload: "this.media='all'",
    // },
  ],
  script: [
    {
      src: 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
      type: 'text/javascript',
      defer: true, // Différer le JS pour ne pas bloquer le rendu
    }
  ]
})
</script>

<style>
@import "@assets-public/css/vendor/bootstrap.min.css";
@import "@assets-public/css/vendor/slick.css";
@import "@assets-public/css/vendor/slick-theme.css";
@import "@assets-public/css/vendor/aos.css";
@import "@assets-public/css/plugins/feature.css";
@import "swiper/css";
@import "swiper/css/effect-fade";
@import "@assets-public/scss/style.scss";
</style>