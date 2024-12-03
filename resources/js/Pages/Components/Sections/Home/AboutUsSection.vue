<script setup>

    import { NButton } from 'naive-ui';

</script>

<template>

    <div class="about-container">
        <div class="about-image">
            <img src="assets/images/home/about_us.jpg">
        </div>
        <div class="about-description">
            <h2>Find your best tasted food and drink just in one place</h2>
            <hr>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Quisque eleifend, augue vitae volutpat sollicitudin, nulla
                magna mattis odio, in vestibulum mauris nisl eu nulla. Integer
                mattis hendrerit odio a venenatis. Sed nec nibh odio.
                Maecenas dui augue, accumsan vitae enim in, porttitor dignissim ipsum.
                Aliquam ornare mauris in dui tempor consectetur.
            </p>
            <div class="contact-info">

            </div>
            <n-button type="primary">Contact Us</n-button>
        </div>
    </div>

</template>

<style scoped>

    .about-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        padding-left: 40px;
        padding-right: 40px;
        padding-top: 100px;
        padding-bottom: 40px;
        background-color: #000;
        border-top: 1px solid #fff;
    }
    .about-image {
        display: flex;
        justify-content: center;
        padding-left: 40px;
        padding-right: 40px;
        padding-bottom: 40px;
    }
    .about-image img {
        border-radius: 10px;
    }
    .about-description {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .about-description h2 {
        font-weight: bold;
        font-size: 30px;
        color: #fff;
    }
    .about-description p {
        color: #fff;
    }
    .about-description hr {
        width: 17%;
    }
    .about-description button {
        width: 150px;
    }

    @media (max-width: 1060px) {
        .about-container {
            display: grid;
            grid-template-columns: 1fr;
        }
    }

</style>
