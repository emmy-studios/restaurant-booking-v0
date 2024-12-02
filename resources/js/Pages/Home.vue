<script setup>

    // Translation Setup
    import { usePage } from "@inertiajs/vue3";

    import {
        NButton,
        NCarousel
    } from "naive-ui";

    import Navbar from "./Components/Navbar.vue";
    import Footer from "./Components/Footer.vue";
    import CategoryBadgeSection from './Components/CategoryBadgeSection.vue';

    // Translation Props
    const { translations } = usePage().props;

</script>

<template>

    <Navbar/>

    <header>

        <div class="header-slider">

            <n-carousel show-arrow>
                <!-- First Item -->
                <div class="slider-item">
                    <!-- image -->
                    <div class="slider-image">
                        <img src="assets/images/home/first_background_image.png">
                    </div>
                    <!--- content -->
                    <div class="slider-text">
                        <h1>NEW ORIGINAL RECIPES EVERYDAY</h1>
                        <p>
                            New products with fresh ingredients, a new experience for
                        </p>
                        <p>
                            your delicate taste. Read our customer reviews for more advice.
                        </p>
                        <n-button style="max-width: 100px;">
                            EXPLORE
                        </n-button>
                    </div>
                </div>
                <!-- End First Iitem -->

                <div class="slider-item">
                    <div class="slider-image">
                        <img src="assets/images/home/second_background_image.png">
                    </div>
                    <div class="slider-text">
                        <h1>
                            Explore our veggie and healthy food
                        </h1>
                        <p>
                            Our vegan menu is prepared with the best and freshest ingredients
                        </p>
                        <p>
                            only for the most experimented tastes.
                        </p>
                    </div>
                </div>

                <div class="slider-item">
                    <div class="slider-image">
                        <img src="assets/images/home/third_background_image.png">
                    </div>
                    <div class="slider-text">
                        <h1>
                            Exquisit and delicate desserts for you!
                        </h1>
                        <p>
                            Get the most delicious and delicate desserts and
                        </p>
                        <p>
                            complement your experience with us.
                        </p>
                    </div>
                </div>

            </n-carousel>

        </div>

    </header>

    <main>

        <section class="category-section">
            <CategoryBadgeSection/>
        </section>

        <section style="height: 100vh; background-color: #000;"></section>

    </main>

    <Footer/>

</template>

<style scoped>

    /* Slider */
    .header-slider {
        /*background-color: #181C14;*/
        background-color: #000;
        color: #fff;
        height: 70vh;
    }
    .slider-item {
        display: grid;
        grid-template-columns: 1fr 2fr;
    }
    /* First Slider */
    .slider-image {
        display: flex;
        justify-content: center;
    }
    .slider-image img {
        height: 65vh;
    }
    .slider-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 30px 10px;
        gap: 4px;
    }
    .slider-text h1 {
        font-weight: bold;
        text-transform: uppercase;
        font-size: 3rem;
    }
    .slider-text p {
        color: gray;
    }
    /* Second Slider */


    @media(max-width: 768px) {
        .slider-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .slider-image {
            padding-top: 20px;
        }
        .slider-image img{
            height: 30vh;
        }
        .slider-text h1 {
            font-size: 16px;
        }
        .slider-text p {
            font-size: 10px;
        }
    }

    /* Main Section */
    .main-section {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 400px;
    }
    /* Category Badges Section */
    .category-section {
        background-color: #000;
        border-bottom: 1px solid orange;
        padding-bottom: 20px;
    }

</style>
