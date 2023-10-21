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

    <form method="POST" action="<?= base_url() ?>admin/editarCompleto" enctype="multipart/form-data">
        <div class="card p-3 mt-3">
            <div class="modal-header p-3     mt-1">
                <h5 class="text-center m-auto">EDICIÓN DEL PRODUCTO. CÓDIGO: {{ producto.codigo }}</h5>
                <button type="submit" class="btn btn-success mx-4"><i class="fa-solid fa-floppy-disk mx-1"></i> Guardar</button>
                <a class="btn btn-danger" href="<?= base_url() ?>admin/productos " role="button">Calcelar</a>
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
                        {{ producto.especificaciones }}
                        </textarea>
                    </div>

                    <input type="hidden" name="primer_archivo" id="primer_archivo" value="">

                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success mx-4"><i class="fa-solid fa-floppy-disk mx-1"></i> Guardar</button>
                    <a class="btn btn-danger" href="<?= base_url() ?>admin/productos " role="button">Calcelar</a>
                </div>
            </div>
    </form>

</div>
<?= $this->endSection() ?>
<?= $this->section('JSSS') ?>

<!-- App Vue -->
<script>
    var app = new Vue({
        el: '#appEditarProducto',
        data: {
            producto: <?= json_encode($producto) ?>,
            //categorias que ya tiene un producto
            subcategorias: <?= json_encode($subcategorias) ?>,
            //todas las categorias y subcategorias de
            cat_subCat: <?= json_encode($allSubCategorias) ?>,
            selectedOptions: [],
            textoBusquedaCategoria: ''
        },
        computed: {
            filtrarSubcategorias() {
                return this.subcategorias.filter(subcategoria => {
                    return subcategoria.nombre.toLowerCase().includes(this.textoBusquedaCategoria.toLowerCase())
                })
            }
        },
        watch: {
            textoBusquedaCategoria() {
                this.$nextTick(() => {
                    $('.selectpicker').selectpicker('refresh')
                })
            }
        }
    });
</script>

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

        // Obtener el arreglo de subcategorías seleccionadas
        var subcategoriasSeleccionadas = <?= json_encode($subcategorias) ?>;

        // Crear una lista para realizar un seguimiento de las subcategorías ya agregadas
        var addedSubcategorias = [];

        // Obtener las subcategorías actualmente seleccionadas en el select
        var subcategoriasSeleccionadasActuales = $('.multiCategorias').val();

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


        // Escuchar evento de selección de subcategorías
        $('.multiCategorias').on('select2:select', function(e) {
            var selectedOption = e.params.data;

            // Verificar si la subcategoría ya está seleccionada antes de agregarla
            var isAlreadySelected = app.subcategorias.find(function(subcategoria) {
                return subcategoria.codigo === selectedOption.id;
            });

            if (!isAlreadySelected) {
                app.subcategorias.push({
                    codigo: selectedOption.id,
                    nombre: selectedOption.text
                });
            }
        });
    });
</script>

<!-- SummerNote -->
<script src="<?php echo base_url() ?>public/js/admin/SummerNoteEdit.js"></script>

