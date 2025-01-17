<template>
  <div
    class="rn-resume-area rn-section-gap section-separator scrollSpysection mw-100"
    id="a-propos"
  >
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title text-center">
            <span class="subtitle">Parcours Professionnel</span>
            <h2 class="title">À propos de moi</h2>
          </div>
        </div>
      </div>
      <div class="row mt--45">
        <div class="col-lg-12">
          <div class="d-flex justify-content-center">
            <ul class="rn-nav-list nav nav-tabs" id="myTabs" role="tablist">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  id="professional-tab"
                  data-bs-toggle="tab"
                  href="#professional"
                  role="tab"
                  aria-controls="professional"
                  aria-selected="true"
                >
                  Compétences professionnelles
                </a>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  id="education-tab"
                  data-bs-toggle="tab"
                  href="#education"
                  role="tab"
                  aria-controls="education"
                  aria-selected="false"
                >
                  Parcours Professionnel
                </a>
              </li>
            </ul>
          </div>

          <!-- Start Tab Content Wrapper  -->
          <div class="rn-nav-content tab-content" id="myTabContents">
            <!-- Start Single Tab  -->
            <div
              class="tab-pane fade show active"
              id="professional"
              role="tabpanel"
              aria-labelledby="professional-tab"
            >
              <div class="personal-experience-inner mt--10">
                <div class="row row--40">
                  <div>
                    <ul class="skill-style-1">
                      <li
                        v-for="(elm, i) in skills"
                        :key="i"
                        data-aos="fade-up"
                        data-aos-duration="500"
                        data-aos-delay="100"
                        data-aos-once="true"
                        :title="elm.title"
                      >
                        <nuxt-img :src="elm.src" alt="skill"/>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Single Tab  -->

            <!-- Start Single Tab  -->
            <div
              class="tab-pane fade single-tab-area"
              id="education"
              role="tabpanel"
              aria-labelledby="education-tab"
            >
              <div class="personal-experience-inner mt--50">
                <div class="row justify-content-center">
                  <!-- Start Skill List Area  -->
                <div class="col-lg-9 col-md-9 col-12 justify-content-center flex">
                    <div class="content">
                      <span class="subtitle">2019 - 2024</span>
                      <h4 class="maintitle">Parcours Professionnel</h4>
                      <div class="experience-list">
                        <!-- Start Single List  -->
                        <div
                          v-for="(elm, i) in education2"
                          :key="i"
                          class="resume-single-list"
                        >
                          <div class="inner">
                            <div class="heading">
                              <div class="title">
                                <h4>{{ elm.title }}</h4>
                                <span>{{ elm.institution }}</span>
                              </div>
                              <div class="date-of-time">
                                <span>{{ elm.rating }}</span>
                              </div>
                            </div>
                            <p class="description">
                              {{ elm.description }}
                            </p>
                          </div>
                        </div>
                        <!-- End Single List  -->

                        <!-- End Single List  -->
                      </div>
                    </div>
                  </div>
                  <!-- End Skill List Area  -->
                </div>
              </div>
            </div>
            <!-- End Single Tab  -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const skills = [
  { id: 1, title: "Symfony", src: "/assets/images/icons/symfony-w.png" },
  { id: 2, title: "VueJS", src: "/assets/images/icons/vuejs.png" },
  { id: 3, title: "NuxtJS", src: "/assets/images/icons/nuxtjs.png" },
  { id: 4, title: "PHP", src: "/assets/images/icons/php.png" },
  { id: 5, title: "Lua", src: "/assets/images/icons/lua.png" },
  { id: 6, title: "HTML5", src: "/assets/images/icons/js.png" },
  { id: 7, title: "CSS3", src: "/assets/images/icons/html.png" },
  { id: 8, title: "PS", src: "/assets/images/icons/css.png" },
  { id: 9, title: "PS", src: "/assets/images/icons/ps.png" },
  { id: 10, title: "git", src: "/assets/images/icons/git.png" },
]

const education2 = [
  {
    id: 1,
    title: "Développeur Freelance",
    institution: "Auto-Entrepreneur",
    rating: "2024",
    description:
      "Création de projets web sur mesure pour divers clients, incluant le développement front-end et back-end, avec une expertise en Symfony, VueJS, NuxtJS."
  },
  {
    id: 2,
    title: "Développeur Web",
    institution: "Eolas - Orange Business Services",
    rating: "2021-2024",
    description:
      "Conception et mise en œuvre de modules backend en PHP orienté objet et Javascript sur le CMS Eolas. Maintenance des sites existants et corrections de bugs. Utilisation de Gitlab et Docker, avec une approche de travail basée sur les méthodes Agiles."
  },
  {
    id: 3,
    title: "Alternant Développeur Web",
    institution: "Eolas - Business & Décision",
    rating: "2020-2021",
    description:
      "Réalisation d’une plateforme SaaS de démocratie participative dans le cadre de mon alternance chez Eolas - Business & Décision (2020-2021), création de module backend en PHP et javascript, corrections de bugs."
  },
  {
    id: 4,
    title: "RNCP Niveau 5 - Technicien Développeur (Bac+2)",
    institution: "Campus Numérique in the Alps",
    rating: "2019-2021",
    description:
      "Formation diplômante de 18 mois en développement web, combinant 800 heures de formation intensive et 12 mois d’alternance. Acquisition de compétences solides en programmation web et en méthodes de travail collaboratives."
  },
]
</script>

<style scoped>
.nav-item {
  @media only screen and (min-width: 768px) and (max-width: 991px) {
    flex-basis: 50%;
  }
}
</style>
