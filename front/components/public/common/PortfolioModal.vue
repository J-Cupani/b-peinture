<template>
  <div
    class="modal fade"
    id="exampleModalCenterportFolio2"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="portfolio-popup-thumbnail">
                <div class="image">
                  <nuxt-img
                    class="w-100"
                    :src="portfolio.image"
                    alt="Portfolio Image"
                  />
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="text-content">
                <h3>
                  <span class="color-blue">{{ portfolio.tagLabel }}</span>
                  {{ portfolio.title }}
                </h3>
                <p class="mb--30">
                 {{ portfolio.description }}
                </p>
<!--                <div class="button-group mt&#45;&#45;20">-->
<!--                  <a href="#" class="rn-btn">-->
<!--                    <span>En savoir plus</span>-->
<!--                    <i data-feather="chevron-right"></i>-->
<!--                  </a>-->
<!--                </div>-->
              </div>
              <!-- End of .text-content -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  portfolio: Object
})
</script>

<style>
.color-blue {
  color: var(--color-primary) !important;
}


</style>
