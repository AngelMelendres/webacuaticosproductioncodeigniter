<?php

namespace App\Controllers;


use App\Filters\AuthFilter;
use App\Models\ajustesProductosModel;
use App\Models\CategoriaModel;
use App\Models\ImagenModel;
use App\Models\PdfModel;
use App\Models\ProductoModel;
use App\Models\ProformaModel;
use App\Models\SubcategoriaModel;
use App\Models\UsuarioModel;
use CodeIgniter\Files\{File, Upload};
use FPDF;

class Admin extends BaseController
{
    protected $auth;

    public function __construct()
    {
        $this->auth = new AuthFilter();
    }


    /* 
    ///
        CONTROLADOR A LAS PAGINAS INICIALES
    ///
    */

    public function login()
    {
        return view('admin/login');
    }

    public function index()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Debe iniciar sesión para acceder.');
        }
        return view('admin/index');
    }

    public function ajustesProductos()
    {

        $modelAjustesProductos = new ajustesProductosModel();
        $estadoVisible = $modelAjustesProductos->getEstado();

        $data = [
            'estadoVisible' => $estadoVisible,

        ];

        return view('admin/inventario/ajustes', $data);

        //print_r($val);
    }

    public function misVentas()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Debe iniciar sesión para acceder.');
        }
        return view('admin/ventas/misVentas');
    }

    public function vender()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Debe iniciar sesión para acceder.');
        }
        return view('admin/ventas/vender');
    }

    public function productos()
    {

        $modelProductos = new ProductoModel();
        $productos = $modelProductos->getAllProducts();
        $data = [
            'productos' => $productos,
        ];

        if (!$this->isLoggedIn()) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Debe iniciar sesión para acceder.');
        }
        return view('admin/inventario/productos', $data);
        //printf(json_encode($productos) );
    }

    public function agregarProducto()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Debe iniciar sesión para acceder.');
        }

        //OBTENER LOS DATOS PARA PA PREEVISUALZACION EN LA VISTA DE Agregar PRODUCTO COMPLETO


        $productoModel = new ProductoModel();
        $allSubCategorias = $this->obtenerCategoriasSubcategorias();


        //datos enviados a la vista
        $data = [
            'allSubCategorias' => $allSubCategorias,
        ];
        //print_r (json_encode($data));
        return view('admin/inventario/agregarProducto', $data);
    }


    public function editarProductoCompleto($codigo)
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Debe iniciar sesión para acceder.');
        }

        //OBTENER LOS DATOS PARA PA PREEVISUALZACION EN LA VISTA DE EDITAR PRODUCTO COMPLETO
        $productoModel = new ProductoModel();
        $producto = $productoModel->getProductByCode($codigo);
        $categorias = $productoModel->getCategoriesByProducto($codigo);
        $subcategorias = $productoModel->getSubCategoriesByProducto($codigo);
        $imagenes = $productoModel->getImagenesByProductByCode($codigo);
        $allSubCategorias = $this->obtenerCategoriasSubcategorias();

        //datos enviados a la vista
        $data = [
            'producto' => $producto,
            'categorias' => $categorias,
            'imagenes' =>  $imagenes,
            'subcategorias' => $subcategorias,
            'allSubCategorias' => $allSubCategorias
        ];

        //print_r (json_encode($data));
        return view('admin/inventario/editarProducto', $data);
    }


    public function categorias()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Debe iniciar sesión para acceder.');
        }

        $modelCategorias = new CategoriaModel();
        $categorias = $modelCategorias->getAllCategoriasConSubcategoria();
        $allsubcategorias = $modelCategorias->getAllSubcategories();

        $data = [
            'categorias' => $categorias,
            'allSubcategorias' => $allsubcategorias
        ];

        //printf(json_encode($categorias) );
        return view('admin/inventario/categorias', $data);
    }

    public function subcategorias()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Debe iniciar sesión para acceder.');
        }
        $modelCategorias = new CategoriaModel();
        $subcategorias = $modelCategorias->getAllSubcategoriasConCategoria();
        $allcategorias = $modelCategorias->getAllCategorias();
        $data = [
            'subcategorias' => $subcategorias,
            'allCategorias' => $allcategorias
        ];
        //printf(json_encode($allcategorias) );
        return view('admin/inventario/subCategorias', $data);
    }


    public function clientes()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Debe iniciar sesión para acceder.');
        }
        return view('admin/clientes/clientes');
    }



    public function agregarCliente()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Debe iniciar sesión para acceder.');
        }
        return view('admin/clientes/agregarCliente');
    }

    public function usuarios()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Debe iniciar sesión para acceder.');
        }
        return view('admin/usuarios/usuarios');
    }

    public function facturacion()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Debe iniciar sesión para acceder.');
        }
        return view('admin/index');
    }

    public function sucursales()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to(base_url('admin/login'))->with('error', 'Debe iniciar sesión para acceder.');
        }
        return view('admin/sucursales/sucursales');
    }




    /* 
    ///
        CONTROLADOR A LAS FUNCIONALIDADES LOGICA DEL NEGOCIO
    ///
    */


    public function postProducto()
    {
        $productoModel = new ProductoModel();
        helper('upload');

        // Obtener los parámetros del formulario
        $codigo = $this->request->getVar('codigo');
        $nombre = $this->request->getPost('nombre');
        $cantidad = $this->request->getVar('cantidad');
        $precio = $this->request->getVar('precio');
        $costo = $this->request->getVar('costo');
        $descripcion = $this->request->getVar('descripcion');
        $especificaciones = $this->request->getVar('especificaciones');
        $categorias = $this->request->getVar('subcategorias');
        $uploadedFiles = $this->request->getFiles();


        $producto = [];

        // Actualizar los campos del producto con los nuevos valores
        $producto['codigo'] = $codigo;
        $producto['nombre'] = $nombre;
        $producto['cantidad'] = $cantidad;
        $producto['precio'] = $precio;
        $producto['costo'] = $costo;
        $producto['descripcion'] = $descripcion;
        $producto['especificaciones'] = $especificaciones;
        $producto['categorias'] = $categorias;
        $producto['imagenes'] = $uploadedFiles['imagenes'];


        //guardar
        if ($productoModel->postProducto($producto)) {
            // Redireccionar con mensaje de éxito

            return redirect()->to(base_url('admin/productos'))->with('success', 'El producto se registro correctamente.');
        } else {
            // Redireccionar con mensaje de error
            return redirect()->to(base_url('admin/productos'))->with('error', 'Error, No se pudo registro el producto.');
        }
    }


    public function postCategoria()
    {

        $categoriaModel = new CategoriaModel();


        $codigo = $this->request->getVar('codigo');
        $nombre = $this->request->getVar('nombre');
        $subcategorias = $this->request->getVar('subcategorias');

        $categoria = [];

        // Actualizar los campos del categoria con los nuevos valores
        $categoria['codigo'] = $codigo;
        $categoria['nombre'] = $nombre;
        $categoria['subcategorias'] = $subcategorias;

        //print_r(json_encode($codigo));


        //guardar
        if ($categoriaModel->postCategoria($categoria)) {
            // Redireccionar con mensaje de éxito

            return redirect()->to(base_url('admin/categorias'))->with('success', 'La categoria se registro correctamente.');
        } else {
            // Redireccionar con mensaje de error
            return redirect()->to(base_url('admin/categorias'))->with('error', 'Error, No se pudo registrar la categoria.');
        }
    }

    public function setEstadoVisibleProductos()
    {
        $modelAjustesProductos = new ajustesProductosModel();

        $estado = $this->request->getVar('estado');

        $modelAjustesProductos->guardarEstado($estado);
        return redirect()->to(base_url('admin/ajustesProductos'))->with('success', 'Se a cambiado el estado correctamente.');
    }

    public function postSubCategoria()
    {
        $categoriaModel = new CategoriaModel();


        $codigo = $this->request->getVar('codigo');
        $nombre = $this->request->getVar('nombre');
        $categorias = $this->request->getVar('categorias');

        $subcategoria = [];

        // Actualizar los campos del categoria con los nuevos valores
        $subcategoria['codigo'] = $codigo;
        $subcategoria['nombre'] = $nombre;
        $subcategoria['categorias'] = $categorias;

        //print_r(json_encode($codigo));

        //guardar
        if ($categoriaModel->postSubCategoria($subcategoria)) {
            // Redireccionar con mensaje de éxito

            return redirect()->to(base_url('admin/subcategorias'))->with('success', 'La categoria se registro correctamente.');
        } else {
            // Redireccionar con mensaje de error
            //print_r('ERROR');
            return redirect()->to(base_url('admin/subcategorias'))->with('error', 'Error, No se pudo registrar la categoria.');
        }
    }

    public function deleteCategoria()
    {
        $categoria = $this->request->getVar('categoria');
        $categoriaModel = new CategoriaModel();

        if ($categoriaModel->deleteCategoria(json_decode($categoria))) {
            return redirect()->to(base_url('admin/categorias'))->with('success', 'Se elimino una categoria');;
        } else {
            // Las credenciales son inválidas, mostrar mensaje de error
            return redirect()->to(base_url('admin/categorias'))->with('error', 'Error, No se pudo elimiar la categoria');
        }
    }


    public function deleteSubCategoria()
    {
        $subcategoria = $this->request->getVar('subcategoria');
        $categoriaModel = new CategoriaModel();


        print_r($subcategoria);
        if ($categoriaModel->deleteSubCategoria(json_decode($subcategoria))) {
            return redirect()->to(base_url('admin/subcategorias'))->with('success', 'Se elimino una subcategoria');;
        } else {
            // Las credenciales son inválidas, mostrar mensaje de error
            return redirect()->to(base_url('admin/subcategorias'))->with('error', 'Error, No se pudo elimiar la subcategoria');
        }
    }

    public function updateCompleto()
    {
        $productoCodigo = $this->request->getVar('productoCodigo');
        $productoModel = new ProductoModel();
        $producto = $productoModel->getProductByCode($productoCodigo);
        helper('upload');

        // Obtener los parámetros del formulario
        $nuevoCodigo = $this->request->getVar('codigo');
        $nombre = $this->request->getPost('nombre');
        $cantidad = $this->request->getVar('cantidad');
        $precio = $this->request->getVar('precio');
        $costo = $this->request->getVar('costo');
        $descripcion = $this->request->getVar('descripcion');
        $especificaciones = $this->request->getVar('especificaciones');
        $categorias = $this->request->getVar('subcategorias');
        $nombrePrimeraImagen = $this->request->getVar('primer_archivo');


        // Verificar si el nuevo código ya existe en otro producto
        $productoExistente = $productoModel->getProductByCode($nuevoCodigo);
        if ($productoExistente && $productoExistente['codigo'] !== $productoCodigo) {
            // Redireccionar con mensaje de error
            return redirect()->to(base_url('admin/productos'))->with('error', 'El código del producto ya existe. Por favor, elija un código único.');
        }

        $imagenes = [];
        $uploadedFiles = $this->request->getFiles();

        // Ruta donde se guardarán las imágenes
        $rutaDestino = FCPATH . 'public/images/inventario/';
        $portadaIdXX = '';

        // Verificar y guardar las imágenes
        foreach ($uploadedFiles['imagenes'] as $index => $imagen) {
            if ($imagen->isValid() && !$imagen->hasMoved()) {
                // Generar un nombre único para la imagen
                $nombreImagen = $imagen->getRandomName();
                // Mover la imagen a la carpeta de destino
                $imagen->move($rutaDestino, $nombreImagen);

                // Guardar la información de la imagen en la base de datos
                //$imagenModel = new ImagenModel();
                $data = [
                    'path' => base_url('public/images/inventario/') . $nombreImagen,
                    'alt' => '', // Establece el valor del atributo 'alt' si es necesario
                    'producto' => $producto['codigo']
                ];
                $imagenModel = new ImagenModel();
                $imagenModel->insert($data);

                // Agregar la información de la imagen al array de imágenes
                $imagenes[] = $data;

                // Verificar si es la primera imagen y guardar el ID
                if ($index === 0) {
                    // Guardar el ID de la primera imagen
                    $portadaIdXX = $imagenModel->getInsertID();
                }
            }
        }

        $imgElim = $this->request->getVar('imagenes_eliminar');
        $imagenesEliminar = json_decode($imgElim[0], true);

        // Eliminar las imágenes de la base de datos
        $imagenModel = new ImagenModel();
        $portadaId = $imagenModel->getIdByFileName($nombrePrimeraImagen);
        foreach ($imagenesEliminar as $imagen) {
            // Obtener el nombre del archivo de la URL de la imagen
            $nombreImagen = basename($imagen);

            // Buscar la imagen en la base de datos por su nombre y eliminarla
            $imagenModel->where('path', $imagen)->delete();
            // Eliminar físicamente el archivo de imagen del servidor
            unlink($rutaDestino . $nombreImagen);
        }

        // Actualizar los campos del producto con los nuevos valores
        $producto['codigo'] = $nuevoCodigo;
        $producto['nombre'] = $nombre;
        $producto['cantidad'] = $cantidad;
        $producto['precio'] = $precio;
        $producto['costo'] = $costo;
        $producto['descripcion'] = $descripcion;
        $producto['especificaciones'] = $especificaciones;
        $producto['categorias'] = $categorias;

        if ($portadaId == '' || $portadaId == 'null') {
            $producto['portada'] = $portadaIdXX;
        } else {
            $producto['portada'] = $portadaId;
        }


        //var_dump($nombrePrimeraImagen);
        //print_r($portadaId);

        //Guardar los cambios en la base de datos
        if ($productoModel->updateCompleto($producto, $productoCodigo)) {
            // Redireccionar con mensaje de éxito
            return redirect()->to(base_url('admin/productos'))->with('success', 'El producto se actualizó correctamente.');
        } else {
            // Redireccionar con mensaje de error
            return redirect()->to(base_url('admin/productos'))->with('error', 'Error, No se pudo actualizar el producto.');
        }
    }

    public function updateParcial()
    {
        $productoCodigo = $this->request->getVar('productoCodigo');
        $productoModel = new ProductoModel();
        $producto = $productoModel->getProductByCode($productoCodigo);

        // Obtener los parámetros del formulario
        $nuevoCodigo = $this->request->getVar('codigo');
        $nombre = $this->request->getPost('nombre');
        $cantidad = $this->request->getVar('cantidad');
        $precio = $this->request->getVar('precio');
        $costo = $this->request->getVar('costo');
        $descripcion = $this->request->getVar('descripcion');

        //if si el codigo nuevo no consida con un producto existente
        // Verificar si el nuevo código ya existe en otro producto
        $productoExistente = $productoModel->getProductByCode($nuevoCodigo);
        if ($productoExistente && $productoExistente['codigo'] !== $productoCodigo) {
            // Redireccionar con mensaje de error
            return redirect()->to(base_url('admin/productos'))->with('error', 'El código del producto ya existe. Por favor, elija un código único.');
        }

        // Actualizar los campos del producto
        $producto['codigo'] = $nuevoCodigo;
        $producto['nombre'] = $nombre;
        $producto['cantidad'] = $cantidad;
        $producto['precio'] = $precio;
        $producto['costo'] = $costo;
        $producto['descripcion'] = $descripcion;

        // Guardar los cambios en la base de datos
        if ($productoModel->updateParcial($producto, $productoCodigo)) {
            // Redireccionar con mensaje de éxito
            return redirect()->to(base_url('admin/productos'))->with('success', 'El producto se actualizó correctamente.');
        } else {
            // Redireccionar con mensaje de error
            return redirect()->to(base_url('admin/productos'))->with('error', 'Error, No se pudo actualizar el producto');
        }
    }


    public function updateCategoria()
    {
        $codigo = $this->request->getVar('categoriaCodigo');
        $categoriaModel = new CategoriaModel();
        //$categoria = $categoria->getProductByCode($productoCodigo);

        // Obtener los parámetros del formulario
        $nuevoCodigo = $this->request->getVar('codigo');
        $nombre = $this->request->getPost('nombre');
        $subcategorias = $this->request->getVar('subcategorias');


        $categoria['nuevoCodigo'] = $nuevoCodigo;
        $categoria['nombre'] = $nombre;
        $categoria['subcategorias'] = $subcategorias;


        print_r(json_encode($codigo));

        if ($categoriaModel->updateCategoria($categoria, $codigo)) {
            // Redireccionar con mensaje de éxito
            return redirect()->to(base_url('admin/categorias'))->with('success', 'La categoria se actualizó correctamente.');
        } else {
            // Redireccionar con mensaje de error
            return redirect()->to(base_url('admin/categorias'))->with('error', 'Error, No se pudo actualizar la categoria.');
        }
    }

    public function updateSubCategoria()
    {
        $codigo = $this->request->getVar('subcategoriaCodigo');
        $categoriaModel = new CategoriaModel();
        //$categoria = $categoria->getProductByCode($productoCodigo);

        // Obtener los parámetros del formulario
        $nuevoCodigo = $this->request->getVar('codigo');
        $nombre = $this->request->getPost('nombre');
        $categorias = $this->request->getVar('subcategorias');


        $subcategoria['nuevoCodigo'] = $nuevoCodigo;
        $subcategoria['nombre'] = $nombre;
        $subcategoria['categorias'] = $categorias;


        print_r(json_encode($codigo));

        if ($categoriaModel->updateSubCategoria($subcategoria, $codigo)) {
            // Redireccionar con mensaje de éxito
            return redirect()->to(base_url('admin/subcategorias'))->with('success', 'La categoria se actualizó correctamente.');
        } else {
            // Redireccionar con mensaje de error
            return redirect()->to(base_url('admin/subcategorias'))->with('error', 'Error, No se pudo actualizar la categoria.');
        }
    }

    public function eliminarProducto()
    {
        $producto = $this->request->getVar('producto');
        $productoModelo = new ProductoModel();

        if ($productoModelo->deleteProducto(json_decode($producto))) {
            return redirect()->to(base_url('admin/productos'));
        } else {
            // Las credenciales son inválidas, mostrar mensaje de error
            return redirect()->to(base_url('admin/productos'))->with('error', 'Error, No se pudo elimiar el producto');
        }
    }


    public function cotizacion()
    {

        // Obtener los datos enviados por el cliente a través de POST
        $nombre = $this->request->getVar('nombre');
        $cedula = $this->request->getPost('cedula');
        $correo = $this->request->getPost('correo');
        $telefono = $this->request->getPost('telefono');
        $direccion = $this->request->getPost('direccion');
        $cotizarEnvio = $this->request->getPost('envio');
        $subtotal = $this->request->getPost('subtotal');
        $items = $this->request->getPost('items');

        // Puedes hacer lo que desees con la información recibida

        // Cargar la librería FPDF
        require_once APPPATH . 'Libraries/fpdf186/fpdf.php';

        // Crear un nuevo objeto FPDF
        $pdf = new FPDF();
        $pdf->AddPage();
        // Set the character encoding to UTF-8
        $pdf->SetFont('Arial', '', 12);

        // Agregar contenido al PDF
        // Cabecera de la proforma con datos de la empresa
        $imagePath = base_url('/public/images/logon.png');

        // Agregar contenido al PDF
        // Logo y cabecera de la proforma con datos de la empresa
        $pdf->Image($imagePath, 10, 10, 50);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40); // Empty cell to create space between logo and text
        $pdf->Cell(0, 10, 'Proforma de Venta', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(40); // Empty cell to create space between logo and text
        $pdf->Ln(2);
        $pdf->Cell(0, 10, utf8_decode('EMPRESA: Acuáticos Toscanini Solution SA LTDA'), 0, 0, 'C');
        $pdf->Ln(10);
        $pdf->Cell(0, 10, utf8_decode('DIRECCIÓN: Quito-Riobamba-Guayaquil'), 0, 0, 'C');
        $pdf->Ln(10);
        $pdf->Cell(0, 10, utf8_decode('TELÉFONO: 0987054324'), 0, 0, 'C');
        $pdf->Ln(10);
        $pdf->Cell(0, 10, utf8_decode('CORREO: ventas@acuaticostoscanini.com'), 0, 0, 'C');
        $pdf->Ln(15);

        // Agregar datos de la proforma
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, utf8_decode('Datos del cliente'));
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, utf8_decode('NOMBRE/EMPRESA: ' . $nombre));
        $pdf->Ln(10);
        $pdf->Cell(0, 10, utf8_decode('CÉDULA/RUC: ' . $cedula));
        $pdf->Ln(10);
        $pdf->Cell(0, 10, utf8_decode('CORREO: ' . $correo));
        $pdf->Ln(10);
        $pdf->Cell(0, 10, utf8_decode('TELÉFONO: ' . $telefono));
        $pdf->Ln(10);
        $pdf->Cell(0, 10, utf8_decode('DIRECCION: ' . $direccion));
        $pdf->Ln(10);

        // Lista de productos
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(40, 10, 'Lista de productos:');
        $pdf->Ln(15);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Producto', 1);
        $pdf->Cell(40, 10, 'Codigo', 1);
        $pdf->Cell(40, 10, 'Precio', 1);
        $pdf->Cell(40, 10, 'Cantidad', 1);
        $pdf->Cell(30, 10, 'Link', 1); // Ajustar el ancho de la columna de la imagen
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 12);

        $decodedItems = json_decode($items, true);
        foreach ($decodedItems as $item) {
            // Save current Y position
            $startY = $pdf->GetY();
            // Agregar la imagen del producto como enlace a la página
            $pdf->Cell(40, 15, $item['nombre'], 1);
            $pdf->Cell(40, 15, $item['codigo'], 1);
            $pdf->Cell(40, 15, $item['precio'], 1);
            $pdf->Cell(40, 15, $item['cantidad'], 1);

            // Calculate aspect ratio of the image to fit in the cell
            $aspectRatio = 80 / 40; // Width / Height
            $imageWidth = 30; // Adjust this value as needed
            $imageHeight = $imageWidth / $aspectRatio;
            $pdf->Image($item['imagen'], $pdf->GetX(), $startY, $imageWidth, $imageHeight);
            $pdf->Link($pdf->GetX(), $startY, $imageWidth, $imageHeight, $item['link']);
            // Go to the next line
            $pdf->Ln();
        }
        // Agregar subtotal
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(40, 10, 'Subtotal:');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Subtotal: ' . $subtotal);
        $pdf->Ln(15);

        // Agregar pie de página
        $pdf->SetY(-35); // Move the pointer 20 units from the bottom
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 10, 'Este es solo un valor estimado. Nos contactaremos contigo para negociar los valores finales.', 0, 1, 'C');




        /* GUARDAR */

        $pdfFolderPath = FCPATH . 'public/pdfs/proformas/';

        // Create the folder if it doesn't exist
        if (!is_dir($pdfFolderPath)) {
            mkdir($pdfFolderPath, 0777, true);
        }

        // Generate a unique filename using timestamp
        $timestamp = date('Ymd_His'); // Format: YearMonthDay_HourMinuteSecond
        $pdfFileName = 'proforma_' . $timestamp . '.pdf';
        $pdfFilePath = $pdfFolderPath . $pdfFileName;

        $pdfContent = $pdf->Output('S');
        file_put_contents($pdfFilePath, $pdfContent);


        $pathSave = base_url('public/pdfs/proformas/') . $pdfFileName;
        $pdfRecord = [
            'path' =>  $pathSave,
            'cliente' => $nombre,
            'telefono' => $telefono,
            'ci' => $cedula,
        ];

        $proformaModel = new ProformaModel();
        $proformaModel->insertar($pdfRecord);


        // Prepare the message for WhatsApp
        $mensaje = "Quisiera cotizar los productos:\n$pathSave\n\n";
        $mensaje .= "Mis datos son:\n";
        $mensaje .= "Nombre: " . $nombre . "\n";
        $mensaje .= "Telefono: " . $telefono . "\n";
        $mensaje .= "Envio: " . $cotizarEnvio . "\n";

        $mensajeEncoded = urlencode($mensaje);

        // The phone number to send the message (replace with the desired phone number)
        $phoneNumber = "593962789128";

        // WhatsApp API URL
        $whatsappApiUrl = "https://api.whatsapp.com/send/?phone=" . $phoneNumber . "&text=" . $mensajeEncoded . "&app_absent=0";

        // Send the proforma PDF through WhatsApp
        shell_exec("whatsapp-cli send -i " . $pdfFilePath . " -c " . $whatsappApiUrl);
        header("location: $whatsappApiUrl");

        // Descargar el archivo PDF en el navegador
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');
        readfile($pdfFilePath);
        exit;
    }

    /* 
    Metodo paa comprobar el inicio de session
     */
    public function loginPost()
    {
        // Obtener los datos del formulario
        $usuario = $this->request->getVar('usuario');
        $password = $this->request->getVar('password');

        // Buscar el usuario en la base de datos
        $model = new UsuarioModel();
        $user = $model->where('cedula', $usuario)->first();

        //usar cuando la contrasena si esta hashada
        // if ($user !== null && isset($user->password) && password_verify($password, $user->password)) {

        // Verificar las credenciales del usuario
        if ($user !== null && isset($user['password']) && $password === $user['password']) {
            // Las credenciales son válidas, iniciar sesión
            $session = session();
            $session->set([
                'usuario_cedula' => $user['cedula'],
                'usuario_nombre' => $user['nombre'],
                'usuario_email' => $user['email'],
                'usuario_sucursal' => $user['sucursal'],
                'usuario_rol' => $user['rol'],
                'logged_in' => true
            ]);
            return redirect()->to(base_url() . 'admin');
        } else {
            // Las credenciales son inválidas, mostrar mensaje de error
            return redirect()->to(base_url('admin/login'))->with('error', 'Usuario o contraseña incorrectos');
        }
    }


    /**
     * Verifica si el usuario ha iniciado sesión.
     */
    private function isLoggedIn(): bool
    {
        $session = session();
        return $session->get('logged_in') === true;
    }


    /* 
        OBTIENE TODAS LAS CATEGORIAS Y SUBCATEGORIAS
    */
    public function obtenerCategoriasSubcategorias()
    {
        $subCategoriaModel = new SubcategoriaModel();
        $categorias = $subCategoriaModel->getCategorias_subcategorias();

        $cat_subcat = array();

        foreach ($categorias as $categoria) {
            $cat_codigo = $categoria['categoria_codigo'];
            $subcategoria = array(
                'nombre' => $categoria['subcategoria'],
                'codigo' => $categoria['subcategoria_codigo']
            );
            if (!isset($cat_subcat[$cat_codigo])) {
                $cat_subcat[$cat_codigo] = array(
                    'nombre' => $categoria['categoria'],
                    'subcategorias' => array($subcategoria)
                );
            } else {
                $cat_subcat[$cat_codigo]['subcategorias'][] = $subcategoria;
            }
        }

        return $cat_subcat;
    }
}
