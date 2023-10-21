<?= $this->extend('admin/layouts/layout') ?>

<?= $this->section('title') ?>
Subcategorias
<?= $this->endSection() ?>


<?= $this->section('CSSS') ?>
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

<!-- jQuery File Upload CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.7.0/css/jquery.fileupload.min.css" />
<!-- jQuery File Upload JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.7.0/js/jquery.fileupload.min.js"></script>

<!-- multiselect -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>









<?= $this->endSection() ?>

<?= $this->section('contentAdmin') ?>


<div class="container-fluid" id="appSubCategoriasAdmin">
    <div class="card mt-4 p-3 bg-light ">
        <div class='d-flex justify-content-between'>
            <div class="mx-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearCategoria">
                    <i class="fa-solid fa-plus"></i> Crear Categoria
                </button>
            </div>

            <div class="mx-2">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalCrearSubCategoria">
                    <i class="fa-solid fa-plus"></i> Crear Subcategoria
                </button>

            </div>
            <div class="mx-2">
                <a href="<?= base_url() ?>admin/productos"> <button class="btn btn-dark">Ver Productos</button></a>
            </div>
            <div class="mx-2">
                <a href="<?= base_url() ?>admin/categorias"> <button class="btn btn-info">Ver Categorias</button></a>
            </div>

        </div>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- TABLA DE CATEGORIAS CON SUBCATEGORIAS-->
    <div class="mt-2">
        <table id="tablaCategorias" class=" table table-striped table-bordered table table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>CODIGO SUBCATEGORIA</th>
                    <th>NOMBRE SUBCATEGORIA</th>
                    <th>Categorias</th>
                    <th></th>
                </tr>
            </thead>
            </thead>
            <tbody>
                <tr v-for="subcategoria in subcategorias">

                    <td>{{ subcategoria.codigo }}</td>
                    <td>{{ subcategoria.nombre }}</td>
                    <td>
                        <span v-if="subcategoria.categorias.length > 0">
                            <span v-for="categoria in subcategoria.categorias" class="badge text-bg-dark" style="margin-right: 5px;">{{ categoria }} </span>
                        </span>
                        <span class="badge text-bg-warning" v-else>ninguna</span>
                    </td>

                    <td>
                        <div class="">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" :data-codigo="subcategoria.codigo" @click="openEditarModal(subcategoria)" :data-bs-target="'#modalEditar-' + subcategoria.codigo">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" :data-bs-target="'#modalEliminar-' + subcategoria.codigo">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>


                        <!-- //MODAL PARA ELIMINAR -->
                        <div class="modal fade" :id="'modalEliminar-' + subcategoria.codigo" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
                                <div class="modal-content">
                                    <form method="POST" action="<?= base_url() ?>admin/deleteSubCategoria">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">ELIMINAR SUBCATEGORIA: {{ subcategoria.codigo }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="subcategoria" :value="JSON.stringify(subcategoria.codigo)">
                                                    <h5 class="text-danger text-center"><b>Estas seguro de eliminar esta subcategoria</b></h5>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt mx-1"></i> Elimiar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- //MODAL PARA EDITAR -->
                        <div class="modal fade" :id="'modalEditar-' + categoriaUpdate.codigo" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">EDICIÓN DE LA SUBCATEGORIA:</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="categoriaFormUpdate" method="POST" action="<?= base_url() ?>admin/updateSubCategoria">
                                            <div class="row">
                                                <!-- Mostramos el mensaje de error debajo del input en rojo -->
                                                <span v-if="errorMensaje3" class="text-danger">{{ errorMensaje3 }}</span>
                                                <div class="col-12 col-md-7">
                                                    <div class=" mb-1">
                                                        <label class="form-label">CÓDIGO</label>
                                                        <input type="text" name="codigo" class="form-control" v-model="categoriaUpdate.codigo">
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label">NOMBRE</label>
                                                        <input type="text" class="form-control" name="nombre" v-model="categoriaUpdate.nombre">
                                                        <input v-if='selectedCategoria' type="hidden" name="subcategoriaCodigo" :value="selectedCategoria.codigo">
                                                    </div>

                                                    <div class="row mb-1">
                                                        <label class="form-label">SUBCATEGORIAS</label>
                                                        <select class="multiCategoriasUpdate form-control" :data-codigo="categoriaUpdate.codigo" required name="subcategorias[]" multiple="multiple">
                                                            <!-- Las opciones del selector de subcategorías se generarán dinámicamente -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" @click="actualizarCategoria" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- FIN TABLA DE CATEGORIAS CON SUBCATEGORIAS-->

    <!-- MODAL CREAR CATEGORISA -->
    <div class="modal fade" id="modalCrearCategoria" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Registrar Catoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="categoriaForm" method="POST" action="<?= base_url() ?>admin/postCategoria">
                        <div class="row">
                            <!-- Mostramos el mensaje de error debajo del input en rojo -->
                            <span v-if="errorMensaje" class="text-danger">{{ errorMensaje }}</span>
                            <div class="col-12 col-md-7">
                                <div class="row mb-1">
                                    <div class="col-6">
                                        <label class="form-label">CÓDIGO</label>
                                        <input type="text" v-model="categoria.codigo" name="codigo" required class="form-control">

                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">NOMBRE</label>
                                    <input type="text" class="form-control" v-model="categoria.nombre" name="nombre">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">ASIGANAR SUBCATEGORIAS</label>
                                    <select class="multiSubCategorias form-control" required name="subcategorias[]" multiple="multiple">
                                        <!-- Las opciones del selector de subcategorías se generarán dinámicamente -->
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" @click="guardarCategoria" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL CREAR SUBCATEGORISA -->
    <div class="modal fade" id="modalCrearSubCategoria" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Registrar SubCategoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="subcategoriaForm" method="POST" action="<?= base_url() ?>admin/postSubCategoria">
                        <div class="row">
                            <!-- Mostramos el mensaje de error debajo del input en rojo -->
                            <span v-if="errorMensaje2" class="text-danger">{{ errorMensaje2 }}</span>
                            <div class="col-12 col-md-7">
                                <div class="row mb-1">
                                    <div class="col-6">
                                        <label class="form-label">CÓDIGO</label>
                                        <input type="text" v-model="subcategoria.codigo" name="codigo" required class="form-control">

                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">NOMBRE</label>
                                    <input type="text" class="form-control" v-model="subcategoria.nombre" name="nombre">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">ASIGANAR CATEGORIAS</label>
                                    <select class="multiCategorias form-control" required name="categorias[]" multiple="multiple">
                                        <!-- Las opciones del selector de subcategorías se generarán dinámicamente -->
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" @click="guardarSubCategoria" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>



