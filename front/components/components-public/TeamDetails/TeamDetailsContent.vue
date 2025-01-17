<template>
    <section class="founder__area pt-120 pb-40">
        <div class="container">
            <div class="row align-items-center wow fadeInUp" data-wow-delay=".3s">
                <div class="col-lg-6">
                    <div class="team__founder-thumb w-img mb-60">
                        <img src="/img/team/team-img-8.jpg" class="img-fluid" alt="about-img">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="team__founder-main mb-60">
                        <div class="section__title-wrapper mb-35">
                            <div class="section-title-wrapper">
                                <h5 class="section-subtitle mb-20">Designer</h5>
                                <h2 class="section-title mb-35">sarah albert</h2>
                            </div>
                            <p class="paragraph-2">The spectacular Harbour Central is a brand new development in
                                London’s The Docklands, comprising a total of 642 private apartments divided across five
                                residential buildings, along with a leisure complex.</p>
                        </div>
                        <div class="team__founder-info">
                            <div class="team__founder-item">
                                <div class="team__founder-item-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="team__founder-text">
                                    <span class="title">Phone Number</span>
                                    <h4 class="contact"><a href="tel:926668880000">92 666 888 0000</a></h4>
                                </div>
                            </div>
                            <div class="team__founder-item">
                                <div class="team__founder-item-icon">
                                    <i class="fas fa-envelope-open"></i>
                                </div>
                                <div class="team__founder-text">
                                    <span class="title">Email Address</span>
                                    <h4 class="contact"><a href="mailto:info@webexample.com">info@webexample.com</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="team__founder-item">
                                <div class="team__founder-item-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="team__founder-text">
                                    <span class="title">Office Location</span>
                                    <h4 class="contact">86 Road Broklyn Street, New York</h4>
                                </div>
                            </div>
                        </div>
                        <div class="team__founder-btn">
                            <NuxtLink to="/contact" class="theme-btn border-btn">Get In Touch</NuxtLink>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container small-container">
        <div class="hr-1"></div>
    </div>

    <TeamSkill />

    <div class="container">
        <div class="hr-1"></div>
    </div>

    <TeamAchivement />
</template>

<script>
import TeamSkill from "./TeamSkill.vue";
import TeamAchivement from "./TeamAchivement.vue";

export default {
    name: "app",
    components: {
        TeamSkill,
        TeamAchivement
    }
};
</script>