<script setup>

    import { ref } from "vue";
    import { Link, usePage } from "@inertiajs/vue3";
    import { NIcon } from "naive-ui";
    import {
        MenuOutlined,
        TagFacesSharp,
        DashboardCustomizeFilled,
        ShopifyOutlined,
        MessageSharp,
        SettingsFilled,
        ArrowCircleLeftFilled,
        SearchFilled,
        NotificationsActiveFilled,
        KeyboardArrowRightRound,
        CloudUploadSharp,
        CalendarMonthFilled,
        SupervisedUserCircleOutlined,
        MonetizationOnOutlined,
        FilterAltSharp,
        PlusFilled,
        MoreVertSharp,
        HomeFilled,
        CoPresentFilled,
        EditFilled,
        RamenDiningFilled,
        InsertChartFilled,
        AssignmentRound,
        PaymentsFilled,
        AutoStoriesFilled,
    } from "@vicons/material";

    // Get Current Locale
    const { locale } = usePage().props;

    // Sidebar Reactive Variable
    const isSidebarHidden = ref(window.innerWidth < 768);

    // Toggle Sidebar
    const toggleSidebar = () => {
        isSidebarHidden.value = !isSidebarHidden.value;
    };

    // Dashboard Variables
    const props = defineProps({
        pageTitle: {
            type: String,
            default: "Dashboard"
        },
        activePage: {
            type: String,
            default: "Dashboard"
        },
        notifications: {
            type: Number,
            default: 0
        }
    });

</script>

<template>

    <!-- SIDEBAR STARTS -->
	<section
        id="sidebar"
        :class="['sidebar', { hide: isSidebarHidden }]"
    >
        <Link :href="`/${locale}/dashboard`" class="brand">
            <n-icon class="bx"><TagFacesSharp/></n-icon>
            <span class="text">Customer</span>
		</Link>

        <ul class="side-menu top">

            <li>
                <Link :href="`/${locale}/`">
                    <n-icon class="bx"><HomeFilled/></n-icon>
                    <span class="text">Home</span>
				</Link>
			</li>

            <li :class="{ active: activePage === 'Dashboard' }">
                <Link :href="`/${locale}/dashboard`">
                    <n-icon class="bx"><DashboardCustomizeFilled/></n-icon>
                    <span class="text">Dashboard</span>
				</Link>
			</li>

            <li :class="{ active: activePage === 'Profile' }">
                <Link :href="`/${locale}/profile`">
                    <n-icon class="bx"><CoPresentFilled/></n-icon>
                    <span class="text">Profile</span>
				</Link>
			</li>

            <li :class="{ active: activePage === 'Edit Profile' }">
                <Link :href="`/${locale}/edit-profile`">
                    <n-icon class="bx"><EditFilled/></n-icon>
                    <span class="text">Edit Profile</span>
				</Link>
			</li>

            <li :class="{ active: activePage === 'Order' }">
                <Link :href="`/${locale}/order`">
                    <n-icon class="bx"><RamenDiningFilled/></n-icon>
                    <span class="text">Order</span>
				</Link>
			</li>

            <li :class="{ active: activePage === 'Orders' }">
                <Link :href="`/${locale}/orders`">
                    <n-icon class="bx"><AssignmentRound/></n-icon>
                    <span class="text">Orders</span>
				</Link>
			</li>

            <li :class="{ active: activePage === 'Analytics' }">
				<a href="#">
                    <n-icon class="bx"><InsertChartFilled/></n-icon>
                    <span class="text">Analytics</span>
				</a>
			</li>

            <li :class="{ active: activePage === 'Invoices' }">
				<a href="#">
                    <n-icon class="bx"><PaymentsFilled/></n-icon>
                    <span class="text">Invoices</span>
				</a>
			</li>

		</ul>

        <ul class="side-menu">
			<li :class="{ active: activePage === 'Reservations' }">
				<a href="#">
                    <n-icon class="bx"><AutoStoriesFilled/></n-icon>
					<span class="text">Reservations</span>
				</a>
			</li>
			<li>
				<a href="#" class="logout">
                    <n-icon class="bx"><ArrowCircleLeftFilled/></n-icon>
                    <Link class="text" :href="`/${locale}/logout`">Logout</Link>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR ENDS -->

    <!-- CONTENT -->
	<section id="content">

        <!-- NAVBAR -->
		<nav>
            <n-icon @click="toggleSidebar">
                <MenuOutlined/>
            </n-icon>
			<input
                type="checkbox"
                id="switch-mode"
                hidden
            >
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="profile">
                <img src="/assets/images/panels/admin_profile.png">
            </a>
            <a href="#" class="notification">
                <n-icon class="bx">
                    <NotificationsActiveFilled/>
                </n-icon>
                <span class="num">{{ notifications }}</span>
			</a>
			<!--<a href="#" class="profile">
                <img src="/assets/images/panels/admin_profile.png">
            </a>-->
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>

            <div class="head-title">
				<div class="left">
                    <h1>{{ pageTitle }}</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
                        <li><n-icon class="bx"><KeyboardArrowRightRound/></n-icon></li>
                        <li>
                            <a class="active" href="#">{{ pageTitle }}</a>
						</li>
					</ul>
				</div>
            </div>

            <slot
                name="mainContentSlot"
            >
            </slot>

		</main>
		<!-- MAIN -->

	</section>
	<!-- CONTENT -->

