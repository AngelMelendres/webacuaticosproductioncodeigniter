<!-- MODAL PARA VER EL PRODUCTO -->
<div v-if="producto.codigo" class="modal fade modal-xl" tabindex="-1" role="dialog" :id="'modal-' + producto.codigo">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PRODUCTO. CODIGO: {{ producto.codigo }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <img src='https://emprendepyme.net/wp-content/uploads/2018/02/cualidades-producto-1200x900.jpg' width="90%" height="240px" class="mr-2 mx-3 image-fluid">
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <p><strong>Nombre:</strong> {{ producto.nombre }}</p>
                        <p><strong>Cantidad:</strong> {{ producto.cantidad }}</p>
                        <p><strong>Precio:</strong> {{ producto.precio }} $USD</p>
                        <p><strong>Costo:</strong> {{ producto.costo }} $USD</p>
                        <p><strong>Descripción:</strong> {{ producto.descripcion }}</p>
                    </div>
                </div>
                <hr>
                <div>
                    <h4>ESPECIFICACIONEsS</h4>
                    <p>{{ producto.especificaciones }}</p>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!--FIN MODAL PARA VER EL PRODUCTO -->