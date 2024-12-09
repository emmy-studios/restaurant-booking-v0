<script setup>

    import DashboardSidebar from './Components/DashboardSidebar.vue';
    import { ref } from 'vue';
    import { usePage } from '@inertiajs/vue3';
    import { NTimeline, NTimelineItem } from 'naive-ui';

    // Get Current Locale
    const { locale } = usePage().props;
    const currentLocale = locale || 'en';

    // User Order
    const { lastOrderCreated } = usePage().props;
    const status = ref(lastOrderCreated.order_status) || ref('Pending');
    // Get User Information
    const notifications = ref(4);

</script>

<template>

    <DashboardSidebar
        :notifications="notifications"
        :pageTitle="'Order'"
        :activePage="'Order'"
    >

        <template v-slot:mainContentSlot>

            <div class="order-container">

                <div
                    v-if="status === 'Pending' || status === 'Processing' || status === 'Completed'"
                >

                    <div class="timeline-container">

                        <n-timeline horizontal>
      						<n-timeline-item content="Oops" />
      						<n-timeline-item
        						type="success"
        						title="Success"
        						content="Success content"
        						time="2018-04-03 20:46"
      						/>
      						<n-timeline-item
        						type="error"
        						content="Error content"
        						time="2018-04-03 20:46"
      						/>
      						<n-timeline-item
        						type="warning"
        						title="Warning"
        						content="Warning content"
        						time="2018-04-03 20:46"
      						/>
      						<n-timeline-item
        						type="info"
        						title="Info"
        						content="Info content"
        						time="2018-04-03 20:46"
      						/>
    					</n-timeline>

                    </div>

                    <div class="create-order">
                        <p>{{ lastOrderCreated }}</p>
                    </div>

                </div>

                <div v-else>
                    <p>Not Order in Process</p>
                </div>

            </div>

         </template>

    </DashboardSidebar>

</template>

<style scoped>

    .order-container {
        display: flex;
        justify-content: center;
        margin-top: 60px;
    }
    .timeline-container {
        display: flex;
        justify-content: center;
        padding: 20px 20px;
    }

</style>
