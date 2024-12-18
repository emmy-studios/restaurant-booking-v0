<script setup>

    import { usePage, Link } from "@inertiajs/vue3";
    import { NIcon } from 'naive-ui';
    import { ArrowCircleLeftOutlined } from '@vicons/material';
    import DashboardSidebar from "../Components/DashboardSidebar.vue";

    const { notificationDetails } = usePage().props;
    // Get Current Locale
    const { locale } = usePage().props;
    const currentLocale = locale || 'en';

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
        :activePage="'Notification Details'"
        :pageTitle="'Notification Details'">

        <template v-slot:mainContentSlot>

            <div class="notification-container">
                <h2>{{ notificationDetails.title }}</h2>
                <span>{{ formatDate(notificationDetails.created_at) }}</span>
                <p>{{ notificationDetails.message }}</p>
                <div class="notification-actions">
                    <Link :href="`/${currentLocale}/notifications`">
                        <n-icon size=30 id="arrow-icon">
                            <ArrowCircleLeftOutlined/>
                        </n-icon>
                    </Link>
                </div>
            </div>

        </template>

    </DashboardSidebar>

</template>

<style scoped>

    .notification-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 20px 20px;
        margin: 60px 10px;
        border-radius: 10px;
        background-color: #F9F9F9;
    }
    .notification-container h2 {
        font-weight: bold;
        font-size: 18px;
    }
    .notification-container span {
        color: gray;
    }
    .notification-container p {
        color: #000;
        padding: 20px 20px;
    }
    .notification-actions {
        display: flex;
    }
    #arrow-icon {
        cursor: pointer;
    }

</style>
