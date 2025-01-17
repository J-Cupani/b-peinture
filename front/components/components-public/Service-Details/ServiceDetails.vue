<script>
import ServiceContent from "./ServiceContent";
import Breadcrumb from "../Common/Breadcrumb.vue";
import CommonCta from "../Common/CommonCta.vue";
import PageFooter from "../Common/PageFooter.vue";
import HeaderDefault from "../Common/HeaderDefault.vue";
import ScrollTop from "../Common/ScrollTop.vue";

export default {
    name: "app",
    components: {
        ServiceContent,
        Breadcrumb,
        CommonCta,
        PageFooter,
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
        <Breadcrumb pageTitle="Service Details" pageSubTitle="Service Details" />
        <!-- page title area end -->

        <!-- service details area start here -->
        <ServiceContent />
        <!-- service details area end here -->

        <!-- cta area  -->
        <CommonCta />
        <!-- cta area end  -->

        <!-- PageFooter area start here -->
        <PageFooter />
        <!-- PageFooter area end here -->

        <!-- scrolltop area start here -->
        <ScrollTop />
        <!-- scrolltop area end here -->
    </main>
</template>

<style scoped></style>
