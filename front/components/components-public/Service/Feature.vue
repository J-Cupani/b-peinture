<template>
    <section class="service-2 pt-120 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-sm-6" v-for="item in service" :key="item.title">
                    <div class="kservice-2 mb-30 wow fadeInUp" data-wow-duration=".3s">
                        <NuxtLink :to="item.titleurl">
                            <div class="kservice-text-2">
                                <span>{{ item.category }}</span>
                                <h4 class="kservice-title-2a" v-html="item.title"></h4>
                                <div>
                                    <img :src="item.icon" class="img-fluid" alt="service-img">
                                </div>
                            </div>
                        </NuxtLink>
                        <div class="kservice-img-2">
                            <img :src="item.image" class="img-fluid" alt="service-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'Service',
    data() {
        return {
            service: [{
                category: 'Services',
                title: 'Website <br>Development',
                titleurl: '/servicedetails',
                image: '/img/service/service-img-1.jpg',
                iconclass: 'flaticon-stats',
                icon: '/img/icon/service-icon-1.png',
            },
            {
                category: 'Services',
                title: 'Graphic <br>designing',
                titleurl: '/servicedetails',
                image: '/img/service/service-img-2.jpg',
                iconclass: 'flaticon-digital-marketing',
                icon: '/img/icon/service-icon-2.png',
            },
            {
                category: 'Services',
                title: 'SEO & Content <br>writting',
                titleurl: '/servicedetails',
                image: '/img/service/service-img-3.jpg',
                iconclass: 'flaticon-website',
                icon: '/img/icon/service-icon-3.png',
            },
            {
                category: 'Services',
                title: 'digital <br>marketing',
                titleurl: '/servicedetails',
                image: '/img/service/service-img-4.jpg',
                iconclass: 'flaticon-idea',
                icon: '/img/icon/service-icon-4.png',
            }
            ]
        }
    }
}
</script>

<style scoped></style>
