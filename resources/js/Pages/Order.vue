<script setup>

    import DashboardSidebar from './Components/DashboardSidebar.vue';
    import { ref, defineProps, reactive, computed, onMounted, watch } from 'vue';
    import { usePage, Link } from '@inertiajs/vue3';
    import {
        NTimeline,
        NTimelineItem,
        NIcon,
        NButton,
    } from 'naive-ui';
    import {
        CheckCircleFilled,
        EditLocationSharp,
        Inventory2Filled,
        ArrowCircleRightSharp,
        ShoppingBagRound,
        KeyboardArrowDownOutlined,
        DeleteOutlineTwotone,
        ShoppingBasketRound,
        CreditCardTwotone,
        AddCardFilled,
        ArticleFilled,
        DeliveryDiningFilled,
    } from '@vicons/material';

    // Get Data From Controllers
    const props = defineProps(
        [
            'shoppingcartProducts',
            'productDiscounts',
            'lastOrderCreated',
            'user',
            'locale',
        ]
    );
    const { locale } = usePage().props;
    const currentLocale = locale || 'en';

    const userData = computed(() => {
        return props.user ? props.user : null;
    });

    const orderCode = computed(() => {
        return props.lastOrderCreated ? props.lastOrderCreated.order_code : null;
    });

    const status = computed(() => {
        return props.lastOrderCreated ? props.lastOrderCreated.order_status : null;
    });

    const orderProducts = reactive([]);

    // Currencies Array
    const currencies = computed(() => {
        const allCurrencies = orderProducts.flatMap(product =>
            product.prices.map(price => price.currency.currency_symbol)
        );
        return [...new Set(allCurrencies)];
    });
    const selectedCurrency = ref('USD $');

    // Remove Product From orderItems
    const removeProduct = (productID) => {
        const indexToRemove = orderProducts.findIndex(product => product.id === productID);

        if (indexToRemove !== -1) {
            orderProducts.splice(indexToRemove, 1);
            console.log("Product removed successfully.");
        } else {
            console.log("Product not found.");
        }
    };

    // Get Discounts
    const itemsDiscounts = computed(() => { // itemsDiscounts se define PRIMERO
        return props.productDiscounts.flatMap(discount => {
            return discount.products.map(product => ({
                id: discount.id,
                product_id: product.id,
                discount_code: discount.discount_code,
                discount_percentage: parseFloat(discount.discount_percentage) / 100,
            }));
        });
    });

    const productDiscountsMap = computed(() => { // productDiscountsMap se define DESPUÉS
        const discountsMap = {};
        itemsDiscounts.value.forEach(discount => { // Ahora itemsDiscounts.value está definido
            if (!discountsMap[discount.product_id]) {
                discountsMap[discount.product_id] = [];
            }
            discountsMap[discount.product_id].push(discount);
        });
        return discountsMap;
    });

    // Create Order Items
    onMounted(() => {
        // Clonar el array de productos de las props y hacerlo reactivo
        props.shoppingcartProducts.products.forEach(product => {
            orderProducts.push(reactive({ ...product, quantity: product.quantity || 1, itemSubtotal: []}));
        });
    });

    const orderItems = computed(() => {
        return orderProducts.map((product) => {
            const quantity = parseFloat(product.quantity) || 1;

            const itemSubtotal = product.prices.map((price) => ({
                currency: price.currency,
                number: parseFloat(price.unit_price) * quantity,
            }));

            const productDiscounts = productDiscountsMap.value[product.id] || [];
            let totalDiscountPercentage = 0;

            productDiscounts.forEach(discount => {
                totalDiscountPercentage += discount.discount_percentage;
            });

            const itemTotal = product.prices.map((price) => {
                let finalPrice = parseFloat(price.unit_price) * quantity;
                finalPrice -= finalPrice * totalDiscountPercentage; // Aplicar el descuento total
                return {
                    currency: price.currency,
                    number: finalPrice,
                };
            });

            return {
                id: product.id,
                name: product.name,
                description: product.description,
                image_url: product.image_url,
                quantity: quantity,
                prices: product.prices.map((price) => ({
                    currency: price.currency.currency_symbol,
                    unit_price: parseFloat(price.unit_price),
                })),
                itemSubtotal: itemSubtotal,
                itemTotal: itemTotal,
            };
        });
    });

    const updateSubtotals = () => {
        orderItems.value.forEach(item => {
            item.itemSubtotal = item.prices.map((price) => ({
                currency: price.currency,
                number: parseFloat(price.unit_price) * item.quantity,
            }))
        })
    }

    const updateTotals = () => {
        orderItems.value.forEach(item => {
            const productDiscounts = productDiscountsMap.value[item.id] || [];
            let totalDiscountPercentage = 0;

            productDiscounts.forEach(discount => {
                totalDiscountPercentage += discount.discount_percentage;
            });

            item.itemTotal = item.prices.map((price) => {
                let finalPrice = parseFloat(price.unit_price) * item.quantity;
                finalPrice -= finalPrice * totalDiscountPercentage;
                return {
                    currency: price.currency,
                    number: finalPrice,
                };
            });
        });
    };

    watch(() => orderProducts.map(prod => prod.quantity), (newQuantities) => {
        updateSubtotals();
        updateTotals();
    });

    // Order Summary
    const orderSummary = computed(() => {
        const summary = {
            subtotal: [],
            total: [],
            totalDiscounts: [],
        };

        orderItems.value.forEach(item => {
            item.itemSubtotal.forEach(subtotal => {
                const existingSubtotal = summary.subtotal.find(s => s.currency === subtotal.currency);
                if (existingSubtotal) {
                    existingSubtotal.amount += subtotal.number;
                } else {
                    summary.subtotal.push({ currency: subtotal.currency, amount: subtotal.number });
                }
            });

            item.itemTotal.forEach(total => {
                const existingTotal = summary.total.find(t => t.currency === total.currency);
                if (existingTotal) {
                    existingTotal.amount += total.number;
                } else {
                    summary.total.push({ currency: total.currency, amount: total.number });
                }
            });

            item.prices.forEach(price => {
                const originalPrice = parseFloat(price.unit_price) * item.quantity;
                const discountedPrice = item.itemTotal.find(total => total.currency === price.currency).number;
                const discountAmount = originalPrice - discountedPrice;

                const existingDiscount = summary.totalDiscounts.find(d => d.currency === price.currency);

                if(existingDiscount){
                    existingDiscount.amount += discountAmount;
                }else{
                    summary.totalDiscounts.push({currency: price.currency, amount: discountAmount})
                }
            })

        });

        return summary;
    });

    // Send Data to Controller
    const orderData = {
        'orderCode': orderCode,
        'orderStatus': status,
    };

    // Get User Information
    const notifications = ref(4);

    const changeStatus = (data) => {
        data = 'Completed';
    };

    const quantity = ref(0);
    const getQuantity = () => {
        alert(quantity.value);
    };


