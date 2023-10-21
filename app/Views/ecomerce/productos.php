<?= $this->extend('ecomerce/layouts/layout') ?>

<?= $this->section('title') ?>
Productos
<?= $this->endSection() ?>
<?= $this->section('metas') ?>
<meta name="description" content='IMPORTADORA Y DISTRIBUIDORA ECUATORIANA.EXPLORARA LOS PRODUCTOS MAS VENDIDOS PARA USO AMBIENTAL E INDUSTRIAL EN ECUADOR PARA EL AGUA SUELO AIRE TERMOMETROS REFRACTOEMTROS MEDIDORES DE PH INSTRUMENTOS DE MEDICION BALANZAS ALCOHOLIMETROS TERMOHIGROMETROS . QUITO-ECUADOR'>
<meta name="keywords" content=" acuaticos,toscanini,<?php foreach ($cat_subcat as $cat_codigo => $categoria) { ?><?= $categoria['nombre'] ?>,<?php } ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('ecomerce/templates/banerMM') ?>
<!-- barra de categorias y busqueda -->
<div class="container mt-3 mb-3">
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
            <div class="product-categori">
                <div class="search-product">
                    <form action="<?= base_url('productos') ?>" method="GET" class="form-inline my-2 my-lg-0">
                        <input type="text" class="form-control" name="busqueda" id="busqueda" placeholder="Buscar productos..." />
                        <button type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
                <div class="filter-sidebar-left">
                    <div class="title-left">
                        <h3>CATEGORIAS</h3>
                    </div>
                    <div class="container">
                        <ul>
                            <li class="list-group-item p-1" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#allCategorias">
                                <h3 class="text-danger">Ver Categorias...</h3>
                            </li>
                            <ul id="allCategorias" class="list-group">
                                <?php foreach ($cat_subcat as $cat_codigo => $categoria) { ?>
                                    <ul class="list-group">
                                        <li class="list-group-item p-2" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#<?= $cat_codigo ?>">
                                            <b><?= $categoria['nombre'] ?></b>
                                            <span class="caret"></span>
                                        </li>
                                        <ul id="<?= $cat_codigo ?>" class="collapse list-group">
                                            <li>
                                                <a href="<?= base_url('productos?categoria=' . $cat_codigo) ?>"><?= $categoria['nombre'] ?></a>
                                            </li>
                                            <?php foreach ($categoria['subcategorias'] as $subcategoria) { ?>
                                                <li>
                                                    <a href="<?= base_url('productos?subcategoria=' . $subcategoria['codigo']) ?>"><?= $subcategoria['nombre'] ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </ul>
                                <?php } ?>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- lista de productos -->
        <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
            <div class="container mt-3">
                <!-- PAGINADOR ARRIBA -->
                <?php echo $pager->links(); ?>
                <div class="row">
                    <?php foreach ($productos as $producto) : ?>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                <div class="products-single fix">
                                    <div class="box-img-hover">
                                        <div class="type-lb">
                                            <p class="new">New</p>
                                        </div>
                                        <img src="<?= $producto['path'] ?>" class="" alt="Image" width="270px" height="270px">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                <div class="why-text full-width">
                                    <h4><?= $producto['nombre'] ?></h4>
                                    <span style="font-size:large;">Codigo: <?= $producto['codigo'] ?></span>
                                    <?php if ($estadoVisible == 1) : ?>
                                        <h5 class="text-danger"><?= $producto['precio'] ?> $</h5>
                                    <?php endif; ?>
                                    <p><?= $producto['descripcion'] ?></p>
                                    <a class="btn hvr-hover" target="_blank" href="<?= base_url() ?>productos/<?= $producto['codigo'] ?>">Ver detalles</a>
                                </div>
                            </div>
                        </div><br>
                    <?php endforeach; ?>


                </div>
                <!-- PAGINADOR ABAJO -->
                <?php echo $pager->links(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#busqueda').on('keyup', function() {
            var query = $(this).val();
            $.ajax({
                url: "<?= base_url() ?>acuaticostoscanini/productos",
                method: "POST",
                data: {
                    query: query
                },
                dataType: "json",
                success: function(data) {
                    var output = '';
                    if (data.result.length > 0) {
                        for (var i = 0; i < data.result.length; i++) {
                            output += '<div class="col-sm-4 p-2 mb-2">';
                            output += '<div class="card p-2 caja">';
                            output += '<img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Producto: ' + data.result[i].nombre + '">';
                            output += '<div class="card-body">';
                            output += '<h5 class="card-title">' + data.result[i].nombre + '</h5>';
                            output += '<p class="card-text">' + data.result[i].codigo + '</p>';
                            output += '<p class="card-text">' + data.result[i].precio + '</p>';
                            output += '<a href="<?= base_url() ?>productos/' + data.result[i].codigo + '" class="btn btn-danger mt-2">Ver producto</a>';
                            output += '</div></div></div>';
                        }
                    } else {
                        output += '<div class="col-sm-12">';
                        output += '<p>No se encontraron productos</p>';
                        output += '</div>';
                    }
                    $('#productos').html(output);
                }
            });
        });
    });
</script>



<!-- Recomendados -->
<?= $this->include('ecomerce/templates/recomendados') ?>

<?= $this->endSection() ?>