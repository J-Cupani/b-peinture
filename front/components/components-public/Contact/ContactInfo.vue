<template>
    <section class="contact-area pt-120 pb-145 fix">
        <div class="container">
            <div class="row">
                <div class="col-xxl-5 col-xl-6 col-lg-6">
                    <div class="section-title-wrapper mb-15">
                        <h5 class="section-subtitle mb-20">{{ sectionSubTitle }}</h5>
                        <h2 class="section-title">{{ sectionTitle }}</h2>
                    </div>
                    <div class="contact-info mr-50 mr-xs-0  mr-md-0">
                        <div class="single-contact-info d-flex align-items-center" v-for="item in contactInfo"
                            :key="item.infoTitle">
                            <div class="contact-info-icon">
                                <a href="#"><i :class="item.f_icon"></i></a>
                            </div>
                            <div class="contact-info-text mt-10">
                                <span>{{ item.infoTitle }}</span>
                                <h5><a href="#">{{ item.infoContent }}</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7 col-xl-6 col-lg-6">
                    <div class="contact-form">
                        <form action="" id="contact-form" method="POST">
                            <div class="row">
                                <div class="col-xxl-6 col-xl-6 col-sm-6 mb-20">
                                    <input name="name" type="text" placeholder="Your Name">
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-sm-6 mb-20">
                                    <input name="email" type="email" placeholder="Email Adress">
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-sm-6 mb-20">
                                    <input name="phone" type="text" placeholder="Phone">
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-sm-6 mb-20">
                                    <input name="subject" type="text" placeholder="Subject">
                                </div>
                                <div class="col-xxl-12 col-xl-12 col-lg-12 mb-20">
                                    <textarea placeholder="Write Massage" name="massage"></textarea>
                                </div>
                                <div class="col-xxl-12 col-xl-12 mb-20">
                                    <button type="submit" class="theme-btn border-btn">Send a message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'Contact',
    data() {
        return {
            sectionSubTitle: 'contact with us',
            sectionTitle: 'Speak with our consultant',
            contactInfo: [{
                infoTitle: 'Call Anytime',
                infoContent: '92 666 888 0000',
                f_icon: "fas fa-phone-alt",
            },
            {
                infoTitle: 'Send Email',
                infoContent: 'needhelp@company.com',
                f_icon: "fas fa-envelope",
            },
            {
                infoTitle: 'visit office',
                infoContent: '86 Road Broklyn Street, New York',
                f_icon: "fas fa-map-marker-alt"
            }]
        }
    }
}
</script>

<style lang="scss" scoped></style>
