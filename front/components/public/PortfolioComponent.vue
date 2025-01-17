<template>
  <div
    id="portfolio"
    class="rn-portfolio-area portfolio-style-three rn-section-gap section-separator scrollSpysection"
  >
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div
            data-aos="fade-up"
            data-aos-duration="500"
            data-aos-delay="100"
            data-aos-once="true"
            class="section-title text-center"
          >
            <span class="subtitle">Visitez mon portfolio</span>
            <h2 class="title">Mon Portfolio</h2>
          </div>
        </div>
        <div class="row">
          <!-- Start Single Portfolio -->
           <div v-if="pending">Chargement des projets...</div>

          <div
            v-else
            v-for="(elm, i) in portfolios"
            :key="i"
            data-aos="fade-up"
            data-aos-delay="100"
            data-aos-once="true"
            class="col-md-6 col-12 mt--80 mt_md--30 mt_sm--30 justify-content-end"
            :class="portfolios.length > 2 ? 'col-lg-4' : 'col-md-6'"
          >
            <div
              class="rn-portfolio justify-content-end"
              data-bs-toggle="modal"
              data-bs-target="#exampleModalCenterportFolio2"
              @click="setPortfolioModal(elm)"
            >
              <div class="inner">
                <div class="thumbnail">
                    <nuxt-img
                      :width="800"
                      :height="600"
                      :src="elm.image"
                      alt="Personal Portfolio Images"
                    />
                </div>
                <div class="content">
                  <div class="category-info">
                    <div class="category-list">
                      <span class="category">{{ elm.tagLabel }}</span>
                    </div>

                  </div>
                  <p class="title">
                    <span class="title-span">{{ elm.title }}
                      <i class="feather-arrow-up-right" />
                    </span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <!-- End Single Portfolio -->
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <PortfolioModal v-if="currentPortfolioModal" :portfolio="currentPortfolioModal"/>
</template>

<script setup>
import PortfolioModal from "@/components/public/common/PortfolioModal.vue" // Assurez-vous que le chemin est correct
// <template>
// <div>
// <div v-if="pending">Chargement des projets...</div>
// <div v-else-if="error">
//   <p>Erreur lors du chargement des projets :</p>
//   <pre>{{ error }}</pre>
// </div>
// <div v-else>
//   <div v-for="project in projects" :key="project.id" class="project-item">
//   <h3>{{ project.title }}</h3>
//   <p>{{ project.description }}</p>
// </div>
// </div>
// </div>
// </template>

const { data, pending } = useFetch('/api/public/get-projects', {
  method: 'GET',
  server: true, // Active le SSR pour récupérer les données côté serveur
})
const portfolios = ref([])
const currentPortfolioModal = ref(null)

onMounted(() => {
  portfolios.value = data.value
  currentPortfolioModal.value = data.value[0] || null // Définit le premier projet comme modal
})

// Méthode pour définir la modal
const setPortfolioModal = (portfolio) => {
  currentPortfolioModal.value = portfolio
}
</script>

<style lang="scss">

.category-list {
  .category {
    color: var(--color-primary);
    font-weight: 500;
    font-family: var(--font-primary);
    font-size: 12px;
    letter-spacing: 1px;
    text-transform: uppercase;
    display: block;
  }
}

.title {
  margin: 0;

  .title-span {
    transition: var(--transition);
    color: var(--color-lightn);
    font-weight: 600;
    font-size: 23px;
    line-height: 34px;
    display: inline-block;

    @media (max-width: 479px) {
      font-size: 20px;
      line-height: 30px;
    }
  }

  .title-span:hover {
    color: var(--color-primary);
  }

  .title-span i {
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
  }

  .title-span:hover i {
    opacity: 1;
  }
}
</style>