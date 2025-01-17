<script>
import Breadcrumb from "../Common/Breadcrumb.vue";
import ProjectItem from "./ProjectItem";
import PageFooter from "../Common/PageFooter";
import HeaderDefault from "../Common/HeaderDefault.vue";
import ScrollTop from "../Common/ScrollTop.vue";

export default {
    name: "app",
    components: {
        Breadcrumb,
        ProjectItem,
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

        <!-- page title area  -->
        <Breadcrumb pageTitle="Projects" pageSubTitle="Our Projects" />
        <!-- page title area end -->

        <!-- project area start  -->
        <ProjectItem />
        <!-- project area end  -->

        <!-- Header area  -->
        <PageFooter />
        <!-- Header area end -->

        <!-- scrolltop area start here -->
        <ScrollTop />
        <!-- scrolltop area end here -->
    </main>
</template>

<style scoped></style>
