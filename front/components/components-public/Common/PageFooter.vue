<template>
  <footer :style="{ backgroundColor: '#252629' }" class="pt-95 position-relative">
    <div class="common-shape-wrapper wow slideInRight animated" data-wow-delay="0ms" data-wow-duration="1500ms">
      <div class="common-shape-inner wow slideInRight animated" data-wow-delay="0ms" data-wow-duration="1500ms"></div>
    </div>
    <div class="footer-area pb-60">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="widget mb-30">
              <div class="footer-logo mb-25">
                <NuxtLink to="/"><img src="/img/logo/logo-white.png" class="img-fluid" alt="footer-logo">
                </NuxtLink>
              </div>
              <p class="mb-20 pr-35">There are many vari of pass of lorem ipsum availab but the majority have
                suffered in some form by injected humour or words.</p>
              <div class="footer-social">
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="#" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-sm-6">
            <div class="widget mb-30">
              <h4 class="widget-title mb-35">Links</h4>
              <ul>
                <li>
                  <NuxtLink to="/service">Our Services</NuxtLink>
                </li>
                <li>
                  <NuxtLink to="/about">Meet Our Team</NuxtLink>
                </li>
                <li>
                  <NuxtLink to="/project">Our Portfolio</NuxtLink>
                </li>
                <li>
                  <NuxtLink to="/contact">Contact</NuxtLink>
                </li>
                <li>
                  <NuxtLink to="/contact">Help</NuxtLink>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="widget widget-contact mb-30">
              <h4 class="widget-title mb-35">Contact</h4>
              <ul>
                <li class="pb-10">86 Road Broklyn Street, 600 <br>New York, USA</li>
                <li><img src="/img/icon/footer-icon-1.png" class="img-fluid" alt="icon-img"><a
                  href="mailto:needhelp@company.com">needhelp@company.com</a></li>
                <li><img src="/img/icon/footer-icon-2.png" class="img-fluid" alt="icon-img"><a
                  href="tel:926668880000">92 666 888 0000</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="widget mb-30">
              <h4 class="widget-title mb-30">Newsletter</h4>
              <p class="mb-20">Subscribe to Our Newsletter for Daily News and Updates</p>
              <div class="widget-newsletter">
                <form action="#">
                  <input type="email" placeholder="Email Address">
                  <button type="submit">Send</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright-area">
      <div class="container">
        <div class="copyright-bg">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="copyright">
                <span>Copyright ©{{ currentYear }}
                  <a
                    :href="urlC4dev"
                    target="_blank"
                    rel="noopener noreferrer">C4Dev
                  </a>
               . All Rights Reserved</span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="privacy-text text-center text-md-end">
                <ul>
                  <li>
                    <NuxtLink to="/contact">Terms & Condition</NuxtLink>
                    <NuxtLink to="/contact">Privacy Policy</NuxtLink>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
const currentYear = ref(new Date().getFullYear())
const urlC4dev = ref('https://c4dev.fr')
</script>

<style lang="scss" scoped>
@import "@/assets/assets-public/scss/variables.scss"; /* Chemin vers votre fichier SCSS contenant $theme-color */

.copyright a {
  text-decoration: none; /* Facultatif : contrôle du style du lien */
  color: $theme-color;
}
</style>











