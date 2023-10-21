<nav class="navbar navbar-expand-md bg-body-tertiary p-4 bg-light main-header fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand  order-md-0" href="<?php echo base_url() ?>">
            <h1>Acuaticos Toscanini Solution</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-5" style="max-height: 300px; overflow-y: auto;">
                <li class="nav-item me-2">
                    <a class="nav-link" href="<?php echo base_url() ?>">
                        <h3>Inicio</h3>
                    </a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="<?php echo base_url() ?>productos">
                        <h3>Productos</h3>
                    </a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="<?php echo base_url() ?>nosotros">
                        <h3>Nosotros</h3>
                    </a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="<?php echo base_url() ?>contacto">
                        <h3>Contacto</h3>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m">
            <div class="icon-header-item icon-header-noti js-show-cart"  id="cart-icon" data-notify="2">
                <i class="zmdi zmdi-shopping-cart   fa-solid fa-cart-shopping"></i>
            </div>
        </div>
        <!-- FIN Icon header -->


    </div>
</nav>

<?= $this->include('ecomerce/templates/carrito') ?>

