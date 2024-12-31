<script setup>

    import { computed } from "vue";
    import { usePage, Link } from "@inertiajs/vue3";
    import DashboardSidebar from "../Components/DashboardSidebar.vue";
    import { NButton } from 'naive-ui';
    import html2pdf from 'html2pdf.js';

    const { locale, invoiceDetails, orderItems, invoiceItems, user, translations } = usePage().props;
    const currentLocale = locale || 'en';

    // Translate Slot Props
    const localizedActivePage = computed(() => {
        return props.translations.profile.dashboard || 'Profile';
    });

    const localizedPageTitle = computed(() => {
        return props.translations.profile.profile || 'Dashboard';
    });

    const formatDate = (dateString, locale) => {
        const date = new Date(dateString);
        const options = {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        };
        return new Intl.DateTimeFormat(locale, options).format(date);
    };

    function formatValue(value) {
        return value.replace(/\.00$/, "");
    }

    const exportToPdf = () => {
        var element = document.getElementById('invoice-printable');
        var opt = {
            margin:       0.3,
            filename:     'invoice.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 3 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().from(element).set(opt).save();
    };

</script>

<template>

    <DashboardSidebar
        :activePage="'Invoice Details'"
        :pageTitle="'Invoice Details'">

        <template v-slot:mainContentSlot>

            <section class="print-btn">
                <n-button @click="exportToPdf()" type=primary color="#E77917">
                    {{ translations.invoices.export_to_pdf }}
                </n-button>
            </section>

            <section id="invoice-printable">
  			    <div class="invoice">
    			    <div class="header">
      				    <div class="i_row">
        				    <div class="i_logo">
          				        <p>Krosty</p>
        				    </div>
        				    <div class="i_title">
                                <h2>{{ translations.invoices.INVOICE }}</h2>
          				        <p class="p_title text_right">
            				        {{ formatDate(invoiceDetails.created_at, currentLocale) }}
          				        </p>
        				    </div>
      				    </div>
      				    <div class="i_row">
        				    <div class="i_number">
                                <p class="p_title">INVOICE NO: {{ invoiceDetails.billing_code }}</p>
        				    </div>
        				    <div class="i_address text_right">
          				        <p>TO</p>
          				        <p class="p_title">
                                    {{ user.first_name }} {{ user.last_name }} <br />
                                    <span>{{ user.city }}, {{ user.country }}</span><br />
          				        </p>
        				    </div>
      				    </div>
    				</div>
    				<div class="body">
      				    <div class="i_table">
        				    <div class="i_table_head">
          				        <div class="i_row">
            				        <div class="i_col w_15">
              				            <p class="p_title">{{ translations.invoices.quantity }}</p>
            				        </div>
            				        <div class="i_col w_55">
              				            <p class="p_title">{{ translations.invoices.product }}</p>
            				        </div>
            				        <div class="i_col w_15">
              				            <p class="p_title">
                                            Subtotal
                                        </p>
            				        </div>
            				        <div class="i_col w_15">
              				            <p class="p_title">Total</p>
            				        </div>
          				        </div>
        				    </div>
        				    <div class="i_table_body">
          				        <div class="i_row" v-for="item in invoiceItems" :key="id">
            				        <div class="i_col w_15">
                                        <p>{{ item.quantity }}</p>
            				        </div>
            				        <div class="i_col w_55">
                                        <span>{{ item.product_name }}</span>
            				        </div>
            				        <div class="i_col w_15">
                                        <p>{{ formatValue(item.subtotal) }}</p>
            				        </div>
            				        <div class="i_col w_15">
                                        <p>{{ formatValue(item.total) }}</p>
            				        </div>
          				        </div>
        				    </div>
        				    <div class="i_table_foot">
                                <div class="invoice-resume">
                                    <div class="resume-item">
                                        <h4>Subtotal</h4>
                                        <p>{{ invoiceDetails.subtotal }}</p>
                                    </div>
                                    <div class="resume-item">
                                        <h4>Total Discounts</h4>
                                        <p>{{ invoiceDetails.subtotal - invoiceDetails.total }}</p>
                                    </div>
                                    <div class="resume-item">
                                        <h4>Total</h4>
                                        <p>{{ invoiceDetails.total }}</p>
                                    </div>
                                </div>
          				        <div class="i_row grand_total_wrap">
            				        <div class="i_col w_50">
            				        </div>
            				        <div class="i_col w_50 grand_total">
              				            <p><span>TOTAL:</span>
                                            <span>
                                                {{ invoiceDetails.currency_symbol }}{{ formatValue(invoiceDetails.total) }}
                                            </span>
              				            </p>
            				        </div>
          				        </div>
        				    </div>
      				    </div>
    				</div>
    				<div class="footer">
      				    <div class="i_row">
        				    <div class="i_col w_50">
          				        <p class="p_title">{{ translations.invoices.payment_method }}</p>
          				        <p>
                                    {{ invoiceDetails.payment_method }}
                                </p>
        				    </div>
        				    <div class="i_col w_50 text_right">
          				        <p class="p_title">{{ translations.invoices.shipping_address }}</p>
          				        <p>
                                    {{ user.address }}
                                </p>
        				    </div>
      				    </div>
    				</div>
  				</div>
			</section>

        </template>

    </DashboardSidebar>

</template>

<style scoped>

    .print-btn {
        display: flex;
        justify-content: flex-end;
        margin-top: 60px;
    }

    .invoice {
        width: 600px;
        max-width: 100%;
        height: auto;
        background: #f9f9f9;
        padding: 50px 60px;
        position: relative;
        margin: 20px auto;
    }
    .w_15 {
        width: 15%;
    }
    .w_50 {
        width: 50%;
    }
    .w_55 {
        width: 55%;
    }
    .p_title {
        font-weight: 700;
        font-size: 14px;
    }
    .i_row {
        display: flex;
    }
    .text_right {
        text-align: right;
    }
    .invoice .header .i_row {
        justify-content: space-between;
        margin-bottom: 30px;
    }
    .invoice .header .i_row:last-child {
        align-items: flex-end;
    }
    .invoice .header .i_row .i_logo p {
        font-family: "Redressed", cursive;
    }
    .invoice .header .i_row .i_logo p,
    .invoice .header .i_row .i_title h2 {
        font-size: 32px;
        line-height: 38px;
        color: #E77917;
    }
    .invoice .header .i_row .i_address .p_title span {
        font-weight: 400;
        font-size: 12px;
    }
    .invoice .body .i_table .i_col p {
        font-weight: 700;
    }
    .invoice .body .i_table .i_row .i_col {
        padding: 12px 5px;
    }
    .invoice .body .i_table .i_table_head .i_row {
        border: 2px solid;
        border-color: #2f2929 transparent #2f2929 transparent;
    }
    .invoice .body .i_table .i_table_body .i_row:last-child {
        border-bottom: 2px solid #2f2929;
    }
    .invoice .body .i_table .i_table_foot .grand_total_wrap {
        margin-top: 20px;
    }
    .invoice .body .i_table .i_table_foot .grand_total_wrap .grand_total {
        background: #E77917;
        color: #fff;
        padding: 10px 15px;
    }
    .invoice .body .i_table .i_table_foot .grand_total_wrap .grand_total p {
        display: flex;
        justify-content: space-between;
    }
    .invoice .footer {
        margin-top: 30px;
    }
    .invoice-resume {
        display: flex;
        flex-direction: column;
    }
    .resume-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .resume-item h4 {
        font-weight: bold;
    }

</style>
