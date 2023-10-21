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

<div class="container" id="appAjustesProductos">
    <div class="card">
        <div class="card-header">
            Configuración de Productos
        </div>
        <div class="card-body">
            <form action="<?= base_url() ?>admin/setEstadoVisibleProductos" method="POST">
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado de los Productos:</label>
                    <select class="form-select" id="estado" name="estado" >
                        <option value="1">Activar</option>
                        <option value="0">Desactivar</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('JSSS') ?>


<?= $this->endSection() ?>