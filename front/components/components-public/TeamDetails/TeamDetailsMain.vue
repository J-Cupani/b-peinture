<template>
    <main>
        <!-- Header area  -->
        <HeaderDefault />
        <!-- Header area end -->

        <!-- Breadcrumb area  -->
        <Breadcrumb pageTitle="Team Details" pageSubTitle="Team Details" />
        <!-- Breadcrumb area end -->

        <!-- Team Details area  -->
        <TeamDetailsContent />
        <!-- Team Details area end -->

        <!-- PageFooter area  -->
        <PageFooter />
        <!-- PageFooter area end -->

        <!-- scrolltop area start here -->
        <ScrollTop />
        <!-- scrolltop area end here -->
    </main>
</template>

<script>
import PageFooter from "../Common/PageFooter";
import HeaderDefault from "../Common/HeaderDefault.vue";
import ScrollTop from "../Common/ScrollTop.vue";
import Breadcrumb from "../Common/Breadcrumb.vue";
import TeamDetailsContent from "./TeamDetailsContent.vue";

export default {
    name: "app",
    components: {
        PageFooter,
        HeaderDefault,
        ScrollTop,
        Breadcrumb,
        TeamDetailsContent
    }
};
</script>

<style scoped></style>
