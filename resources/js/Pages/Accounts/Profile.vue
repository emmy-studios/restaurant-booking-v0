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

            <article class="profile-container">
                <div class="image-profile">
                    <img
                        :src="user.image_url ? `/storage/${user.image_url}` : '/assets/images/products/hamburger.png'"
                    >
                </div>
                <div class="information-container">
                    <span>Name:</span>
                    <p>{{ user.first_name }} {{ user.last_name }}</p>
                    <span>Email:</span>
                    <p>{{ user.email }}</p>
                    <span>Phone Number:</span>
                    <p>{{ user.country_code }} {{ user.phone_number }}</p>
                    <span>Identification Number:</span>
                    <p>{{ user.identification_number }}</p>
                    <span>Address:</span>
                    <p>{{ user.address }}</p>
                </div>


                <!--<div>{{ user }}</div>-->
            </article>

        </template>

    </DashboardSidebar>

</template>

<style scoped>

    .profile-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        margin: 60px 20px;
        padding: 20px 20px;
	    background-color: #F9F9F9;
        border-radius: 10px;
    }
    .image-profile {
        display: flex;
        justify-self: center;
        align-items: center;
    }
    .image-profile img {
        width: 200px;
        height: 200px;
    }
    .information-container {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding-top: 20px;
    }
    .information-container span {
        font-weight: bold;
        font-size: 20px;
    }

    @media (max-width: 768px) {
        .profile-container {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }

</style>
