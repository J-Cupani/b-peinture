<template>
    <section class="video-area z-index">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title-wrapper mb-45 text-center">
                        <h5 class="section-subtitle mb-20">{{ sectionSubTitle }}</h5>
                        <h2 class="section-title mb-35">{{ sectionTitle }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="kvideo-wrapper" data-aos="zoom-in" data-aos-duration="1000">
                        <div class="kvideo" :style="{ backgroundImage: `url(/img/bg/video-bg.jpg)` }">
                            <div class="kvideo-sign text-center">
                                <span class="popup-video" @click.prevent="handleVideoPopup"><i class="fas fa-play"></i></span>
                                <h2>{{ watchTitle }}</h2>
                            </div>
                            <div class="kvideo-number">
                                <span>{{ numTitle }}</span>
                                <a href="tel:6668880000">{{ number }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- video popup start -->
    <VideoModal ref="video_modal" video-url="https://www.youtube.com/embed/7e90gBu4pas" />
    <!-- video popup end -->
</template>

<script>
import VideoModal from '../Common/VideoModal.vue';

export default {
    name: 'Video',
    data() {
        return {
            sectionSubTitle: 'one minute video',
            sectionTitle: 'Watch video work',
            watchTitle: 'Watch Video',
            numTitle: 'get estimate',
            number: '666 888 0000',
        };
    },
    components: { VideoModal },
    methods: {
      handleVideoPopup() {
         this.$refs.video_modal.playVideo();
      },
   }
}
</script>

<style lang="scss" scoped></style>
