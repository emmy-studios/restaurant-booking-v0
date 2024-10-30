<script setup>

    import { useForm, usePage, Link } from '@inertiajs/vue3';

    import { ref } from "vue";

    import {
        NButton
    } from "naive-ui";

    // Get Current Locale
    const { locale } = usePage().props;
    const currentLocale = locale || 'en';

    // Images path
    const logoPath = '/assets/images/logo/krosty_logo_dark_mode.png';

    // Form Fields
    const form = useForm({
        name: null,
        email: null,
        password: null,
        confirmPassword: null,
    });

    // Submit Form
    form.post(`/${currentLocale}/register`, {
        preserveScroll: true,
        //onSuccess: () => form.reset('password'),
    });

</script>

<template>

    <section class="main-container">

        <div class="form-container">

            <div class="header-container">
                <img :src="logoPath" alt="Krosty Logo" />
                <h1>Create an Account</h1>
                <!--<p>Please enter your credentials to continue.</p>-->
            </div>

            <form @submit.prevent="form.post(`/${currentLocale}/register`)" method="POST">

                <div class="form-item">
                    <label for="name">Username</label>
                    <input
                        v-model="form.name"
                        id="name"
                        type="text"
                        placeholder="Enter your username"
                        required
                    />
                </div>
                <!-- username errors -->
                <!--<div v-if="form.errors.name">{{ form.errors.name }}</div>-->

                <div class="form-item">
                    <label for="email">Email</label>
                    <input
                        v-model="form.email"
                        id="email"
                        type="email"
                        placeholder="Enter your email"
                        required
                    />
                </div>
                <!-- email errors -->
                <!--<div v-if="form.errors.email">{{ form.errors.email }}</div>-->

                <div class="form-item">
                    <label for="password">Password</label>
                    <input
                        v-model="form.password"
                        id="password"
                        type="password"
                        placeholder="Enter your password"
                        required
                    />
                </div>
                <!-- password errors -->
                <!--<div v-if="form.errors.password">{{ form.errors.password }}</div>-->

                <div class="form-item">
                    <label for="confirmPassword">Confirm Password</label>
                    <input
                        v-model="form.confirmPassword"
                        id="confirmPassword"
                        type="password"
                        placeholder="Confirm your password"
                        required
                    />
                </div>

                <div class="button-container">
                    <button
                        type="submit"
                        :disabled="form.processing"
                    >
                        Create
                    </button>
                </div>

                <div class="extra-actions">
                    <Link :href="`/${currentLocale}/login`">Have an Account?</Link>
                </div>

            </form>
        </div>
    </section>

</template>

<style scoped>
    /* General Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        font-family: 'Inter', sans-serif;
    }

    .main-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #ff7e5f, #feb47b);
        padding: 20px;
    }

    /* Form Container */
    .form-container {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 40px;
        width: 100%;
        max-width: 400px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Header Section */
    .header-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 10px;
    }

    .header-container h1 {
        font-weight: 700;
        font-size: 1.8rem;
        color: #333;
    }

    .header-container p {
        color: #777;
        font-size: 0.9rem;
    }

    .header-container img {
        width: 90px;
        height: auto;
    }

    /* Form Items */
    .form-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
        margin-top: 15px;
    }

    .form-item label {
        font-weight: 600;
        color: #444;
    }

    .form-item input {
        height: 2.5rem;
        padding: 0 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        transition: border-color 0.3s ease;
    }

    .form-item input:focus {
        border-color: #ff7e5f;
        outline: none;
        background-color: #fff;
    }

    /* Button */
    .button-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 10px;
    }

    .button-container button {
        background-color: #ff7e5f !important;
        padding: 5px 150px;
        border-radius: 5px;
        color: white;
        transition: background-color 0.3s ease;
    }

    .button-container button:hover {
        background-color: #e06c50 !important;
    }

    /* Extra Actions */
    .extra-actions {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-top: 15px;
        font-size: 0.85rem;
    }

    .extra-actions a {
        color: #ff7e5f;
        text-decoration: none;
    }

    .extra-actions a:hover {
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 480px) {
        .form-container {
            padding: 20px;
        }

        .header-container h1 {
            font-size: 1.5rem;
        }

        .form-item input {
            height: 2.2rem;
        }
    }
</style>
