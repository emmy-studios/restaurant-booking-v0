<script setup>

</script>

<template>

    <div class="badge-section">

        <div class="badge-container">
            <div class="badge-image">
                <img src="assets/images/home/first_background_image.png">
            </div>
            <div class="badge-text">
                <h2>FOOD</h2>
                <p>Lorem ipsum dolem it</p>
                <a>Buy Online</a>
            </div>
        </div>

        <div class="badge-container" style="background-color: green;">
            <div class="badge-image">
                <img src="assets/images/home/second_background_image.png">
            </div>
            <div class="badge-text">
                <h2>SNACK</h2>
                <p>Lorem ipsum dolem it</p>
                <a>Buy Online</a>
            </div>
        </div>

        <div class="badge-container" style="background-color: purple;">
            <div class="badge-image">
                <img src="assets/images/home/third_background_image.png">
            </div>
            <div class="badge-text">
                <h2>BEVERAGE</h2>
                <p>Lorem ipsum dolem it</p>
                <a>Buy Online</a>
            </div>
        </div>

    </div>

</template>

<style scoped>

    .badge-section {
        display: flex;
        justify-content: center;
        gap: 30px;
        padding: 80px 30px;
        align-items: center;
        width: 100%;
        height: 50vh;
    }
    .badge-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        background-color: red;
        border-radius: 10px;
        padding: 15px 15px;
    }
    .badge-image {
        display: flex;
        align-items: flex-end;
        justify-content: flex-start;
    }
    .badge-image img {
        max-width: 70px;
        max-height: 70px;
    }
    .badge-text {
        display: flex;
        flex-direction: column;
    }
    .badge-text h2 {
        text-transform: uppercase;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
    }
    .badge-text p {
        color: #fff;
    }
    .badge-text a {
        color: orange;
        padding-top: 4px;
    }

</style>
