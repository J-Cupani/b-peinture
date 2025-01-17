<template>
    <section class="project-2 pt-115 pb-90 fix">
        <div class="container">
            <div class="aportfolio-menu text-center mb-60">
                <nav>
                    <div class="nav" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                            type="button" role="tab" aria-controls="nav-home" aria-selected="true">All</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Branding</button>
                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                            type="button" role="tab" aria-controls="nav-contact" aria-selected="false">illustration</button>
                        <button class="nav-link" id="nav-photography-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-photography" type="button" role="tab" aria-controls="nav-photography"
                            aria-selected="false">Photography</button>
                        <button class="nav-link" id="nav-web-tab" data-bs-toggle="tab" data-bs-target="#nav-web"
                            type="button" role="tab" aria-controls="nav-web" aria-selected="false">Web Design</button>
                    </div>
                </nav>
            </div>
            <div class="aportfolio-active">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 grid-item" v-for="item in projectContent" :key="item.title">
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
                                            <NuxtLink :to="item.projectLinkUrl"><i class="fas fa-long-arrow-right"></i>
                                            </NuxtLink>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 grid-item" v-for="item in projectContent.slice(2, 7)"
                                :key="item.title">
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
                                            <NuxtLink :to="item.projectLinkUrl"><i class="fas fa-long-arrow-right"></i>
                                            </NuxtLink>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 grid-item" v-for="item in projectContent.slice(3, 8)"
                                :key="item.title">
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
                                            <NuxtLink :to="item.projectLinkUrl"><i class="fas fa-long-arrow-right"></i>
                                            </NuxtLink>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-photography" role="tabpanel" aria-labelledby="nav-photography-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 grid-item" v-for="item in projectContent.slice(4, 6)"
                                :key="item.title">
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
                                            <NuxtLink :to="item.projectLinkUrl"><i class="fas fa-long-arrow-right"></i>
                                            </NuxtLink>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-web" role="tabpanel" aria-labelledby="nav-web-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 grid-item" v-for="item in projectContent.slice(1, 4)"
                                :key="item.title">
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
                                            <NuxtLink :to="item.projectLinkUrl"><i class="fas fa-long-arrow-right"></i>
                                            </NuxtLink>
                                        </div>
                                    </div>
                                </div>
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
            projectContent: [{
                image: '/img/project/project-img-5.jpg',
                category: 'Graphic',
                title: 'Fimlor Experience',
                titleUrl: '/projectdetails',
                projectLinkUrl: '/projectdetails',
            },
            {
                image: '/img/project/project-img-6.jpg',
                category: 'Design',
                title: 'Using SWR React',
                titleUrl: '/projectdetails',
                projectLinkUrl: '/projectdetails',
            },
            {
                image: '/img/project/project-img-7.jpg',
                category: 'Development',
                title: 'Incremental Static',
                titleUrl: '/projectdetails',
                projectLinkUrl: '/projectdetails',
            },
            {
                image: '/img/project/project-img-8.jpg',
                category: 'Networking',
                title: 'Developer Decisions',
                titleUrl: '/projectdetails',
                projectLinkUrl: '/projectdetails',
            },
            {
                image: '/img/project/project-img-9.jpg',
                category: 'Graphic',
                title: 'Process of Taking',
                titleUrl: '/projectdetails',
                projectLinkUrl: '/projectdetails',
            },
            {
                image: '/img/project/project-img-10.jpg',
                category: 'Design',
                title: 'Interactive Learning',
                titleUrl: '/projectdetails',
                projectLinkUrl: '/projectdetails',
            },
            {
                image: '/img/project/project-img-11.jpg',
                category: 'Devolopment',
                title: 'Refactoring CSS',
                titleUrl: '/projectdetails',
                projectLinkUrl: '/projectdetails',
            },
            {
                image: '/img/project/project-img-12.jpg',
                category: 'Networking',
                title: 'Regression Testing',
                titleUrl: '/projectdetails',
                projectLinkUrl: '/projectdetails',
            },
            {
                image: '/img/project/project-img-13.jpg',
                category: 'Graphic',
                title: 'Cumulative Layout',
                titleUrl: '/projectdetails',
                projectLinkUrl: '/projectdetails',
            }
            ]
        }
    }
}
</script>

<style lang="scss" scoped></style>
