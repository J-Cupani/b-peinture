<script>
import ContactInfo from "./ContactInfo";
import Breadcrumb from "../Common/Breadcrumb.vue";
import PageFooter from "../Common/PageFooter";
import HeaderDefault from "../Common/HeaderDefault.vue";
import ScrollTop from "../Common/ScrollTop.vue";

export default {
    name: "app",
    components: {
        Breadcrumb,
        ContactInfo,
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
        <Breadcrumb pageTitle="Contact Us" pageSubTitle="Contact Us" />
        <!-- Breadcrumb area end -->

        <!-- Contact area  -->
        <ContactInfo />
        <!-- Contact area end -->

        <!-- PageFooter area  -->
        <PageFooter />
        <!-- PageFooter area end -->

        <!-- scrolltop area start here -->
        <ScrollTop />
        <!-- scrolltop area end here -->
    </main>
</template>

<style scoped></style>