</template>

<style scoped>

    /* LIST STYLES */
    a {
	    text-decoration: none;
    }
    li {
	    list-style: none;
    }
    /* LIST STYLES */

    /* SIDEBAR */
    #sidebar {
	    position: fixed;
	    top: 0;
	    left: 0;
	    width: 280px;
	    height: 100%;
	    background: #F9F9F9;
	    z-index: 2000;
	    /*font-family: var(--lato);*/
	    transition: .3s ease;
	    overflow-x: hidden;
	    scrollbar-width: none;
    }
    #sidebar::--webkit-scrollbar {
	    display: none;
    }
    #sidebar.hide {
	    width: 60px;
    }
    #sidebar .brand {
	    font-size: 24px;
	    font-weight: 700;
	    height: 56px;
	    display: flex;
	    align-items: center;
	    color: #3C91E6;
	    position: sticky;
	    top: 0;
	    left: 0;
	    background: #F9F9F9;
	    z-index: 500;
	    padding-bottom: 20px;
	    box-sizing: content-box;
    }
    #sidebar .brand .bx {
	    min-width: 60px;
	    display: flex;
	    justify-content: center;
    }
    #sidebar .side-menu {
	    width: 100%;
	    margin-top: 48px;
    }
    #sidebar .side-menu li {
	    height: 48px;
	    background: transparent;
	    margin-left: 6px;
	    border-radius: 48px 0 0 48px;
	    padding: 4px;
    }
    #sidebar .side-menu li.active {
	    background: #eee;
	    position: relative;
    }
    #sidebar .side-menu li.active::before {
	    content: '';
	    position: absolute;
	    width: 40px;
	    height: 40px;
	    border-radius: 50%;
	    top: -40px;
	    right: 0;
	    box-shadow: 20px 20px 0 #eee;
	    z-index: -1;
    }
    #sidebar .side-menu li.active::after {
	    content: '';
	    position: absolute;
	    width: 40px;
	    height: 40px;
	    border-radius: 50%;
	    bottom: -40px;
	    right: 0;
	    box-shadow: 20px -20px 0 #eee;
	    z-index: -1;
    }
    #sidebar .side-menu li a {
	    width: 100%;
	    height: 100%;
	    background: #F9F9F9;
	    display: flex;
	    align-items: center;
	    border-radius: 48px;
	    font-size: 16px;
	    color: #342E37;
	    white-space: nowrap;
	    overflow-x: hidden;
    }
    #sidebar .side-menu.top li.active a {
	    color: #3C91E6;
    }
    #sidebar.hide .side-menu li a {
	    width: calc(48px - (4px * 2));
	    transition: width .3s ease;
    }
    #sidebar .side-menu li a.logout {
	    color: #DB504A;
    }
    #sidebar .side-menu.top li a:hover {
	    color: #3C91E6;
    }
    #sidebar .side-menu li a .bx {
	    min-width: calc(60px  - ((4px + 6px) * 2));
	    display: flex;
	    justify-content: center;
    }
    /* SIDEBAR */

	/* CONTENT */
	#content {
		position: relative;
		width: calc(100% - 280px);
		left: 280px;
		transition: .3s ease;
	}
	#sidebar.hide ~ #content {
		width: calc(100% - 60px);
		left: 60px;
	}
	/* NAVBAR */
	#content nav {
		height: 56px;
		background: #F9F9F9;
		padding: 0 24px;
		display: flex;
        /*justify-content: flex-end;*/
		align-items: center;
		grid-gap: 24px;
		/*font-family: var(--lato);*/
		position: sticky;
		top: 0;
		left: 0;
		z-index: 1000;
	}
	#content nav::before {
		content: '';
		position: absolute;
		width: 40px;
		height: 40px;
		bottom: -40px;
		left: 0;
		border-radius: 50%;
		box-shadow: -20px -20px 0 #F9F9F9;
	}
	#content nav a {
		color: #342E37;
	}
	#content nav .bx.bx-menu {
		cursor: pointer;
		color: #342E37;
	}
	#content nav .nav-link {
		font-size: 16px;
		transition: .3s ease;
	}
	#content nav .nav-link:hover {
		color: #3C91E6;
	}
	#content nav .notification {
		font-size: 20px;
		position: relative;
	}
	#content nav .notification .num {
		position: absolute;
		top: -6px;
		right: -6px;
		width: 20px;
		height: 20px;
		border-radius: 50%;
		border: 2px solid #F9F9F9;
		background: #DB504A;
		color: #F9F9F9;
		font-weight: 700;
		font-size: 12px;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	#content nav .profile img {
		width: 36px;
		height: 36px;
		object-fit: cover;
		border-radius: 50%;
	}
	#content nav .switch-mode {
		display: block;
		min-width: 50px;
		height: 25px;
		border-radius: 25px;
		background: #eee;
		cursor: pointer;
		position: relative;
	}
	#content nav .switch-mode::before {
		content: '';
		position: absolute;
		top: 2px;
		left: 2px;
		bottom: 2px;
		width: calc(25px - 4px);
		background: #3C91E6;
		border-radius: 50%;
		transition: all .3s ease;
	}
	#content nav #switch-mode:checked + .switch-mode::before {
		left: calc(100% - (25px - 4px) - 2px);
	}
	/* NAVBAR */

    /* MAIN SECTION */
    #content main {
		width: 100%;
		padding: 36px 24px;
		font-family: var(--poppins);
		max-height: calc(100vh - 56px);
		overflow-y: auto;
	}
	#content main .head-title {
		display: flex;
		align-items: center;
		justify-content: space-between;
		grid-gap: 16px;
		flex-wrap: wrap;
	}
	#content main .head-title .left h1 {
		font-size: 36px;
		font-weight: 600;
		margin-bottom: 10px;
		color: #342E37;
	}
	#content main .head-title .left .breadcrumb {
		display: flex;
		align-items: center;
		grid-gap: 16px;
	}
	#content main .head-title .left .breadcrumb li {
		color: #342E37;
	}
	#content main .head-title .left .breadcrumb li a {
		color: #AAAAAA;
		pointer-events: none;
	}
	#content main .head-title .left .breadcrumb li a.active {
		color: #3C91E6;
		pointer-events: unset;
	}
	#content main .head-title .btn-download {
		height: 36px;
		padding: 0 16px;
		border-radius: 36px;
		background: #3C91E6;
		color: #F9F9F9;
		display: flex;
		justify-content: center;
		align-items: center;
		grid-gap: 10px;
		font-weight: 500;
	}
    /* MAIN SECTION */

    /* RESPONSIVE DESIGN */
    @media screen and (max-width: 768px) {
	    #sidebar {
		    width: 200px;
	    }
	    #content {
		    width: calc(100% - 60px);
		    left: 200px;
	    }
	    #content nav .nav-link {
		    display: none;
	    }
    }
    @media screen and (max-width: 576px) {
	    #content nav form.show ~ .notification,
    	#content nav form.show ~ .profile {
	    	display: none;
	    }
	    #content main .box-info {
		    grid-template-columns: 1fr;
	    }
	    #content main .table-data .head {
		    min-width: 420px;
	    }
    	#content main .table-data .order table {
	    	min-width: 420px;
	    }
	    #content main .table-data .todo .todo-list {
		    min-width: 420px;
	    }
    }

</style>
