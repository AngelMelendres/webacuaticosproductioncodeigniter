<div class="container mt-4 mb-3" id="caurruselRelacionados">
    <h1 class="p-3">Productos Relacionados</h1>
    <div class="carousel">
        <div v-for="producto in productos">
            <div class="">
                <div class="card p-2 cajaRelacionados mx-2">
                    <img :src="producto.portada_path" width="200px" height="200px" class="card-img-top" alt="Producto:">
                    <div class="card-body">
                        <h5 style="font-size: 10px;" class=" text-white card-title">{{producto.nombre}}</h5>
                        <p class="card-text">{{producto.codigo}}</p>
                        <p class="card-text">Precio: {{producto.precio}}</p>
                        <a :href="'<?= base_url() ?>productos/' + producto.codigo" class="butonRecomendado btn btn-danger mt-2">Ver producto</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    new Vue({
        el: '#caurruselRelacionados',
        data: {
            productos: <?= json_encode($recomedados) ?>
        },
        mounted() {
            $('.carousel').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 3,
                autoplay: true, // Agregamos la opción autoplay
                autoplaySpeed: 2000, // Configuramos la velocidad de cambio de slide en milisegundos

                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                        }
                    }, {
                        breakpoint: 570,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            })
        }
    })
</script>