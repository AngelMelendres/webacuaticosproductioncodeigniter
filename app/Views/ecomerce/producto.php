<?= $this->extend('ecomerce/layouts/layout') ?>

<?= $this->section('title') ?>
<?= $producto['nombre'] ?>
<?= $this->endSection() ?>

<?= $this->section('metas') ?>
<meta name="description" content='<?= $producto['descripcion'] ?>'>
<meta name="keywords" content="<?= $producto['nombre'] ?>, <?= $producto['descripcion'] ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <!-- CARRUSEL DE IMAGENES -->
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div id="carouselProducto" class="slick-slider mx-4">
                    <div class="main-image">
                        <img :src="mainImageSrc" class="image-fluid" />
                    </div>
                    <div class="thumbnail-images">
                        <div v-for="(image, index) in imgSrcArray" :key="index" @click="selectImage(index)" :class="{ 'active': index === selectedIndex }">
                            <img :src='image.path' alt="image.path" />
                        </div>
                    </div>
                </div>
                <!-- Script para el carrusel de las imagenes -->
                <script>
                    new Vue({
                        el: '#carouselProducto',
                        data: {
                            imgSrcArray: <?= json_encode($imagenes) ?>,
                            selectedIndex: 0
                        },
                        computed: {
                            mainImageSrc() {
                                return this.imgSrcArray[this.selectedIndex].path
                            }
                        },
                        methods: {
                            selectImage(index) {
                                this.selectedIndex = index
                            }
                        },
                        mounted() {
                            $('.thumbnail-images').slick({
                                slidesToShow: 4,
                                slidesToScroll: 1,
                                arrows: false,
                                focusOnSelect: true,
                                responsive: [{
                                        breakpoint: 768,
                                        settings: {
                                            slidesToShow: 3,
                                            centerMode: true,
                                            centerPadding: '20px'
                                        }
                                    },
                                    {
                                        breakpoint: 576,
                                        settings: {
                                            slidesToShow: 2,
                                            centerMode: true,
                                            centerPadding: '20px'
                                        }
                                    }
                                ]
                            })
                        }
                    })
                </script>

            </div>
            <!-- FIN CARRUSEL DE IMAGENES -->


            <div class="col-xl-7 col-lg-7 col-md-6">
                <div class="single-product-details">
                    <h2><?= $producto['nombre'] ?></h2>
                    <h4><b id="codigoProducto"><?= $producto['codigo'] ?></b></h4>
                    <h4>Precio:</h4>
                    <p><?= $producto['precio'] ?></p>
                    <h4>Descripcion:</h4>
                    <p><?= $producto['descripcion'] ?></p>
                    <div class="d-flex align-items-center">
                        <div class="mx-4">
                            <label class="control-label">Cantidad</label>
                            <input class="form-control p-2 text-center" value="1" min="1" max="20" type="number" name="cantidad">
                        </div>
                        <div class="mt-4">
                            <a class="btn btn-danger btn-lg" data-fancybox-close="" href="#" @click="addToCart">Añadir al carrito</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class=" mt-3 container row my-2 justify-content-center">
        <div class="card card-outline-secondary my-4 col-md-8 col-lg-11">
            <div class="card-header">
                <h2>Especificaciones:</h2>
            </div>
            <div class="card-body">
                <div class="media mb-3">
                    <div class="media-body">
                        <p><?= $producto['especificaciones'] ?>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('ecomerce/templates/recomendados') ?>


</div>

<!-- AGREGAR AL LOCAL STORAGE -->
<script>
    // Obtener el botón "Agregar al carrito"
    const addToCartBtn = document.querySelector('.btn.btn-danger.btn-lg');
    // Agregar evento click al botón
    addToCartBtn.addEventListener('click', () => {
        // Obtener los datos del producto
        const link = '<?= base_url() ?>productos/<?= $producto['codigo'] ?>';
        const nombre = '<?= $producto['nombre'] ?>';
        const codigo = '<?= $producto['codigo'] ?>';
        // const descripcion = '<?= $producto['descripcion'] ?>';
        const precio = '<?= $producto['precio'] ?>';
        const cantidad = parseInt(document.querySelector('input[name="cantidad"]').value);
        // Obtener la imagen del producto o asignar una imagen predeterminada
        const imagenElement = document.querySelector('.main-image img');
        const imagen = imagenElement ? imagenElement.getAttribute('src') : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_6wvTLOpXiNZ540gl6dfmtlG7hQTJg4iQgQ&usqp=CAU';

        // Crear objeto del producto
        const producto = {
            nombre,
            codigo,
            precio,
            cantidad,
            imagen,
            link
        };

        // Obtener carrito del LocalStorage o crear uno vacío si no existe
        const cart = JSON.parse(localStorage.getItem('cart')) || [];


        // Buscar si el producto ya está en el carrito
        const existingProductIndex = cart.findIndex((product) => product.codigo === codigo);

        if (existingProductIndex !== -1) {
            // Si el producto ya está en el carrito, aumentar la cantidad del objeto existente en el array
            cart[existingProductIndex].cantidad += parseInt(cantidad);
        } else {
            // Si el producto no está en el carrito, agregar el nuevo objeto al array
            cart.push(producto);
        }
        // Guardar el array de carrito actualizado en el LocalStorage
        localStorage.setItem('cart', JSON.stringify(cart));
        alert('producto agregado')
        // Recargar la página
        location.reload();
    });
</script>

<?= $this->endSection() ?>