<script>
import Breadcrumb from "../Common/Breadcrumb.vue";
import Feature from "./Feature";
import ServiceAbout from "./ServiceAbout.vue";
import ServiceCat from "./ServiceCat";
import Brand from "../Home/Brand.vue";
import Quality from "../Home/Quality";
import PageFooter from "../Common/PageFooter";
import HeaderDefault from "../Common/HeaderDefault.vue";
import ScrollTop from "../Common/ScrollTop.vue";

export default {
    name: "app",
    components: {
        Feature,
        ServiceAbout,
        ServiceCat,
        Quality,
        Brand,
        PageFooter,
        Breadcrumb,
        HeaderDefault,
        ScrollTop
    }
};
</script>


<template>
    <main>
        <!-- header area start here -->
        <HeaderDefault />
        <!-- header area end here -->

        <!-- page title area  -->
        <Breadcrumb pageTitle="Services" pageSubTitle="Our Services" />
        <!-- page title area end -->

        <!-- service area start here -->
        <Feature />
        <!-- service area end here -->

        <!-- about area start here -->
        <ServiceAbout />
        <!-- about area end here -->

        <!-- service area start here -->
        <ServiceCat />
        <!-- service area end here -->

        <!-- brand area end here -->
        <Brand brand_bg="brand-area3 pt-100 pb-100" />
        <!-- brand area end-->

        <!-- quality area start here -->
        <Quality />
        <!-- quality area start here -->

        <!-- PageFooter area start here -->
        <PageFooter />
        <!-- PageFooter area end here -->

        <!-- scrolltop area start here -->
        <ScrollTop />
        <!-- scrolltop area end here -->
    </main>
</template>

<style scoped></style>