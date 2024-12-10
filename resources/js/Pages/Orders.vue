<script setup>

    import DashboardSidebar from './Components/DashboardSidebar.vue';
    import { ref } from 'vue';
    import { usePage } from '@inertiajs/vue3';
    import {
        NButton,
        NModal,
        NCard,
    } from 'naive-ui';

    // Get Current Locale
    const { locale } = usePage().props;
    const currentLocale = locale || 'en';

    // User Orders
    const { orders } = usePage().props;
    // Get User Information
    const notifications = ref(4);
    // Total Orders
    const totalOrders = ref(orders.length) || ref(0);
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

                <div class="stat-card">
                    <h2>Total Orders</h2>
                    <p>{{ totalOrders }}</p>
                </div>

                <div class="stat-card">
                    <h2>Total Products</h2>
                    <p>90</p>
                </div>

                <div class="stat-card">
                    <h2>Total Invoices</h2>
                    <p>23</p>
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
                            <td>{{ order.order_code }}</td>
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

    /* Stats */
    .stats-container {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .stat-card {
        display: flex;
        justify-content: center;
        background-color: red;
        border-radius: 10px;
    }
    /* Orders Table */
    .orders-container {
        max-width: 100%;
        overflow-x: auto; /* Scroll horizontal */
        overflow-y: hidden; /* Opcional: evita el scroll vertical */
        border: 1px solid #ddd; /* Para visibilidad */
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
        border: 1px solid #ddd;
    }
    .table-container th {
        background-color: #f4f4f4;
        font-weight: bold;
    }
    .table-container tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .table-container tr:hover {
        background-color: #f1f1f1;
    }
    /*.pending-order {
        display: flex;
    }*/
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
        .table-container {
            font-size: 14px;
        }
        .table-container th, .table-container td {
            padding: 10px;
        }
    }


</style>
