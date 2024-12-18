<script setup>

    import DashboardSidebar from '../Components/DashboardSidebar.vue';

</script>

<template>

    <DashboardSidebar
        :pageTitle="'Analytics'"
        :activePage="'Analytics'"
    >

        <template v-slot:mainContentSlot>

            <div>User Stats</div>

        </template>

    </DashboardSidebar>

</template>
