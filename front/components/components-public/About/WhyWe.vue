<template>
    <section class="why-we bg-grey pt-125 pb-75 position-relative fix">
        <div class="common-shape-wrapper wow slideInLeft animated">
            <div class="common-shape-inner"></div>
        </div>
        <div class="container z-index">
            <div class="row justify-content-between">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="choose-left mb-40 mr-xs-0 mr-md-0 mr-lg-0 mr-90">
                        <div class="section-title-wrapper">
                            <h5 class="section-subtitle mb-20">{{ sectionSubTitle }}</h5>
                            <h2 class="section-title mb-35">{{ sectionTitle }}</h2>
                        </div>
                        <p>{{ sectionTitleContent }}</p>
                        <div class="why-tab-list">
                            <ul>
                                <li v-for="item in whyTabList" :key="item.List"><i class="far fa-check"></i> {{ item.List }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="choose-right">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        How to process the funtion for development?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>There are many variations of passages of available but the majority have suffered
                                            alteration in that some form by injected randomised words which don’t look even
                                            as slightly believable.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Where should I incorporate my business?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Web fonts are often terrible for web performance and none of the font loading
                                            strategies are particularly effective to address that. Upcoming font options may
                                            finally deliver on the promise.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        How there are many variations of passages
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Front-end and design are remarkably complex these days. That’s why we invite
                                            kind, smart folks from the community to run online workshops for all of us to
                                            learn together. And we have new ones.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            sectionSubTitle: 'All Categories List',
            sectionTitle: 'Why Choose our agency',
            sectionTitleContent: 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.',

            whyTabList: [{
                List: 'Refresing to get such a personal touch.',
            },
            {
                List: 'Duis aute irure dolor in reprehenderit in voluptate.',
            },
            {
                List: 'Velit esse cillum dolore eu fugiat nulla pariatur.',
            }
            ],
            tabTitle1: 'How to process the funtion for development?',
            tabTitle2: 'Where should I incorporate my business?',
            tabTitle3: 'How there are many variations of passages?',

            Text1: 'There are many variations of passages of available but the majority have suffered alteration in that some form by injected randomised words which don’t look even as slightly believable.',
            Text2: 'Web fonts are often terrible for web performance and none of the font loading strategies are particularly effective to address that. Upcoming font options may finally deliver on the promise.',
            Text3: 'Front-end and design are remarkably complex these days. That’s why we invite kind, smart folks from the community to run online workshops for all of us to learn together. And we have new ones.',
        };
    },
};
</script>

<style lang="scss" scoped></style>
