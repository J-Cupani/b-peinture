<template>
    <section class="about-area pt-120 pb-70 fix">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="kabout-img mb-50 mr-70">
                        <div class="kabout-img-shape"></div>
                        <img src="/img/about/about-img-1.jpg" class="img-fluid z-index" alt="about-img">
                        <div class="kabout-img-small">
                            <img src="/img/about/about-img-2.jpg" class="img-fluid" alt="about-img">
                            <div class="kabout-img-small-icon play_btn">
                                <span>
                                    <i><img src="/img/icon/about-icon.png" class="img-fluid z-index" alt="about-img"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="kabout mb-50">
                        <div class="section-title-wrapper mb-45">
                            <h5 class="section-subtitle mb-20">get to know us</h5>
                            <h2 class="section-title mb-35">Welcome to digital <br>agency</h2>
                            <p>A digital agency is a creative and strategic company that specializes in providing a range of online services to help businesses establish a strong and effective digital presence.</p>
                        </div>
                        <div class="row">
                            <div class="col-sm-6" v-for="item in aboutService" :key="item.title">
                                <div class="kabout-service mb-30">
                                    <h4 class="kabout-service-title">{{ item.title }}</h4>
                                    <p>{{ item.description }}</p>
                                </div>
                            </div>
                        </div>
                        <ul class="mt-20 mb-55">
                            <li v-for="item in aboutServiceList" :key="item.list"><i class="fas fa-check"></i>{{ item.list}}</li>
                        </ul>
                        <div class="kabout-btn">
                            <NuxtLink to="/service" class="theme-btn border-btn">Discover more</NuxtLink>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script lang="ts">
export default {
    name: 'About',
    data() {
        return {
            aboutService: [{
                title: 'The Best Services',
                description: 'Digital agency is a creative and strategic company.',
            },
            {
                title: 'Expert Designers',
                description: 'Digital agency is a creative and strategic company.',
            }
            ],
            aboutServiceList: [{
                list: 'Entum estibulum dignissim posuere.',
            },
            {
                list: 'If you are going to use a passage.',
            },
            {
                list: 'Lorem Ipsum generators on the tend to repeat.',
            }
            ],
        }
    }
}
</script>

<style lang="scss" scoped></style>