</script>

<template>

    <DashboardSidebar
        :notifications="notifications"
        :pageTitle="'Order'"
        :activePage="'Order'"
    >

        <template v-slot:mainContentSlot>
            <p>{{ code }}</p>
            <section
                class="order-container"
                v-if="
                    status === 'Pending' ||
                    status === 'Processing' ||
                    status === 'Completed' ||
                    status === 'Awaiting Payment' ||
                    status === 'Delivered'"
            >

                <!-- Status = Pending -->
                <article v-if="status === 'Pending'">
                    <div class="timeline-container">
                        <n-timeline horizontal>
      						<n-timeline-item
        						type="info"
        						title="Creating Order"
        						content="Choose your orders items">
                                <template #icon>
                                    <n-icon size=30><ShoppingBagRound/></n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item
                                color="gray"
                                title="Shipping Address"
                                content="Verify your delivered address"
                            >
                                <template #icon>
                                    <n-icon size=30>
                                        <EditLocationSharp />
                                    </n-icon>
                                </template>

                            </n-timeline-item>
                            <n-timeline-item
                                color="gray"
                                title="Payment Method"
                                content="Choose your order payments"
                            >
                                <n-icon size=30><CreditCardTwotone/></n-icon>
                            </n-timeline-item>
    					</n-timeline>
                    </div>

                    <div class="create-order-container">

                        <div class="header-title">
                            <h2>Your Cart</h2>
                            <n-icon id="arrow-icon" color="#f7b267" size=80>
                                <KeyboardArrowDownOutlined/>
                            </n-icon>
                        </div>

                        <div class="currency-container">
                            <span>Currency: </span>
                            <select v-model="selectedCurrency">
                                <option
                                    v-for="(currency, index) in currencies"
                                    :key="index"
                                    :value="currency">
                                    {{ currency }}
                                </option>
                            </select>
                        </div>

                        <div class="products-container">

                            <table class="product-table">

                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Currency</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(item, index) in orderItems" :key="item.id">
                                        <td>
                                            <span class="product-image">
                                                <img
                        :src="item.image_url ? `/storage/${item.image_url}` : '/assets/images/products/hamburger.png'">
                                            </span>
                                        </td>
                                        <td>
                                            {{ item.name }}
                                        </td>
                                        <td>
                                            <span v-for="price in item.prices" :key="price.currency">
                                                <span v-if="price.currency === selectedCurrency">
                                                    {{ selectedCurrency }}
                                                </span>
                                            </span>
                                            <span
                                                v-if="!item.prices.some(price => price.currency === selectedCurrency)"
                                            >
                                                Not Available
                                            </span>
                                        </td>
                                        <td>
                                            <span v-for="price in item.prices" :key="price.currency">
                                                <span v-if="price.currency === selectedCurrency">
                                                    {{ price.unit_price }}
                                                </span>
                                            </span>
                                            <span
                                                v-if="!item.prices.some(price => price.currency === selectedCurrency)"
                                            >
                                                Not Available
                                            </span>
                                        </td>
                                        <td>
                                            <input
                                                type="number"
                                                v-model.number="orderProducts[index].quantity"
                                                @input="updateSubtotals"
                                                min="0"
                                                placeholder="Enter quantity"
                                                style="width: 80px;"
                                            >
                                        </td>
                                        <td>
                                            <span v-for="(subtotal, key) in item.itemSubtotal" :key="key">
                                                <span v-if="subtotal.currency === selectedCurrency">
                                                    {{ subtotal.number }} {{subtotal.symbol}}
                                                </span>
                                            </span>
                                        </td>
                                        <td>
                                            <span v-for="(total, key) in item.itemTotal" :key="key">
                                                <span v-if="total.currency === selectedCurrency">
                                                    {{ total.number }} {{total.symbol}}
                                                </span>
                                            </span>
                                        </td>
                                        <td>
                                            <n-icon @click="removeProduct(item.id)">
                                                <DeleteOutlineTwotone/>
                                            </n-icon>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>

                        </div>

                        <div class="order-resume">
                            <div class="resume-item">
                                <span>Currency</span>
                                <p>{{ selectedCurrency }}</p>
                            </div>
                            <div class="resume-item">
                                <span>Subtotal</span>
                                <template v-for="(subtotal, index) in orderSummary.subtotal" :key="index">
                                    <p v-if="subtotal.currency === selectedCurrency">{{ subtotal.amount }}</p>
                                </template>
                            </div>
                            <div class="resume-item">
                                <span>Total Discounts</span>
                                <template v-for="(discount, index) in orderSummary.totalDiscounts" :key="index">
                                    <p v-if="discount.currency === selectedCurrency">{{ discount.amount }}</p>
                                </template>
                            </div>
                            <div class="resume-item">
                                <span>Total</span>
                                <template v-for="(total, index) in orderSummary.total" :key="index">
                                    <p v-if="total.currency === selectedCurrency">{{ total.amount }}</p>
                                </template>
                            </div>
                            <Link
                                id="checkout-btn"
                                method="post"
                                :data="{
                                    orderCode: lastOrderCreated.order_code,
                                    orderStatus: status,
                                    orderSubtotal: 300,
                                    orderDiscounts: 200,
                                    orderTotal: 100,
                                    orderCurrency: 'CRC ₡',
                                    orderItems: orderItems,
                                }"
                                :href="`/${currentLocale}/order/add-items`"
                            >
                                Proceed To Checkout
                            </Link>
                        </div>


                        <div>
                            <p>{{ orderItems }}</p>
                            <p>------------------------------------------</p>
                            <p>{{ orderSummary }}</p>
                        </div>

                    </div>

                    <div class="pending-actions">
                        <n-icon
                            size=40
                            @click="status = 'Processing'"
                        >
                            <ArrowCircleRightSharp/>
                        </n-icon>
                    </div>
                </article>


                <!-- Status = Processing -->
                <article v-else-if="status === 'Processing'" class="processing-container">
                    <div class="timeline-container">
                        <n-timeline horizontal>
      						<n-timeline-item
        						type="success"
                                color="success"
        						title="ORDER CREATED"
                            >
                                <template #icon>
                                    <n-icon size=30>
                                        <CheckCircleFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item
                                type="info"
                                title="Shipping Address"
                                content="Verify your delivered address"
                                time="2018-04-03 20:46"
                            >
                                <template #icon>
                                    <n-icon size=30>
                                        <EditLocationSharp />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item
                                color="gray"
                                title="PAYMENT"
                            >
                                <n-icon size=30><CreditCardTwotone/></n-icon>
                            </n-timeline-item>
                            <n-timeline-item
                                color="gray"
                                title="INVOICE"
                            >
                                <n-icon size=30><ArticleFilled/></n-icon>
                            </n-timeline-item>
                            <n-timeline-item
                                color="gray"
                                title="DELIVEREY"
                            >
                                <n-icon size=30><DeliveryDiningFilled/></n-icon>
                            </n-timeline-item>
    					</n-timeline>
                    </div>
                    <div class="address-header">
                        <div class="header-image">
                            <img src="/assets/images/system/house.svg">
                        </div>
                        <div class="header-text">
                            <span>Address</span>
                            <p>Shipping Details</p>
                        </div>
                    </div>
                    <div class="address-container">
                        <div class="country-item">
                            <span>Country:</span>
                            <input v-model="userData.country">
                        </div>
                        <div class="city-item">
                            <span>City</span>
                            <input v-model="userData.city">
                        </div>
                        <div class="contact-item">
                            <div class="phone-code">
                                <span>Phone Code:</span>
                                <input v-model="userData.country_code">
                            </div>
                            <div class="phone-number">
                                <span>Phone Number:</span>
                                <input v-model="userData.phone_number">
                            </div>
                        </div>
                        <div class="address-item">
                            <textarea rows="4" cols="50" v-model="userData.address"></textarea>
                        </div>
                    </div>
                    <div class="processing-actions">
                        <Link
                            method="post"
                            :data="{
                                userOrderCode: lastOrderCreated.order_code,
                                userCity: userData.city,
                                userCountry: userData.country,
                                userAddress: userData.address,
                                userCountryCode: userData.country_code,
                                userPhoneNumber: userData.phone_number
                            }"
                            :href="`/${currentLocal}/update-customer-address`"
                            style="padding: 5px 7px; background-color: red; color: #fff; border-radius: 8px;"
                        >
                            CONTINUE
                        </Link>
                    </div>
                </article>
                <!-- Status = Processing -->

                <!-- Status = Awaiting Payment -->
                <article v-else-if="status === 'Awaiting Payment'">
                    <div class="timeline-container">
                        <n-timeline horizontal>
      						<n-timeline-item
        						type="success"
                                color="success"
        						title="CREATED"
                            >
                                <template #icon>
                                    <n-icon size=30>
                                        <CheckCircleFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item
                                type="success"
                                color="success"
                                title="ADDRESS"
                            >
                                <template #icon>
                                    <n-icon size=30>
                                        <CheckCircleFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item
                                type="info"
                                title="Payment Information"
                                content="Choose your payment information"
                                time="2018-04-03 20:46"
                            >
                                <template #icon>
                                    <n-icon size=30>
                                        <AddCardFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item
                                color="gray"
                                title="INVOICE"
                            >
                                <n-icon size=30><ArticleFilled/></n-icon>
                            </n-timeline-item>
                            <n-timeline-item
                                color="gray"
                                title="DELIVERY"
                            >
                                <n-icon size=30><DeliveryDiningFilled/></n-icon>
                            </n-timeline-item>
    					</n-timeline>
                    </div>
                    <div class="payment-container">
                        <p>Choose Payment Method</p>
                    </div>
                    <div class="payment-actions">
                        <Link
                            :href="`/${currentLocale}/billing/create`"
                            method="post"
                            :data="{
                                userOrderCode: lastOrderCreated.order_code
                            }"
                        >
                            NEXT
                        </Link>
                    </div>
                </article>

                <!-- Status = Completed -->
                <article v-else-if="status === 'Completed'" class="invoice-container">
                    <p>Order Completed</p>
                    <p>Generate Invoice</p>
                </article>

                <!-- Status = Delivered -->
                <article v-else-if="status === 'Delivered'" class="voucher-container">
                    <p>
                        Your order has been delivered,
                        if you want a proof of purchase
                        you can print it below
                    </p>
                    <button type=primary>Generate</button>
                </article>

            </section>

            <section v-else class="empty-container">
                <p>Not Order in Process</p>
            </section>

         </template>

    </DashboardSidebar>

