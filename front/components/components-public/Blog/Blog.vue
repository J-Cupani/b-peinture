<script>
import Breadcrumb from "../Common/Breadcrumb.vue";
import BlogContent from "./BlogContent";
import PageFooter from "../Common/PageFooter";
import HeaderDefault from "../Common/HeaderDefault.vue";
import ScrollTop from "../Common/ScrollTop.vue";

export default {
    name: "app",
    components: {
        Breadcrumb,
        BlogContent,
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
        <Breadcrumb pageTitle="Blog" pageSubTitle="Blog" />
        <!-- page title area end -->

        <!-- page title area  -->
        <BlogContent />
        <!-- page title area end -->

        <!-- Header area  -->
        <PageFooter />
        <!-- Header area end -->

        <!-- scrolltop area start here -->
        <ScrollTop />
        <!-- scrolltop area end here -->
    </main>
</template>

<style scoped></style>
