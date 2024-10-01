<template>

    <h1>Are you a member of our organization?</h1>
    <h2>Choose your role and login</h2>

    <p>{{ counter }}</p>

</template>

<script setup>

    import { ref } from 'vue';

    const counter = ref(0);

</script>