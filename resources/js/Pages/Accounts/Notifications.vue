<script setup>

    import { ref, reactive } from "vue";
    import { Link, usePage } from "@inertiajs/vue3";
    import DashboardSidebar from "../Components/DashboardSidebar.vue";
    import { NIcon, NModal, NCard, NButton } from 'naive-ui';
    import { RemoveRedEyeFilled } from '@vicons/material';

    // Notification Information
    const { notifications } = usePage().props;
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
    // Notification Modal
    const showModal = ref(false)
    const selectedNotification = ref(null);
    const openModal = (notification) => {
        selectedNotification.value = notification;
        showModal.value = true;
    };
    const changeReadStatus = () => {
        console.log('status changed' + selectedNotification.id);
    };

</script>

<template>

    <DashboardSidebar
        :activePage="'Notifications'"
        :pageTitle="'Notifications'"
    >

        <template v-slot:mainContentSlot>

            <div class="notifications-container">

                <div
                    v-for="notification in notifications"
                    :key="notification.id"
                    class="notification-card"
                >
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
                        <n-icon @click="openModal(notification)" size=25 class="view-icon" color="#457b9d">
                            <RemoveRedEyeFilled />
                        </n-icon>
                        <!-- Modal -->
                        <n-modal
                            v-model:show="showModal"
                            :on-after-leave="changeReadStatus"
                        >
                            <n-card
                                style="width: 600px"
                                title="Details"
                                :bordered="false"
                                size="huge"
                                role="dialog"
                                aria-modal="true"
                            >
                                <template #header-extra>
                                    <h3>{{ formatDate(selectedNotification.created_at) }}</h3>
                                </template>
                                <div class="notification-modal">
                                    <h3>{{ selectedNotification.title }}</h3>
                                    <p>{{ selectedNotification.message }}</p>
                                </div>
                                <template #footer>
                                    <n-button type=primary @click="showModal = false">close</n-button>
                                </template>
                            </n-card>
                        </n-modal>
                        <!-- Modal -->
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
    /* MODAL */
    .notification-modal {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .notification-modal h3 {
        font-weight: bold;
        font-size: 18px;
    }
    /* Modal */

</style>
