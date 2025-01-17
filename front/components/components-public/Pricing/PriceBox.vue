<template>
    <section class="pricing-area pt-120 pb-150 fix">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-wrapper text-center mb-30" v-for="item in starPlan" :key="item.title">
                        <div class="pricing-icon mb-25">
                            <span><i class="far fa-star"></i></span>
                        </div>
                        <div class="pricing-price mb-25">
                            <h5 class="pricing-subtitle">{{ item.title }}</h5>
                            <h3 class="pricing-title">{{ item.price }}</h3>
                        </div>
                        <div class="pricing-list-bg">
                            <div class="pricing-list mb-45">
                                <ul>
                                    <li><i class="far fa-check"></i> {{ item.list1 }}</li>
                                    <li><i class="far fa-check"></i> {{ item.list2 }}</li>
                                    <li><i class="fas fa-times cross-icon"></i> {{ item.list3 }}</li>
                                    <li><i class="fas fa-times cross-icon"></i> {{ item.list4 }}</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <NuxtLink :to="item.planBtnUrl" class="theme-btn">{{ item.planBtn }}</NuxtLink>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-wrapper text-center mb-30" v-for="item in heartPlan" :key="item.title">
                        <div class="pricing-icon mb-25">
                            <span><i class="far fa-heart"></i></span>
                        </div>
                        <div class="pricing-price mb-25">
                            <h5 class="pricing-subtitle">{{ item.title }}</h5>
                            <h3 class="pricing-title">{{ item.price }}</h3>
                        </div>
                        <div class="pricing-list-bg">
                            <div class="pricing-list mb-45">
                                <ul>
                                    <li><i class="far fa-check"></i> {{ item.list1 }}</li>
                                    <li><i class="far fa-check"></i> {{ item.list2 }}</li>
                                    <li><i class="far fa-check"></i> {{ item.list3 }}</li>
                                    <li><i class="fas fa-times cross-icon"></i> {{ item.list4 }}</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <NuxtLink :to="item.planBtnUrl" class="theme-btn">{{ item.planBtn }}</NuxtLink>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-wrapper text-center mb-30" v-for="item in diamondPlan" :key="item.title">
                        <div class="pricing-icon mb-25">
                            <span><i class="far fa-gem"></i></span>
                        </div>
                        <div class="pricing-price mb-25">
                            <h5 class="pricing-subtitle">{{ item.title }}</h5>
                            <h3 class="pricing-title">{{ item.price }}</h3>
                        </div>
                        <div class="pricing-list-bg">
                            <div class="pricing-list mb-45">
                                <ul>
                                    <li><i class="far fa-check"></i> {{ item.list1 }}</li>
                                    <li><i class="far fa-check"></i> {{ item.list2 }}</li>
                                    <li><i class="far fa-check"></i> {{ item.list3 }}</li>
                                    <li><i class="far fa-check"></i> {{ item.list4 }}</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <NuxtLink :to="item.planBtnUrl" class="theme-btn">{{ item.planBtn }}</NuxtLink>
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
    name: 'Price',
    data() {
        return {
            starPlan: [{
                title: 'Star Plan',
                price: '$25.00',
                list1: 'Extra features',
                list2: 'Lifetime free support',
                list3: 'Upgrate options',
                list4: 'Full access',
                planBtn: 'Choose a plan',
                planBtnUrl: '/pricing',
            }],
            heartPlan: [{
                title: 'Heart plan',
                price: '$35.00',
                list1: 'Extra features',
                list2: 'Lifetime free support',
                list3: 'Upgrate options',
                list4: 'Full access',
                planBtn: 'Choose a plan',
                planBtnUrl: '/pricing',
            }],
            diamondPlan: [{
                title: 'Diamond Plan',
                price: '$45.00',
                list1: 'Extra features',
                list2: 'Lifetime free support',
                list3: 'Upgrate options',
                list4: 'Full access',
                planBtn: 'Choose a plan',
                planBtnUrl: '/pricing',
            }]
        }
    }
}
</script>

<style lang="scss" scoped></style>
