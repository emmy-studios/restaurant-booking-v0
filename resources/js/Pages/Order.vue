<script setup>

    import DashboardSidebar from './Components/DashboardSidebar.vue';
    import { ref, reactive } from 'vue';
    import { usePage, Link } from '@inertiajs/vue3';
    import {
        NTimeline,
        NTimelineItem,
        NIcon,
        NButton,
    } from 'naive-ui';
    import {
        CheckCircleFilled,
        EditLocationSharp,
        Inventory2Filled,
        ArrowCircleRightSharp,
        ArrowCircleLeftTwotone,
        ShoppingBagRound,
        KeyboardArrowDownOutlined,
    } from '@vicons/material';

    // Get Current Locale
    const { locale } = usePage().props;
    const currentLocale = locale || 'en';

    // User Order
    const { lastOrderCreated, user, shoppingcartProducts } = usePage().props;
    const status = ref(lastOrderCreated.order_status) || ref('Pending');
    // Shoppingcart Products
    //const products = reactive(shoppingcartProducts);
    // Address Information
    const userCountry = ref(user.country) || ref('Costa Rica');
    const userCity = ref(user.city);
    const userAddress = ref(user.address) || ref('Some Address Here');

    // Get User Information
    const notifications = ref(4);

    const changeStatus = (data) => {
        data = 'Completed';
    };

</script>

<template>

    <DashboardSidebar
        :notifications="notifications"
        :pageTitle="'Order'"
        :activePage="'Order'"
    >

        <template v-slot:mainContentSlot>

            <div
                class="order-container"
                v-if="status === 'Pending' || status === 'Processing' || status === 'Completed'"
            >

                <!-- Status = Pending -->
                <div v-if="status === 'Pending'">
                    <div class="timeline-container">
                        <n-timeline horizontal>
      						<n-timeline-item
        						type="info"
        						title="Creating Order"
        						content="Choose your orders items">
                                <template #icon>
                                    <n-icon size=30><ShoppingBagRound/></n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item
                                color="gray"
                                title="Shipping Address"
                                content="Verify your delivered address"
                            >
                                <template #icon>
                                    <n-icon size=30>
                                        <EditLocationSharp />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item color="gray">
                                <n-icon size=30><Inventory2Filled/></n-icon>
                            </n-timeline-item>
    					</n-timeline>
                    </div>

                    <div class="create-order-container">

                        <div class="header-title">
                            <h2>Your Cart</h2>
                            <n-icon id="arrow-icon" color="#f7b267" size=80>
                                <KeyboardArrowDownOutlined/>
                            </n-icon>
                        </div>

                        <div class="products-container">

                            <div class="cart-header">
                                <span>Product</span>
                                <span>Currency</span>
                                <span>Price</span>
                                <span>Quantity</span>
                                <span>Subtotal</span>
                            </div>
                            <div class="product-row">
                                <div>

                                </div>
                            </div>

                        </div>

                        <div class="order-resume">
                            <div class="resume-item">
                                <span>Currency</span>
                                <p>USD $</p>
                            </div>
                            <div class="resume-item">
                                <span>Subtotal</span>
                                <p>9000.00</p>
                            </div>
                            <div class="resume-item">
                                <span>Total Discounts</span>
                                <p>890.00</p>
                            </div>
                            <div class="resume-item">
                                <span>Total</span>
                                <p>10000.00</p>
                            </div>
                            <Link
                                id="checkout-btn"
                                method="post"
                                :href="`/${currentLocale}/order/add-items`"
                            >
                                Proceed To Checkout
                            </Link>
                        </div>

                    </div>

                    <div class="pending-actions">
                        <n-icon
                            size=40
                            @click="status = 'Processing'"
                        >
                            <ArrowCircleRightSharp/>
                        </n-icon>
                    </div>
                </div>


                <!-- Status = Processing -->
                <div v-if="status === 'Processing'">
                    <div class="timeline-container">
                        <n-timeline horizontal>
      						<n-timeline-item
        						type="success"
                                color="success"
        						title="Order Created"
        						content="Your order is processing"
        						time="2018-04-03 20:46">
                                <template #icon>
                                    <n-icon size=30>
                                        <CheckCircleFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item
                                type="info"
                                title="Shipping Address"
                                content="Verify your delivered address"
                                time="2018-04-03 20:46"
                            >
                                <template #icon>
                                    <n-icon size=30>
                                        <EditLocationSharp />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item color="gray">
                                <n-icon size=30><Inventory2Filled/></n-icon>
                            </n-timeline-item>
    					</n-timeline>
                    </div>
                    <div class="processing-order-container">
                        <p>{{ userCountry }}</p>
                        <p>{{ userCity }}</p>
                        <input v-model="userCity"/>
                        <p>{{ userAddress }}</p>
                    </div>
                    <div class="processing-actions">
                        <n-icon size=40
                            @click="status = 'Pending'"
                        >
                            <ArrowCircleLeftTwotone/>
                        </n-icon>
                        <n-icon
                            size=40
                            @click="status = 'Completed'"
                        >
                            <ArrowCircleRightSharp/>
                        </n-icon>
                    </div>
                </div>

                <!-- Status = Completed -->
                <div v-if="status === 'Completed'">
                    <p>Order Created Successfully</p>
                    <button>Generate Invoice</button>
                </div>

            </div>

            <div v-else>
                <p>Not Order in Process</p>
            </div>

         </template>

    </DashboardSidebar>

</template>

<style scoped>

    .order-container {
        display: flex;
        flex-direction: column;
        margin-top: 60px;
    }
    .timeline-container {
        display: flex;
        justify-content: center;
        padding: 20px 20px;
        overflow: auto;
    }


    /* Create Order */
    .create-order-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-top: 60px;
    }
    .header-title {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding-top: 20px;
        padding-bottom: 20px;
    }
    .header-title h2 {
        font-weight: bold;
        font-size: 28px;
    }
    .products-container {
        display: flex;
        flex-direction: column;
        padding-top: 20px;
        padding-bottom: 20px;
    }
    .cart-header {
        display: flex;
        justify-content: space-between;
        background-color: #f7b267;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 10px;
        padding-right: 10px;
        color: #fff;
    }
    .order-resume {
        display: flex;
        flex-direction: column;
        background-color: pink;
        margin-top: 20px;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 20px;
        padding-right: 20px;
        border-radius: 10px;
    }
    .resume-item {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }
    .resume-item span {
        font-weight: bold;
        font-size: 14px;
    }
    #checkout-btn {
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 5px;
        padding-right: 5px;
        color: #fff;
        background-color: #f7b267;
    }


    /* Processing Order */
    .processing-order-container {
        display: flex;
        background-color: red;
        margin-top: 60px;
    }
    .processing-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 10px;
        padding-bottom: 10px;
    }

</style>
