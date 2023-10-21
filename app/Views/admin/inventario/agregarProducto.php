<?= $this->extend('admin/layouts/layout') ?>

<?= $this->section('title') ?>
Editar Producto
<?= $this->endSection() ?>

<?= $this->section('CSSS') ?>
<!-- SummerNote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- multiselect -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Dropzone -->
<!-- jQuery File Upload CSS -->
<!-- Dropzone -->
<!-- jQuery File Upload CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.7.0/css/jquery.fileupload.min.css" />
<!-- jQuery File Upload JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.7.0/js/jquery.fileupload.min.js"></script>


<!-- Dropzone http://www.dropzonejs.com/-->
<link rel="stylesheet" href="<?php echo base_url() ?>public/plugins/dropzone/dropzone.css">
<script src="<?php echo base_url() ?>public/plugins/dropzone/dropzone.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>



<?= $this->endSection() ?>

<?= $this->section('contentAdmin') ?>


<div class="container" id="appEditarProducto">

    <form method="POST" action="<?= base_url() ?>admin/postProducto" enctype="multipart/form-data">
        <div class="card p-3 mt-3">
            <div class="modal-header p-3     mt-1">
                <h5 class="text-center m-auto text-primary">REGISTRA EL PRODUCTO</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-5 mb-3">
                        <p>Agrega las imagenes, la primera es la portada</p>
                        <!--<img src='https://www.entornoestudiantil.com/wp-content/uploads/2018/03/retail-carrito-compra.jpg' class="img-fluid"> -->
                        <div class="form-group agregarMultimedia">

                            <!--=====================================
                            SUBIR MULTIMEDIA DE PRODUCTO VIRTUAL
                            ======================================-->

                            <div class="input-group multimediaVirtual" style="display:none">
                                <span class="input-group-addon"><i class="fa fa-youtube-play"></i></span>
                                <input type="text" class="form-control input-lg multimedia">
                            </div>

                            <!--=====================================
                            SUBIR MULTIMEDIA DE PRODUCTO FÍSICO
                            ======================================-->

                            <div class="multimediaFisica needsclick dz-clickable">
                                <div class="dz-message needsclick">
                                    Arrastrar o dar clic para subir imágenes.
                                </div>

                                <input type="file" name="imagenes[]" multiple style="display: none;">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="mb-1">
                            <label class="form-label">NOMBRE</label>
                            <input type="text" class="form-control" name="nombre">
                        </div>
                        <div class="row mb-1">
                            <div class="col-6">
                                <label class="form-label">CÓDIGO</label>
                                <input type="text" name="codigo" class="form-control">
                            </div>
                            <div class="col-6">
                                <label class="form-label">CANTIDAD (STOCK)</label>
                                <input type="number" name="cantidad" min="0" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-6">
                                <label class="form-label">PRECIO</label>
                                <input type="text" name="precio" class="form-control">
                            </div>
                            <div class="col-6">
                                <label class="form-label">COSTO</label>
                                <input type="text" name="costo" class="form-control">
                            </div>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">DESCRIPCIÓN</label>
                            <input type="text" name="descripcion" class="form-control">
                        </div>

                        <div class="mb-1">
                            <label class="form-label">SUBCATEGORIAS</label>
                            <select class="multiCategorias form-control" name="subcategorias[]" multiple="multiple">
                                <!-- Agregar las opciones del selector de categorías aquí -->
                            </select>

                        </div>
                    </div>

                    <div class="mb-3 mt-3">
                        <label class="form-label">ESPECIFICACIONES</label>
                        <textarea id="editEspecificaciones" name="especificaciones">

                        </textarea>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success mx-4"><i class="fa-solid fa-floppy-disk mx-1"></i> Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
    </form>

</div>
<?= $this->endSection() ?>
<?= $this->section('JSSS') ?>

