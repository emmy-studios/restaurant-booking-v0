<script setup>

    import { computed } from "vue";
    import { Link, usePage } from "@inertiajs/vue3";
    import DashboardSidebar from "../Components/DashboardSidebar.vue";
    import { NIcon, NButton } from 'naive-ui';
    import { RemoveRedEyeFilled } from '@vicons/material';

    // Notification Information
    // Get Current Locale
    const { locale, translations } = usePage().props;
    const currentLocale = locale || 'en';
    const { userNotifications } = usePage().props;

    const formatDate = (date) => {
        const d = new Date(date);
        const day = String(d.getDate()).padStart(2, '0');
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const year = d.getFullYear();
        return `${day}-${month}-${year}`;
    };
    // Truncate Notification Text
    function truncateMessage(text, length = 70) {
        return text.length > length ? text.substring(0, length) + '...' : text;
    };
    // Truncate Notification Title
    function truncateTitle(text, length = 70) {
        return text.length > length ? text.substring(0, length) + '...' : text;
    };
    const convertBoolean = (number) => {
        if (number === 1) {
            return true;
        } else {
            return false;
        };
    };
    // Translate Slot Props
    const localizedPageTitle = computed(() => {
        return translations.notifications.notifications || 'Notifications';
    });

</script>

<template>

    <DashboardSidebar
        :activePage="'Notifications'"
        :pageTitle="localizedPageTitle"
    >

        <template v-slot:mainContentSlot>

            <div class="notifications-container">

                <div
                    v-for="notification in userNotifications"
                    :key="notification.id"
                    class="notification-card"
                >
                    <div class="card-icon">
                        <img src="/assets/images/system/chat_bubble.svg">
                    </div>
                    <div class="card-title">
                        <h2>{{ truncateTitle(notification.title) }}</h2>
                    </div>
                    <div class="card-date">
                        <p>{{ formatDate(notification.created_at) }}</p>
                    </div>
                    <div class="card-container">
                        <p>{{ truncateMessage(notification.message) }}</p>
                    </div>
                    <div class="card-action">
                        <Link
                            :href="route('notification.show', { notificationId: notification.id })"
                        >
                            {{ translations.notifications.details }}
                        </Link>
                    </div>
                </div>

            </div>

        </template>

    </DashboardSidebar>

</template>

<style scoped>

    .notifications-container {
        display: flex;
        flex-direction: column;
        gap: 5px;
        background-color: #fff;
        margin: 60px 20px;
    }
    .notification-card {
        display: flex;
        flex-direction: column;
        gap: 10px;
        border-radius: 10px;
        margin: 10px 10px;
        padding: 15px 15px;
        border: 1px solid gray;
    }
    .card-icon {
        display: flex;
    }
    .card-icon img {
        width: 5%;
        height: 5%;
    }
    .card-title {
        display: flex;
        flex-wrap: wrap;
    }
    .card-title h2 {
        font-weight: bold;
        font-size: 18px;
    }
    .card-date {
        display: flex;
        flex-wrap: wrap;
    }
    .card-date p {
        color: gray;
        font-size: 16px;
    }
    .card-container {
        display: flex;
        flex-wrap: wrap;
    }
    .card-container p {
        color: gray;
    }
    .card-action {
        display: flex;
        justify-content: flex-end;
    }
    .view-icon {
        cursor: pointer;
    }

</style>
