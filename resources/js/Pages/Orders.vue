<script setup>

    import DashboardSidebar from './Components/DashboardSidebar.vue';
    import { ref, defineProps, computed } from 'vue';
    import { usePage, router, Link } from '@inertiajs/vue3';
    import {
        NButton,
        NIcon,
    } from 'naive-ui';

    import {
        ShoppingBagOutlined,
    } from '@vicons/material';

    // User Orders
    const props = defineProps([
        'orders',
        'totalOrders',
        'pendingOrders',
        'deliveredOrders',
        'locale',
        'translations',
    ]);

    const currentLocale = computed(() => {
        return props.locale ? props.locale : 'en';
    });

    // Orders Stats
    const totalOrders = computed(() => {
        return props.totalOrders ? props.totalOrders : 0;
    });
    const pendingOrders = computed(() => {
        return props.pendingOrders ? props.pendingOrders : 0;
    });
    const deliveredOrders = computed(() => {
        return props.deliveredOrders ? props.deliveredOrders : 0;
    });

    // Format Created at Date
    const formatDate = (date) => {
        const d = new Date(date);
        const day = String(d.getDate()).padStart(2, '0');
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const year = d.getFullYear();
        return `${day}-${month}-${year}`;
    };

    // Pagination
    const navigate = (url) => {
        router.get(url);
    };

</script>

<template>

    <DashboardSidebar
        :notifications="notifications"
        :pageTitle="'Orders'"
        :activePage="'Orders'"
    >

        <template v-slot:mainContentSlot>

            <div class="stats-container">
                <div class="stat-card" id="stat-one">
                    <div class="card-icon">
                        <img src="/assets/images/system/orders_list.svg">
                    </div>
                    <div class="card-container">
                        <p>{{ totalOrders }}</p>
                        <h2>Total Orders</h2>
                    </div>
                </div>
                <div class="stat-card" id="stat-two">
                    <div class="card-icon">
                        <img src="/assets/images/system/pending_status.svg">
                    </div>
                    <div class="card-container">
                        <p>{{ pendingOrders }}</p>
                        <h2>Orders Pending</h2>
                    </div>
                </div>
                <div class="stat-card" id="stat-three">
                    <div class="card-icon">
                        <img src="/assets/images/system/delivery_status.svg">
                    </div>
                    <div class="card-container">
                        <p>{{ deliveredOrders }}</p>
                        <h2>Orders Delivered</h2>
                    </div>
                </div>
            </div>
            <div class="container-header">
                <span>All Orders Made</span>
                <p>This is the information of all your orders</p>
            </div>
            <div class="orders-container">
                <table class="table-container">
                    <thead>
                        <tr>
                            <th>Order Code</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Source</th>
                            <th>Currency</th>
                            <th>Subtotal</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in orders.data" :key="order.id">
                            <td>
                                <div id="order-code">
                                    <n-icon color="#bc6c25" size=20><ShoppingBagOutlined/></n-icon>{{ order.order_code }}
                                </div>
                            </td>
                            <td>{{ formatDate(order.created_at) }}</td>
                            <td>
                                <span v-if="order.order_status === 'Pending'" class="pending-order">
                                    {{ order.order_status }}
                                </span>
                                <span v-else-if="order.order_status === 'Processing'" class="processing-order">
                                    {{ order.order_status }}
                                </span>
                                <span v-else-if="order.order_status === 'Completed'" class="completed-order">
                                    {{ order.order_status }}
                                </span>
                                <span v-else-if="order.order_status === 'Failed'" class="failed-order">
                                    {{ order.order_status }}
                                </span>
                                <span v-else-if="order.order_status === 'Delivered'" class="delivered-order">
                                    {{ order.order_status }}
                                </span>
                                <span v-else class="other-status">
                                    {{ order.order_status }}
                                </span>

                            </td>
                            <td>
                                <span class="order-source">{{ order.order_source }}</span>
                            </td>
                            <td>
                                <span class="order-currency">{{ order.currency_symbol }}</span>
                            </td>
                            <td>{{ order.subtotal }}</td>
                            <td>{{ order.total }}</td>
                            <td>
                                <Link
                                    :href="`/${currentLocale}/order`"
                                    :data="{ orderCode: order.order_code }"
                                >
                                    <n-button tertiary type="primary">Details</n-button>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="pagination-container">
                <button
                    v-for="link in orders.links"
                    :key="link.url"
                    :disabled="!link.url"
                    @click="navigate(link.url)"
                    v-html="link.label"
                    :class="{ 'active': link.active }"
                ></button>
            </div>
        </template>

    </DashboardSidebar>

