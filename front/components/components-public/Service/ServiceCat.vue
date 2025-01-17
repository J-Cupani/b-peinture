<template>
    <section class="service-area service-area2 pt-115 pb-100"
        :style="{ backgroundImage: `url(/img/service/service-bg.jpg)` }">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xxl-6 col-lg-6">
                    <div class="kservice-text mb-50 aos-init aos-animate" data-aos="fade-right" data-aos-duration="1000">
                        <h5 class="kservice-text-subtitle mb-15">All Categories List</h5>
                        <h2 class="kservice-text-title mb-40">The Services <br>We’re Offering</h2>
                    </div>
                </div>
                <div class="col-xxl-5 col-lg-6">
                    <div class="kservice-text mb-50 aos-init aos-animate" data-aos="fade-right" data-aos-duration="1000">
                        <p class="mb-45 mt-35 mt-md-0 mt-xs-0">There are many variations of passages of lorem ipsum
                            available but the majority have suffered alteration in some form by injected humour.</p>
                    </div>
                </div>
            </div>
            <div class="row custom-mar-20 aos-init aos-animate" data-aos="fade-down" data-aos-duration="1000">
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-sm-6 custom-pad-20" v-for="item in serviceBox"
                    :key="item.title">
                    <NuxtLink :to="item.url">
                        <div class="kservice text-center mb-20">
                            <div class="kservice-icon">
                                <i :class="item.f_icon"></i>
                            </div>
                            <div class="kservice-content">
                                <h5 class="kservice-content-title" v-html="item.serviceBoxTitle"></h5>
                            </div>
                        </div>
                    </NuxtLink>
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
            serviceBox: [{
                serviceBoxTitle: 'Website <br>Development',
                url: '/servicedetails',
                f_icon: "flaticon-stats",
            },
            {
                serviceBoxTitle: 'Graphic <br>Designing',
                url: '/servicedetails',
                f_icon: "flaticon-digital-marketing",
            },
            {
                serviceBoxTitle: 'SEO & Content <br>writting',
                url: '/servicedetails',
                f_icon: "flaticon-website"
            },
            {
                serviceBoxTitle: 'Digital <br>marketing',
                url: '/servicedetails',
                f_icon: "flaticon-idea"
            }
            ]
        }
    }
}
</script>

<style lang="scss" scoped></style>
