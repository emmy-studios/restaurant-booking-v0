<script setup>

    import { ref, reactive } from "vue";
    import { Link, usePage } from "@inertiajs/vue3";
    import { NIcon } from "naive-ui";
    import {
        MenuOutlined,
        TagFacesSharp,
        DashboardCustomizeFilled,
        ShopifyOutlined,
        DonutSmallFilled,
        MessageSharp,
        SupervisedUserCircleFilled,
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
        MoreVertSharp
    } from "@vicons/material";

    // Get Current Locale
    const { locale } = usePage().props;
    const currentLocale = locale || 'en';

    // Get User Information
    const props = defineProps({
        user: {
            type: Object,
            required: true,
        }
    });
    const notifications = ref(4);
    //const imageProfile = ref("/assets/images/panels/admin_profile.png");

    import DashboardSidebar from "../Components/DashboardSidebar.vue";

</script>

<template>

    <DashboardSidebar
        :notifications="notifications"
        :pageTitle="'Dashboard'"
        :activePage="'Dashboard'"
    >

        <template v-slot:mainContentSlot>

            <!-- Dashboard Banner -->
            <div class="banner-container">
                <div class="card-container">
                    <div class="card-content">
                        <span>Welcome Back, {{ user.name }}!</span>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit.
                        </p>
                    </div>
                    <div class="card-image">
                        <img src="/assets/images/system/store01.svg">
                    </div>
                </div>
            </div>

            <!-- Stats -->
			<ul class="box-info">
				<li id="total-orders-stats">
                    <n-icon class="bx"><CalendarMonthFilled/></n-icon>
                    <span class="text">
						<h3>1020</h3>
						<p>Total Orders</p>
					</span>
				</li>
				<li>
                    <n-icon class="bx"><SupervisedUserCircleOutlined/></n-icon>
                    <span class="text">
						<h3>2834</h3>
						<p>Visitors</p>
					</span>
				</li>
				<li>
                    <n-icon class="bx"><MonetizationOnOutlined/></n-icon>
                    <span class="text">
						<h3>$2543</h3>
						<p>Total Sales</p>
					</span>
				</li>
            </ul>
            <!-- Stats Ends -->

            <!-- Orders Table -->
			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Orders</h3>
                        <n-icon class="bx"><SearchFilled/></n-icon>
					    <n-icon class="bx"><FilterAltSharp/></n-icon>
                    </div>
					<table>
						<thead>
							<tr>
								<th>User</th>
								<th>Date Order</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<img src="/assets/images/products/pizza.jpg">
									<p>Pizza Slice</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status completed">Completed</span></td>
							</tr>
							<tr>
								<td>
									<img src="/assets/images/products/hamburger.jpg">
									<p>Hamburger Order</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.png">
									<p>John Doe</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status process">Process</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.png">
									<p>John Doe</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>
								<td>
									<img src="img/people.png">
									<p>John Doe</p>
								</td>
								<td>01-10-2021</td>
								<td><span class="status completed">Completed</span></td>
							</tr>
						</tbody>
					</table>
				</div>
            </div>
            <!-- Orders Table Ends -->

        </template>

    </DashboardSidebar>

</template>

<style scoped>

    a {
	    text-decoration: none;
    }

    li {
	    list-style: none;
    }

    /* DASHBOARD BANNER */
    .banner-container {
        display: flex;
        margin-top: 60px;
        margin-bottom: 100px;
    }
    .card-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        background-image: linear-gradient(to right top, #f0c6f4, #ddbbe4, #cab0d4, #b9a5c4, #a89ab3);
        width: 100%;
        border-radius: 10px;
    }
    .card-content {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding-left: 20px;
        padding-right: 20px;
        flex-direction: column;
        gap: 20px;
    }
    .card-content span {
        font-weight: bold;
        font-size: 1.7rem;
        color: #fff;
    }
    .card-content p {
        font-size: 14px;
    }
    .card-image {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px 20px;
        width: 100%;
        height: 100%;
    }
    /* DASHBOARD BANNER */

	/* STATS */
	.box-info {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
		grid-gap: 24px;
		margin-top: 36px;
	}
	.box-info li {
		padding: 24px;
		/*background: #F9F9F9;*/
		border-radius: 20px;
		display: flex;
		align-items: center;
		grid-gap: 24px;
	}
    .box-info #total-orders-stats {
        background-image: linear-gradient(to right top, #2ceeb1, #1aed9a, #1feb7f, #33e860, #48e538);
    }
	.box-info li .bx {
		width: 80px;
		height: 80px;
		border-radius: 10px;
		font-size: 36px;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.box-info li:nth-child(1) .bx {
		background: #CFE8FF;
		color: #3C91E6;
	}
	.box-info li:nth-child(2) .bx {
		background: #FFF2C6;
		color: #FFCE26;
	}
	.box-info li:nth-child(3) .bx {
		background: #FFE0D3;
        color: #FD7238;
	}
	.box-info li .text h3 {
		font-size: 24px;
		font-weight: 600;
		color: #342E37;
	}
	.box-info li .text p {
		color: #342E37;
	}
    /* STATS */

    /* TABLE */
	.table-data {
		display: flex;
		flex-wrap: wrap;
		grid-gap: 24px;
		margin-top: 24px;
		width: 100%;
		color: #342E37;
	}
	.table-data > div {
		border-radius: 20px;
		background: #F9F9F9;
		padding: 24px;
		overflow-x: auto;
	}
	.table-data .head {
		display: flex;
		align-items: center;
		grid-gap: 16px;
		margin-bottom: 24px;
	}
	.table-data .head h3 {
		margin-right: auto;
		font-size: 24px;
		font-weight: 600;
	}
	.table-data .head .bx {
		cursor: pointer;
	}
	.table-data .order {
		flex-grow: 1;
		flex-basis: 500px;
	}
	.table-data .order table {
		width: 100%;
		border-collapse: collapse;
	}
	.table-data .order table th {
		padding-bottom: 12px;
		font-size: 13px;
		text-align: left;
		border-bottom: 1px solid #eee;
	}
	.table-data .order table td {
		padding: 16px 0;
	}
	.table-data .order table tr td:first-child {
		display: flex;
		align-items: center;
		grid-gap: 12px;
		padding-left: 6px;
	}
	.table-data .order table td img {
		width: 36px;
		height: 36px;
		border-radius: 50%;
		object-fit: cover;
	}
	.table-data .order table tbody tr:hover {
		background: #eee;
	}
	.table-data .order table tr td .status {
		font-size: 10px;
		padding: 6px 16px;
		color: #F9F9F9;
		border-radius: 20px;
		font-weight: 700;
	}
	.table-data .order table tr td .status.completed {
		background: #3C91E6;
	}
	.table-data .order table tr td .status.process {
		background: #FFCE26;
	}
	.table-data .order table tr td .status.pending {
		background: #FD7238;
	}
	/* TABLE */

    /* RESPONSIVE DESIGN */
    @media screen and (max-width: 768px) {
        .card-container {
            display: grid;
            grid-template-columns: 1fr;
        }
    }
    @media screen and (max-width: 576px) {
	    .box-info {
		    grid-template-columns: 1fr;
	    }
	    .table-data .head {
		    min-width: 420px;
	    }
    	.table-data .order table {
	    	min-width: 420px;
	    }
	    .table-data .todo .todo-list {
		    min-width: 420px;
	    }
    }

</style>


