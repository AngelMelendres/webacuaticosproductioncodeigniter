<?= $this->extend('ecomerce/layouts/layout') ?>

<?= $this->section('title') ?>
Acuaticos Toscanini
<?= $this->endSection() ?>
<?= $this->section('metas') ?>
<meta name="description" content='IMPORTADORA Y DISTRIBUIDORA ECUATORIANA.EXPLORARA LOS PRODUCTOS MAS VENDIDOS PARA USO AMBIENTAL E INDUSTRIAL EN ECUADOR PARA EL AGUA SUELO AIRE TERMOMETROS REFRACTOEMTROS MEDIDORES DE PH INSTRUMENTOS DE MEDICION BALANZAS ALCOHOLIMETROS TERMOHIGROMETROS . QUITO-ECUADOR'>
<meta name="keywords" content=" acuaticos,toscanini,<?php foreach ($cat_subcat as $cat_codigo => $categoria) { ?><?= $categoria['nombre'] ?>,<?php } ?>">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<!-- Inicio carrusel -->
<section>
    <div>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000" data-bs-wrap="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div style="background: rgba(0, 0, 0, 1);">
                        <img src="<?= base_url() ?>public/images/Baner1.jpg" class="d-block w-100 img-fluid" alt="Importadora y Distibuidora Ecuatoriana" style="opacity: 0.5" />
                    </div>
                    <div class="carousel-caption d-none d-md-block mb-3" style="margin-top: -50px; text-align: center;">
                        <h1 class="text-white" style="color: white; text-shadow: 2px 2px black;">Importadora y Distibuidora Ecuatoriana</h1>
                        <h1 class="text-white" style="color: white; text-shadow: 2px 2px black;">
                            Somos importadores y distribuidores de intrumentos de medicion y analisis Amabiental e industrial </h1>
                        <div>
                        <a href="<?= base_url() ?>productos"><button class="btn btn-danger">Ver Productos </button></a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div style="background: rgba(0, 0, 0, 1);">
                        <img src="<?= base_url() ?>public/images/Baner2.jpg" class="d-block w-100 img-fluid" alt="Importadora y Distibuidora Ecuatoriana" style="opacity: 0.5" />
                    </div>
                    <div class="carousel-caption d-none d-md-block mb-3" style="margin-top: -50px; text-align: center;">
                        <h1 class="text-white" style="color: white; text-shadow: 2px 2px black;">Importadora y Distibuidora Ecuatoriana</h1>
                        <h1 class="text-white" style="color: white; text-shadow: 2px 2px black;">
                            Somos importadores y distribuidores de intrumentos de medicion y analisis Amabiental e industrial </h1>
                        <div>
                            <button class="btn btn-danger">Ver Productos</button>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div style="background: rgba(0, 0, 0, 1);">
                        <img src="<?= base_url() ?>public/images/Baner3.jpg" class="d-block w-100 img-fluid" alt="Importadora y Distibuidora Ecuatoriana" style="opacity: 0.5" />
                    </div>
                    <div class="carousel-caption d-none d-md-block mb-3" style="margin-top: -50px; text-align: center;">
                        <h1 class="text-white" style="color: white; text-shadow: 2px 2px black;">Importadora y Distibuidora Ecuatoriana</h1>
                        <h1 class="text-white" style="color: white; text-shadow: 2px 2px black;">
                            Somos importadores y distribuidores de intrumentos de medicion y analisis Amabiental e industrial </h1>
                        <div>
                            <button class="btn btn-danger">Ver Productos</button>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
</section>
<!-- Fin carrusel carrusel -->

<!-- Inicio categorias-->
<section class="categories-shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="<?php echo base_url() ?>public/images/termometros.jpg" alt="" />
                    <a class="btn hvr-hover" href="<?php echo base_url() ?>productos?categoria=termometro">
                        TERMOMETROS
                    </a>
                </div>
                <div class="shop-cat-box">
                    <img class="img-fluid" src="<?php echo base_url() ?>public/images/soilmether.jpg" alt="" />
                    <a class="btn hvr-hover" href="<?php echo base_url() ?>productos?categoria=soil">
                        INSTRUMENTOS DEL SUELO
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="<?php echo base_url() ?>public/images/papeltst.jpg" alt="" />
                    <a class="btn hvr-hover" href="<?php echo base_url() ?>productos?categoria=testerwather">
                        PH-METROS
                    </a>
                </div>
                <div class="shop-cat-box">
                    <img class="img-fluid" src="<?php echo base_url() ?>public/images/refractometro.jpg" alt="" />
                    <a class="btn hvr-hover" href="<?php echo base_url() ?>productos?categoria=refractometro">
                        REFRACTOMETROS
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="<?php echo base_url() ?>public/images/dataloger.jpg" alt="" />
                    <a class="btn hvr-hover" href="<?php echo base_url() ?>productos?categoria=data">
                        DATA LOGGERS
                    </a>
                </div>
                <div class="shop-cat-box">
                    <img class="img-fluid" src="<?php echo base_url() ?>public/images/otros.jpg" alt="" />
                    <a class="btn hvr-hover" href="<?php echo base_url() ?>productos?categoria=otros">
                        OTROS
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Fin categorias -->

<!-- Inicio Ventajas-->
<section class="latest-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>TOSCANINI & ACUATICOS</h1>
                    <p>
                        TOSCANINI & ACUATICOS es una empresa ecuatoriana responsable
                        que cumplimos con nuestros compromisos, contamos con local
                        fisico y entrega a domicilio de productos de calidad
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="blog-box">
                    <div class="blog-img">
                        <img class="img-fluid" src="<?php echo base_url() ?>public/images/equipoTrabajo.jpg" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="title-blog">
                            <h3>PERSONAL DE VENTAS</h3>
                            <p>
                                Satisfacer totalmente las necesidades de logística y
                                comunicación integral de nuestros Clientes, a través de la
                                excelencia en el servicio, el desarrollo integral de
                                nuestros Líderes de Acción y el sentido de compromiso con
                                nuestra familia y nuestro País.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="blog-box">
                    <div class="blog-img">
                        <img class="img-fluid" src="<?php echo base_url() ?>public/images/servicio_entrega.jpg" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="title-blog">
                            <h3>SERVICIOS DE ENTREGA</h3>
                            <p>
                                Nuestra empresa tiene convenios con las principales
                                empresas de tranporte en el Ecuador, asegurando que tu
                                producto llegue a tus manos :
                            </p>
                            <p>Servientrega</p>
                            <p>Tramaco Express</p>
                            <p>Delivery dentro de Quito</p>
                            <p>Encomienda</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="blog-box">
                    <div class="blog-img">
                        <img class="img-fluid" src="<?php echo base_url() ?>public/images/metodoPago.jpg" alt="" />
                    </div>

                    <div class="blog-content">
                        <div class="title-blog">
                            <h3>METODOS DE PAGO</h3>
                            <p>
                                Acuaticos & Toscanini cuenta con muchos los metodos de
                                pago, al gusto del cliente.<br>Metodos de pago como:
                                <br>Tarjeta de credito<br>Tarjeta de debito
                                <br>Depositos y tranferencias<br>Cheques
                            </p>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Fin  Ventajas-->

<?= $this->endSection() ?>