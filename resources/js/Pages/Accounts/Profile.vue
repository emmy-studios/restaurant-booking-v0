<script setup>

    import { reactive, computed, ref } from "vue";
    import { usePage } from "@inertiajs/vue3";
    import DashboardSidebar from "../Components/DashboardSidebar.vue";
    import { NIcon } from 'naive-ui';
    import { CheckCircleFilled } from '@vicons/material';
    import { Doughnut } from 'vue-chartjs';
    import {
        Chart as ChartJS,
        Title,
        Tooltip,
        Legend,
        ArcElement,
    } from 'chart.js';

    const props = defineProps({
        translations: {
            type: Object,
            required: true
        },
        user: {
            type: Object,
            required: true,
        },
        locale: {
            type: String,
            required: true,
        },
    });

    const userData = reactive(props.user);

    // Translate Slot Props
    const localizedActivePage = computed(() => {
        return props.translations.profile.dashboard || 'Profile';
    });

    const localizedPageTitle = computed(() => {
        return props.translations.profile.profile || 'Dashboard';
    });

    // Charts
    ChartJS.register(Title, Tooltip, Legend, ArcElement);

    const chartData = ref({
        //labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
        datasets: [
            {
                label: 'Orders',
                data: [12, 19, 3, 5, 2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }
        ]
    });

    const chartOptions = ref({
        responsive: true,
        plugins: {
            legend: {
                position: 'top'
            },
            title: {
                display: true,
                text: 'Total Orders Made'
            }
        },
        cutout: '30%',
        maintainAspectRatio: false,
    });

</script>

<template>

    <DashboardSidebar
        :activePage="'Profile'"
        :pageTitle="localizedPageTitle"
    >

        <template v-slot:mainContentSlot>

            <section class="profile-container">
                <article class="profile-card">
                    <div class="card-image">
                        <img
                            :src="user.image_url ? `/storage/${user.image_url}` : '/assets/images/panels/admin.svg'"
                        >
                    </div>
                    <div class="card-container">
                        <div class="name-container">
                            <h2>{{ user.first_name }} {{ user.last_name }}</h2>
                            <span>{{ user.role }}</span>
                            <n-icon size=20 color="green">
                                <CheckCircleFilled/>
                            </n-icon>
                        </div>
                        <div class="container-item">
                            <h3>Email: </h3>
                            <p>{{ user.email }}</p>
                        </div>
                        <div class="container-item">
                            <h3>Phone: </h3>
                            <p>{{ user.country_code }} {{ user.phone_number }}</p>
                        </div>
                        <div class="container-item">
                            <h3>Identification Number: </h3>
                            <p>{{ user.identification_number }}</p>
                        </div>
                        <div class="container-item">
                            <h3>Birth: </h3>
                            <p>{{ user.birth }}</p>
                        </div>
                        <div class="container-item">
                            <h3>Gender: </h3>
                            <p>{{ user.gender }}</p>
                        </div>
                    </div>
                </article>
                <article class="address-card">
                    <div class="address-information">
                        <h2>Shipping Address</h2>
                        <div class="info-item">
                            <p>{{ user.city }} |</p>
                            <p>{{ user.country }}</p>
                        </div>
                        <div class="info-item">
                            <span>Postal Code:</span>
                                <p>{{ user.postal_code }}</p>
                        </div>
                        <div class="info-item">
                            <p>{{ user.address }}</p>
                        </div>
                    </div>
                </article>
            </section>

            <section class="charts-row">
                <article class="first-chart">

                    <!--<Doughnut
                        id="my-chart-id"
                        :options="chartOptions"
                        :data="chartData"
                    />-->

                </article>
                <article class="second-chart">

                    <!--<Doughnut
                        id="my-chart-id"
                        :options="chartOptions"
                        :data="chartData"
                    />-->

                </article>
            </section>

        </template>

    </DashboardSidebar>

</template>

<style scoped>

    /* FIRST ROW */
    .profile-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 10px;
    }
    /* FIRST ROW */
    /* PROFILE CARD */
    .profile-card {
        margin-top: 60px;
        display: flex;
        padding: 20px 20px;
        border-radius: 10px;
        background-color: #f9f9f9;
    }
    .card-image {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card-image img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
    }
    .card-container {
        display: flex;
        flex-direction: column;
        padding-left: 10px;
        gap: 10px;
    }
    .name-container {
        display: flex;
        gap: 10px;
        padding-left: 20px;
        align-items: center;
    }
    .name-container h2 {
        font-weight: bold;
        font-size: 18px;
    }
    .name-container span {
        font-size: 12px;
        color: #fff;
        padding: 4px 4px;
        background-color: #ef8354;
        border-radius: 5px;
    }
    .container-item {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding-left: 20px;
        align-items: center;
    }
    .container-item h3 {
        font-weight: bold;
        color: #432818;
    }
    .container-item p {
        color: #262a10;
    }
    /* PROFILE CARD */

    /* ADDRESS CARD */
    .address-card {
        margin-top: 60px;
        display: flex;
        /*width: 60%;*/
        padding: 30px 30px;
        border-radius: 10px;
        background-color: #f5ebe0;
    }
    .address-information {
        display: flex;
        flex-direction: column;
        gap: 6px;
        width: 100%;
    }
    .address-information h2 {
        font-weight: bold;
        font-size: 16px;
        padding-bottom: 4px;
        border-bottom: 1px solid #ddb892;
    }
    .info-item {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding-top: 6px;
        align-items: center;
    }
    .info-item p {
        color: #432818;
    }
    /* ADDRESS CARD */

    /* CHARTS ROW */
    .charts-row {
        display: flex;
        margin-top: 60px;
        /*grid-template-columns: 1fr 1fr;*/
    }
    .first-chart {
        display: flex;
        align-items: center;
        justify-content: center;
        /*max-width: 30%;*/
    }
    .second-chart {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    /* CHARTS ROW */

    @media (max-width: 1041px) {
        .profile-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2px;
        }
        .profile-card {
            display: flex;
            flex-direction: column;
        }
        .card-image {
            padding-bottom: 10px;
        }
        .name-container {
            display: flex;
            flex-direction: column;
        }
        .container-item {
            padding-left:0px;
        }
        .address-card {
            margin-top: 2px;
        }
        .charts-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }
    }

</style>
