<script setup>
const skillsHero = [
  { id: 1, src: "/assets/images/icons/vuejs.png" },
  { id: 2, src: "/assets/images/icons/symf.png" },
  { id: 3, src: "/assets/images/icons/nuxtjs.png" }
]

const socials = [
  { id: 1, icon: "github", link: "https://github.com/J-Cupani", label: 'Accéder à Github' },
  { id: 2, icon: "twitter", link: "https://x.com/C4dev_fr", label: 'Accéder à Twitter' },
  { id: 3, icon: "linkedin", link: "https://www.linkedin.com/in/joachim-cupani", label: 'Accéder à Linkedin' }
]
</script>

<template>
  <div id="accueil" class="rn-slider-area scrollSpysection">
    <div class="slide slider-style-1 with-square-box">
      <div class="container">
        <div class="row row--30 align-items-center">
          <div
            class="order-2 order-lg-1 col-lg-7 mt_md--50 mt_sm--50 mt_lg--30"
          >
            <div class="content">
              <div class="inner">
                <span class="subtitle">Bienvenue dans mon monde</span>
                <h1 class="title">
                    <span>Joachim Cupani</span><br /><span class="span">
                    Développeur Fullstack</span>
                </h1>
                <div>
                  <p class="description">Développeur freelance, j’aime
                    créer des sites et applications simples à utiliser. Mon objectif
                    est de rendre chaque interaction fluide et naturelle, en trouvant
                    des solutions adaptées à vos besoins. Mon approche est toujours de
                    rester proche de l’essentiel pour offrir une expérience agréable et
                    intuitive.
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 col-12">
                  <div class="social-share-inner-left">
                    <span class="title">Retrouvez moi sur</span>
                    <ul class="social-share d-flex liststyle">
                      <li
                        v-for="(elm, i) in socials.slice(0, 3)"
                        :key="i"
                        class=""
                      >
                        <a :href="elm.link" :aria-label="elm.label" class="accessible-link" rel="noopener noreferrer">
                          <i :data-feather="elm.icon" aria-hidden="true"></i>
                          <span class="sr-only">{{ elm.label }}</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>

                <div
                  class="col-lg-6 col-xl-6 col-md-6 col-sm-6 col-12 mt_mobile--30"
                >
                  <div class="skill-share-inner">
                    <span class="title">Mon univers tech</span>
                    <ul class="skill-share d-flex liststyle">
                      <li v-for="(elm, i) in skillsHero" :key="i">
                        <nuxt-img :src="elm.src" alt="Icons Images" />
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="order-1 order-lg-2 col-lg-5 position-relative">
            <div class="thumbnail style-2">
              <div class="inner">
                <nuxt-img
                  :width="520"
                  :height="597"
                  class="w-100"
                  src="/assets/images/profilPicture.webp"
                  alt="Image personnelle"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border: 0;
}
</style>