<!-- SELECT 2 -->
<script>
    $(document).ready(function() {
        var data = [];
        var addedOptions = {};

        // Iterar sobre el objeto que contiene las categorías y subcategorías
        $.each(<?= json_encode($allSubCategorias) ?>, function(key, value) {
            var categoria = {
                id: key,
                text: value.nombre,
                children: []
            };

            // Iterar sobre el arreglo de subcategorías y crear las opciones correspondientes
            $.each(value.subcategorias, function(index, subcategoria) {
                // Verificar si la opción ya ha sido agregada
                if (!addedOptions[subcategoria.codigo]) {
                    categoria.children.push({
                        id: subcategoria.codigo,
                        text: subcategoria.nombre
                    });

                    // Agregar la opción al objeto de opciones agregadas
                    addedOptions[subcategoria.codigo] = true;
                }
            });

            data.push(categoria);
        });

        $('.multiCategorias').select2({
            data: data,
            maximumSelectionLength: 6,
            placeholder: "Seleccione las categorias",
            language: "es",
            dropdownAutoWidth: true
        });

        var subcategoriasSeleccionadas = []; // Inicializar como un arreglo vacío

        // Verificar si hay subcategorías seleccionadas
        if (subcategoriasSeleccionadas.length > 0) {
            // Obtener las subcategorías actualmente seleccionadas en el select
            var subcategoriasSeleccionadasActuales = $('.multiCategorias').val();

            // Crear una lista para realizar un seguimiento de las subcategorías ya agregadas
            var addedSubcategorias = [];

            // Iterar sobre las subcategorías seleccionadas y agregar las nuevas al select
            $.each(subcategoriasSeleccionadas, function(index, subcategoria) {
                // Verificar si la subcategoría ya está seleccionada actualmente en el select
                var subcategoriaSeleccionada = $.inArray(subcategoria.codigo, subcategoriasSeleccionadasActuales) !== -1;

                // Verificar si la subcategoría ya ha sido agregada previamente y no está seleccionada actualmente en el select
                if (addedSubcategorias.indexOf(subcategoria.codigo) === -1 && !subcategoriaSeleccionada) {
                    $('.multiCategorias').append($('<option>', {
                        value: subcategoria.codigo,
                        text: subcategoria.nombre,
                        selected: true
                    }));

                    // Agregar la subcategoría a la lista de agregadas
                    addedSubcategorias.push(subcategoria.codigo);
                }
            });

            // Actualizar Select2 para reflejar los cambios
            $('.multiCategorias').trigger('change');
        }
    });
</script>

<!-- SummerNote -->
<script src="<?php echo base_url() ?>public/js/admin/SummerNoteEdit.js"></script>

<script>
    var newFiles = [];

    $(".multimediaFisica").dropzone({
        url: "/",
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg, image/png",
        maxFilesize: 2, //2mb
        maxFiles: 10, //máximo 10 archivos
        accept: function(file, done) {
            // Guardar las imágenes nuevas en el array de archivos nuevos
            file.id = Date.now(); // Generar un ID único para la imagen
            file.dataURL = URL.createObjectURL(file); // Obtener la URL de la imagen
            newFiles.push(file);

            done();
        },
        init: function() {
            var dropzoneInstance = this;

            this.on("removedfile", function(file) {
                var index = newFiles.indexOf(file);
                newFiles.splice(index, 1);
            });

            $("form").submit(function(e) {
                // Crear un objeto FileList con los archivos seleccionados
                var fileList = new DataTransfer();
                for (var i = 0; i < newFiles.length; i++) {
                    fileList.items.add(newFiles[i]);
                }

                // Obtener el campo de entrada de archivos
                var inputElement = document.querySelector("input[name='imagenes[]']");

                // Asignar el objeto FileList al campo de entrada de archivos
                if (inputElement) {
                    inputElement.files = fileList.files;
                }
            });
        }
    });


    // Inicializar Sortable.js en el dropzone
    Sortable.create(dropzoneInstance.element, {
        handle: ".dz-preview",
        onEnd: function(event) {
            var files = dropzoneInstance.files;
            arrayFiles = Array.from(files);
        }
    });
</script>



<?= $this->endSection() ?>