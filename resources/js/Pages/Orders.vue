<script setup>

    import DashboardSidebar from './Components/DashboardSidebar.vue';
    import { ref } from 'vue';
    import { usePage } from '@inertiajs/vue3';
    import {
        NButton,
        NModal,
        NCard,
        NIcon,
    } from 'naive-ui';
    import {
        StickyNote2Filled,
        CheckCircleOutlineFilled,
        DeliveryDiningFilled,
    } from '@vicons/material';

    // Get Current Locale
    const { locale } = usePage().props;
    const currentLocale = locale || 'en';

    // User Orders
    const { orders } = usePage().props;
    // Get User Information
    const notifications = ref(4);
    // Orders Stats
    const totalOrders = ref(orders.length);
    const ordersConfirmed = ref(9);
    const ordersDelivered = ref(2);
    // Format Created at Date
    const formatDate = (date) => {
        const d = new Date(date);
        const day = String(d.getDate()).padStart(2, '0');
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const year = d.getFullYear();
        return `${day}-${month}-${year}`;
    };

    // Order Info Modal
    const showModal = ref(false);

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
                        <n-icon size=45 color="#fff">
                            <StickyNote2Filled />
                        </n-icon>
                    </div>
                    <div class="card-container">
                        <p>{{ totalOrders }}</p>
                        <h2>Total Orders</h2>
                    </div>
                </div>

                <div class="stat-card" id="stat-two">
                    <div class="card-icon">
                        <n-icon size=45 color="#fff">
                            <CheckCircleOutlineFilled />
                        </n-icon>
                    </div>
                    <div class="card-container">
                        <p>{{ ordersConfirmed }}</p>
                        <h2>Orders Completed</h2>
                    </div>
                </div>

                <div class="stat-card" id="stat-three">
                    <div class="card-icon">
                        <n-icon size=45 color="#fff">
                            <DeliveryDiningFilled />
                        </n-icon>
                    </div>
                    <div class="card-container">
                        <p>{{ ordersDelivered }}</p>
                        <h2>Orders Delivered</h2>
                    </div>
                </div>

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
                        <tr v-for="order in orders" :key="order.id">
                            <td id="order-code">{{ order.order_code }}</td>
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

                                <n-button tertiary type="primary" @click="showModal=true">:</n-button>

                                <n-modal v-model:show="showModal">
    								<n-card
      								    style="width: 600px"
      								    title="Modal"
      								    :bordered="false"
      								    size="huge"
      								    role="dialog"
      								    aria-modal="true"
    								>
      								    <template #header-extra>
                                            <n-button @click="showModal = false">X</n-button>
      								    </template>
      								    Content
      								    <template #footer>
        								    Footer
      								    </template>
    							    </n-card>
  								</n-modal>

                            </td>
                        </tr>
                    </tbody>

                </table>

            </div>

        </template>

    </DashboardSidebar>

</template>

<style scoped>

    /* STATS */
    .stats-container {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
        margin-top: 60px;
        margin-bottom: 100px;
    }
    .stat-card {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: red;
        padding: 20px 20px;
        border-radius: 10px;
        gap: 20px;
    }
    #stat-one {
        background-color: #a7c957;
    }
    #stat-two {
        background-color: #eaac8b;
    }
    #stat-three {
        background-color: #fb6f92;
    }
    .card-icon {
        display: flex;
    }
    .card-container {
        display: flex;
        flex-direction: column;
        width: 100%;
        gap: 10px;
    }
    .card-container h2 {
        font-size: 16px;
        color: #fff;
    }
    .card-container p {
        color: #fff;
        font-weight: bold;
        font-size: 30px;
    }
    /* STATS */
    /* Orders Table */
    .orders-container {
        max-width: 100%;
        overflow-x: auto; /* Scroll horizontal */
        overflow-y: hidden; /* Opcional: evita el scroll vertical */
        /*border: 1px solid #ddd;*/ /* Para visibilidad */
        border: 1px solid #a7c957;
        border-radius: 8px;
        background-color: #fff;
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
        /*border: 1px solid #ddd;*/
    }
    .table-container th {
        /*background-color: #f4f4f4;*/
        background-color: #a7c957;
        font-weight: bold;
        color: #fff;
    }
    #order-code {
        font-weight: bold;
    }
    .table-container tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .table-container tr:hover {
        background-color: #f1f1f1;
    }
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
    /* Responsive */
    @media (max-width: 768px) {
        .stats-container {
            grid-template-columns: 1fr;
        }
        .table-container {
            font-size: 14px;
        }
        .table-container th, .table-container td {
            padding: 10px;
        }
    }


</style>
