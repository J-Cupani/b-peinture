<template>
  <li v-for="(elm, i) in navItems" :key="i" class="nav-item">
    <a :class="`nav-link ${i == 0 ? 'current' : ''}`" :href="elm.href">{{
      elm.title
    }}</a>
  </li>
</template>

<script setup>
import addScrollspy from "~/utils/public/addScrollSpy"
import addSmoothScroll from "~/utils/public/addSmoothScroll"

defineProps(["navItems"])

function initScrollspy() {
  addScrollspy()
}

onMounted(() => {
  addSmoothScroll()
  window.addEventListener("scroll", initScrollspy);
})

onUnmounted(() => {
  window.removeEventListener("scroll", initScrollspy);
})
</script>