<?php

namespace App\Controllers;

use App\Models\ajustesProductosModel;
use App\Models\CategoriaModel;
use App\Models\ProductoModel;
use App\Models\SubcategoriaModel;
use CodeIgniter\Pager\PagerRenderer;
use Config\Pager;



class Ecomerce extends BaseController
{


    public function index()
    {
        $cat_subcat = $this->obtenerCategoriasSubcategorias();
        $data = [
            'cat_subcat' => $cat_subcat,
        ];
        return view('ecomerce/index', $data);
    }

    public function nosotros()
    {
        return view('ecomerce/nosotros');
    }


    public function productos()
    {
        // Importar modelos
        $productoModel = new ProductoModel();
        $modelAjustesProductos = new ajustesProductosModel();
        $estadoVisible = $modelAjustesProductos->getEstado();


        // Obtener la entrada del formulario de búsqueda
        $busqueda = $this->request->getVar('busqueda');
        $categoria_codigo = $this->request->getVar('categoria');
        $subcategoria_codigo = $this->request->getVar('subcategoria');

        // Consultar todas las categorias y sus subCategorias
        $cat_subcat = $this->obtenerCategoriasSubcategorias();

        // Filtrar por categoría seleccionada (si corresponde)
        $productos = $this->obtenerProductosFiltro($categoria_codigo, $subcategoria_codigo, $productoModel);
        $recomendados = $productoModel->getProductosRecomendados(20);
        // Filtrar por término de búsqueda (si se proporciona)
        if ($busqueda !== null) {
            $productos->groupStart()
                ->like('producto.nombre', $busqueda)
                ->orLike('producto.codigo', $busqueda)
                ->groupEnd();
        }

        // Paginar los resultados
        $productos = $productos->paginate(15);

        $paginador = $productoModel->pager;
        $paginador->setPath('acuaticostoscanini/productos');

        $data = [
            'recomedados' => $recomendados,
            'productos' => $productos,
            'pager' => $paginador,
            'cat_subcat' => $cat_subcat,
            'busqueda' => $busqueda, // Pasar término de búsqueda a la vista
            'estadoVisible' => $estadoVisible['productos_visible']
        ];
        //print_r(json_encode($cat_subcat) );
        return view('ecomerce/productos', $data);
    }



    /*     public function mostrarProducto($codigo)
    {

        $productoModel = new ProductoModel();
        $producto = $productoModel->getProductByCode($codigo);
        $categorias = $productoModel->getCategoriesByProducto($codigo);
        $recomendados = $productoModel->getProductosPorCategoria($categorias['codigo']);

        $imagenes = $productoModel->getImagenesByProductByCode($codigo);

        $data = [
            'producto' => $producto,
            'productos' => $recomendados,
            'imagenes' => $imagenes
        ];

        //return view('ecomerce/producto', $data);
        print_r($data);
    } */

    public function mostrarProducto($codigo)
    {
        $productoModel = new ProductoModel();
        $producto = $productoModel->getProductByCode($codigo);
        $categorias = $productoModel->getCategoriesByProducto($codigo);

        if ($categorias === null) {
            $recomendados = $productoModel->getProductosRecomendados(20);
        } else {
            $recomendados = $productoModel->getProductosPorCategoria($categorias['codigo']);

            if (empty($recomendados)) {
                $recomendados = $productoModel->getProductosRecomendados(20);
            }
        }

        $imagenes = $productoModel->getImagenesByProductByCode($codigo);

        $data = [
            'producto' => $producto,
            'recomedados' => $recomendados,
            'imagenes' => $imagenes
        ];
        return view('ecomerce/producto', $data);
        //print_r($recomendados);
    }


    public function contacto()
    {
        return view('ecomerce/contacto');
    }

    public function compras()
    {
        return view('ecomerce/cart');
    }



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
        //return $categorias;
    }


    public function obtenerProductosFiltro($categoria_codigo, $subcategoria_codigo, $productoModel)
    {

        if ($categoria_codigo !== null) {
            return $productoModel->select('*')
                ->join('producto_categoria', 'producto.codigo = producto_categoria.producto_codigo')
                ->join('subcategoria_categoria', 'producto_categoria.subcategoria_codigo = subcategoria_categoria.subcategoria_codigo')
                ->join('imagen', 'imagen.id = producto.portada', 'left') // Utilizar LEFT JOIN en lugar de JOIN
                ->where('subcategoria_categoria.categoria_codigo', $categoria_codigo);
        } else if ($subcategoria_codigo !== null) {
            return $productoModel->select('*')
                ->join('producto_categoria', 'producto.codigo = producto_categoria.producto_codigo')
                ->join('imagen', 'imagen.id = producto.portada', 'left') // Utilizar LEFT JOIN en lugar de JOIN
                ->where('producto_categoria.subcategoria_codigo', $subcategoria_codigo);
        } else {
            // Consultar todos los productos con la categoría
            return $productoModel->select('*')
                ->join('imagen', 'imagen.id = producto.portada', 'left'); // Utilizar LEFT JOIN en lugar de JOIN
        }
    }
}
