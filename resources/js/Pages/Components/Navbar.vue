<script setup>

    import { ref, h, onMounted, onBeforeUnmount } from "vue";

    import ShoppingcartDrawer from './ShoppingcartDrawer.vue';

    import { Link, usePage } from "@inertiajs/vue3";
    import { router } from "@inertiajs/vue3";

    import {
        NButton,
        NIcon,
        NDropdown,
        NFloatButton,
        NBadge
    } from "naive-ui";

    // xicons
    import {
        AccountBoxTwotone,
        AccountCircleFilled,
        AccountCircleOutlined,
        GroupAddFilled,
        MenuFilled,
        EditFilled,
        LogInFilled,
        ExitToAppTwotone,
        LanguageFilled,
        AddBusinessFilled,
    } from "@vicons/material";

	// Localization Setup
    const { locale } = usePage().props;
    const currentLocale = locale || 'en';

    // Change Current Language
    const changeLanguage = (lang) => {
        window.location.href = `/${lang}${window.location.pathname.substring(3)}`;
    };

    // Responsive Menu Show Function
    const isMenuOpen = ref(false);
    const toggleMenu = () => {
        isMenuOpen.value = !isMenuOpen.value;
    };

    // Render Icons for Dropdown
    const renderIcon = (icon) => () => h(NIcon, null, {
        default: () => h(icon)
    });

    // Authenticated Account Dropdown Options
    const accountOptions = ref([
        {
            label: "Dashboard",
            key: "dashboard",
            icon: renderIcon(AccountCircleFilled),
            url: `/${currentLocale}/dashboard`,
        },
        {
            label: "Edit Profile",
            key: "edit profile",
            icon: renderIcon(EditFilled),
            url: `/${currentLocale}/edit-profile`,
        },
        {
            label: "Logout",
            key: "logout",
            icon: renderIcon(ExitToAppTwotone),
            url: `/${currentLocale}/logout`,
        },
    ]);

    // Guest Account Dropdown Options
    const guestOptions = ref([
        {
            label: "Sign Up",
            key: "signup",
            icon: renderIcon(GroupAddFilled),
            url: `/${currentLocale}/signup`,
        },
        {
            label: "Log In",
            key: "login",
            icon: renderIcon(LogInFilled),
            url: `/${currentLocale}/login`,
        },
        {
            label: "Teams",
            key: "teams",
            icon: renderIcon(AddBusinessFilled),
            url: `/${currentLocale}/teams`,
        },
    ]);

    // Language Dropdown Options
    const languages = ref([
        {label: "Español", key: "es"},
        {label: "English", key: "en"},
    ]);

    // ############# Account Logic #################

    // Inertia Router - NaiveUI Dropdown
    const handleDropdownSelect = (key) => {
        const option = guestOptions.value.find(opt => opt.key === key);

        if (option && option.url) {
            // Use Inertia Router for Browser
            router.visit(option.url);
        } else {
            console.warn('Url Not Defined:', key);
        }
    };

    // Authenticated User Dropdown Links
    const authenticatedLinksSelect = (key) => {
        const option = accountOptions.value.find(opt => opt.key === key);

        if (option && option.url) {
            // Use Inertia Router for Browser
            router.visit(option.url);
        } else {
            console.warn('Url Not Defined:', key);
        }
    };

    // Get Products from Home
    defineProps({
        customerProducts: Object,
        required: true,
    });

</script>

<template>

    <nav class="navbar">
        <div class="navbar-container">

            <div class="navbar-logo">
                <div class="logo-image">
                    <img src="/assets/images/logo/krosty_logo_dark_mode.png"/>
                </div>
            </div>

            <div class="navbar-links">
                <Link :href="`/${currentLocale}/`">INICIO</Link>
                <Link :href="`/${currentLocale}/products`">PRODUCTS</Link>
                <Link :href="`/${currentLocale}/teams`">OUR MENU</Link>
                <a>ABOUT US</a>
                <n-button type="warning">BOOK A TABLE</n-button>
            </div>

            <div class="navbar-buttons">

                <!-- Language Dropdown -->
                <n-dropdown trigger="click" :options="languages" @select="changeLanguage">
                    <n-icon size="30">
                        <LanguageFilled/>
                    </n-icon>
                </n-dropdown>

                <!-- Account Dropdown -->
                <!-- authenticated user -->
                <n-dropdown
                    v-if="$page.props.auth.isLoggedIn"
                    trigger="click"
                    :options="accountOptions"
                    @select="authenticatedLinksSelect"
                >
                    <n-icon size="30">
                        <AccountCircleFilled/>
                    </n-icon>
                </n-dropdown>
                <!-- guest user -->
                <n-dropdown v-else
                    trigger="click"
                    :options="guestOptions"
                    @select="handleDropdownSelect"
                >
                    <n-icon size="30">
                        <AccountCircleFilled />
                    </n-icon>
                </n-dropdown>

                <!-- Shoppingcart Button -->
                <div class="navbar-shoppingcart">
                    <ShoppingcartDrawer :shoppingcartProducts="customerProducts"/>
                </div>

                <!-- Bars Menu Button -->
                <div class="navbar-menu">
                    <n-icon
                        size="25"
                        class="navbar-responsiveBtn"
                        @click="toggleMenu">
                        <MenuFilled/>
                    </n-icon>
                </div>

            </div>

        </div>

    </nav>
    <!-- Responsive Navbar Items -->
    <div class="responsive-navbar" v-show="isMenuOpen" ref="navbarRef" :class="{ 'active': isMenuOpen }">
        <div class="responsive-items">
            <a href="#">INICIO</a>
        </div>
        <div class="responsive-items">
            <a>ABOUT</a>
        </div>
        <div class="responsive-items">
            <a>CONTACT</a>
        </div>

    </div>


</template>

<style scoped>

    .navbar {
        background-color: #0b090a;
        color: #fff;
        padding: 1rem;
        width: 100%;
        /*box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);*/
    }

    .navbar-container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        max-width: 100%;
        margin: 0 auto;
        height: 50px;
    }

    .navbar-logo {
        display: flex;
        justify-content: center;
        height: auto;
        max-width: 150px;
    }

    .logo-image {
        width: 100%;
        height: auto;
        max-width: 100px;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .navbar-links {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 1.5rem;
    }
    .navbar-links a:hover {
        color: gray;
    }

    .navbar-buttons {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .navbar-shoppingcart {
        display: flex;
        align-items: center;
    }
    /* Responsive Navbar */
    .navbar-menu {
        display: flex;
        justify-content: center;
        align-items: center;
        padding-left: 10px;
    }

    .navbar-responsiveBtn {
        display: none;
        cursor: pointer;
    }

    .navbar-responsiveBtn:hover {
        color: red;
    }

    .responsive-navbar {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 10px 10px;
        gap: 10px;
        background-color: red;
        color: #fff;
        transition: all 0.3s ease-in-out;
    }

    .responsive-items {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .responsive-items a {
        cursor: pointer;
    }

    .responsive-items a:hover {
        color: #000;
    }

    /* Media Queries */
    @media (max-width: 768px) {
        .navbar-responsiveBtn {
            display: flex;
        }

        .navbar-links {
            display: none;
        }
    }

</style>
