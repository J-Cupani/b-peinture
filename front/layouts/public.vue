<template>
  <slot></slot>
</template>

<script setup>
import AOS from 'aos'
import 'aos/dist/aos.css'

useHead({
  script: [
    {
      src: 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js',
      crossorigin: "anonymous",
    },
    {
      src: 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js',
      integrity: "sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa",
      crossorigin: "anonymous",
    }
  ],
  link: [
    {
      rel: "stylesheet",
      href: "https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css",
    },
  ],
})

onMounted(() => {
  // Initialisation de WOW.js
  if (process.client && window.WOW) {
    const wow = new window.WOW({
      boxClass: 'wow', // Class name for the elements to animate
      animateClass: 'animated', // Class name for animations
      offset: 0, // Offset to trigger animations
      mobile: true, // Enable animations on mobile devices
      live: true, // Watch for new elements added to the DOM
    })
    wow.init()
  } else {
    console.error('WOW.js could not be initialized. Make sure the script is loaded correctly.')
  }

  // Initialisation de AOS
  AOS.init({
    duration: 1000, // Durée de l'animation en millisecondes
    easing: 'ease', // Type d'animation
    offset: 100, // Décalage avant le déclenchement de l'animation
    once: true, // Si true, l'animation ne se déclenchera qu'une seule fois
  })
})
</script>