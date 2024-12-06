<script setup>

    import { NIcon } from 'naive-ui';
    import { FacebookFilled } from '@vicons/material';

</script>

<template>

    <footer class="footer-container">

        <div class="social-items">
            <div class="logo-container">
                <img src="/assets/images/logo/krosty_logo_dark_mode.png">
            </div>
            <div class="social-links">
                <p>Follow Us:</p>
                <n-icon size=20 color="#f77f00"><FacebookFilled/></n-icon>
                <n-icon size=20 color="#f77f00"><FacebookFilled/></n-icon>
                <n-icon size=20 color="#f77f00"><FacebookFilled/></n-icon>
                <n-icon size=20 color="#f77f00"><FacebookFilled/></n-icon>
            </div>
        </div>

        <div class="info-container">
            <div class="about-info">
                <h2>About Us</h2>
                <p>(+506) 78908765</p>
                <p>Auburn, EEUU</p>
                <p>
                    3098 Randolph Street.
                </p>
            </div>
            <div class="website-info">
                <h2>Explore</h2>
                <a>Home</a>
                <a>Products</a>
                <a>Contact Us</a>
            </div>
            <div class="news-info">
                <h2>Recent News</h2>
                <a>News Title Here</a>
                <a>News Title Here</a>
                <a>News Title Here</a>
            </div>
        </div>

        <div class="footer-message">
            <p>©2024 All Rights Reserved | Krosty Website</p>
        </div>

    </footer>

</template>

<style scoped>

    .footer-container {
        display: flex;
        flex-direction: column;
        width: 100%;
        background-color: #000;
        padding-top: 60px;
        padding-bottom: 20px;
        padding-left: 20px;
        padding-right: 20px;
        gap: 30px;
    }
    .social-items {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 20px;
        border-bottom: 1px solid #fff;
    }
    .logo-container {
        display: flex;
    }
    .logo-container img {
        width: 150px;
        height: 50px;
    }
    .social-links {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
        color: #fff;
    }
    .info-container {
        display: grid;
        padding-top: 20px;
        grid-template-columns: 1fr 1fr 1fr;
    }
    .info-container h2 {
        color: #f77f00;
        font-size: 20px;
    }
    .about-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }
    .about-info p {
        color: #fff;
        align-self: center;
    }
    .website-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }
    .website-info a {
        color: #fff;
    }
    .news-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }
    .news-info a {
        color: #fff;
    }
    .footer-message {
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 20px;
    }
    .footer-message p {
        color: #fff;
    }
    @media (max-width: 768px) {
        .info-container {
            display: flex;
            flex-direction: column;
        }
        .social-items {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }
    }
</style>
