<template>
    <section class="blog-area pt-120" :style="{ backgroundImage: `url(/img/blog/blog-bg-1.jpg)` }">
        <div class="blog-space pb-120">
            <div class="blog-text pt-60" data-aos="zoom-in">
                <div class="section-title-wrapper pr-25 mb-50">
                    <h5 class="section-subtitle mb-20">{{ sectionSubTitle }}</h5>
                    <h2 class="section-title mb-35">{{ sectionTitle }}</h2>
                    <p class="pr-50">{{ sectionTitleDescription }}</p>
                </div>
                <!-- If we need navigation buttons -->
                <div class="kblog-arrow">
                    <div class="blog-button-prev slide-prev">
                        <i class="fas fa-long-arrow-alt-left"></i>
                    </div>
                    <div class="blog-button-next slide-next">
                        <i class="fas fa-long-arrow-alt-right"></i>
                    </div>
                </div>
            </div>
            <div class="blog-active"> 
                <client-only>
                    <swiper :modules="modules" :slides-per-view="1" :loop="true" :space-between="30"
                        :autoplay="{ delay: 3000, disableOnInteraction: false }" :navigation="{
                            clickable: true,
                            nextEl: '.blog-button-next',
                            prevEl: '.blog-button-prev',
                        }" 
                        :breakpoints="{
                            320: {
                                slidesPerView: 1,
                            },
                            576: {
                                slidesPerView: 2,
                            },
                            768: {
                                slidesPerView: 2,
                            },
                            1200: {
                                slidesPerView: 2,
                            },
                            1400: {
                                slidesPerView: 3,
                            }
                        }">
                        <swiper-slide v-for="item in blogs" :key="item.id">
                            <div class="kblog swiper-slidess">
                                <div class="kblog-img">
                                    <NuxtLink :to="item.imageUrl"><img :src="item.image" class="img-fluid" alt="blog-img">
                                    </NuxtLink>
                                    <span>{{ item.date }}</span>
                                </div>
                                <div class="kblog-text">
                                    <div class="kblog-meta">
                                        <NuxtLink :to="item.metaAdminUrl"><i class="far fa-user-circle"></i>{{ item.metaAdmin
                                        }}</NuxtLink>
                                        <NuxtLink :to="item.metaCommentUrl"><i
                                                class="far fa-comments"></i>{{ item.metaComment }}</NuxtLink>
                                    </div>
                                    <h3 class="kblog-text-title mb-20">
                                        <NuxtLink :to="item.titleUrl"> {{ item.title }}</NuxtLink>
                                    </h3>
                                    <div class="kblog-text-link">
                                        <NuxtLink :to="item.blogLinkUrl">{{ item.blogLink }}
                                            <i class="far fa-chevron-right"></i>
                                        </NuxtLink>
                                    </div>
                                </div>
                            </div>
                        </swiper-slide>
                    </swiper>
                </client-only>
            </div>
        </div>
    </section>
</template>

<script>
import { Autoplay } from 'swiper'
import { Navigation } from 'swiper'
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/swiper-bundle.css'

export default {
    name: 'swiper-slider3',
    data() {
        return {
            sectionSubTitle: 'recent blog posts',
            sectionTitle: 'Latest News & Articles',
            sectionTitleDescription: 'Discover how digital agencies assist businesses in setting up e-commerce platforms for online selling.',
            blogs: [{
                id: '1',
                image: '/img/blog/blog-img-1.jpg',
                imageUrl: '/blogdetails',
                date: '20 May',
                metaAdmin: 'by Admin',
                metaAdminUrl: '/blogdetails',
                metaComment: '2 Comments',
                metaCommentUrl: '/blogdetails',
                title: 'Our Strategy Create Business Growth',
                titleUrl: '/blogdetails',
                blogLink: 'Read more',
                blogLinkUrl: '/blogdetails',
            },
            {
                id: '2',
                image: '/img/blog/blog-img-2.jpg',
                imageUrl: '/blogdetails',
                date: '21 May',
                metaAdmin: 'by Admin',
                metaAdminUrl: '/blogdetails',
                metaComment: '2 Comments',
                metaCommentUrl: '/blogdetails',
                title: 'We work with change oriented executives',
                titleUrl: '/blogdetails',
                blogLink: 'Read more',
                blogLinkUrl: '/blogdetails',
            },
            {
                id: '3',
                image: '/img/blog/blog-img-3.jpg',
                imageUrl: '/blogdetails',
                date: '22 May',
                metaAdmin: 'by Admin',
                metaAdminUrl: '/blogdetails',
                metaComment: '2 Comments',
                metaCommentUrl: '/blogdetails',
                title: 'From banking and insurance to wealth',
                titleUrl: '/blogdetails',
                blogLink: 'Read more',
                blogLinkUrl: '/blogdetails',
            },
            {
                id: '4',
                image: '/img/blog/blog-img-4.jpg',
                imageUrl: '/blogdetails',
                date: '23 May',
                metaAdmin: 'by Admin',
                metaAdminUrl: '/blogdetails',
                metaComment: '2 Comments',
                metaCommentUrl: '/blogdetails',
                title: 'Our Strategy Create Business Growth',
                titleUrl: '/blogdetails',
                blogLink: 'Read more',
                blogLinkUrl: '/blogdetails',
            },
            {
                id: '5',
                image: '/img/blog/blog-img-5.jpg',
                imageUrl: '/blogdetails',
                date: '24 May',
                metaAdmin: 'by Admin',
                metaAdminUrl: '/blogdetails',
                metaComment: '2 Comments',
                metaCommentUrl: '/blogdetails',
                title: 'We work with change oriented executives',
                titleUrl: '/blogdetails',
                blogLink: 'Read more',
                blogLinkUrl: '/blogdetails',
            }
            ],
        }
    },
    components: {
        Swiper,
        SwiperSlide
    },
    setup() {
        return {
            modules: [Autoplay, Navigation],
        }
    }
}
</script>

<style lang="scss" scoped></style>