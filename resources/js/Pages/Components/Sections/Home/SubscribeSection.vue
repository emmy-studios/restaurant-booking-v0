<script setup>

    import { NButton } from 'naive-ui';

</script>

<template>

    <div class="subscribe-container">
        <div class="subscribe-title">
            <h2>Get Exclusive Update</h2>
            <p>
                Lorem ipsum dolerum notre damun.
            </p>
        </div>
        <div class="action-buttons">
            <input/>
            <n-button type="primary">Subscribe Now</n-button>
        </div>
    </div>

</template>

<style scoped>

    .subscribe-container {
        height: 30vh;
        background-color: orange;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }
    .subscribe-title h2 {
        font-weight: bold;
        text-transform: uppercase;
        color: #000;
        font-size: 30px;
    }
    .subscribe-title p {
        color: #fff;
    }
    .action-buttons {
        display: flex;
        gap: 10px;
    }

</style>
