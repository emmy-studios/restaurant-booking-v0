<script setup>

</script>

<template>

    <div class="review-container">

        <div class="header-container">
            <h2>Customer Review</h2>
            <hr>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Donec viverra mattis neque at aliquam. Morbi elementum sit
                amet risus varius ultricies. Ut feugiat erat vitae magna
                dignissim, a mollis urna finibus.
            </p>
        </div>

        <div class="review-cards">

            <div class="review-card">
                <div class="review-text">
                    <p>
                        Donec viverra mattis neque at aliquam. Morbi elementum sit
                        amet risus varius ultricies. Ut feugiat erat vitae magna
                        dignissim, a mollis urna finibus.
                    </p>
                </div>
                <div class="customer-review">
                    <div class="customer-info">
                        <img src="assets/images/panels/chef_profile.png">
                        <div class="customer-text">
                            <span>Jon Doe</span>
                            <p>customer</p>
                        </div>
                    </div>
                    <div class="text-decoration">
                        <span>;;</span>
                    </div>
                </div>
            </div>

            <div class="review-card">
                <div class="review-text">
                    <p>
                        Donec viverra mattis neque at aliquam. Morbi elementum sit
                        amet risus varius ultricies. Ut feugiat erat vitae magna
                        dignissim, a mollis urna finibus.
                    </p>
                </div>
                <div class="customer-review">
                    <div class="customer-info">
                        <img src="assets/images/panels/chef_profile.png">
                        <div class="customer-text">
                            <span>Jon Doe</span>
                            <p>customer</p>
                        </div>
                    </div>
                    <div class="text-decoration">
                        <span>;;</span>
                    </div>
                </div>
            </div>

            <div class="review-card">
                <div class="review-text">
                    <p>
                        Donec viverra mattis neque at aliquam. Morbi elementum sit
                        amet risus varius ultricies. Ut feugiat erat vitae magna
                        dignissim, a mollis urna finibus.
                    </p>
                </div>
                <div class="customer-review">
                    <div class="customer-info">
                        <img src="assets/images/panels/chef_profile.png">
                        <div class="customer-text">
                            <span>Jon Doe</span>
                            <p>customer</p>
                        </div>
                    </div>
                    <div class="text-decoration">
                        <span>;;</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</template>

<style scoped>

    .review-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding-top: 20px;
        background-color: #202020;
    }
    .header-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
        padding-top: 50px;
        padding-bottom: 30px;
    }
    .header-container h2 {
        font-weight: bold;
        font-size: 30px;
        color: #fff;
        text-transform: uppercase;
    }
    .header-container hr {
        border: 1px solid orange;
        height: 1px;
        width: 15%;
    }
    .header-container p {
        color: #7f9183;
        max-width: 50%;
        text-align: center;
        padding-top: 10px;
    }
    .review-cards {
        display: flex;
        justify-content: center;
        gap: 20px;
        padding-left: 30px;
        padding-right: 30px;
        padding-bottom: 100px;
    }
    .review-card {
        background-color: #000;
        border-radius: 10px;
    }
    .review-text {
        display: flex;
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 30px;
        padding-bottom: 30px;
    }
    .review-text p {
        color: #fff;
    }
    .customer-review {
        display: flex;
        justify-content: space-between;
        padding-left: 20px;
        padding-right: 10px;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .customer-info {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .customer-info img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
    }
    .customer-text {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .customer-text span{
        color: #fff;
        font-weight: bold;
        font-size: 16px;
    }
    .customer-text p {
        color: #fff;
    }
    .text-decoration span {
        color: orange;
        font-size: 60px;
        font-weight: italic;
    }
    @media (max-width: 902px) {
        .review-cards {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
    }

</style>
