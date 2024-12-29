<script setup>

    import { usePage, Link } from "@inertiajs/vue3";
    import DashboardSidebar from "../Components/DashboardSidebar.vue";
    import { NButton } from 'naive-ui';
    import html2pdf from 'html2pdf.js';

    const { locale, invoiceDetails, orderItems, invoiceItems } = usePage().props;
    const currentLocale = locale || 'en';

    const formatDate = (date) => {
        const d = new Date(date);
        const day = String(d.getDate()).padStart(2, '0');
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const year = d.getFullYear();
        return `${day}-${month}-${year}`;
    };

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
            <div>{{ orderItems }}</div>
            <p>+++++++++++++++++++++++++++++</p>
            <div>
                <p>{{ invoiceItems }}</p>
            </div>


            <section class="print-btn">
                <n-button @click="exportToPdf()">
                    Export to PDF
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
          				        <h2>INVOICE</h2>
          				        <p class="p_title text_right">
            				        April 20, 2023
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
            				        Facebook <br />
            				        <span>Menlo Park, California</span><br />
            				        <span>United States</span>
          				        </p>
        				    </div>
      				    </div>
    				</div>
    				<div class="body">
      				    <div class="i_table">
        				    <div class="i_table_head">
          				        <div class="i_row">
            				        <div class="i_col w_15">
              				            <p class="p_title">Quantity</p>
            				        </div>
            				        <div class="i_col w_55">
              				            <p class="p_title">Product</p>
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
                                        <!--<p>Lorem, ipsum.</p>-->
                                        <span>{{ item.product_name }}</span>
            				        </div>
            				        <div class="i_col w_15">
                                        <p>{{ item.subtotal }}</p>
            				        </div>
            				        <div class="i_col w_15">
                                        <p>{{ item.total }}</p>
            				        </div>
          				        </div>
        				    </div>
        				    <div class="i_table_foot">
          				        <!--<div class="i_row">
            				        <div class="i_col w_15">
              				            <p></p>
            				        </div>
            				        <div class="i_col w_55">
              				            <p></p>
            				        </div>
            				        <div class="i_col w_15">
              				            <p>Sub Total</p>
              				            <p>Tax 10%</p>
            				        </div>
            				        <div class="i_col w_15">
                                        <p>{{ invoiceDetails.currency_symbol }}{{ invoiceDetails.subtotal }}</p>
                                        <p>{{ invoiceDetails.currency_symbol }}{{ invoiceDetails.total }}</p>
            				        </div>
                                </div>-->

                                <div style="display: flex; justify-content: space-between">
                                    <p>Subtotal</p>
                                    <p>{{ invoiceDetails.subtotal }}</p>
                                </div>

                                <div style="display: flex; justify-content: space-between">
                                    <p>Total</p>
                                    <p>{{ invoiceDetails.total }}</p>
                                </div>

          				        <div class="i_row grand_total_wrap">
            				        <div class="i_col w_50">
            				        </div>
            				        <div class="i_col w_50 grand_total">
              				            <p><span>TOTAL:</span>
                                            <span>{{ invoiceDetails.currency_symbol }}{{ invoiceDetails.total }}</span>
              				            </p>
            				        </div>
          				        </div>
        				    </div>
      				    </div>
    				</div>
    				<div class="footer">
      				    <div class="i_row">
        				    <div class="i_col w_50">
          				        <p class="p_title">Payment Method</p>
          				        <p>
                                    {{ invoiceDetails.payment_method }}
                                </p>
        				    </div>
        				    <div class="i_col w_50 text_right">
          				        <p class="p_title">Terms and Conditions</p>
          				        <p>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
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
        justify-content: center;
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
        color: #5265a7;
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
        background: #5265a7;
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

</style>
