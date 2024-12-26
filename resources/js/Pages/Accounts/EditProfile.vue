<script setup>

    import { computed, defineProps, reactive } from "vue";
    import { usePage, Link, useForm } from "@inertiajs/vue3";
    import { NIcon } from "naive-ui";
    import { ArrowCircleLeftFilled } from "@vicons/material";

    import DashboardSidebar from "../Components/DashboardSidebar.vue";

    const props = defineProps([
        'locale',
        'user',
        'countries',
        'countryCodes',
        'genderOptions',
        'errors',
    ]);
    const user = computed(() => {
        return props.user ? props.user : [];
    });

    const countries = computed(() => {
        return props.countries ? props.countries : [];
    });
    const genderOptions = computed(() => {
        return props.genderOptions ? props.genderOptions : [];
    });
    const countriyCodes = computed(() => {
        return props.countryCodes ? props.countryCodes : [];
    });
    const currentLocale = computed(() => {
        return props.locale ? props.locale : 'en';
    });
    const errors = computed(() => props.errors ?? {});

    // Form Test
    const form = useForm({
        username: user.value.name,
        firstName: user.value.first_name,
        lastName: user.value.last_name,
        email: user.value.email,
        birth: user.value.birth,
        gender: user.value.gender,
        identificationNumber: user.value.identification_number,
        phoneCode: user.value.country_code,
        phoneNumber: user.value.phone_number,
        postalCode: user.value.postal_code,
        city: user.value.city,
        country: user.value.country,
        address: user.value.address,
    });

</script>

<template>

    <DashboardSidebar
        :activePage="'Edit Profile'"
        :pageTitle="'Edit Profile'"
        :notifications="0">

        <template v-slot:mainContentSlot>

            <form class="main-container" @submit.prevent="form.post(`/${currentLocale}/edit-profile/save`)">
        		<section class="form-container">

            		<div class="image-container">
                	    <img
                            :src="user.image_url ? `/storage/${user.image_url}` : '/assets/images/panels/admin.svg'"
                        >
                        <input type="file"/>
            		</div>

            		<div class="user-information">

                		<h1>My Profile</h1>

                		<div class="personal-information">
                    		<div class="form-item">
                        		<label>NAME</label>
                                <input type="text" v-model="form.username"/>
                                <div class="error-message" v-if="form.errors.username">
                                    {{ form.errors.username }}
                                </div>
                    		</div>
                    		<div class="form-item">
                        		<label>FIRST NAME</label>
                        		<input type="text" v-model="form.firstName"/>
                    		</div>
                    		<div class="form-item">
                        		<label>LAST NAME</label>
                        		<input type="text" v-model="form.lastName"/>
                    		</div>
                    		<div class="form-item">
                        		<label>IDENTIFICATION NUMBER</label>
                        		<input type="text" v-model="form.identificationNumber"/>
                    		</div>
                            <div class="form-item">
                        		<label>PHONE CODE</label>
                            	<select v-model="form.phoneCode">
                                    <option v-for="(code, index) in countryCodes" :key="index" :value="code">
                                        {{ code }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-item">
                        		<label>PHONE NUMBER</label>
                        		<input type="text" v-model="form.phoneNumber"/>
                                <div class="error-message" v-if="form.errors.phoneNumber">
                                    {{ form.errors.phoneNumber }}
                                </div>
                    		</div>
                            <div class="form-item">
                        		<label>POSTAL CODE</label>
                        		<input type="text" v-model="form.postalCode"/>
                    		</div>
                            <div class="form-item">
                        		<label>EMAIL</label>
                        		<input type="email" v-model="form.email"/>
                                <div class="error-message" v-if="form.errors.email">
                                    {{ form.errors.email }}
                                </div>
                    		</div>
                            <div class="form-item">
                        		<label>BIRTH</label>
                        		<input type="date" v-model="form.Birth"/>
                    		</div>
                            <div class="form-item">
                        		<label>GENDER</label>
                            	<select v-model="form.gender">
                                    <option v-for="(gender, index) in genderOptions" :key="index" :value="gender">
                                        {{ gender }}
                                    </option>
                                </select>
                            </div>
                		</div>

                		<div class="address-information">
                    		<h2>ADDRESS INFORMATION</h2>
                    		<p>Some information about the customer address</p>

                    		<div class="address-items">
                        		<div class="address-item">
                            		<label>COUNTRY</label>
                            	    <select v-model="form.country">
                                        <option v-for="country in countries" :key="country" :value="country">
                                            {{ country }}
                                        </option>
                                    </select>
                        		</div>
                        		<div class="address-item">
                            		<label>CITY</label>
                            		<input type="text" v-model="form.city"/>
                                    <div class="error-message" v-if="form.errors.city">
                                        {{ form.errors.city }}
                                    </div>
                        		</div>
                        		<div class="address-item-info">
                            		<label>ADDRESS</label>
                                    <textarea rows="6" v-model="form.address"></textarea>
                                    <div class="error-message" v-if="form.errors.address">
                                        {{ form.errors.address }}
                                    </div>
                        		</div>
                    		</div>
                		</div>

            		</div>

        		</section>

        		<aside class="form-actions">
            		<Link :href="`/${currentLocale}/dashboard`">
                		<n-icon size="40" color="#000">
                    		<ArrowCircleLeftFilled/>
                		</n-icon>
            		</Link>

                    <button id="save-btn" type="submit" :disabled="form.processing">
                        SAVE
                    </button>
        		</aside>
    		</form>

        </template>

    </DashboardSidebar>

</template>

<style scoped>

    .main-container {
        margin-top: 60px;
        display: flex;
        flex-direction: column;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
    }
    .form-container {
        display: grid;
        grid-template-columns: 1fr 2fr;
        background-color: #f9f9f9;
        gap: 20px;
    }
    .image-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    .image-container img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
    }
    .user-information {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .user-information h1 {
        font-weight: bold;
        font-size: 24px;
        margin-bottom: 10px;
        padding-top: 30px;
    }
    .personal-information {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    .form-item {
        display: flex;
        flex-direction: column;
    }
    /* Inputs and Forms */
    input,
    textarea,
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s;
    }
    input:focus,
    textarea:focus,
    select:focus {
        border-color: #E77917;
        outline: none;
    }
    .form-item label {
        margin-bottom: 5px;
        font-weight: bold;
    }
    .address-information {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
    }
    .address-information h2 {
        font-weight: bold;
    }
    .address-information p {
        padding-bottom: 20px;
    }
    /* Address Section */
    .address-items {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    .address-item {
        display: flex;
        flex-direction: column;
        margin-top: 10px;
    }
    .address-item-info {
        grid-column-start: 1;
        grid-column-end: span 2;
        display: flex;
        flex-direction: column;
        margin-top: 10px;
        width: 100%;
    }
     /* Form Actions */
    .form-actions {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        gap: 20px;
    }
    #save-btn {
        background-color: #E77917;
        padding: 10px 20px;
        color: #fff;
        font-weight: bold;
        border-radius: 5px;
    }
    #save-btn:hover {
        background-color: #f1b559;
    }
    .error-message {
        padding-top: 2px;
        color: red;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .form-container {
            grid-template-columns: 1fr;
        }
        .personal-information {
            grid-template-columns: 1fr;
        }
        .address-items {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
            gap: 10px;
        }
    }

</style>
