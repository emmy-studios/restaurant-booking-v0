<script setup>

</script>

<template>

    <div class="discount-container">

        <div class="discount-card">
            <div class="discount-paragraph">
                <span>Payday promo</span>
                <h2>Get 10% Discount On Payday Week</h2>
                <p>
                    Lorem ipsum dolerum ipsum notre damun.
                </p>
                <span>Buy Online</span>
            </div>
            <div class="discount-image">
                <img src="assets/images/home/first_background_image.png">
            </div>
        </div>

        <div class="discount-card">
            <div class="discount-paragraph">
                <span>Payday promo</span>
                <h2>Get 10% Discount On Payday Week</h2>
                <p>
                    Lorem ipsum dolerum ipsum notre damun.
                </p>
                <span>Buy Online</span>
            </div>
            <div class="discount-image">
                <img src="assets/images/home/second_background_image.png">
            </div>
        </div>

    </div>

</template>

<style scoped>

    .discount-container {
        display: flex;
        justify-content: center;
        padding: 100px 30px;
        gap: 20px;
        /*height: 80vh;*/
        border-bottom: 1px solid #fff;
    }
    .discount-card {
        background-color: #212529;
        display: grid;
        grid-template-columns: 1fr 1fr;
        padding: 10px 10px;
        border-radius: 10px;
    }
    .discount-paragraph {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 10px;
        padding: 10px 10px;
    }
    .discount-paragraph h2 {
        color: #fff;
        font-size: 26px;
        font-weight: bold;
        text-transform: uppercase;
    }
    .discount-paragraph p {
        color: #cfdbd5;
    }
    .discount-paragraph span {
        color: orange;
    }
    .discount-image {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .discount-image img {
        /*max-width: 300px;
        max-height: 300px;*/
        width: 300px;
        height: 300px;
        object-fit: cover;
    }

    @media (max-width: 1082px) {
        .discount-container {
            display: flex;
            flex-direction: column;
            padding: 10px 20px;
        }
        .discount-card {
            display: flex;
            flex-direction: column;
        }
        .discount-paragraph {
            justify-content: center;
        }
        .discount-image img {
            /*width: 150px;
            height: 200px;*/
        }
    }
    @media (max-width: 768px) {
        .discount-container {
            display: flex;
            flex-direction: column;
            padding: 20px 30px;
        }
        .discount-card {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .discount-paragraph h2{
            font-size: 16px;
        }
    }

</style>