</div>


<?= $this->endSection() ?>




<?= $this->section('JSSS') ?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<!-- dataTable -->
<script>
    $(document).ready(function() {
        $('#tablaCategorias').DataTable({
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
        });

    });
</script>



<!-- SELECT 2 -->
<script>
    $(document).ready(function() {
        var dataSubcategorias = [];
        var dataCategorias = [];

        var subcategorias = <?= json_encode($subcategorias) ?>; // Arreglo de subcategorías
        var categorias = <?= json_encode($allCategorias) ?>; // Arreglo de subcategorías

        // Iterar sobre el arreglo de subcategorías y crear las opciones correspondientes
        $.each(subcategorias, function(index, subcategoria) {
            dataSubcategorias.push({
                id: subcategoria.codigo,
                text: subcategoria.codigo,
                categorias: subcategoria.categorias

            });
        });

        // Iterar sobre el arreglo de categorías y crear las opciones correspondientes
        $.each(categorias, function(index, categoria) {
            dataCategorias.push({
                id: categoria.codigo,
                text: categoria.codigo,
            });
        });

        // Función para inicializar Select2
        function initializeSelect2() {
            $('.multiSubCategorias').select2({
                dropdownParent: $('#modalCrearCategoria'),
                data: dataSubcategorias,
                maximumSelectionLength: 6,
                placeholder: "Seleccione las subcategorías",
                language: "es",
                dropdownAutoWidth: true
            });

            $('.multiCategorias').select2({
                dropdownParent: $('#modalCrearSubCategoria'),
                data: dataCategorias,
                maximumSelectionLength: 6,
                placeholder: "Seleccione las categorías",
                language: "es",
                dropdownAutoWidth: true
            });



            // Función para inicializar Select2
            function initializeSelect2(subCategoriaCodigo) {
                var subcategoria = dataSubcategorias.find(function(item) {
                    return item.id === subCategoriaCodigo;
                });

                if (subcategoria) {
                    var selectedCategorias = subcategoria.categorias.map(function(categoria) {
                        return categoria.codigo; // Assuming subcategories have 'id' property, change it accordingly if different.
                    });

                    console.log(subcategoria.categorias)
                    $('.multiCategoriasUpdate[data-codigo="' + subCategoriaCodigo + '"]').empty();


                    $.each(subcategoria.categorias, function(index, categoria) {

                        // Verificar si la subcategoría ya ha sido agregada previamente y no está seleccionada actualmente en el select
                        $('.multiCategoriasUpdate[data-codigo="' + subCategoriaCodigo + '"]').append($('<option>', {
                            value: categoria,
                            text: categoria,
                            selected: true
                        }));

                        // Agregar la subcategoría a la lista de agregadas
                        //addedSubcategorias.push(subcategoria.codigo);

                    });

                    $('.multiCategoriasUpdate').select2({
                        dropdownParent: $('#modalEditar-' + subCategoriaCodigo),
                        data: dataCategorias,
                        maximumSelectionLength: 6,
                        placeholder: "Seleccione las categorías",
                        language: "es",
                        dropdownAutoWidth: true
                    });
                }
            }
            // Asociar evento al botón para abrir el modal y pasar la categoría
            $(document).on('click', '.btn-primary', function() {
                var categoriaCodigo = $(this).data('codigo');
                initializeSelect2(categoriaCodigo);
            });
        }

        initializeSelect2();
    });
