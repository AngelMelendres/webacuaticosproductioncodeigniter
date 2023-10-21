<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Verifica si el usuario está autenticado.
     *
     * @param RequestInterface $request
     * @param array|null       $params
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $params = null)
    {
        // Verifica si el usuario está autenticado
        if (!logged_in()) {
            // Si el usuario no está autenticado, redirige a la página de login
            return redirect()->to('admin/login');
        }
    }

    /**
     * No realiza ninguna acción después de la ejecución del controlador.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $params
     *
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $params = null)
    {
        // No realiza ninguna acción después de la ejecución del controlador
    }
}
