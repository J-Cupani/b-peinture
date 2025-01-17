<template>
  <div class="rn-footer-area rn-section-gap section-separator mw-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="footer-area text-center">
            <div class="logo">
              <nuxt-link to="/">
                <nuxt-img
                  :width="150"
                  :height="85"
                  class="logo-light"
                  src="/assets/images/logo/logo.png"
                  alt="logo"
                  format="webp"
                />

              </nuxt-link>
            </div>

            <p class="description mt--30">
              © {{ new Date().getFullYear() }}. Tous droits réservés
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup></script>

<style lang="scss" scoped></style>
