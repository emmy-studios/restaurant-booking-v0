<script setup>

    import DashboardSidebar from '../Components/DashboardSidebar.vue';

</script>

<template>

    <DashboardSidebar
        :pageTitle="'Invoices'"
        :activePage="'Invoices'"
    >

        <template v-slot:mainContentSlot>

            <div>User Invoices</div>

        </template>

    </DashboardSidebar>

</template>
