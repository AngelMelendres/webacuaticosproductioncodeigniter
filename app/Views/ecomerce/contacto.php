<?= $this->extend('ecomerce/layouts/layout') ?>

<?= $this->section('title') ?>
Contacto
<?= $this->endSection() ?>
<?= $this->section('metas') ?>
<meta name="description" content='Acuaticos & Toscanini esta pendiente de tus concejos y requerimientos, si tienes alguna pregunta o quieres que nos comuniquemos contigo, porfavor envianos un mensaje con tus datos correspondientes, y a la brebedad nos comuncaremos contigo.'>
<meta name="keywords" content="Acuaticos,Toscanini,Solutions,venta,online,online,Ecuador,Quito,Cuenca,Riobamba,Guayaquil,Costa,Sierra,Oriente,Galapagos,Ambiente,Medicion,calidad,gatantia">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section>
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Comprar</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a target="_blank" href="https://www.mercadolibre.com.ec/perfil/ACUATICOS+EC">
                                MERCADO LIBRE
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a target="_blank" href="https://www.facebook.com/ElMundoAcuaticoEc">
                                MARKETPLACE
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</section>
<section>
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <div class="contact-info-left">
                        <h2>INFORMACION DE CONTACTO</h2>
                        <p>
                            Acuaticos & Toscanini esta pendiente de tus concejos y
                            requerimientos, si tienes alguna pregunta o quieres que
                            nos comuniquemos contigo, porfavor envianos un mensaje con
                            tus datos correspondientes, y a la brebedad nos
                            comuncaremos contigo.
                        </p>

                        <div>
                            <ul>
                                <li>
                                    <p>
                                        <i className="fa-solid fa-route"></i>
                                        Quito-Ecuador. Av. 9 de octubre N26-84 y Marieta de
                                        Veintilla(MATRIZ) Riobamba - Avenida Canonigo Ramos
                                        y Nicolas Delgado (PUNTO DE ENTREGA) Guayaquil -
                                        Valentina González Silgad
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        <i class="fa-solid fa-square-phone"></i>
                                        +593 987054324 <br>+593 983445550 <br>+593
                                        984764505<br> +593 989800549
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        <i class="fa-regular fa-envelopes-bulk"></i>
                                        gerencia@acuaticostoscanini.com
                                        ventas_quito@acuaticostoscanini.com
                                        ventas_rio@acuaticostoscani.com
                                        ventas_gye@acuaticostoscani.com
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">
                        <h2>Ayudanos a contactarte</h2>
                        <p>
                            Nuestro equipo respondera tus preguntas y tus dudas muy
                            rapido.
                        </p>
                        <form id="contactorm">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre" required data-error="Porfavor ingresa tu nombre" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Tu Email" id="email" class="form-control" name="name" required data-error="Porfavor ingresa tu email" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="subject" name="name" placeholder="Ciudad " required data-error="Porfavor ingresa tu apellido" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" id="message" placeholder="Invianos tu mensaje" rows="4" data-error="Escribe tu mensaje" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="submit-button text-center">
                                        <button class="btn hvr-hover" id="submit" type="submit">
                                            Enviar Mensaje
                                        </button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>