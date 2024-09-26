<template>

    <h1>About Us</h1>
    <p>{{ name }} {{ last_name }}</p>

</template>

<script>

    export default {
        props: {
            'name': String,
            'last_name': String,
        },
    };

</script>