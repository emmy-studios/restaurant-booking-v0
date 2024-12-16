<script setup>

    import { ref, reactive } from "vue";
    import { Link, usePage } from "@inertiajs/vue3";
    import DashboardSidebar from "../Components/DashboardSidebar.vue";

    // User Information
    const { notifications } = usePage().props;

</script>

<template>

    <DashboardSidebar
        :activePage="'Notifications'"
        :pageTitle="'Notifications'"
    >

        <template v-slot:mainContentSlot>

            <h1>User Notifications</h1>

            <p>---------------------------------------</p>

            <ul v-for="notification in notifications" :key="notification.id">
                <li>{{ notification.title }}</li>
                <li>{{ notification.message }}</li>
                <li>{{ notification.notification_type }}</li>
                <li>{{ notification.created_at }}</li>
                <p>++++++++++++++++++++++++++++++++++++++</p>
            </ul>

        </template>

    </DashboardSidebar>

</template>

<style scoped>

</style>
