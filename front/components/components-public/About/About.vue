<script>
import Mission from "./Mission";
import PageFooter from "../Common/PageFooter";
import WhyWe from "./WhyWe";
import Team from "../Home-Two/Team";
import Brand from "../Home/Brand.vue";
import Testimonial from "../Home/Testimonial.vue";
import Fact from "../Home-Two/Fact.vue";
import HeaderDefault from "../Common/HeaderDefault.vue";
import ScrollTop from "../Common/ScrollTop.vue";
import Breadcrumb from "../Common/Breadcrumb.vue";

export default {
    name: "app",
    components: {
        Mission,
        PageFooter,
        WhyWe,
        Team,
        Brand,
        Fact,
        Testimonial,
        HeaderDefault,
        ScrollTop,
        Breadcrumb
    }
};
</script>

<template>
    <main>
        <!-- header-area-start -->
        <HeaderDefault />
        <!-- header-area-end -->

        <!-- page title area  -->
        <Breadcrumb pageTitle="About Us" pageSubTitle="About Us" />
        <!-- page title area end -->

        <!-- mission area  -->
        <Mission />
        <!-- mission area end  -->

        <!-- testimonial area start here -->
        <Testimonial test_space="testimonial-area pb-85 pt-85" />
        <!-- testimonial area end here -->

        <!-- fact area start here -->
        <Fact fact_space="fact-area pb-85" />
        <!-- fact area end here -->

        <!-- about area start here -->
        <WhyWe />
        <!-- about area end here -->

        <!-- team area start here -->
        <Team />
        <!-- team area end here -->

        <!-- brand area end here -->
        <Brand brand_bg="brand-area2 bg-grey pt-100 pb-100" />
        <!-- brand area start here -->

        <!-- PageFooter area start here -->
        <PageFooter />
        <!-- PageFooter area end here -->

        <!-- scrolltop area start here -->
        <ScrollTop />
        <!-- scrolltop area end here -->
    </main>
</template>

<style scoped></style>
