<script setup>

    import { ref } from 'vue';
    import { NButton, NModal, NCard, NIcon } from 'naive-ui';
    import { CancelFilled, AddShoppingCartFilled } from '@vicons/material';

    const showModal = ref(false);

</script>

<template>

    <div class="menu-container">

        <div class="container-header">
            <h2>Our Best Menu</h2>
            <hr/>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
        </div>

        <div class="products-grid">

            <div class="product-card">
                <div class="product-img-container">
                    <img src="assets/images/products/camarones.jpg"
                </div>
                <h3>Arroz con camarones.</h3>
                <p>
                    Some description of the product right here.
                </p>
                <span>$30</span>
                <!-- Modal -->
                <n-button
                    @click="showModal = true"
                    color="#E77917"
                >
                    Details
                </n-button>
                <n-modal v-model:show="showModal">
                    <n-card
                        style="width: 600px"
                        title=" "
                        :bordered="false"
                        size="huge"
                        role="dialog"
                        aria-modal="true"
                    >
                        <template #header-extra>
                            <div class="header-actions">
                                <n-button color="#E77917">
                                    <n-icon><AddShoppingCartFilled/></n-icon>
                                    Add to Cart
                                </n-button>
                                <n-button
                                    type="secondary"
                                    @click="showModal = false"
                                >
                                    close
                                </n-button>
                            </div>
                        </template>

                        <div class="modal-container">
                            <div class="modal-image">
                                <img src="assets/images/products/camarones.jpg">
                            </div>
                            <div class="modal-description">
                                <h1>Brochetas de Camarones </h1>
                                <p>
                                    Un platillo de camarones acompañado de unas brochetas
                                    y distintos aderezos especiales para los paladares
                                    más exquisitos de nuestros clientes.
                                </p>
                            </div>
                        </div>

                    </n-card>
                </n-modal>
                <!-- End Modal -->
            </div>

            <div class="product-card">
                <div class="product-img-container">
                    <img src="assets/images/products/mojito.jpg"
                </div>
                <h3>Title of the product</h3>
                <p>
                    Some description of the product right here.
                </p>
                <span>$100</span>
                <n-button
                    color="#E77917"
                >
                    Details
                </n-button>
            </div>

            <div class="product-card">
                <div class="product-img-container">
                    <img src="assets/images/products/malteada-fresa.jpg"
                </div>
                <h3>Title of the product</h3>
                <p>
                    Some description of the product right here.
                </p>
                <span>$100</span>
                <n-button
                    color="#E77917"
                >
                    Details
                </n-button>
            </div>

            <div class="product-card">
                <div class="product-img-container">
                    <img src="assets/images/products/pie-manazana.jpg"
                </div>
                <h3>Title of the product</h3>
                <p>
                    Some description of the product right here.
                </p>
                <span>$100</span>
                <n-button
                    color="#E77917"
                >
                    Details
                </n-button>
            </div>

            <div class="product-card">
                <div class="product-img-container">
                    <img src="assets/images/products/vegan-pizza.jpg">
                </div>
                <h3>Title of the product</h3>
                <p>
                    Some description of the product right here.
                </p>
                <span>$100</span>
                <n-button
                    color="#E77917"
                >
                    Details
                </n-button>
            </div>

            <div class="product-card">
                <div class="product-img-container">
                    <img src="assets/images/products/pizza-hawaina.jpg">
                </div>
                <h3>Title of the product</h3>
                <p>
                    Some description of the product right here.
                </p>
                <span>$100</span>
                <n-button
                    color="#E77917"
                >
                    Details
                </n-button>
            </div>

            <div class="product-card">
                <div class="product-img-container">
                    <img src="assets/images/products/capuccino.jpg">
                </div>
                <h3>Title of the product</h3>
                <p>
                    Some description of the product right here.
                </p>
                <span>$100</span>
                <n-button
                    color="#E77917"
                >
                    Details
                </n-button>
            </div>

            <div class="product-card">
                <div class="product-img-container">
                    <img src="assets/images/products/friedchicken.jpg">
                </div>
                <h3>Title of the product</h3>
                <p>
                    Some description of the product right here.
                </p>
                <span>$100</span>
                <n-button
                    color="#E77917"
                >
                    Details
                </n-button>
            </div>

        </div>

        <div class="grid-footer">
            <a href="#">Explore More</a>
        </div>

    </div>

</template>

<style scoped>

    .menu-container {
        display: flex;
        flex-direction: column;
        background-color: #000;
        padding-top: 30px;
    }
    .container-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding-top: 30px;
        padding-bottom: 20px;
    }
    .container-header h2 {
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 30px;
    }
    .container-header hr {
        border: 1px solid orange;
        height: 1px;
        width: 15%;
    }
    .container-header p {
        color: #fff;
        text-align: center;
        max-width: 50%;
    }
    .products-grid {
        margin-top: 50px;
        display: grid;
        gap: 10px;
        padding: 50px 40px;
        grid-template-columns: repeat(4, 1fr);
    }
    .product-card {
        padding: 15px 15px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .product-img-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 300px;
        background-color: #212529;
        border-radius: 30px;
    }
    .product-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 5px;
    }
    .product-card h3 {
        color: #fff;
    }
    .product-card p {
        color: gray;
    }
    .product-card span {
        color: orange;
    }
    .grid-footer {
        display: flex;
        flex-direction: row-reverse;
        padding-right: 40px;
    }
    .grid-footer a {
        font-weight: bold;
        color: #fff;
        padding-bottom: 50px;
    }
    /* Product Modal */
    .modal-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .header-actions {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }
    .modal-image {
        width: 100%;
        height: 40%px;
    }
    .modal-image img {
        height: 40%;
        object-fit: cover;
    }
    .modal-description {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .modal-description h1 {
        font-weight: bold;
        font-size: 20px;
        color: #000;
    }

    @media (max-width: 1132px) {
        .products-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin-top: 30px;
        }
    }
    @media (max-width: 768px) {
        .products-grid {
            display: flex;
            flex-direction: column;
            margin-top: 40px;
        }
    }

</style>
