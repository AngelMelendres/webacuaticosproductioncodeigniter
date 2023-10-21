<section class="full-width navLateral">
    <div class="full-width navLateral-bg btn-menu"></div>
    <div class="full-width navLateral-body">
        <div class="full-width navLateral-body-logo text-center tittles">
            <i class="zmdi zmdi-close fa-solid fa-square-xmark btn-menu"></i> ACUATICOS TOSCANINI SOLUTIONS.
        </div>
        <figure class="full-width navLateral-body-tittle-menu">
            <div>
                <img src="https://cdn-icons-png.flaticon.com/512/219/219983.png" alt="Avatar" class="img-responsive">
            </div>
            <figcaption>
                <span>
                    Nombre completo
                    <small>Cargo</small>
                </span>
            </figcaption>
        </figure>
        <nav class="full-width">
            <ul class="full-width list-unstyle menu-principal">
                <li class="full-width divider-menu-h"></li>
                <li class="full-width">
                    <a href="<?= base_url() ?>admin" class="full-width btn-subMenu">
                        <div class="navLateral-body-cl">
                            <i class="fa-solid fa-house"></i>
                        </div>
                        <div class="navLateral-body-cr">
                            INICIO
                        </div>
                    </a>
                </li>

                <li class="full-width divider-menu-h"></li>
                <li class="full-width">
                    <a class="full-width btn-subMenu">
                        <div class="navLateral-body-cl">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                        <div class="navLateral-body-cr">
                            VENTAS
                        </div>
                        <span class="fa-solid fa-chevron-left"></span>
                    </a>
                    <ul class="full-width menu-principal sub-menu-options">
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/misVentas" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-widgets"></i>
                                </div>
                                <div class="navLateral-body-cr">
                                    Mis Ventas
                                </div>
                            </a>
                        </li>
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/vender" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-widgets"></i>
                                </div>
                                <div class="navLateral-body-cr">
                                    Nueva Venta
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="full-width divider-menu-h"></li>
                <li class="full-width">
                    <a class="full-width btn-subMenu">
                        <div class="navLateral-body-cl">
                            <i class="fa-solid fa-boxes-stacked"></i>

                        </div>
                        <div class="navLateral-body-cr">
                            INVENTARIO
                        </div>
                        <span class="fa-solid fa-chevron-left"></span>
                    </a>
                    <ul class="full-width menu-principal sub-menu-options">
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/productos" class="full-width">
                                <div class="navLateral-body-cl">
                                </div>
                                <div class="navLateral-body-cr">
                                    Productos
                                </div>
                            </a>
                        </li>
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/agregarProducto" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-widgets"></i>
                                </div>
                                <div class="navLateral-body-cr">
                                    Agregar Producto
                                </div>
                            </a>
                        </li>
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/categorias" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-widgets"></i>
                                </div>
                                <div class="navLateral-body-cr">
                                    Categorias
                                </div>
                            </a>
                        </li>
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/subcategorias" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-widgets"></i>
                                </div>
                                <div class="navLateral-body-cr">
                                    Subcategorias
                                </div>
                            </a>
                        </li>
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/ajustesProductos" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-widgets"></i>
                                </div>
                                <div class="navLateral-body-cr">
                                   Ajustes
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="full-width divider-menu-h"></li>
                <li class="full-width">
                    <a class="full-width btn-subMenu">
                        <div class="navLateral-body-cl">
                            <i class="fas fa-user me-2"></i>
                        </div>
                        <div class="navLateral-body-cr">
                            CLIENTES
                        </div>
                        <span class="fa-solid fa-chevron-left"></span>
                    </a>
                    <ul class="full-width menu-principal sub-menu-options">
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/clientes" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-widgets"></i>
                                </div>
                                <div class="navLateral-body-cr">
                                    Ver Clientes
                                </div>
                            </a>
                        </li>
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/agregarCliente" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-widgets"></i>
                                </div>
                                <div class="navLateral-body-cr">
                                    Nuevo Cliente
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="full-width divider-menu-h"></li>
                <li class="full-width">
                    <a class="full-width btn-subMenu">
                        <div class="navLateral-body-cl">
                            <i class="fa-solid fa-people-carry-box"></i>
                        </div>
                        <div class="navLateral-body-cr">
                            EMPLEADOS
                        </div>
                        <span class="fa-solid fa-chevron-left"></span>
                    </a>
                    <ul class="full-width menu-principal sub-menu-options">
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/usuarios" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-widgets"></i>
                                </div>
                                <div class="navLateral-body-cr">
                                    Ver Empleados
                                </div>
                            </a>
                        </li>
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/agregarUsuario" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-widgets"></i>
                                </div>
                                <div class="navLateral-body-cr">
                                    Nuevo Empleado
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="full-width divider-menu-h"></li>
                <li class="full-width">
                    <a class="full-width btn-subMenu">
                        <div class="navLateral-body-cl">
                            <i class="fa-solid fa-file-invoice"></i>
                        </div>
                        <div class="navLateral-body-cr">
                            FACTURACION
                        </div>
                        <span class="fa-solid fa-chevron-left"></span>
                    </a>
                    <ul class="full-width menu-principal sub-menu-options">
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/vender" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-widgets"></i>
                                </div>
                                <div class="navLateral-body-cr">
                                    Ver Facturas
                                </div>
                            </a>
                        </li>
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/vender" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-widgets"></i>
                                </div>
                                <div class="navLateral-body-cr">
                                    Nueva Factura
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="full-width divider-menu-h"></li>
                <li class="full-width">
                    <a class="full-width btn-subMenu">
                        <div class="navLateral-body-cl">
                            <i class="fa-solid fa-store"></i>
                        </div>
                        <div class="navLateral-body-cr">
                            SUCURSALES
                        </div>
                        <span class="fa-solid fa-chevron-left"></span>
                    </a>
                    <ul class="full-width menu-principal sub-menu-options">
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/vender" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-widgets"></i>
                                </div>
                                <div class="navLateral-body-cr">
                                    Administrar Sucursales
                                </div>
                            </a>
                        </li>
                        <li class="full-width">
                            <a href="<?= base_url() ?>admin/vender" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-widgets"></i>
                                </div>
                                <div class="navLateral-body-cr">
                                    Nueva Sucursal
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</section>