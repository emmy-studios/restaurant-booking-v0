<script setup>

    import { reactive, computed } from "vue";
    import { usePage } from "@inertiajs/vue3";
    import DashboardSidebar from "../Components/DashboardSidebar.vue";

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

</script>

<template>

    <DashboardSidebar
        :activePage="'Profile'"
        :pageTitle="localizedPageTitle"
    >

        <template v-slot:mainContentSlot>

            <article class="profile-container">
                <div class="image-profile">
                    <img
                        :src="userData.image_url
                            ? `/storage/${userData.image_url}`
                            : '/assets/images/products/hamburger.png'"
                    >
                </div>
                <div class="information-container">
                    <span>{{ translations.profile.name }}:</span>
                    <p>{{ userData.first_name }} {{ userData.last_name }}</p>
                    <span>{{ translations.profile.email }}:</span>
                    <p>{{ userData.email }}</p>
                    <span>{{ translations.profile.phone_number }}:</span>
                    <p>{{ userData.country_code }} {{ userData.phone_number }}</p>
                    <span>{{ translations.profile.identification_number }}:</span>
                    <p>{{ userData.identification_number }}</p>
                    <span>{{ translations.profile.address }}:</span>
                    <p>{{ userData.address }}</p>
                </div>

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
        padding: 60px 60px;
    }
    .image-profile img {
        width: 100%;
        height: 100%;
        /*padding: 60px 60px;*/
        border-radius: 10px;
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

    @media (max-width: 994px) {
        .profile-container {
            grid-template-columns: 1fr;
            gap: 2px;
        }
    }

</style>
