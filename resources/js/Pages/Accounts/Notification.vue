<script setup>

    import { usePage } from "@inertiajs/vue3";
    import DashboardSidebar from "../Components/DashboardSidebar.vue";

    const { notificationDetails } = usePage().props;

</script>

<template>

    <DashboardSidebar
        :activePage="'Notification Details'"
        :pageTitle="'Notification Details'">

        <template v-slot:mainContentSlot>

            <h1>{{ notificationDetails.title }}</h1>
            <h2>{{ notificationDetails.created_at }}</h2>
            <p>{{ notificationDetails.message }}</p>

        </template>

    </DashboardSidebar>

</template>

<style scoped>

</style>