<!-- DROPZONE -->
<script>
    var imagenes = <?php echo json_encode($imagenes); ?>;
    var portadaId = '<?php echo $producto['portada']; ?>';
    var newFiles = [];
    var existingFiles = [];
    var imagenesEliminar = [];

    $(".multimediaFisica").dropzone({
        url: "/",
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg, image/png",
        maxFilesize: 2, // 2MB
        maxFiles: 10, // Máximo 10 archivos
        init: function() {
            var dropzoneInstance = this;

            // Recorrer el array de imágenes y agregar cada una como archivo preexistente
            for (var i = 0; i < imagenes.length; i++) {
                var imagen = imagenes[i];
                var mockFile = {
                    name: imagen.path,
                    id: imagen.id,
                    size: 12345,
                    type: 'image/jpeg',
                    accepted: true
                };

                // Emitir el evento "addedfile" para simular la adición del archivo preexistente
                dropzoneInstance.emit("addedfile", mockFile);

                // Establecer la URL de la imagen preexistente en la vista previa del archivo
                dropzoneInstance.emit("thumbnail", mockFile, imagen.path);

                // Asegurarse de que el archivo aparezca como completamente cargado
                dropzoneInstance.emit("complete", mockFile);

                // Guardar el nombre del archivo en el array de archivos existentes
                existingFiles.push(mockFile.name);
            }

            // Inicializar Sortable.js para permitir la reordenación de las imágenes
            Sortable.create(dropzoneInstance.element, {
                handle: ".dz-preview",
                draggable: ".dz-preview",
                animation: 150,

                onEnd: function(event) {
                    var files = dropzoneInstance.files;
                    var reorderedFiles = [];

                    // Obtener el nuevo orden de los archivos
                    for (var j = 0; j < files.length; j++) {
                        reorderedFiles.push(files[j].name);
                    }

                    // Actualizar el array de imágenes con el nuevo orden
                    imagenes.sort(function(a, b) {
                        var aIndex = reorderedFiles.indexOf(a.path);
                        var bIndex = reorderedFiles.indexOf(b.path);
                        return aIndex - bIndex;
                    });

                    // Actualizar las imágenes preexistentes con el nuevo orden
                    dropzoneInstance.removeAllFiles();
                    for (var k = 0; k < imagenes.length; k++) {
                        var imagen = imagenes[k];
                        var mockFile = {
                            name: imagen.path,
                            size: 12345,
                            type: 'image/jpeg',
                            accepted: true
                        };

                        // Agregar archivo solo si no existe previamente
                        if (existingFiles.indexOf(mockFile.name) === -1) {
                            dropzoneInstance.emit("addedfile", mockFile);
                            dropzoneInstance.emit("thumbnail", mockFile, imagen.path);
                            dropzoneInstance.emit("complete", mockFile);

                            if (imagen.id === portadaId) {
                                dropzoneInstance.emit("thumbnail", mockFile, imagen.path);
                                mockFile.previewElement.classList.add("dz-portada");
                            }

                            // Agregar el nombre del archivo al array de archivos existentes
                            existingFiles.push(mockFile.name);
                        }
                    }

                    // Agregar las imágenes nuevas al array de imágenes
                    for (var l = 0; l < newFiles.length; l++) {
                        var newFile = newFiles[l];
                        imagenes.push({
                            id: newFile.name,
                            path: newFile.name,
                            alt: newFile.alt,
                            producto_id: 'PROD-06842'
                        });

                        // Agregar el archivo solo si no existe previamente
                        if (existingFiles.indexOf(newFile.name) === -1) {
                            dropzoneInstance.emit("addedfile", newFile);
                            dropzoneInstance.emit("thumbnail", newFile, newFile.dataURL);
                            dropzoneInstance.emit("complete", newFile);

                            if (newFile.id === portadaId) {
                                dropzoneInstance.emit("thumbnail", newFile, newFile.dataURL);
                                newFile.previewElement.classList.add("dz-portada");
                            }

                            // Agregar el nombre del archivo al array de archivos existentes
                            existingFiles.push(newFile.name);
                        }
                    }

                    // Limpiar el array de archivos nuevos
                    newFiles = [];
                }

            });


            // Capturar el evento "removedfile" cuando se elimina un archivo del Dropzone
            this.on("removedfile", function(file) {
                // Verificar si el archivo eliminado es una imagen preexistente
                if (existingFiles.indexOf(file.name) !== -1) {
                    // Agregar el nombre del archivo al array de imágenes a eliminar
                    imagenesEliminar.push(file.name);
                }
            });

        },
        accept: function(file, done) {
            // Guardar las imágenes nuevas en el array de archivos nuevos
            file.id = Date.now(); // Generar un ID único para la imagen
            file.dataURL = URL.createObjectURL(file); // Obtener la URL de la imagen
            newFiles.push(file);

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

            done();
        }
    });


    $("form").submit(function(e) {
        // Agregar el array de imágenes a eliminar al formulario antes de enviarlo
        $("<input>").attr({
            "type": "hidden",
            "name": "imagenes_eliminar[]",
            "value": JSON.stringify(imagenesEliminar)
        }).appendTo($(this));

        // Obtener todos los elementos .dz-filename
        var filenameElements = $(".dz-filename");

        // Verificar si hay elementos .dz-filename
        if (filenameElements.length > 0) {
            // Obtener el primer elemento y su contenido
            var primerEnlace = filenameElements.first().find("span").text();
            console.log("Primer enlace:", primerEnlace);

            // Asignar el valor al campo oculto correspondiente
            $("input[name='primer_archivo']").val(primerEnlace);
        }

    });
</script>



<?= $this->endSection() ?>