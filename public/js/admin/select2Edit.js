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