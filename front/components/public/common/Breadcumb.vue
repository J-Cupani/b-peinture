<template>
  <div class="breadcrumb-area rn-section-gap breadcrumb-style-one">
    <div class="plr--85">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-inner">
            <h1 class="title">{{ currentPage }}</h1>
            <ul class="page-list">
              <li><nuxt-link to="/">Home</nuxt-link></li>
              <li class="separator"></li>
              <li class="current-page">{{ currentPage }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps(["currentPage"]);
</script>

<style lang="scss" scoped></style>
