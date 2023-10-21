<?php

namespace Config;

use App\Controllers\Ecomerce;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


/* RUTAS PARA EL ECOMERCE */
//$routes->get('/', 'Home::index');
$routes->get('/', 'Ecomerce::index');
$routes->get('/nosotros', 'Ecomerce::nosotros');
$routes->get('/productos', 'Ecomerce::productos');
$routes->get('/productos/(:any)', 'Ecomerce::mostrarProducto/$1');
$routes->get('/contacto', 'Ecomerce::contacto');
$routes->get('/compras', 'Ecomerce::compras'); 


/* RUTAS PARA ADMINISTRADOR */

$routes->match(['get', 'post'], '/admin/login', 'Admin::login');
$routes->post('/admin/loginPost', 'Admin::loginPost', ['as' => 'loginPost']);
$routes->get('/admin', 'Admin::index');

$routes->get('/admin/usuarios', 'Admin::usuarios');

$routes->get('/admin/misVentas', 'Admin::misVentas');
$routes->get('/admin/vender', 'Admin::vender');

$routes->get('/admin/productos', 'Admin::productos');
$routes->get('/admin/agregarProducto', 'Admin::agregarProducto');
$routes->get('/admin/editar/(:any)', 'Admin::editarProductoCompleto/$1');


/* POST */
$routes->post('/admin/postProducto', 'Admin::postProducto');
$routes->post('/admin/editarParcial', 'Admin::updateParcial');
$routes->post('/admin/editarCompleto', 'Admin::updateCompleto');
$routes->post("/admin/eliminarProducto", "Admin::eliminarProducto");

$routes->post('/admin/postCategoria', 'Admin::postCategoria');
$routes->post('/admin/postSubCategoria', 'Admin::postSubCategoria');

$routes->post('/admin/updateCategoria', 'Admin::updateCategoria');
$routes->post('/admin/updateSubCategoria', 'Admin::updateSubCategoria');


$routes->post('/admin/deleteCategoria', 'Admin::deleteCategoria');
$routes->post('/admin/deleteSubCategoria', 'Admin::deleteSubCategoria');
$routes->post('/admin/setEstadoVisibleProductos', 'Admin::setEstadoVisibleProductos');



$routes->post('/admin/cotizacion', 'Admin::cotizacion');

$routes->get('/admin/categorias', 'Admin::categorias');
$routes->get('/admin/ajustesProductos', 'Admin::ajustesProductos');

$routes->get('/admin/agregarCategoria', 'Admin::agregarCategoria');
$routes->get('/admin/subcategorias', 'Admin::subcategorias');
$routes->get('/admin/agregarSubcategoria', 'Admin::agregarSubcategoria');

$routes->get('/admin/clientes', 'Admin::clientes');
$routes->get('/admin/agregarCliente', 'Admin::agregarCliente');


$routes->get('/admin/usuarios', 'Admin::usuarios');

$routes->get('/admin/usuarios', 'Admin::sucursales'); 

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
