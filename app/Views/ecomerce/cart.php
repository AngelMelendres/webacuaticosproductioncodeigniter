<?= $this->extend('ecomerce/layouts/layout') ?>

<?= $this->section('title') ?>
Carrito Acuticos Toscanini
<?= $this->endSection() ?>
<?= $this->section('metas') ?>
<meta name="description" content='QUE ES ACUATICOS & TOSCANINI EC. La empresa se encarga de las ventas y distribución de instrumentos y tecnologías de evaluación al ambiente, comprendiendo las áreas de la calidad del agua, del suelo y del aire. También, se posiciona con una amplia línea en el área de la temperatura y otros productos que permitirán a nuestros clientes obtener resultados eficaces ya sea como emprendedores y otros colegas empresarios.'>
<meta name="keywords" content="Acuaticos,Toscanini,Solutions,venta,online,online,Ecuador,Quito,Cuenca,Riobamba,Guayaquil,Costa,Sierra,Oriente,Galapagos,Ambiente,Medicion,calidad,gatantia">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('ecomerce/templates/banerMM') ?>

<div class="container mt-4 mb-5" id="proforma">
    <h1 class="text-center p-4"><b>GENERAR TU PROFORMA</b></h1>
    <hr>
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Producto</th>
                            <th class="text-sm">Precio</th>
                            <th class="text-sm">Cantidad</th>
                            <th class="text-sm">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in items" :key="index">
                            <td style="cursor: pointer;">
                                <i @click="eliminarProducto(index)" class="fa-solid fa-trash fa-xl" style="color: #b51c1c;"></i>
                            </td>
                            <td class="d-flex align-items-center">
                                <img :src=item.imagen width="100px" class="mr-2 mx-3">
                                <div>
                                    <p>{{ item.nombre }}</p>
                                    <p class="text-muted">{{ item.codigo }}</p>
                                </div>
                            </td>
                            <td class="text-sm">{{ item.precio }}</td>
                            <td class="text-sm" style="width: 60px;"><input type="number" min='1' max="500" class="form-control form-control-sm" v-model="item.cantidad"></td>
                            <td class="text-sm text-center">{{ (item.precio * item.cantidad).toFixed(2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4">
                <form id="proformaForm" @submit.prevent="enviarProforma">
                    <h2>Detalles</h2>
                    <h5>Subtotal: {{subtotal}} $USD</h5>
                    <hr>
                    <span style="font-size: 10px;" class="text-center"><b>Este es solo un valor estimado. Nos contactaremos contigo para negociar los valores finales.</b></span>
                    <hr>
                    <h5 class="text-center"><b>Datos para la proforma</b></h5>


                    <div class="form-group">
                        <label for="nombre">Nombre y Apellido o Empresa</label>
                        <input required type="text" class="form-control" id="nombre" v-model="nombre" maxlength="120">
                    </div>
                    <div class="form-group">
                        <label for="cedula">Cedula o RUC</label>
                        <input required type="text" class="form-control"  v-model="cedula" id="cedula" pattern="[0-9]{1,14}" title="Ingrese tu CI o DNI">
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo Electronico</label>
                        <input type="email" class="form-control" v-model="correo" id="correo">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input required type="tel" class="form-control" v-model="telefono" id="telefono" pattern="[0-9]{10}" maxlength="14">
                    </div>

                    <div class="form-group">
                        <label for="cotizarEnvio">Desea cotizar el valor del envio?</label>
                        <select v-model="cotizarEnvio" style="width: 60px;" class="form-control"  id="cotizarEnvio">
                            <option value="no">NO</option>
                            <option value="si">SI</option>
                        </select>
                    </div>

                    <div class="form-group" v-if="cotizarEnvio === 'si'">
                        <label for="direccion">Direccion o ciudad</label>
                        <input type="text" class="form-control" id="direccion" v-model="direccion" required maxlength="200">
                    </div>
                    <div class="mt-2 text-center">
                        <button class="btn btn-danger" form="proformaForm" class="btn btn-danger" type="submit">Enviar Proforma</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>
    new Vue({
        el: '#proforma',
        data: {
            items: [],
            cotizarEnvio: 'no',
            // Agrega variables para el formulario
            nombre: '',
            cedula: '',
            correo: '',
            telefono: '',
            envio: '',
            direccion: ''
        },

        created() {
            // Obtener los datos del Local Storage
            const data = localStorage.getItem('cart');

            if (data) {
                // Convertir los datos de JSON a un array de objetos
                this.items = JSON.parse(data);
            }
        },
        // Resto del código
        methods: {
            // Resto de los métodos, incluido eliminarProducto
            eliminarProducto(index) {
                // Eliminar el producto del array items
                this.items.splice(index, 1);
                // Actualizar el Local Storage con el nuevo array items
                localStorage.setItem('cart', JSON.stringify(this.items));
            },

            enviarProforma() {
                // Crea un formulario HTML oculto
                const hiddenForm = document.createElement('form');
                hiddenForm.action = '<?= base_url() ?>admin/cotizacion'; // Ruta del controlador
                hiddenForm.method = 'POST';
                hiddenForm.style.display = 'none';

                // Agrega los campos al formulario oculto
                const createField = (name, value) => {
                    const field = document.createElement('input');
                    field.setAttribute('type', 'hidden');
                    field.setAttribute('name', name);
                    field.setAttribute('value', value);
                    return field;
                };

                hiddenForm.appendChild(createField('subtotal', this.subtotal));
                hiddenForm.appendChild(createField('items', JSON.stringify(this.items)));
                hiddenForm.appendChild(createField('nombre', this.nombre));
                hiddenForm.appendChild(createField('cedula', this.cedula));
                hiddenForm.appendChild(createField('correo', this.correo));
                hiddenForm.appendChild(createField('telefono', this.telefono));
                hiddenForm.appendChild(createField('envio', this.cotizarEnvio));
                hiddenForm.appendChild(createField('direccion', this.direccion));

                // Agrega el formulario oculto al documento y envía la solicitud
                document.body.appendChild(hiddenForm);
                hiddenForm.submit();
                //console.log(hiddenForm)
            }
        },


        computed: {
            subtotal() {
                return this.items.reduce((acc, item) => acc + item.precio * item.cantidad, 0).toFixed(2);
            }
        }
    });
</script>
<?= $this->endSection() ?>