</template>

<style scoped>

    /* STATS */
    .stats-container {
        display: flex;
        justify-content: flex-start;
        gap: 10px;
        margin-top: 60px;
        margin-bottom: 100px;
    }
    .stat-card {
        width: 100%;
        display: flex;
        padding: 30px 15px;
        border-radius: 10px;
    }
    #stat-one {
        background-color: #eb5e28;
    }
    #stat-two {
        background-color: #fb6f92;
    }
    #stat-three {
        background-color: #adc178;
    }
    .card-container {
        display: flex;
        justify-content: center;
        padding-left: 20px;
        flex-direction: column;
    }
    .card-container p {
        font-weight: bold;
        font-size: 2rem;
        color: #fff;
    }
    .card-container h2 {
        font-weight: bold;
        color: #fff;
    }
    .card-icon {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .card-icon img {
        width: 70px;
    }
    /* STATS */

    /* ORDERS TABLE */
    .orders-container {
        max-width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
        background-color: #fff;
        padding-top: 20px;
    }
    .container-header {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding-bottom: 10px;
    }
    .container-header span {
        font-weight: bold;
        font-size: 1.5rem;
    }
    .container-header p {
        color: gray;
    }
    .table-container {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        min-width: 600px;
    }
    .table-container th,
    .table-container td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        border-top: 1px solid #ddd;
    }
    .table-container th {
        font-weight: bold;
        padding-top: 20px;
        padding-bottom: 20px;
        color: #000;
    }
    #order-code {
        display: flex;
        align-items: center;
        gap: 3px;
    }
    .table-container tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .table-container tr:hover {
        background-color: #f1f1f1;
    }
    /* ORDERS TABLE */

    /* STATUS BADGE */
    .pending-order {
        padding: 3px 6px;
        background-color: #f7b267;
        color: #fff;
        border-radius: 5px;
    }
    .processing-order {
        padding: 3px 6px;
        background-color: #7678ed;
        color: #fff;
        border-radius: 5px;
    }
    .completed-order {
        padding: 3px 6px;
        background-color: #008000;
        color: #fff;
        border-radius: 5px;
    }
    .failed-order {
        padding: 3px 6px;
        background-color: #f25c54;
        color: #fff;
        border-radius: 5px;
    }
    .delivered-order {
        padding: 3px 6px;
        background-color: #669bbc;
        color: #fff;
        border-radius: 5px;
    }
    .other-status {
        padding: 3px 6px;
        background-color: #dd9787;
        color: #fff;
        border-radius: 5px;
    }
    .order-source {
        padding: 3px 6px;
        background-color: #fb6f92;
        color: #fff;
        border-radius: 5px;
    }
    .order-currency {
        padding: 3px 6px;
        background-color: #eb5e28;
        color: #fff;
        border-radius: 5px;
    }
    /* STATUS BADGE */

    /* PAGINATION */
    .pagination-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        padding-right: 20px;
        padding-top: 20px;
    }
    /* PAGINATION */

    /* Responsive */
    @media (max-width: 768px) {
        .table-container {
            font-size: 14px;
        }
        .table-container th, .table-container td {
            padding: 10px;
        }
    }
    @media (max-width: 900px) {
        .stats-container {
            flex-wrap: wrap;
        }
    }


</style>
