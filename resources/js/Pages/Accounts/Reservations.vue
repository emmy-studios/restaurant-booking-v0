<script setup>

    import DashboardSidebar from '../Components/DashboardSidebar.vue';

</script>

<template>

    <DashboardSidebar
        :pageTitle="'Reservations'"
        :activePage="'Reservations'"
    >

        <template v-slot:mainContentSlot>

            <div>User Reservations</div>

        </template>

    </DashboardSidebar>

</template>
