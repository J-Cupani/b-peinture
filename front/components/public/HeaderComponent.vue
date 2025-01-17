<template>
  <MobileMenu :navItems="navItems" />
  <header
    class="rn-header haeder-default black-logo-version header--fixed header--sticky"
  >
    <div
      class="header-wrapper m--0 rn-popup-mobile-menu row align-items-center"
    >
      <div class="col-lg-2 col-6">
        <div class="header-left">
          <div class="logo mt-2 ml-1">
            <nuxt-link to="/">
              <nuxt-img
                class="logo-light"
                src="/assets/images/logo/logo.png"
                style="object-fit: contain"
                :width="139"
                :height="40"
                alt="logo-image"
                format="webp"

              />
            </nuxt-link>
          </div>
        </div>
      </div>
      <!-- End Header Left -->
      <!-- Start Header Center -->
      <div class="col-lg-10 col-6">
        <div class="header-center">
          <nav id="sideNav" class="mainmenu-nav navbar-example2 onepagenav">
            <!-- Start Mainmanu Nav -->
            <ul class="primary-menu nav nav-pills scrollspyLinks">
              <NavComponent :navItems="navItems" />
            </ul>
            <!-- End Mainmanu Nav -->
          </nav>
          <!-- Start Header Right  -->
          <div class="header-right">
            <a class="rn-btn no-shadow" href="#contacts"
              ><span>ME CONTACTER</span></a
            >
            <i
              id="menuBtn"
              class="feather-menu humberger-menu d-block d-lg-none"
              @click="menuOpen"
            ></i>
            <div class="close-menu d-block">
              <span class="closeTrigger">
                <i data-feather="x"></i>
              </span>
            </div>
          </div>
          <!-- End Header Right  -->
        </div>
      </div>
      <!-- End Header Center -->
    </div>
  </header>
</template>

<script setup>
import { menuOpen } from "~/utils/public/menuToggle"
import MobileMenu from "@/components/public/common/MobileMenu.vue"
import NavComponent from '@/components/public/NavComponent.vue'
defineProps(["navItems"])
</script>
