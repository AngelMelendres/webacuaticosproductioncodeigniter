<?= $this->extend('admin/layouts/layout') ?>

<?= $this->section('title') ?>
Productos
<?= $this->endSection() ?>

<?= $this->section('CSSS') ?>
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

<?= $this->endSection() ?>

<?= $this->section('contentAdmin') ?>


<div v-if="productos" class="container" id="appProductosAdmin">
    <div class="card mt-4 p-3 bg-light ">
        <div class='d-flex justify-content-between'>
            <div class="mx-2">
                <a href="<?= base_url() ?>admin/agregarProducto"> <button class="btn btn-success">+ Nuevo Producto</button></a>
            </div>
            <div class="mx-2">
                <a href="<?= base_url() ?>admin/categorias"> <button class="btn btn-warning">Ver categorias</button></a>
            </div>
            <div class="mx-2">
                <a href="<?= base_url() ?>admin/subcategorias"> <button class="btn btn-info">Ver Subcategorias</button></a>
            </div>

        </div>
    </div>


    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="mt-2">
        <table id="tablaProductos" class=" table table-striped table-bordered table table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Costo</th>
                    <th>Descripción</th>
                    <th></th>
                </tr>
            </thead>
            </thead>
            <tbody>
                <tr v-for="producto in productos">
                    <td class="align-items-center">
                        <img :src="producto.portada_path" width="100px" class="mr-2 mx-3">

                        <div class="text-center">
                            {{ producto.codigo }}
                        </div>
                    </td>
                    <td>{{ producto.nombre }}</td>
                    <td>{{ producto.cantidad }}</td>
                    <td>{{ producto.precio }}</td>
                    <td>{{ producto.costo }}</td>
                    <td>{{ producto.descripcion }}</td>
                    <td>
                        <div class="btn-group dropend">
                            <button type="button" class="btn btn-primary" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-bs-toggle="modal" :data-bs-target="'#modalView-' + producto.codigo" @click="setViewProducto(producto)"><i class="fas fa-eye"></i> Ver</a>
                                <a class="dropdown-item" data-bs-toggle="modal" :data-bs-target="'#modalEdit-' + producto.codigo" @click="setEditProducto(producto)"><i class="fas fa-edit"></i> Editar Rapido</a>
                                <a class="dropdown-item" v-bind:href="`<?= base_url('/admin/editar/') ?>${producto.codigo}`"><i class="fas fa-edit"></i> Editar Completo</a>
                                <hr class="dropdown-divider">
                                <a class="bg-danger text-white dropdown-item" data-bs-toggle="modal" :data-bs-target="'#modalDelete-' + producto.codigo" @click="setDeleteProducto(producto)"><i class="fas fa-trash-alt"></i> Eliminar</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- MODAL PARA VER EL PRODUCTO -->
    <div v-if="producto.codigo" class="modal fade modal-xl" tabindex="-1" role="dialog" :id="'modalView-' + producto.codigo">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PRODUCTO. CODIGO: {{ producto.codigo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-5 mb-3">
                            <img src='https://www.entornoestudiantil.com/wp-content/uploads/2018/03/retail-carrito-compra.jpg' class="img-fluid">
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <h5><strong>Nombre:</strong> {{ producto.nombre }}</h5>
                            <h5><strong>Cantidad:</strong> {{ producto.cantidad }}</h5>
                            <h5><strong>Precio:</strong> {{ producto.precio }} $USD</h5>
                            <h5><strong>Costo:</strong> {{ producto.costo }} $USD</h5>
                            <h5><strong>Descripción:</strong> {{ producto.descripcion }}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="">
                        <h4>ESPECIFICACIONES</h4>
                        <p id="especificacionesshow"></p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!--FIN MODAL PARA VER EL PRODUCTO -->

    <!-- MODAL PARA EDITAR RAPIDO EL PRODUCTO -->
    <div v-if="producto.codigo" class="modal fade modal-xl" tabindex="-1" role="dialog" :id="'modalEdit-' + producto.codigo">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="POST" action="<?= base_url() ?>admin/editarParcial">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">EDICIÓN DEL PRODUCTO. CÓDIGO: {{ producto.codigo }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-md-5 mb-3">
                                <img src='https://www.entornoestudiantil.com/wp-content/uploads/2018/03/retail-carrito-compra.jpg' class="img-fluid">
                            </div>
                            <div class="col-12 col-md-7">
                                <div class="mb-1">
                                    <label class="form-label">NOMBRE</label>
                                    <input type="text" class="form-control" name="nombre" :value="producto.nombre">
                                    <input type="hidden" name="productoCodigo" :value="producto.codigo">
                                </div>
                                <div class="row mb-1">
                                    <div class="col-6">
                                        <label class="form-label">CÓDIGO</label>
                                        <input type="text" name="codigo" class="form-control" :value="producto.codigo">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">CANTIDAD (STOCK)</label>
                                        <input type="number" name="cantidad" min="0" class="form-control" :value="producto.cantidad">
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-6">
                                        <label class="form-label">PRECIO</label>
                                        <input type="text" name="precio" class="form-control" :value="producto.precio">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">COSTO</label>
                                        <input type="text" name="costo" class="form-control" :value="producto.costo">
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">DESCRIPCIÓN</label>
                                    <input type="text" name="descripcion" class="form-control" :value="producto.descripcion">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-success mx-4"><i class="fa-solid fa-floppy-disk mx-1"></i> Guardar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!--FIN MODAL PARA EDITAR EL PRODUCTO -->

    <!-- MODAL PARA ELIMINAR EL PRODUCTO -->
    <div v-if="producto.codigo" class="modal fade" tabindex="-1" role="dialog" :id="'modalDelete-' + producto.codigo">
        <form method="POST" action="<?= base_url() ?>admin/eliminarProducto">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 m-auto" id="exampleModalLabel">ELIMINAR PRODUCTO</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><b>CODIGO: </b>{{producto.codigo}}</p>
                        <p><b>NOMBRE: </b>{{producto.nombre}}</p>
                        <input type="hidden" name="producto" :value="JSON.stringify(producto.codigo)">
                        <h5 class="text-danger text-center"><b>Estas seguro de eliminar este producto de tu inventario?</b></h5>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt mx-1"></i> Elimiar</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <!--FIN MODAL PARA ELIMINAR EL PRODUCTO -->


</div>




<?= $this->endSection() ?>

<?= $this->section('JSSS') ?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<!-- ScrollVIew -->
<script>
    $(document).ready(function() {
        $('#tablaProductos').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            scrollY: 350,
            scrollX: true,
        });
    });
