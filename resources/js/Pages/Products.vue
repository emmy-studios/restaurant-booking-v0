<script setup>

    import { ref } from 'vue';
    import Navbar from "./Components/Navbar.vue";
    import Footer from "./Components/Footer.vue";
    import { usePage, useForm, Link, router } from '@inertiajs/vue3';
    import { NButton } from 'naive-ui';

    const { products, categories, locale, shoppingcartProducts } = usePage().props;
    const currentLocale = locale || 'en';
    // Search Bar
    const searchTerm = ref('');
    const tagChoose = ref('');

    // Pagination
    const navigate = (url) => {
        router.get(url);
    };

</script>

<template>

    <Navbar :customerProducts="shoppingcartProducts"/>

    <section class="main-container">

        <div class="products-header">
            <h2>Our Products</h2>
            <p>The Most Popular</p>
        </div>

        <div class="searchbar-container">
            <input
                name="searchTerm"
                v-model="searchTerm"
                placeholder="Search For a Product"
            />
            <Link
                class="search-btn"
                :href="`/${currentLocale}/products`"
                :data="{ 'searchTerm': searchTerm }"
            >
                Search
            </Link>
        </div>

        <div class="categories-tags">
            <div v-for="category in categories" :key="category.id">
                <!--<n-button color="#6b9080" type="primary">{{ category.name }}</n-button>-->

                <Link
                    :href="`/${currentLocale}/products`"
                    :data="{ 'tagChoose': category.name }"
                    class="search-btn"
                >
                    {{ category.name }}
                </Link>

            </div>
        </div>

        <span style="color: #fff;">{{ tag }}</span>

        <div class="product-grid">

            <div class="product-card" v-for="product in products.data" :key="product.id">
                <!--<div class="image-container">
                    <img :src="product.image_url ? `/storage/${product.image_url}` : '/assets/images/products/hamburger.png'" >
                </div>-->
                <div class="product-info">
                    <p>{{ product.name }}</p>
                </div>
                <div class="action-buttons">
                    <n-button color="#cca43b">Details</n-button>
                </div>
            </div>

        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <button
                v-for="link in products.links"
                :key="link.url"
                :disabled="!link.url"
                @click="navigate(link.url)"
                v-html="link.label"
                :class="{ 'active': link.active }"
            ></button>
        </div>

    </section>

    <Footer/>

</template>

<style scoped>

    .main-container {
        display: flex;
        flex-direction: column;
        background-color: #000;
    }
    .products-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        padding-top: 100px;
    }
    .products-header h2 {
        color: orange;
        font-size: 20px;
    }
    .products-header p {
        color: #fff;
        font-size: 28px;
    }
    .searchbar-container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 30px;
        gap: 5px;
    }
    .searchbar-container input {
        height: 32px;
        padding-left: 4px;
    }
    .search-btn {
        padding: 6px 4px;
        background-color: #ff9505;
        color: #fff;
        border-radius: 2px;
    }
    .search-btn:hover {
        background-color: #ffc971;
    }
    .categories-tags {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        padding-top: 30px;
        gap: 10px;
    }
    .product-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        padding-top: 80px;
        padding-left: 30px;
        padding-right: 30px;
        gap: 40px;
    }
    .product-card {
        display: flex;
        flex-direction: column;
    }
    .image-container {
        display: flex;
        height: 300px;
        width: 100%;
    }
    .image-container img {
        height: 100%;
        width: 100%;
    }
    .product-info {
        display: flex;
        background-color: #fff;
        align-items: center;
        padding-top: 20px;
        padding-bottom: 10px;
        height: 20%;
        padding-left: 10px;
    }
    .product-card p {
        color: #000;
        font-size: 20px;
    }
    .action-buttons {
        display: flex;
        padding-left: 10px;
        padding-bottom: 10px;
        padding-bottom: 20px;
        padding-top: 20px;
        background-color: #fff;
    }
    .pagination-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        padding-right: 20px;
        height: 40%;
        background-color: #000;
        color: #fff;
    }
    @media (max-width: 768px) {
        .product-grid {
            display: grid;
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 996px) {
        .product-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
    }

</style>