</template>

<style scoped>

    .order-container {
        display: flex;
        flex-direction: column;
        margin-top: 60px;
    }
    .timeline-container {
        display: flex;
        justify-content: center;
        padding: 20px 20px;
        overflow: auto;
    }


    /* Create Order */
    .create-order-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-top: 60px;
    }
    .header-title {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding-top: 20px;
        padding-bottom: 20px;
    }
    .header-title h2 {
        font-weight: bold;
        font-size: 28px;
    }
    .currency-container {
        display: flex;
        gap: 10px;
    }
    .products-container {
        max-width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
        /*border: 1px solid #ddd;*/
        border: 1px solid #f7b267;
        border-radius: 8px;
        background-color: #fff;
    }
    .product-table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        min-width: 600px;
    }
    .product-table th,
    .product-table td {
        padding: 12px 15px;
        text-align: left;
        /*border: 1px solid #ddd;*/
    }
    .product-table th {
        /*background-color: #f4f4f4;*/
        background-color: #f7b267;
        font-weight: bold;
    }
    .product-table tr:nth-child(even) {
        background-color: #f9f9f9;
        /*background-color: #f7b267;*/
    }
    .product-table tr:hover {
        background-color: #f1f1f1;
    }
    .product-image img {
        width: 50px;
        height: 50px;
        border-radius: 5px;
    }
    .order-resume {
        display: flex;
        flex-direction: column;
        background-color: pink;
        margin-top: 20px;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 20px;
        padding-right: 20px;
        border-radius: 10px;
    }
    .resume-item {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }
    .resume-item span {
        font-weight: bold;
        font-size: 14px;
    }
    #checkout-btn {
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 5px;
        padding-right: 5px;
        color: #fff;
        background-color: #f7b267;
    }


    /* SHIPPING INFORMATION */
    .address-header {
        display: flex;
        align-items: flex-end;
        padding-top: 30px;
        gap: 30px;
    }
    .header-image {
        display: flex;
    }
    .header-image img {
        width: 100px;
        height: 100px;
    }
    .header-text {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .header-text span {
        font-weight: bold;
        font-size: 20px;
    }
    .header-text p {
        text-transform: uppercase;
    }
    .processing-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .address-container {
        display: flex;
        flex-direction: column;
        margin-top: 30px;
        padding: 60px 60px;
        gap: 20px;
        background-color: red;
        border-radius: 10px;
    }
    .country-item,
    .city-item {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .country-item span, .city-item span, .contact-item span {
        font-weight: bold;
        font-size: 16px;
    }
    .country-item input, .city-item input, .contact-item input {
        padding: 10px 10px;
        border: 1px solid orange;
    }
    .address-item textarea {
        padding: 10px 10px;
    }
    .contact-item {
        display: flex;
        gap: 10px;
    }
    .processing-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    /* SHIPPING INFORMATION */

    /* PAYMENT INFORMATION */
    .payment-container {
        display: flex;
        padding: 60px 60px;
        margin-top: 60px;
        background-color: red;
    }
    .payment-actions {
        display: flex;
        align-items: center;
        padding: 20px 20px;
        justify-content: flex-end;
    }
    /* PAYMENT INFORMATION */

    /* GENERATE INVOICE */
    /* GENERATE INVOICE */

    /* GENERATE VOUCHER */
    /* GENERATE VOUCHER */

    /* EMPTY CONTAINER */
    .empty-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 40px 40px;
    }
    /* EMPTY CONTAINER */
</style>
