<template>
    <section class="page-title-area breadcrumb-spacing" :style="{ backgroundImage: `url(/img/bg/breadcrumb-bg.jpg)` }">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-9">
                    <div class="page-title-wrapper text-center">
                        <h3 class="page-title mb-25">{{ pageTitle }}</h3>
                        <div class="breadcrumb-menu">
                            <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                                <ul class="trail-items">
                                    <li class="trail-item trail-begin">
                                        <NuxtLink to="/"><span>Home</span></NuxtLink>
                                    </li>
                                    <li class="trail-item trail-end"><span>{{ pageSubTitle }}</span></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'PageTitle',
    props: {
        pageTitle: String,
        pageSubTitle: String,
    }
}
</script>