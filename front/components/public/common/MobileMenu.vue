<template>
  <div class="popup-mobile-menu">
    <div class="inner mobileMenuInner">
      <div class="menu-top">
        <div class="menu-header">
          <nuxt-link class="logo" to="/">
            <nuxt-img
              :width="120"
              :height="120"
              src="assets/images/logo/logo.png"
              alt="Personal Portfolio"
            />
          </nuxt-link>
          <div class="close-button">
            <button
              @click="closeMobileMenu"
              class="close-menu-activation close"
            >
              <i data-feather="x"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="content">
        <ul class="primary-menu">
          <li><a class="nav-link" href="#accueil">Accueil</a></li>
          <li><a class="nav-link" href="#services">Mes Services</a></li>
          <li><a class="nav-link" href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link" href="#a-propos">Resume</a></li>
          <li><a class="nav-link" href="#contacts">Contact</a></li>
        </ul>
        <!-- social sharea area -->
        <div class="social-share-style-1 mt--40">
          <span class="title">Retrouvez moi sur</span>
          <ul class="social-share d-flex liststyle">
            <li class="github">
              <a href="https://github.com/J-Cupani"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="feather feather-github"
                >
                  <path
                    d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"
                  ></path></svg
              ></a>
            </li>
            <li class="twitter">
              <a href="https://x.com/C4dev_fr">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="feather feather-twitter"
                >
                  <path
                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53A4.48 4.48 0 0 0 16.29 2c-2.43 0-4.39 2.17-3.82 4.5A13.07 13.07 0 0 1 3 4.19a4.48 4.48 0 0 0 1.38 6A4.52 4.52 0 0 1 2 9.72v.05A4.48 4.48 0 0 0 4.47 15a4.52 4.52 0 0 1-2 .08 4.48 4.48 0 0 0 4.19 3.12A9 9 0 0 1 2 19.88 12.94 12.94 0 0 0 8 21c7.88 0 12.19-6.54 12-12.41a8.5 8.5 0 0 0 2-2.09z"
                  ></path>
                </svg>
              </a>
            </li>
            <li class="linkedin">
              <a href="https://www.linkedin.com/in/joachim-cupani"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="feather feather-linkedin"
                >
                  <path
                    d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"
                  ></path>
                  <rect x="2" y="9" width="4" height="12"></rect>
                  <circle cx="4" cy="4" r="2"></circle></svg
              ></a>
            </li>
          </ul>
        </div>
        <!-- end -->
      </div>
    </div>
  </div>
</template>

<script setup>
import addScrollspy from "~/utils/public/addScrollSpy"
import addSmoothScroll from "~/utils/public/addSmoothScroll"
import { closeMobileMenu } from "~/utils/public/menuToggle"

defineProps(["navItems"])

function ititScrollspy() {
  addScrollspy("nav-link smoth-animation", ".scrollspyLinks2", "active")
}

onMounted(() => {
  addSmoothScroll(".scrollspyLinks2")
  window.addEventListener("scroll", ititScrollspy)

  // Get the popup mobile menu element
  document.querySelector(".popup-mobile-menu")

  // Add click event listener to the document
  document.addEventListener("click", function (event) {
    // Check if the clicked element is inside the popup menu
    if (event.target.closest(".popup-mobile-menu")) {
      // Click is inside the popup menu
      // Check if the clicked element is not an inner element that should be excluded
      if (!event.target.closest(".mobileMenuInner")) {
        closeMobileMenu(event)
        // Code to handle clicks inside the popup menu but not on inner elements
      }
    } else {
      // Click is outside the popup menu
      // Code to handle clicks outside the popup menu
    }
  })
})

onUnmounted(() => {
  window.removeEventListener("scroll", ititScrollspy)
})
</script>
