<script setup>

    import { ref } from "vue";
    import { useForm, usePage, Link } from "@inertiajs/vue3";

    // Get Current Locale
    const { locale } = usePage().props;
    const currentLocale = locale || 'en';

    // Images path
    const logoPath = "/assets/images/logo/krosty_logo_dark_mode.png";

    // Form Fields
    const form = useForm({
        name: "",
        password: "",
    });

</script>

<template>

    <section class="main-container">

        <div class="form-container">

            <div class="header-container">
                <img :src="logoPath" alt="Krosty Logo" />
                <h1>Welcome Back!</h1>
                <p>Please enter your credentials to continue.</p>
            </div>

            <div class="error-message" v-if="form.errors.name">
                <span>{{ form.errors.name }}</span>
            </div>
            <form
                @submit.prevent="form.post(`/${currentLocale}/authenticate`)"
                method="POST"
            >

                <div class="form-item">
                    <label for="name">Username</label>
                    <input
                        v-model="form.name"
                        id="name"
                        type="text"
                        placeholder="Enter your username"
                    />
                </div>

                <div class="form-item">
                    <label for="password">Password</label>
                    <input
                        v-model="form.password"
                        id="password"
                        type="password"
                        placeholder="Enter your password"
                    />
                </div>

                <div class="button-container">
                    <button
                        id="enter-btn"
                        type="submit"
                        :disabled="form.processing"
                    >
                        Enter
                    </button>
                </div>

                <div class="extra-actions">
                    <a href="#">Forgot password?</a>
                    <span> | </span>
                    <Link :href="`/${currentLocale}/signup`">Register Now!</Link>
                </div>

            </form>
        </div>
    </section>

</template>

<style scoped>

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
    #enter-btn {
        width: 100%;
        padding: 10px 120px;
        border-radius: 5px;
        background-color: #ff7e5f !important;
        color: white;
        transition: background-color 0.3s ease;
    }
    #enter-btn button:hover {
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
    /* Error Message */
    .error-message {
        display: flex;
        justify-content: center;
    }
    .error-message span {
        font-size: 12px;
        color: red;
    }

    /* Responsive Design */
    @media (max-width: 480px) {
        .main-container {
            align-items: flex-start;
        }
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

