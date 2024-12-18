<script setup>

    import { ref, reactive } from "vue";
    import { Link, usePage } from "@inertiajs/vue3";
    import {
        NIcon,
        NButton,
        NTooltip,
        NDrawer,
        NDrawerContent,
    } from "naive-ui";
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
        CircleNotificationsFilled
    } from "@vicons/material";

    // Get Current Locale
    const { locale } = usePage().props;
    const notifications = ref(usePage().props.notifications.length);
    const userNotifications = reactive(usePage().props.notifications);

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
    // Notifications Drawer
    const active = ref(false);
    const placement = ref("left");
    const activate = (place) => {
      active.value = true;
      placement.value = place;
    };
    const formatDate = (date) => {
        const d = new Date(date);
        const day = String(d.getDate()).padStart(2, '0');
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const year = d.getFullYear();
        return `${day}-${month}-${year}`;
    };
    // Truncate Notification Text
    function truncateMessage(text, length = 70) {
        return text.length > length ? text.substring(0, length) + '...' : text;
    };
    // Truncate Notification Title
    function truncateTitle(text, length = 70) {
        return text.length > length ? text.substring(0, length) + '...' : text;
    };
    // Notification Modal
    const showModal = ref(false);
    const selectedNotification = ref(null);
    const openModal = (notification) => {
        selectedNotification.value = notification;
        showModal.value = true;
    };

</script>

