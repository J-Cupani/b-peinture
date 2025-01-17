<template>
    <section class="project-2 pt-115 pb-90 fix">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title-wrapper mb-50 text-center">
                        <h5 class="section-subtitle mb-20">{{ sectionSubTitle }}</h5>
                        <h2 class="section-title">{{ sectionTitle }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6" v-for="item in projectContent" :key="item.title">
                    <div class="kproject kproject-2 mb-30">
                        <img :src="item.image" class="img-fluid" alt="project_img">
                        <div class="kproject-text kproject-text-2">
                            <div class="kproject-text-content">
                                <span>{{ item.category }}</span>
                                <h5 class="kproject-text-title">
                                    <NuxtLink :to="item.titleUrl">{{ item.title }}</NuxtLink>
                                </h5>
                            </div>
                            <div class="kproject-text-icon">
                                <NuxtLink :to="item.projectLinkUrl" class="kproject-text-icon-arrow">
                                    <i class="fas fa-long-arrow-alt-right"></i>
                                </NuxtLink>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'portfolio',
    data() {
        return {
            sectionSubTitle: 'Our recent work',
            sectionTitle: 'More similar work',
            projectContent: [{
                image: '/img/project/project-img-5.jpg',
                category: 'Graphic',
                title: 'Incremental Static',
                titleUrl: '/projectdetails',
                projectLinkUrl: '/projectdetails',
            },
            {
                image: '/img/project/project-img-6.jpg',
                category: 'Design',
                title: 'Developer Decisions',
                titleUrl: '/projectdetails',
                projectLinkUrl: '/projectdetails',
            },
            {
                image: '/img/project/project-img-7.jpg',
                category: 'Development',
                title: 'Fimlor Experience',
                titleUrl: '/projectdetails',
                projectLinkUrl: '/projectdetails',
            }
            ]
        }
    }
}
</script>

<style lang="scss" scoped></style>
