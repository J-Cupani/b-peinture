<template>
    <main>
        <!-- Header area  -->
        <HeaderDefault />
        <!-- Header area end -->

        <!-- Breadcrumb area  -->
        <Breadcrumb pageTitle="Team" pageSubTitle="Our Team" />
        <!-- Breadcrumb area end -->

        <!-- team area -->
        <TeamContent />
        <!-- team area end -->

        <!-- CommonCta area -->
        <CommonCta />
        <!-- CommonCta area end -->

        <!-- PageFooter area -->
        <PageFooter />
        <!-- PageFooter area end -->

        <!-- scrolltop area start here -->
        <ScrollTop />
        <!-- scrolltop area end here -->
    </main>
</template>

<script>
import CommonCta from "../Common/CommonCta";
import PageFooter from "../Common/PageFooter";
import HeaderDefault from "../Common/HeaderDefault.vue";
import ScrollTop from "../Common/ScrollTop.vue";
import Breadcrumb from "../Common/Breadcrumb.vue";
import TeamContent from "./TeamContent.vue";

export default {
    name: "app",
    components: {
        CommonCta,
        PageFooter,
        HeaderDefault,
        ScrollTop,
        Breadcrumb,
        TeamContent
    }
};
</script>

<style scoped></style>
