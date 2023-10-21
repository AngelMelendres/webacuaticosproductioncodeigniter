<?php

namespace App\Models;

use CodeIgniter\Model;

class ProformaModel extends Model
{
    protected $table = 'proformas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['path', 'cliente', 'telefono', 'ci'];


    public function insertar($pdfRecord)
    {
        $this->insert($pdfRecord);
        //print_r($pdfRecord);
    }
}
