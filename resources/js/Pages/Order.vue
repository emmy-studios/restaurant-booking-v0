<script setup>

    import DashboardSidebar from './Components/DashboardSidebar.vue';
    import { ref, defineProps, reactive, computed, onMounted, watch, onUnmounted } from 'vue';
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
            'paymentMethods',
            'countries',
            'countryCodes',
        ]
    );
    const { locale } = usePage().props;
    const currentLocale = locale || 'en';

    // Timeline Orientation
    const isHorizontal = ref(true);
    const updateTimelineOrientation = () => {
        isHorizontal.value = window.innerWidth >= 768;
    };

    onMounted(() => {
        updateTimelineOrientation();
        window.addEventListener('resize', updateTimelineOrientation);
    });

    onUnmounted(() => {
        window.removeEventListener('resize', updateTimelineOrientation);
    });
    // Timeline Orientation

    const userData = computed(() => {
        return props.user ? props.user : null;
    });

    const orderCode = computed(() => {
        return props.lastOrderCreated ? props.lastOrderCreated.order_code : null;
    });

    const status = computed(() => {
        return props.lastOrderCreated ? props.lastOrderCreated.order_status : null;
    });

    // Payment Methods
    const paymentMethods = computed(() => {
        return props.paymentMethods ? props.paymentMethods : [];
    });
    const paymentMethod = ref('Cash');

    // Get Country Codes - Country
    const countries = computed(() => {
        return props.countries ? props.countries : [];
    });
    const countryCodes = computed(() => {
        return props.countryCodes ? props.countryCodes : [];
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

    // GET CURRENT DATETIME
    const getCurrentDateTime = () => {
        const now = new Date();

        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');

        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');

        return `${year}-${month}-${day} ${hours}:${minutes}`;
    };

</script>

<template>

    <DashboardSidebar
        :notifications="notifications"
        :pageTitle="'Order'"
        :activePage="'Order'"
    >

        <template v-slot:mainContentSlot>
            <section
                class="order-container"
                v-if="
                    status === 'Pending' ||
                    status === 'Processing' ||
                    status === 'Completed' ||
                    status === 'Awaiting Payment' ||
                    status === 'Delivered' ||
                    status === 'Failed' ||
                    status === 'On Hold' ||
                    status === 'Refunded' ||
                    status === 'Shipped' ||
                    status === 'Cancelled'"
            >

                <!-- Status = Pending -->
                <article v-if="status === 'Pending'" class="article-container">
                    <div class="timeline-container">
                        <n-timeline :horizontal=isHorizontal size="large">
      						<n-timeline-item
        						type="info"
        						title="Creating Order"
        						content="Choose your orders items"
                                :time=getCurrentDateTime()
                            >
                                <template #icon>
                                    <n-icon size=30><ShoppingBagRound/></n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item color="gray" line-type="dashed" title="ADDRESS">
                                <template #icon>
                                    <n-icon size=30>
                                        <EditLocationSharp/>
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item color="gray" line-type="dashed" title="PAYMENT">
                                <template #icon>
                                    <n-icon size=30>
                                        <CreditCardTwotone/>
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item color="gray" line-type="dashed" title="INVOICE">
                                <template #icon>
                                    <n-icon size=30>
                                        <ArticleFilled/>
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item color="gray" line-type="dashed" title="DELIVERY">
                                <template #icon>
                                    <n-icon size=30>
                                        <DeliveryDiningFilled/>
                                    </n-icon>
                                </template>
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
                            <div class="checkout-container">
                                <Link
                                    id="checkout-btn"
                                    method="post"
                                    :data="{
                                        orderCode: lastOrderCreated.order_code,
                                        orderSubtotal: orderSummary.subtotal,
                                        orderDiscounts: 200,
                                        orderTotal: orderSummary.total,
                                        orderCurrency: selectedCurrency,
                                        orderItems: orderItems,
                                    }"
                                    :href="`/${currentLocale}/order/add-items`"
                                >
                                    Proceed To Checkout
                                </Link>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Status = Processing -->
                <article v-else-if="status === 'Processing'" class="article-container">
                    <div class="timeline-container">
                        <n-timeline :horizontal=isHorizontal size="large">
      						<n-timeline-item type="success" color="success" title="ORDER CREATED">
                                <template #icon>
                                    <n-icon size=30>
                                        <CheckCircleFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item
                                type="info"
                                title="SHIPPING ADDRESS"
                                content="Verify your shipping address"
                                :time=getCurrentDateTime()
                            >
                                <template #icon>
                                    <n-icon size=30>
                                        <EditLocationSharp />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item color="gray" line-type="dashed" title="PAYMENT">
                                <template #icon>
                                    <n-icon size=30>
                                        <CreditCardTwotone/>
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item color="gray" line-type="dashed" title="INVOICE">
                                <template #icon>
                                    <n-icon size=30>
                                        <ArticleFilled/>
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item color="gray" line-type="dashed" title="DELIVERY">
                                <template #icon>
                                    <n-icon size=30>
                                        <DeliveryDiningFilled/>
                                    </n-icon>
                                </template>
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
                        <div class="address-item">
                            <div class="country-item">
                                <span>Country:</span>
                                <select v-model="userData.country">
                                    <option v-for="(country, index) in countries" :key="index" :value="country">
                                        {{ country }}
                                    </option>
                                </select>
                            </div>
                            <div class="city-item">
                                <span>City</span>
                                <input v-model="userData.city">
                            </div>
                        </div>
                        <div class="address-item">
                            <div class="code-item">
                                <span>Phone Code:</span>
                                <select v-model="userData.country_code">
                                    <option v-for="(code, index) in countryCodes" :key="index" :value="code">
                                        {{ code }}
                                    </option>
                                </select>
                            </div>
                            <div class="phone-item">
                                <span>Phone Number:</span>
                                <input v-model="userData.phone_number">
                            </div>
                        </div>
                        <div class="address-description">
                            <span>Address:</span>
                            <textarea rows="4" cols="50" v-model="userData.address"></textarea>
                        </div>
                    </div>
                    <div class="processing-actions">
                        <Link
                            method="post"
                            as="button"
                            id="update-address-btn"
                            :data="{
                                userOrderCode: lastOrderCreated.order_code,
                                userCity: userData.city,
                                userCountry: userData.country,
                                userAddress: userData.address,
                                userCountryCode: userData.country_code,
                                userPhoneNumber: userData.phone_number
                            }"
                            :href="`/${currentLocal}/update-customer-address`"
                        >
                            CONTINUE
                        </Link>
                    </div>
                </article>
                <!-- Status = Processing -->

                <!-- Status = Awaiting Payment -->
                <article v-else-if="status === 'Awaiting Payment'" class="payment-container">
                    <div class="timeline-container">
                        <n-timeline :horizontal=isHorizontal size="large">
      						<n-timeline-item type="success" color="success" title="CREATED">
                                <template #icon>
                                    <n-icon size=30>
                                        <CheckCircleFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item type="success" color="success"title="ADDRESS">
                                <template #icon>
                                    <n-icon size=30>
                                        <CheckCircleFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item
                                type="info"
                                title="PAYMENT INFORMATION"
                                line-type="dashed"
                                content="Choose your payment information"
                                :time=getCurrentDateTime()
                            >
                                <template #icon>
                                    <n-icon size=30>
                                        <AddCardFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item color="gray" title="INVOICE" line-type="dashed">
                                <template #icon>
                                    <n-icon size=30>
                                        <ArticleFilled/>
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item color="gray" title="DELIVERY" line-type="dashed">
                                <template #icon>
                                    <n-icon size=30>
                                        <DeliveryDiningFilled/>
                                    </n-icon>
                                </template>
                            </n-timeline-item>
    					</n-timeline>
                    </div>
                    <div class="payment-header">
                        <div class="payment-icon">
                            <img src="/assets/images/system/credit_card01.svg">
                        </div>
                        <div class="header-text">
                            <span>Payment</span>
                            <p>Update your payment information</p>
                        </div>
                    </div>
                    <div class="payment-content">
                        <div class="payment-card">
                            <h3>Order Code:</h3>
                            <p>
                                {{ lastOrderCreated.order_code }}
                            </p>
                            <h3>Currency:</h3>
                            <p>
                                {{ lastOrderCreated.currency_symbol }}
                            </p>
                            <h3>Payment Method:</h3>
                            <select v-model="paymentMethod">
                                <option v-for="(payment, index) in paymentMethods" :key="index" :value="payment">
                                    {{ payment }}
                                </option>
                            </select>
                            <div class="card-aside">
                                <div class="aside-item">
                                    <h3>Subtotal:</h3>
                                    <p>{{ lastOrderCreated.subtotal }}</p>
                                </div>
                                <div class="aside-item">
                                    <h3>Total:</h3>
                                    <p>{{ lastOrderCreated.total }}</p>
                                </div>
                            </div>
                            <div class="payment-actions">
                                <Link
                                    id="next-button"
                                    :href="`/${currentLocale}/billing/create`"
                                    method="post"
                                    :data="{
                                        userOrderCode: lastOrderCreated.order_code,
                                        paymentMethod: paymentMethod,
                                    }"
                                >
                                    CONTINUE
                                </Link>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Status = Completed -->
                <article v-else-if="status === 'Completed'" class="article-container">
                    <div class="timeline-container">
                        <n-timeline :horizontal=isHorizontal size="large">
      						<n-timeline-item type="success" color="success" title="CREATED">
                                <template #icon>
                                    <n-icon size=30>
                                        <CheckCircleFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item type="success" color="success" title="ADDRESS">
                                <template #icon>
                                    <n-icon size=30>
                                        <CheckCircleFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item type="success" color="success" title="PAYMENT">
                                <template #icon>
                                    <n-icon size=30>
                                        <CheckCircleFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item
                                color="info"
                                type="info"
                                line-type="dashed"
                                title="GENERATE INVOICE"
                                content="Print your invoice"
                                :time=getCurrentDateTime()

                            >
                                <template #icon>
                                    <n-icon size=30>
                                        <ArticleFilled/>
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item color="gray" title="DELIVERY" line-type="dashed">
                                <template #icon>
                                    <n-icon size=30>
                                        <DeliveryDiningFilled/>
                                    </n-icon>
                                </template>
                            </n-timeline-item>
    					</n-timeline>
                    </div>
                    <aside class="message-container">
                        <div class="card">
                            <div class="card-icon">
                                <img src="/assets/images/system/success_tick.svg">
                            </div>
                            <div class="card-content">
                                <span>Order Successfully</span>
                                <p>
                                    Your order has been created, if you want an invoice,
                                    click below to print it.
                                </p>
                            </div>
                            <div class="card-actions">
                                <n-button type=primary>PRINT</n-button>
                            </div>
                        </div>
                    </aside>
                </article>

                <!-- Status = Delivered -->
                <article v-else-if="status === 'Delivered'" class="article-container">
                    <div class="timeline-container">
                        <n-timeline :horizontal=isHorizontal size="large">
      						<n-timeline-item type="success" color="success" title="CREATED">
                                <template #icon>
                                    <n-icon size=30>
                                        <CheckCircleFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item type="success" color="success" title="ADDRESS">
                                <template #icon>
                                    <n-icon size=30>
                                        <CheckCircleFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item type="success" color="success" title="PAYMENT">
                                <template #icon>
                                    <n-icon size=30>
                                        <CheckCircleFilled />
                                    </n-icon>
                                </template>
                            </n-timeline-item>
                            <n-timeline-item
                                color="info"
                                type="info"
                                title="DELIVERY VOUCHER"
                                content="Generate a delivered voucher"
                                :time=getCurrentDateTime()
                            >
                                <template #icon>
                                    <n-icon size=30>
                                        <DeliveryDiningFilled/>
                                    </n-icon>
                                </template>
                            </n-timeline-item>
    					</n-timeline>
                    </div>
                    <aside class="message-container">
                        <div class="card">
                            <div class="card-icon">
                                <img src="/assets/images/system/delivery_truck.svg">
                            </div>
                            <div class="card-content">
                                <span>Your order has been placed</span>
                                <p>
                                    if you want a proof of purchase
                                    you can print it below.
                                </p>
                            </div>
                            <div class="card-actions">
                                <n-button type=primary>GENERATE</n-button>
                            </div>
                        </div>
                    </aside>
                </article>

                <!-- Status = Failed -->
                <article v-else-if="status === 'Failed'">
                    <p>Order Failed</p>
                </article>

                <!-- Status = Shipped -->
                <article v-else-if="status === 'Shipped'">
                    <p>Order Shipped</p>
                </article>

                <!-- Status = Refunded -->
                <article v-else-if="status === 'Refunded'">
                    <p>Order Refunded</p>
                </article>

                <!-- Status = On Hold -->
                <article v-else-if="status === 'On Hold'">
                    <p>Order On Hold</p>
                </article>

                <!-- Status = Cancelled -->
                <article v-else-if="status === 'Cancelled'" class="article-container">
                    <div class="message-container">
                        <div class="card">
                            <div class="card-icon">
                                <img src="/assets/images/system/cancel_icon.svg">
                            </div>
                            <div class="card-content">
                                <span>This order has been cancelled!</span>
                            </div>
                        </div>
                    </div>
                </article>

            </section>

            <section v-else class="empty-container">
                <p>Not Order in Process</p>
            </section>

         </template>

    </DashboardSidebar>

