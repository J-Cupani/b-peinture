<template>
<section class="trust-area pt-105 pb-120">
    <div class="trust-bg" :style="{ backgroundImage: `url(/img/trust/trust-bg.jpg)` }"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="ktrust text-center z-index">
                    <h2 class="ktrust-title mb-45 wow fadeInUp" data-wow-delay=".2s" v-html="title"></h2>
                    <div class="ktrust-btn">
                        <NuxtLink :to="url" class="theme-btn">{{ buttonText }}</NuxtLink>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</template>

<script>
export default {
    name: 'trust',
    data() {
        return {
            title: 'Trust the Experts for All <br>Your business Needs',
            buttonText: 'Discover more',
            url: '/service',
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
