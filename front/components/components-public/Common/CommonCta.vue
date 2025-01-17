<template>
  <section class="cta-area mt--60 z-index" data-aos="fade-up">
    <div class="container">
      <div class="cta-bg bg-theme">
        <div class="cta-number">
          <div class="cta-number-icon mr-30">
            <img src="/img/icon/cta-icon.png" class="img-fluid z-index" alt="about-img" />
          </div>
          <div class="cta-number-text fix">
            <span class="uppercase">{{ subtitle }}</span>
            <h3><a href="tel:6668880000">{{ numberText }}</a></h3>
          </div>
        </div>
        <div class="cta-description">
          <p>{{ description }}</p>
        </div>
        <div class="cta-btn">
          <NuxtLink :to="ctaLinkUrl" class="theme-btn black-btn">{{ ctaLinkText }}</NuxtLink>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'

const subtitle = ref('Get a Free Consultation')
const numberText = ref('666 888 0000')
const description = ref('Stay up-to-date with the latest technological advancements.')
const ctaLinkText = ref('Discover more')
const ctaLinkUrl = ref('/service')
</script>

<style lang="scss" scoped></style>