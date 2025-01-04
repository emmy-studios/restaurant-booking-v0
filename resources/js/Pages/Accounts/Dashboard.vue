<script setup>

    import { ref, reactive } from "vue";
    import { Link, usePage } from "@inertiajs/vue3";
    import { NIcon, NButton } from "naive-ui";
    import { AssignmentReturnFilled, MenuBookFilled, ShoppingCartFilled } from "@vicons/material";
    import DashboardSidebar from "../Components/DashboardSidebar.vue";

    // Get Current Locale
    const { locale, user, translations, lastOrderMade, orderItems, totalOrders, totalReservations } = usePage().props;
    const currentLocale = locale || 'en';

    //const notifications = ref(4);

    const formatDate = (dateString, locale) => {
        const date = new Date(dateString);
        const options = {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        };
        return new Intl.DateTimeFormat(locale, options).format(date);
    };

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
                        <span>{{ translations.dashboard.welcome_back }}, {{ user.name }}!</span>
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
                    <n-icon class="bx"><ShoppingCartFilled/></n-icon>
                    <span class="text">
                        <h3>{{ totalOrders }}</h3>
                        <p>{{ translations.dashboard.total_orders }}</p>
					</span>
				</li>
				<li id="total-reservations-stats">
                    <n-icon class="bx"><MenuBookFilled/></n-icon>
                    <span class="text">
                        <!--<h3>{{ totalReservations }}</h3>-->
                        <h3>90</h3>
                        <p>{{ translations.dashboard.total_reservations }}</p>
					</span>
				</li>
				<li id="total-returns-stats">
                    <n-icon class="bx"><AssignmentReturnFilled/></n-icon>
                    <span class="text">
						<h3>2</h3>
                        <p>{{ translations.dashboard.returns }}</p>
					</span>
				</li>
            </ul>
            <!-- Stats Ends -->

            <!-- Orders Table -->
			<div class="table-data">
				<div class="order">
					<div class="head">
                        <h3>{{ translations.dashboard.recent_products_purchased }}</h3>
                        <n-button type=primary color="#EC6BDC">
                            <Link :href="`/${currentLocale}/orders`">View All</Link>
                        </n-button>
                    </div>
					<table>
						<thead>
							<tr>
                                <th>{{ translations.dashboard.customer }}</th>
                                <th>{{ translations.dashboard.order_date }}</th>
                                <th>{{ translations.dashboard.status }}</th>
							</tr>
						</thead>
						<tbody>
                            <tr v-for="item in orderItems" :key="item.id">
                                <td>
								    <img
                                        :src="`/storage/${item.product.image_url}`"
                                    >
                                    <p>{{ item.product.name }}</p>
								</td>
                                <td>{{ formatDate(item.created_at, currentLocale) }}</td>
                                <td><span class="status completed">{{ lastOrderMade.order_status }}</span></td>
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
    .box-info #total-reservations-stats {
        background-image: linear-gradient(to right top, #f9a0f6, #e88cf3, #d579f0, #be67ef, #a457ee);
    }
    .box-info #total-returns-stats {
        background-image: linear-gradient(to right top, #f485a3, #f77cad, #f874ba, #f46eca, #ec6bdc);
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
        .table-data .head {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .table-data .head h3 {
            font-size: 16px;
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


