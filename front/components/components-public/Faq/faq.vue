<script>
import Breadcrumb from "../Common/Breadcrumb.vue";
import CommonCta from "../Common/CommonCta";
import PageFooter from "../Common/PageFooter";
import HeaderDefault from "../Common/HeaderDefault.vue";
import ScrollTop from "../Common/ScrollTop.vue";

export default {
    name: "app",
    components: {
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
        <!-- Header area  -->
        <HeaderDefault />
        <!-- Header area end -->

        <!-- Breadcrumb area  -->
        <Breadcrumb pageTitle="FAQ" pageSubTitle="FAQ" />
        <!-- Breadcrumb area end -->

        <!-- Faq area -->
        <FaqContent />
        <!-- Faq area end -->

        <!-- CommonCta area -->
        <CommonCta />
        <!-- CommonCta area end -->

        <!-- PageFooter area  -->
        <PageFooter />
        <!-- PageFooter area end -->

        <!-- scrolltop area start here -->
        <ScrollTop />
        <!-- scrolltop area end here -->
    </main>
</template>

<style scoped></style>