</script>

<!-- App Vue para el modal -->
<script>
    var app = new Vue({
        el: '#appProductosAdmin',
        data: {
            producto: {},
            productos: <?= json_encode($productos) ?>
        },
        methods: {
            setViewProducto(producto) {
                this.producto = producto;
                Vue.nextTick(() => {
                    $(`#modalView-${producto.codigo}`).modal('show');
                    // Assuming 'producto.especificaciones' contains the HTML content
                    console.log(this.producto.especificaciones)
                    const productoEspecificaciones = this.producto.especificaciones;
                    const pElement = document.getElementById('especificacionesshow');
                    pElement.innerHTML = productoEspecificaciones;
                });



            },
            setEditProducto(producto) {
                this.producto = producto;
                Vue.nextTick(() => {
                    $(`#modalEdit-${producto.codigo}`).modal('show');
                });
            },
            setDeleteProducto(producto) {
                this.producto = producto;
                Vue.nextTick(() => {
                    $(`#modalDelete-${producto.codigo}`).modal('show');
                });
            },
            checkCodigoProducto(producto) {
                const codigoProducto = producto.codigo;
                const existeProducto = this.productos.some(p => p.codigo === codigoProducto);

                if (existeProducto) {
                    alert(`El producto con código ${codigoProducto} SI existe.`);
                    /* window.location.href = 'url-de-la-pagina'; */
                } else {
                    alert(`El producto con código ${codigoProducto} no existe.`);
                }
            }

        }
    });
</script>



<?= $this->endSection() ?>