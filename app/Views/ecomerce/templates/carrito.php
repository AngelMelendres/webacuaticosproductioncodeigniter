<div id="appCarrito">
    <div class="wrap-header-cart js-panel-cart">
        <div class="header-cart">
            <div class="header-cart-title d-flex justify-content-between m-auto mt-5">
                <h1>Tu Carrito</h1>
                <div class="pointer js-hide-cart">
                    <i class="fa-solid fa-rectangle-xmark fa-2xl" style="color: #d92020;"></i>
                </div>
            </div>
            <div class="m-auto text-center">
                <div>
                    <ul>
                        <li v-for="(product, index) in cart" :key="index" class="header-cart-item d-flex justify-content-around align-items-center">
                            <div class="header-cart-item-img p-2">
                                <i class="fa-solid fa-circle-xmark" @click="removeFromCart(product)" style="color: #ca2121;"></i>
                                <img :src="product.imagen" class="image-fluid">
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a :href="'<?= base_url() ?>productos/' + product.codigo" class="header-cart-item-name m-b-18 hov-cl1 trans-04">{{ product.codigo }}</a>
                                <span class="header-cart-item-info">Cantidad: {{ product.cantidad }} x {{ product.precio }}$ </span>
                            </div>
                        </li>
                    </ul>
                </div>

                <hr>
                <div class="header-cart-total mt-2">
                    Total: {{ total }}$ USD
                </div>

                <div class="d-flex justify-content-around align-items-center mt-4">
                    <a href="<?=base_url()?>compras" class="btn btn-danger">Cotizar</a>
                    <div class="js-hide-cart btn btn-secondary">Seguir Comprando</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Definir la instancia de Vue -->

</script>