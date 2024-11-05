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
    const user = reactive(usePage().props.user);
    const notifications = ref(4);
    //const imageProfile = ref("/assets/images/panels/admin_profile.png");

    import DashboardSidebar from "./Components/DashboardSidebar.vue";

</script>

<template>

    <DashboardSidebar
        :notifications="notifications"
        :pageTitle="'Dashboard'"
    >

        <template v-slot:mainContentSlot>

            <!-- Stats -->
			<ul class="box-info">
				<li>
                    <n-icon class="bx"><CalendarMonthFilled/></n-icon>
                    <span class="text">
						<h3>1020</h3>
						<p>New Order</p>
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
					<!--<div class="head">
						<h3>Recent Orders</h3>
                        <n-icon class="bx"><SearchFilled/></n-icon>
					    <n-icon class="bx"><FilterAltSharp/></n-icon>
                    </div>-->
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

	/* MAIN */
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
	 .head-title .left .breadcrumb li a.active {
		color: #3C91E6;
		pointer-events: unset;
	}
	#content main .box-info {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
		grid-gap: 24px;
		margin-top: 36px;
	}
	#content main .box-info li {
		padding: 24px;
		background: #F9F9F9;
		border-radius: 20px;
		display: flex;
		align-items: center;
		grid-gap: 24px;
	}
	#content main .box-info li .bx {
		width: 80px;
		height: 80px;
		border-radius: 10px;
		font-size: 36px;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	#content main .box-info li:nth-child(1) .bx {
		background: #CFE8FF;
		color: #3C91E6;
	}
	#content main .box-info li:nth-child(2) .bx {
		background: #FFF2C6;
		color: #FFCE26;
	}
	#content main .box-info li:nth-child(3) .bx {
		background: #FFE0D3;
		color: #FD7238;
	}
	#content main .box-info li .text h3 {
		font-size: 24px;
		font-weight: 600;
		color: #342E37;
	}
	#content main .box-info li .text p {
		color: #342E37;
	}

	#content main .table-data {
		display: flex;
		flex-wrap: wrap;
		grid-gap: 24px;
		margin-top: 24px;
		width: 100%;
		color: #342E37;
	}
	#content main .table-data > div {
		border-radius: 20px;
		background: #F9F9F9;
		padding: 24px;
		overflow-x: auto;
	}
	#content main .table-data .head {
		display: flex;
		align-items: center;
		grid-gap: 16px;
		margin-bottom: 24px;
	}
	#content main .table-data .head h3 {
		margin-right: auto;
		font-size: 24px;
		font-weight: 600;
	}
	#content main .table-data .head .bx {
		cursor: pointer;
	}

	#content main .table-data .order {
		flex-grow: 1;
		flex-basis: 500px;
	}
	#content main .table-data .order table {
		width: 100%;
		border-collapse: collapse;
	}
	#content main .table-data .order table th {
		padding-bottom: 12px;
		font-size: 13px;
		text-align: left;
		border-bottom: 1px solid #eee;
	}
	#content main .table-data .order table td {
		padding: 16px 0;
	}
	#content main .table-data .order table tr td:first-child {
		display: flex;
		align-items: center;
		grid-gap: 12px;
		padding-left: 6px;
	}
	#content main .table-data .order table td img {
		width: 36px;
		height: 36px;
		border-radius: 50%;
		object-fit: cover;
	}
	#content main .table-data .order table tbody tr:hover {
		background: #eee;
	}
	#content main .table-data .order table tr td .status {
		font-size: 10px;
		padding: 6px 16px;
		color: #F9F9F9;
		border-radius: 20px;
		font-weight: 700;
	}
	#content main .table-data .order table tr td .status.completed {
		background: #3C91E6;
	}
	#content main .table-data .order table tr td .status.process {
		background: #FFCE26;
	}
	#content main .table-data .order table tr td .status.pending {
		background: #FD7238;
	}

	#content main .table-data .todo {
		flex-grow: 1;
		flex-basis: 300px;
	}
	#content main .table-data .todo .todo-list {
		width: 100%;
	}
	#content main .table-data .todo .todo-list li {
		width: 100%;
		margin-bottom: 16px;
		background: #eee;
		border-radius: 10px;
		padding: 14px 20px;
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
	#content main .table-data .todo .todo-list li .bx {
		cursor: pointer;
	}
	#content main .table-data .todo .todo-list li.completed {
		border-left: 10px solid #3C91E6;
	}
	#content main .table-data .todo .todo-list li.not-completed {
		border-left: 10px solid #FD7238;
	}
	#content main .table-data .todo .todo-list li:last-child {
		margin-bottom: 0;
	}
	/* MAIN */
	/* CONTENT */

    /* RESPONSIVE DESIGN */
    @media screen and (max-width: 768px) {
	    #content {
		    width: calc(100% - 60px);
		    left: 200px;
	    }
    }

    @media screen and (max-width: 576px) {
	    #content nav form .form-input input {
		    display: none;
	    }

	    #content nav form .form-input button {
		    width: auto;
		    height: auto;
		    background: transparent;
		    border-radius: none;
		    color: #342E37;
	    }

	    #content nav form.show .form-input input {
		    display: block;
		    width: 100%;
	    }
	    #content nav form.show .form-input button {
		    width: 36px;
		    height: 100%;
		    border-radius: 0 36px 36px 0;
		    color: #F9F9F9;
		    background: #DB504A;
	    }

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


