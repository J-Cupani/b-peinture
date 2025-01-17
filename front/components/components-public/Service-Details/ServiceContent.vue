<template>
    <section class="service-detals pt-120 pb-160 fix">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-xl-8 col-lg-8">
                    <div class="develop-wrapper">
                        <div class="develop-thumb">
                            <img :src="image" class="img-fluid" alt="service-img">
                        </div>
                        <div class="develop-content">
                            <h3 class="service-title">{{ title }}</h3>
                            <p>{{ content }}</p>
                        </div>
                    </div>
                    <div class="planning-wrapper pt-50">
                        <div class="row">
                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                <div class="plan-thumb mb-md-40 mb-xs-40">
                                    <img :src="image2" class="img-fluid" alt="service-img">
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                <div class="plan-content">
                                    <div>
                                        <h4>{{ planTitle }}</h4>
                                        <p>{{ planContent }}</p>
                                    </div>
                                    <ul>
                                        <li v-for="item in planList" :key="item.list"><i class="far fa-check"></i>
                                            {{ item.list }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xxl-12">
                                <div class="plan-content pr-10 pt-50 pt-xs-30 pt-md-30 pb-15">
                                    <p>{{ description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-wrapper">
                        <div class="choose-right">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            How to process the funtion for development?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>There are many variations of passages of available but the majority have
                                                suffered alteration in that some form by injected randomised words which
                                                don’t look
                                                even as slightly believable.</p>
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
                                                strategies are particularly effective to address that. Upcoming font options
                                                may finally deliver on the promise.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            How there are many variations of passages
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Front-end and design are remarkably complex these days. That’s why we invite
                                                kind, smart folks from the community to run online workshops for all of us
                                                to learn together. And we have new ones.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <div class="sidebar-wrap">
                        <div class="widget_categories grey-bg">
                            <h4 class="bs-widget-title pl-20">{{ catTitle }}</h4>
                            <ul>
                                <li v-for="item in categoryList" :key="item.list">
                                    <NuxtLink to="/servicedetails">{{ item.list }} <i
                                            class="fas fa-long-arrow-alt-right"></i></NuxtLink>
                                </li>
                            </ul>
                        </div>
                        <div class="widget-btn mt-30">
                            <NuxtLink to="/about" class="theme-btn border-btn">{{ categoryBtn }}</NuxtLink>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'ServiceContent',
    data() {
        return {
            title: 'Web Development',
            content: 'Need something changed or is there something not quite working the way you envisaged? Is your van a little old and tired and need refreshing? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries but also the leap into electronic typesetting remaining essentially unchanged.',
            image: '/img/service/service-img-5.jpg',
            image2: '/img/service/service-img-6.jpg',
            planTitle: 'planning & strategy',
            planContent: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            planList: [{
                list: 'Research beyond the business plan'
            },
            {
                list: 'Marketing options and rates'
            },
            {
                list: 'The ability to turnaround consulting'
            },
            {
                list: 'Customer engagement matters'
            }
            ],
            description: 'Need something changed or is there something not quite working the way you envisaged? Is your van a little old and tired and need refreshing? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
            catTitle: 'Categories',
            categoryList: [{
                list: 'Web Developement',
            },
            {
                list: 'Graphic Design',
            },
            {
                list: 'SEO & Content Writting',
            },
            {
                list: 'Digital Marketing',
            },
            {
                list: 'App Development',
            }
            ],
            categoryBtn: 'get a free estimate',
            tabTitle1: 'How to process the funtion for development?',
            tabTitle2: 'Where should I incorporate my business?',
            tabTitle3: 'How there are many variations of passages?',
            Text1: 'There are many variations of passages of available but the majority have suffered alteration in that some form by injected randomised words which don’t look even as slightly believable.',
            Text2: 'Web fonts are often terrible for web performance and none of the font loading strategies are particularly effective to address that. Upcoming font options may finally deliver on the promise.',
            Text3: 'Front-end and design are remarkably complex these days. That’s why we invite kind, smart folks from the community to run online workshops for all of us to learn together. And we have new ones.',
        }
    }
}
</script>

<style lang="scss" scoped></style>
