<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuario';
    protected $primaryKey       = 'codigo';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'cedula',
        'nombre',
        'email',
        'password',
        'telefono',
        'direccion',
        'sucursal',
    ];

    public function getAllCategories()
    {
        return $this->findAll();
    }
}
