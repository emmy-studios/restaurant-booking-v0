<script setup>

    // Translation Setup
    import { usePage } from "@inertiajs/vue3";

    import {
        NButton,
        NCarousel
    } from "naive-ui";

    import Navbar from "./Components/Navbar.vue";
    import Footer from "./Components/Footer.vue";

    // Translation Props
    const { translations } = usePage().props;

</script>

<template>

    <Navbar/>

    <header>

        <div class="header-slider">

            <n-carousel show-arrow>

                <div class="slider-item">
                    <p>{{ translations.home }}</p>
                </div>

                <div class="slider-item">
                    <p>
                        lorem ipsum dolerum ipsum notre damum.
                    </p>
                </div>

                <div class="slider-item">
                    <p>
                        lorem ipsum nosem.
                    </p>
                </div>

            </n-carousel>

        </div>

    </header>

    <main>

        <section class="main-section">
            <h1>HOME PAGE</h1>
        </section>

    </main>

    <Footer/>

</template>

<style scoped>

    .header-slider {
        background-color: #000;
        color: #fff;
        height: 70vh;
    }

    .slider-item {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .carousel-img {
        width: 100%;
        height: 240px;
        object-fit: cover;
    }

    .main-section {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 400px;
    }

</style>
