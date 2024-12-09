<script setup>

    import DashboardSidebar from './Components/DashboardSidebar.vue';
    import { ref } from 'vue';
    import { usePage } from '@inertiajs/vue3';
    import { NButton } from 'naive-ui';

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

                <div
                    v-for="order in orders"
                    :key="order.id"
                    class="order-container"
                >

                    <p>{{ order.order_code }}</p>
                    <p>{{ formatDate(order.created_at) }}</p>
                    <p>{{ order.currency_symbol }} {{ order.subtotal }}</p>
                    <p>{{ order.total }}</p>
                    <p>{{ order.order_status }}</p>

                    <div
                        v-if="order.order_status === 'Completed' | 'Delivered' | 'Paid'"
                    >
                        <n-button>Details</n-button>
                    </div>
                    <n-button>Actions</n-button>

                </div>

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
        background-color: red;
    }

    .orders-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 30px;
        background-color: gray;
        color: #000;
        border-radius: 10px;
        padding: 10px 10px;
    }
    .order-container {
        display: flex;
        justify-content: space-between;
    }


</style>
