<script setup>

    import { ref, reactive } from "vue";
    import { Link, usePage } from "@inertiajs/vue3";
    import DashboardSidebar from "../Components/DashboardSidebar.vue";

    // User Information
    const user = reactive(usePage().props.user);

</script>

<template>

    <DashboardSidebar :activePage="'Profile'" :pageTitle="'Profile'">

        <template v-slot:mainContentSlot>

            <h1>User Personal Information</h1>
            <h2>Welcome Back, {{ user.name }}</h2>
            <p>{{ user.email }}</p>

        </template>

    </DashboardSidebar>

</template>

<style scoped>

</style>
