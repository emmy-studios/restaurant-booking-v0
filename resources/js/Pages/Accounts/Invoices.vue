<script setup>

    import DashboardSidebar from '../Components/DashboardSidebar.vue';
    import { usePage, router, Link } from '@inertiajs/vue3';
    import { NIcon } from 'naive-ui';
    import { LocalPrintshopFilled } from '@vicons/material';

    const { invoices, user, locale } = usePage().props;
    const currentLocale = locale || 'en';

    // Pagination
    const navigate = (url) => {
        router.get(url);
    };
    // Format Created At Date
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
        :pageTitle="'Invoices'"
        :activePage="'Invoices'"
    >

        <template v-slot:mainContentSlot style="padding-bottom: 100px;">

            <section class="invoices-section">
                <article class="invoice-card" v-for="invoice in invoices.data" :key="invoice.id">
                    <header class="card-header">
                        <h2>{{ invoice.billing_code }}</h2>
                        <Link
                            :href="route('invoice.show', { invoiceId: invoice.id })"
                        >
                            <n-icon id="print-icon" color="#e36414" size=20><LocalPrintshopFilled/></n-icon>
                        </Link>
                    </header>
                    <div class="card-content">
                        <h3>{{ invoice.currency_symbol }} {{ invoice.total }}</h3>
                        <span>Subtotal: {{ invoice.subtotal }}</span>
                        <div class="date-item">
                            <h4>Date:</h4>
                            <p>{{ formatDate(invoice.created_at) }}</p>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <div class="user-image">
                            <img
                                :src="user.image_url ? `/storage/${user.image_url}` : '/assets/images/panels/admin.svg'"
                            >
                        </div>
                        <p>{{ user.first_name }} {{ user.last_name }}</p>
                    </footer>
                </article>
            </section>
            <!-- Pagination -->
            <aside class="pagination-container">
                <button
                    v-for="link in invoices.links"
                    :key="link.url"
                    :disabled="!link.url"
                    @click="navigate(link.url)"
                    :class="{ 'active': link.active, 'disabled': !link.url }"
                >
                    <span v-if="link.label.includes('«')">⬅️</span>
                    <span v-else-if="link.label.includes('»')">➡️</span>
                    <span v-else v-html="link.label"></span>
                </button>
            </aside>

        </template>

    </DashboardSidebar>

</template>

<style scoped>

    .invoices-section {
        margin-top: 60px;
        display: grid;
        gap: 15px;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(2, 1fr);
    }
    .invoice-card {
        display: flex;
        flex-direction: column;
        gap: 20px;
        border-radius: 5px;
        padding: 10px 10px;
        background-color: #e3d5ca;
    }
    .card-header {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .card-header h2 {
        font-weight: bold;
    }
    #print-icon {
        cursor: pointer;
    }
    .card-content {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 30px 10px;
        border: 1px dotted black;
    }
    .card-content h3 {
        font-weight: bold;
        font-size: 20px;
    }
    .date-item {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        align-items: center;
    }
    .date-item h4 {
        color: gray;
    }
    .date-item p {
        font-weight: bold;
        font-size: 1.5rem;
    }
    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .user-image {
        display: flex;
    }
    .user-image img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
    }
    /* Pagination */
    .pagination-container {
        display: flex;
        margin-top: 20px;
        gap: 10px;
        justify-content: flex-end;
        align-items: center;
    }
    .pagination-container button {
        border: none;
        border-radius: 5px;
        padding: 8px 10px;
        font-size: 12px;
        cursor: pointer;
        background-color: #f3f4f6; /* Gris claro */
        color: #374151; /* Gris oscuro */
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .pagination-container button.active {
        background-color: #f35b04;
        color: #fff;
        font-weight: bold;
    }
    .pagination-container button.disabled {
        background-color: #e5e7eb; /* Gris claro */
        color: #9ca3af; /* Gris */
        cursor: not-allowed;
    }
    .pagination-container button:hover:not(.disabled):not(.active) {
        background-color: #e0e7ff; /* Azul claro */
        color: #3730a3; /* Azul oscuro */
    }
    /* Pagination */

    @media (max-width: 1120px) {
        .invoices-section {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 842px) {
        .invoices-section {
            grid-template-columns: 1fr;
        }
        .pagination-container {
            justify-content: center;
        }
    }

</style>
