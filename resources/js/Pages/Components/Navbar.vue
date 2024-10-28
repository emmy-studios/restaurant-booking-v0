<script setup>

    import { ref, h, onMounted, onBeforeUnmount } from "vue";

    import { Link, usePage } from "@inertiajs/vue3";
    import { router } from "@inertiajs/vue3";

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
        LanguageFilled
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
            //url: `/${currentLocale}/signup`,
        },
        {
            label: "Logout",
            key: "logout",
            icon: renderIcon(ExitToAppTwotone),
            //url: `/${currentLocale}/signup`,
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
    ]);

    // Language Dropdown Options
    const languages = ref([
        {label: "Español", key: "es"},
        {label: "English", key: "en"},
    ]);

    // Shoppingcart Drawer
    const active = ref(false);
    const placement = ref("right");
    const activate = (place) => {
        active.value = true;
        placement.value = place;
    };

    // Shoppingcart Items
    const shoppingcartNumber = ref(0);

    // Account Logic
    const isLoggedIn = window.auth.isLoggedIn;

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

</script>

<template>

    <nav class="navbar">

        <div class="navbar-container">

            <div class="navbar-logo">
                <div class="logo-image">
                    <img src="assets/images/logo/krosty_logo_dark_mode.png"/>
                </div>
            </div>

            <div class="navbar-links">
                <Link :href="`/${currentLocale}/`">INICIO</Link>
                <Link :href="`/${currentLocale}/products`">PRODUCTS</Link>
                <Link :href="`/${currentLocale}/teams`">TEAMS</Link>
                <a>Reservation</a>
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
                    v-if="isLoggedIn"
                    trigger="click"
                    :options="accountOptions"
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
                    <n-float-button
                        position="relative"
                        height="25"
                        width="25"
                        @click="activate('right')"
                    >
                        <n-badge
                            type="warning"
                            :value="shoppingcartNumber"
                            show-zero
                            :offset="[6, -8]"
                        >
                            <n-icon>
                                <ShoppingCartRound />
                            </n-icon>
                        </n-badge>
                    </n-float-button>
                    <!-- Shoppingcart Drawer -->
                    <n-drawer v-model:show="active" :width="400" :placement="placement">
                        <n-drawer-content>
                            <!-- header -->
                            <template #header>
                                <div class="drawer-header">
                                    <span>Shopping Cart</span>
                                    <n-button ghost size="small" @click="active = false">
                                        <n-icon>
                                            <CloseFilled/>
                                        </n-icon>
                                    </n-button>
                                </div>
                            </template>
                            <!-- content -->
                            <div class="drawer-content">
                                <p>Lorem ipsum opem unoi...</p>
                            </div>
                            <!-- footer -->
                            <template #footer>
                                <n-button type="warning" block>
                                    Make Order
                                </n-button>
                            </template>
                        </n-drawer-content>
                    </n-drawer>
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
        background-color: #000;
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
        gap: 1.5rem;
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

    /* Shoppingcart Drawer */
    .drawer-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .drawer-content {
        display: flex;
        justify-content: space-around;
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

    /*.responsive-navbar.active {
        display: flex;
    }*/

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