</script>

<!-- App Vue para el modal -->
<!-- JavaScript -->
<script>
    var app = new Vue({
        el: '#appSubCategoriasAdmin',
        data: {
            categoria: {
                codigo: '',
                nombre: '',
                subcategorias: []
            },

            categoriaUpdate: {
                codigo: '',
                codigoOriginal: '',
                nombre: '',
                categorias: []
            },

            subcategoria: {
                codigo: '',
                nombre: '',
                categorias: []
            },

            selectedCategoria: null,
            selectedSubCategoria: null,
            subcategorias: <?= json_encode($subcategorias) ?>,
            categorias: <?= json_encode($allCategorias) ?>,
            errorMensaje: '',
            errorMensaje2: '',
            errorMensaje3: ''
        },
        methods: {

            openEditarModal: function(categoria) {
                // Any other code to show the modal
                this.selectedCategoria = categoria;
                this.categoriaUpdate.codigo = categoria.codigo;
                this.categoriaUpdate.nombre = categoria.nombre;
                console.log("Selected category:", this.selectedCategoria);
                console.log("categoriaUpdate:", this.categoriaUpdate);
            },

            guardarCategoria: function() {
                // Verificamos que los campos no estén vacíos
                if (!this.categoria.codigo || !this.categoria.nombre) {
                    this.errorMensaje = 'Por favor, completa todos los campos.';
                    this.mostrarErrorTemporal();
                    return;
                }

                // Verificamos si la categoría ya existe en la lista de categorías
                var codigoCategoria = this.categoria.codigo;
                var existeCategoria = this.categorias.some(function(cat) {
                    return cat.codigo === codigoCategoria;
                });

                // Si la categoría existe, mostramos el mensaje y no enviamos el formulario
                if (existeCategoria) {
                    this.errorMensaje = 'Ya existe una categoría con ese código.';
                    this.mostrarErrorTemporal();
                } else {
                    // Si la categoría no existe y los campos están completos, enviamos el formulario
                    document.getElementById('categoriaForm').submit();
                }
            },

            actualizarCategoria: function() {

                if (!this.categoriaUpdate.codigo || !this.categoriaUpdate.nombre) {
                    this.errorMensaje3 = 'Por favor, completa todos los campos.';
                    this.mostrarErrorTemporal();
                    return;
                }

                console.log(this.selectedCategoria);
                if (!this.selectedCategoria) {
                    console.error('No category selected');
                    return;
                }

                // Verificamos si la categoría ya existe en la lista de categorías, except for the current category being edited
                var codigoSubCategoria = this.categoriaUpdate.codigo;
                var existeSubCategoria = this.subcategorias.some(cat => cat.codigo === codigoSubCategoria && cat.codigo !== this.selectedCategoria.codigo);

                // Si la categoría existe, mostramos el mensaje y no enviamos el formulario
                if (existeSubCategoria) {
                    this.errorMensaje3 = 'Ya existe una subcategoría con ese código.';
                    this.mostrarErrorTemporal();
                } else {
                    // Si la categoría no existe and the fields are completed, enviamos el formulario
                    document.getElementById('categoriaFormUpdate').submit();
                }
            },

            guardarSubCategoria: function() {
                // Verificamos que los campos no estén vacíos
                if (!this.subcategoria.codigo || !this.subcategoria.nombre) {
                    this.errorMensaje2 = 'Por favor, completa todos los campos.';
                    this.mostrarErrorTemporal();
                    return;
                }

                // Verificamos si la categoría ya existe en la lista de categorías
                var codigoSubCategoria = this.subcategoria.codigo;
                var existeSubCategoria = this.subcategorias.some(function(cat) {
                    return cat.codigo === codigoSubCategoria;
                });

                // Si la categoría existe, mostramos el mensaje y no enviamos el formulario
                if (existeSubCategoria) {
                    this.errorMensaje2 = 'Ya existe una categoría con ese código.';
                    this.mostrarErrorTemporal();
                } else {
                    // Si la categoría no existe y los campos están completos, enviamos el formulario
                    document.getElementById('subcategoriaForm').submit();
                }
            },

            mostrarErrorTemporal: function() {
                setTimeout(() => {
                    this.errorMensaje2 = '';
                }, 5000);
            }
        }
    });
</script>
<?= $this->endSection() ?>