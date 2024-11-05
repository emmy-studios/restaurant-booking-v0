<script setup>

    import { reactive } from "vue";

    import { usePage, Link } from "@inertiajs/vue3";

    import { NIcon } from "naive-ui";

    import { ArrowCircleLeftFilled } from "@vicons/material";

    const user = reactive(usePage().props.user);
    const currentLocale = reactive(usePage().props.locale);

</script>

<template>

    <form class="main-container">

        <section class="form-container">

            <div class="image-container">
                <img src="https://png.pngtree.com/png-clipart/20230927/original/pngtree-man-avatar-image-for-profile-png-image_13001882.png"/>
                <input type="file"/>
            </div>

            <div class="user-information">

                <h1>My Profile</h1>

                <div class="personal-information">
                    <div class="form-item">
                        <label>NAME</label>
                        <input type="text"/>
                    </div>
                    <div class="form-item">
                        <label>FIRST NAME</label>
                        <input type="text"/>
                    </div>
                    <div class="form-item">
                        <label>LAST NAME</label>
                        <input type="text"/>
                    </div>
                    <div class="form-item">
                        <label>IDENTIFICATION NUMBER</label>
                        <input type="text"/>
                    </div>
                </div>

                <div class="email-information">
                    <label for="email">EMAIL ADDRESS</label>
                    <input type="email"/>
                </div>

                <div class="address-information">
                    <h2>ADDRESS INFORMATION</h2>
                    <p>Some information about the customer address</p>

                    <div class="address-items">
                        <div class="address-item">
                            <label>COUNTRY</label>
                            <select>
                                <option value="us">United States</option>
                                <option value="cr">Costa Rica</option>
                            </select>
                        </div>
                        <div class="address-item">
                            <label>CITY</label>
                            <input type="text"/>
                        </div>
                        <div class="address-item">
                            <label>Address</label>
                            <textarea/>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <aside class="form-actions">
            <!--<button type="button">Back</button>-->
            <Link :href="`/${currentLocale}/dashboard`">
                <n-icon size="40" color="#000">
                    <ArrowCircleLeftFilled/>
                </n-icon>
            </Link>
            <button type="submit">Change</button>
        </aside>

    </form>

</template>

<style scoped>

    .main-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-container {
        display: grid;
        grid-template-columns: 1fr 2fr;
        background-color: #fff;
        gap: 20px;
    }

    .image-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .image-container img {
        width: 200px;
        height: 200px;
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
        border-color: #007bff;
        outline: none;
    }

    .form-item label {
        margin-bottom: 5px;
        font-weight: bold;
    }

    .email-information {
        display: flex;
        flex-direction: column;
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

    /* Buttons */
    .form-actions {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
        padding: 20px;
        gap: 20px;
    }

    button {
        background-color: orange;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .form-container {
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