<template>

    <!-- SIDEBAR STARTS -->
	<section
        id="sidebar"
        :class="['sidebar', { hide: isSidebarHidden }]"
    >
        <Link :href="`/${locale}/dashboard`" class="brand">
            <n-icon class="bx" color="#db7c26"><TagFacesSharp/></n-icon>
            <span class="text">Admin</span>
		</Link>

        <ul class="side-menu top">

            <li>
                <n-tooltip trigger="hover">
                    <template #trigger>
                        <Link :href="`/${locale}/`">
                            <n-icon class="bx"><HomeFilled/></n-icon>
                            <span class="text">Home</span>
				        </Link>
                    </template>
                    Home
                </n-tooltip>
			</li>

            <li :class="{ active: activePage === 'Dashboard' }">
                <n-tooltip trigger="hover">
                    <template #trigger>
                        <Link :href="`/${locale}/dashboard`">
                            <n-icon class="bx"><DashboardCustomizeFilled/></n-icon>
                            <span class="text">Dashboard</span>
				        </Link>
                    </template>
                    Dashboard
                </n-tooltip>
			</li>

            <li :class="{ active: activePage === 'Profile' }">
                <n-tooltip trigger="hover">
                    <template #trigger>
                        <Link :href="`/${locale}/profile`">
                            <n-icon class="bx"><CoPresentFilled/></n-icon>
                            <span class="text">Profile</span>
				        </Link>
                    </template>
                    Profile
                </n-tooltip>
			</li>

            <li :class="{ active: activePage === 'Notifications' }">
                <n-tooltip trigger="hover">
                    <template #trigger>
                        <Link :href="`/${locale}/notifications`">
                            <n-icon class="bx"><CircleNotificationsFilled/></n-icon>
                            <span class="text">Notifications</span>
				        </Link>
                    </template>
                    Notifications
                </n-tooltip>
			</li>

            <li :class="{ active: activePage === 'Edit Profile' }">
                <n-tooltip trigger="hover">
                    <template #trigger>
                        <Link :href="`/${locale}/edit-profile`">
                            <n-icon class="bx"><EditFilled/></n-icon>
                            <span class="text">Edit Profile</span>
				        </Link>
                    </template>
                    Edit Profile
                </n-tooltip>
			</li>

            <li :class="{ active: activePage === 'Order' }">
                <n-tooltip trigger="hover">
                    <template #trigger>
                        <Link :href="`/${locale}/order`">
                            <n-icon class="bx"><RamenDiningFilled/></n-icon>
                            <span class="text">Order</span>
				        </Link>
                    </template>
                    Order
                </n-tooltip>
			</li>

            <li :class="{ active: activePage === 'Orders' }">
                <n-tooltip trigger="hover">
                    <template #trigger>
                        <Link :href="`/${locale}/orders`">
                            <n-icon class="bx"><AssignmentRound/></n-icon>
                            <span class="text">Orders</span>
				        </Link>
                    </template>
                    Orders
                </n-tooltip>
			</li>

            <li :class="{ active: activePage === 'Analytics' }">
                <n-tooltip trigger="hover">
                    <template #trigger>
                        <Link :href="`/${locale}/analytics`">
                            <n-icon class="bx"><InsertChartFilled/></n-icon>
                            <span class="text">Analytics</span>
				        </Link>
                    </template>
                    Analytics
                </n-tooltip>
			</li>

            <li :class="{ active: activePage === 'Invoices' }">
                <n-tooltip trigger="hover">
                    <template #trigger>
                        <Link :href="`/${locale}/invoices`">
                            <n-icon class="bx"><PaymentsFilled/></n-icon>
                            <span class="text">Invoices</span>
				        </Link>
                    </template>
                    Invoices
                </n-tooltip>
			</li>

		</ul>

        <ul class="side-menu">
			<li :class="{ active: activePage === 'Reservations' }">
                <n-tooltip trigger="hover">
                    <template #trigger>
                        <Link :href="`/${locale}/reservations`">
                            <n-icon class="bx"><AutoStoriesFilled/></n-icon>
					        <span class="text">Reservations</span>
				        </Link>
                    </template>
                    Reservations
                </n-tooltip>
			</li>
			<li>
				<n-tooltip trigger="hover">
                    <template #trigger>
                        <a href="#" class="logout">
                            <n-icon class="bx"><ArrowCircleLeftFilled/></n-icon>
                            <Link class="text" :href="`/${locale}/logout`">Logout</Link>
				        </a>
                    </template>
                    Logout
                </n-tooltip>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR ENDS -->

    <!-- CONTENT -->
	<section id="content">

        <!-- NAVBAR -->
		<nav>

            <n-icon @click="toggleSidebar" class="bx">
                <MenuOutlined/>
            </n-icon>

            <a class="notification" @click="activate('left')" style="cursor: pointer;">
                <n-icon class="bx">
                    <NotificationsActiveFilled/>
                </n-icon>
                <span class="num">{{ notifications }}</span>

                <!-- Notifications Drawer -->
                <n-drawer
                    v-model:show="active"
                    :width="300"
                    :default-width="502"
                    :placement="placement"
                    resizable
                >
                    <n-drawer-content title="Notifications" closable>
                        <div
                            v-if="notifications === 0"
                            class="notifications-empty"
                        >
                            <div class="notifications-image">
                                <img src="/assets/images/system/notification.svg">
                            </div>
                            <div class="empty-text">
                                <p>No notifications right now!</p>
                            </div>
                        </div>

                        <div
                            v-else
                            v-for="notification in userNotifications"
                            :key="notification.id"
                            class="notifications-container"
                        >
                            <div class="notification-icon">
                                <img src="/assets/images/system/notification_icon.svg">
                            </div>
                            <div class="notification-message">
                                <h2>{{ truncateTitle(notification.title) }}</h2>
                                <p>{{ truncateMessage(notification.message) }}</p>
                            </div>
                            <div class="notification-date">
                                <p>Date: {{ formatDate(notification.created_at) }}</p>
                            </div>
                        </div>
                        <div class="link-container">
                            <Link :href="`/${locale}/notifications`">
                                View All
                            </Link>
                        </div>
                    </n-drawer-content>
                </n-drawer>

            </a>

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
	    /*color: #3C91E6;*/
	    color: #db7c26;
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
	    /*color: #3C91E6;*/
        color: #db7c26;
    }
    #sidebar.hide .side-menu li a {
	    width: calc(48px - (4px * 2));
	    transition: width .3s ease;
    }
    #sidebar .side-menu li a.logout {
	    color: #DB504A;
    }
    #sidebar .side-menu.top li a:hover {
	    /*color: #3C91E6;*/
        color: #db7c26;
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
	#content nav .notification {
		font-size: 24px;
        display: flex;
        align-items: center;
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
		/*color: #342E37;*/
        color: #bd632f;
	}
	#content main .head-title .left .breadcrumb li a {
		color: #AAAAAA;
		pointer-events: none;
	}
	#content main .head-title .left .breadcrumb li a.active {
		/*color: #3C91E6;*/
		color: #bd632f;
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

    /* NOTIFICATIONS SECTION */
    .notifications-empty {
        display: flex;
        flex-direction: column;
    }
    .notifications-image {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .notifications-image img {
        width: 50%;
        height: 50%;
    }
    .empty-text {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .empty-text p {
        font-weight: bold;
        text-transform: capitalize;
        padding-top: 20px;
    }
    .notifications-container {
        display: flex;
        flex-direction: column;
        background-color: #d8e2dc;
        padding: 10px 10px;
        border-radius: 10px;
        margin-bottom: 5px;
    }
    .notification-icon {
        display: flex;
        padding-bottom: 10px;
    }
    .notification-icon img {
        width: 10%;
        height: 10%;
    }
    .notification-message {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .notification-message h2 {
        font-weight: bold;
    }
    .notification-date {
        display: flex;
        padding-top: 10px;
    }
    .notification-date p {
        color: gray;
        font-size: 13px;
    }
    .link-container {
        display: flex;
        justify-content: flex-end;
        padding-top: 10px;
    }
    .link-container a {
        font-weight: bold;
    }
    /* NOTIFICATIONS SECTION */

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
