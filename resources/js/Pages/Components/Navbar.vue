<script setup>

    import { ref, h, onMounted, onBeforeUnmount } from "vue";
    import {
        NButton,
        NIcon,
        NDropdown,
        NDrawer,
        NDrawerContent,
        NFloatButton,
        NBadge
    } from "naive-ui";
    import {
        AccountBoxTwotone,
        ShoppingCartRound,
        AccountCircleFilled,
        MenuFilled,
        EditFilled,
        LogInFilled,
        CloseFilled
    } from "@vicons/material";

    // Responsive Menu Show Function
    const isMenuOpen = ref(false);
    const toggleMenu = () => {
        isMenuOpen.value = !isMenuOpen.value;
    };
    /*const navbarRef = ref(null);
    const handleClickOutside = (event) => {
        if (navbarRef.value && !navbarRef.value.contains(event.target)) {
            isMenuOpen.value = false;
        }
    };
    onMounted(() => {
        document.addEventListener("click", handleClickOutside);
    });
    onBeforeUnmount(() => {
        document.removeEventListener("click", handleClickOutside);
    });*/

    // Render Icons for Dropdown
    const renderIcon = (icon) => () => h(NIcon, null, {
        default: () => h(icon)
    });

    // Dropdown Options
    const options = ref([
        {
            label: "Profile",
            key: "profile",
            icon: renderIcon(AccountCircleFilled),
        },
        {
            label: "Edit Profile",
            key: "edit profile",
            icon: renderIcon(EditFilled),
        },
        {
            label: "Logout",
            key: "logout",
            icon: renderIcon(LogInFilled),
        },
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
                <a>INICIO</a>
                <a>PRODUCTS</a>
                <a>MENU</a>
                <a>Reservation</a>
            </div>

            <div class="navbar-buttons">

                <!-- Account Dropdown -->
                <n-dropdown :options="options">
                    <n-button secondary circle color="red">
                        <n-icon size="20">
                            <AccountCircleFilled />
                        </n-icon>
                    </n-button>
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
