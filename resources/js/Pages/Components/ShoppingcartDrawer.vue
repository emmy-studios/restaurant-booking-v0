<script setup>

    import { ref } from 'vue';
    import { Link, usePage } from "@inertiajs/vue3";

    import {
        NButton,
        NIcon,
        NDropdown,
        NDrawer,
        NDrawerContent,
        NFloatButton,
        NBadge
    } from "naive-ui";

    // xicons
    import {
        AccountBoxTwotone,
        ShoppingCartRound,
        AccountCircleFilled,
        AccountCircleOutlined,
        GroupAddFilled,
        MenuFilled,
        EditFilled,
        LogInFilled,
        CloseFilled,
        ExitToAppTwotone,
        LanguageFilled,
        AddBusinessFilled,
        DeleteForeverFilled,
    } from "@vicons/material";

    // Localization Setup
    const { locale } = usePage().props;
    const currentLocale = locale || 'en';

    // Render Icons for Dropdown
    const renderIcon = (icon) => () => h(NIcon, null, {
        default: () => h(icon)
    });

    // Shoppingcart Drawer
    const active = ref(false);
    const placement = ref("right");
    const activate = (place) => {
        active.value = true;
        placement.value = place;
    };

    // Shoppingcart Items
    defineProps({
        shoppingcartProducts: Array,
    });

</script>

<template>

    <n-float-button
        position="relative"
        height="25"
        width="25"
        @click="activate('right')"
    >
        <n-badge
            type="warning"
            :value="shoppingcartProducts.length"
            show-zero
            :offset="[6, -8]"
        >
            <n-icon>
                <ShoppingCartRound />
            </n-icon>
        </n-badge>
    </n-float-button>
    <!-- Shoppingcart Drawer -->
    <n-drawer v-model:show="active" :width="300" :placement="placement">

        <n-drawer-content>
            <!-- header -->
            <template #header>
                <div class="drawer-header">

                    <span>
                        <img
                            class="drawer-image"
                            src="/assets/images/logo/krusty_logo_transparent.png"
                        >
                    </span>
                    <n-button ghost color="#E77917" size="small" @click="active = false">
                        <n-icon color="#E77917">
                            <CloseFilled/>
                        </n-icon>
                    </n-button>
                </div>
            </template>
            <!-- content -->
            <div class="drawer-content" v-if="$page.props.auth.isLoggedIn">

                <div v-if="shoppingcartProducts.length > 0">
                    <div v-for="product in shoppingcartProducts" class="product-grid">
                        <img
                            :src="product.image_url ? `/storage/${product.image_url}` : '/assets/images/products/hamburger.png'"
                        >
                        <p>{{ product.name }}</p>
                        <Link
                            :href="`/${currentLocale}/shoppingcart/remove`"
                            method="post"
                            as="button"
                            :data="{ 'product_id': product.id }"
                        >
                            <n-icon size=20 color="#f02d3a"><DeleteForeverFilled/></n-icon>
                        </Link>
                    </div>
                    <div class="order-actions">
                        <Link
                            id="order-btn"
                            :href="`/${currentLocale}/order/create`"
                            method="post"
                        >
                            Make Order
                        </Link>
                    </div>
                </div>

                <div v-else>
                    <p>No products in Shoppingcart</p>
                </div>

            </div>

            <div
                class="drawer-content"
                v-else
            >
                <p>No products available</p>
            </div>

        </n-drawer-content>

    </n-drawer>

</template>

<style scoped>

    .drawer-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .drawer-content {
        display: flex;
        justify-content: space-around;
    }
    .drawer-image {
        width: 100px;
    }
    .product-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        align-items: center;
        gap: 20px;
        padding-bottom: 10px;
    }
    .product-grid img {
        width: 60px;
        height: 60px;
        border-radius: 5px;
    }
    .order-actions {
        display: flex;
        padding-top: 20px;
        justify-content: center;
        align-items: center;
    }
    #order-btn {
        width: 100%;
        color: #fff;
        padding: 4px 4px;
        background-color: #E77917;
        text-align: center;
        border-radius: 4px;
    }
    #order-btn:hover {
        background-color: #f1b559;
    }

</style>
