<template>
    <section class="why-we bg-grey pt-120 pb-125 pb-md-110 position-relative">
        <div class="common-shape-wrapper wow slideInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms">
            <div class="common-shape-inner wow slideInleft animated" data-wow-delay="0ms" data-wow-duration="1500ms"></div>
        </div>
        <div class="container z-index">
            <div class="row justify-content-between">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="provide-thumb">
                        <img :src="image" class="img-fluid" alt="about_img">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="provide-content">
                        <div class="section-title-wrapper mb-25">
                            <h5 class="section-subtitle mb-20">{{ subTitle }}</h5>
                            <h2 class="section-title mb-35" v-html="title"></h2>
                            <p>{{ content }}</p>
                        </div>
                        <p>{{ descriptionText }}</p>
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
            image: '/img/about/about-img-7.jpg',
            subTitle: 'All Categories List',
            title: 'We provide a best <br>services',
            content: 'There are many variations of pass of lorem ipsum available but the majority have suffered alteration in some form.',
            descriptionText: 'Injected humour randomised words which dont look even slightly believable you need to be sure there isnt anything embarrassing.',
        }
    }
}
</script>

<style scoped></style>