</template>

<style scoped>

    /* Main Styles */
    .order-container {
        display: flex;
        flex-direction: column;
        margin-top: 60px;
    }
    .main-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .timeline-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px 20px;
        overflow: auto;
        max-width: 100%;
    }
    .article-container {
        display: flex;
        flex-direction: column;
    }
    .message-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 60px;
    }
    .card {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 10px;
        background-color: #f9f9f9;
        padding: 30px 30px;
        border-radius: 10px;
    }
    .card-icon {
        display: flex;
        padding: 10px 10px;
        justify-content: center;
    }
    .card-icon img {
        width: 100px;
        height: 100px;
    }
    .card-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 10px 10px;
        gap: 10px;
    }
    .card-content span {
        font-weight: bold;
        font-size: 1.5rem;
    }
    .card-content p {
        color: gray;
    }
    .card-actions {
        display: flex;
        justify-content: center;
    }
    /* Main Styles */

    /* Create Order Container */
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
    /* Create Order Container */

    /* Currency Container */
    .currency-container {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .currency-container span {
        font-weight: bold;
    }
    .currency-container select {
        background-color: #f9f9f9;
    }
    /* Currency Container */

    /* Shipping Products Table */
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
        background-color: #f9f9f9;
    }
    .product-image img {
        width: 50px;
        height: 50px;
        border-radius: 5px;
    }
    /* Shipping Products Table */

    /* Order Resume */
    .order-resume {
        display: flex;
        width: 50%;
        gap: 10px;
        flex-direction: column;
        background-color: #fff;
        border: 1px solid #adb5bd;
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
    .checkout-container {
        display: flex;
        align-items: center;
    }
    #checkout-btn {
        padding-top: 6px;
        padding-bottom: 6px;
        padding-left: 5px;
        padding-right: 5px;
        color: #fff;
        width: 100%;
        text-align: center;
        background-color: #f79d65;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 4px;
    }
    #checkout-btn:hover {
        cursor: pointer;
        background-color: #f7b267;
    }
    /* Order Resume */

    /* Update Shipping Address Form */
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
    .address-container {
        display: flex;
        flex-direction: column;
        margin-top: 30px;
        padding: 60px 60px;
        gap: 20px;
        background-color: #eae4e9;
        border-radius: 10px;
    }
    .address-item {
        display: flex;
        justify-content: center;
        gap: 10px;
        align-items: center;
    }
    .country-item, .city-item,
    .code-item, .phone-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
        width: 100%;
    }
    .country-item span, .city-item span,
    .code-item span, .phone-item span, .address-description span {
        font-weight: bold;
        font-zise: 2rem;
    }
    .country-item select, .city-item input,
    .code-item select, .phone-item input {
        padding: 10px 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        transition: border-color 0.3s;
    }
    .country-item select:focus, .city-item input:focus,
    .code-item select:focus, .phone-item input:focus {
        border-color: #E77917;
        outline: none;
    }
    .country-item select, .code-item select {
        background-color: #fff;
        border: 1px solid #ccc;
    }
    .address-description {
        display: flex;
        flex-direction: column;
    }
    .address-description textarea {
        padding: 10px 10px;
        width: 100%;
        border-radius: 5px;
        border: 1px solid #ccc;
        transition: border-color 0.3s;
    }
    .address-description textarea:focus {
        border-color: #E77917;
        outline: none;
    }
    .processing-actions {
        display: flex;
        padding-top: 15px;
        padding-bottom: 15px;
    }
    #update-address-btn {
        padding: 5px 16px;
        width: 100%;
        background-color: #E77917;
        color: #fff;
        text-align: center;
        border-radius: 5px;
    }
    /* Update Shipping Address Form */

    /* Payment Information */
    .payment-header {
        display: flex;
        align-items: center;
        padding-top: 30px;
        gap: 30px;
    }
    .payment-icon {
        display: flex;
    }
    .payment-icon img {
        width: 100px;
        height: 100px;
    }
    .payment-content {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .payment-card {
        display: flex;
        flex-direction: column;
        gap: 10px;
        border: 1px solid #adb5bd;
        background-color: #f9f9f9;
        width: 50%;
        padding: 20px 20px;
        border-radius: 10px;
    }
    .payment-card h3 {
        color: #000;
        font-weight: bold;
        padding: 4px 4px;
    }
    .payment-card p, select {
        background-color: #fff;
        border: 1px solid #adb5bd;
        border-radius: 5px;
        color: #000;
        padding: 8px 8px;
    }
    .card-aside {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
    }
    .aside-item {
        display: flex;
        width: 100%;
        flex-direction: column;
        gap: 10px;
    }
    .payment-actions {
        display: flex;
        align-items: center;
        padding-top: 20px;
        width: 100%;
    }
    #next-button {
        padding: 10px 10px;
        width: 100%;
        background-color: #E77917;
        border-radius: 5px;
        text-align: center;
        color: #fff;
        font-weight: bold;
    }
    #next-button:hover {
        cursor: pointer;
        background-color: #f1b559;
    }
    /* Payment Information */

    /* Empty Container */
    .empty-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 40px 40px;
    }
    /* Empty Container */

    /* Responsive Media Queries */
    @media (max-width: 896px) {
        .order-resume {
            width: 100%;
        }
        .payment-card {
            width: 100%;
        }
        .card-aside {
            display: flex;
            flex-direction: column;
        }
        .address-item {
            flex-direction: column;
        }
        .address-container {
            padding: 30px 30px;
        }
    }

</style>
