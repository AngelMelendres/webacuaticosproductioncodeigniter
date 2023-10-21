<?= $this->extend('admin/layouts/layout') ?>

<?= $this->section('title') ?>
ADMINISTRACION
<?= $this->endSection() ?>

<?= $this->section('contentAdmin') ?>

<div class="container-fluid">
    <div class="row mt-5">
        <!-- Caja de Ventas -->
        <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
            <div class="caja">
                <div class="caja-titulo">Ventas</div>
                <div class="caja-numero">25</div>
                <i class="fas fa-shopping-cart fa-3x"></i>
            </div>
        </div>
        <!-- Caja de Productos -->
        <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
            <div class="caja">
                <div class="caja-titulo">Productos</div>
                <div class="caja-numero">10</div>
                <i class="fas fa-boxes fa-3x"></i>
            </div>
        </div>
        <!-- Caja de Clientes -->
        <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
            <div class="caja">
                <div class="caja-titulo">Clientes</div>
                <div class="caja-numero">50</div>
                <i class="fas fa-users fa-3x"></i>
            </div>
        </div>
        <!-- Caja de Usuarios -->
        <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
            <div class="caja">
                <div class="caja-titulo">Usuarios</div>
                <div class="caja-numero">50</div>
                <i class="fas fa-users fa-3x"></i>
            </div>
        </div>
        <!-- Caja de Facturas -->
        <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
            <div class="caja">
                <div class="caja-titulo">Facturas</div>
                <div class="caja-numero">100</div>
                <i class="fas fa-file-invoice fa-3x"></i>
            </div>
        </div>
        <!-- Caja de Sucursales -->
        <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
            <div class="caja">
                <div class="caja-titulo">Sucursales</div>
                <div class="caja-numero">3</div>
                <i class="fas fa-building fa-3x"></i>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>