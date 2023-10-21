<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class FacturaSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $clientes = $this->db->table('cliente')->get()->getResult();
        $vendedores = $this->db->table('usuario')->get()->getResult();

        $tipos_documento = ['Factura de venta', 'Nota de venta', 'Boleta de venta'];
        $fecha_inicio = strtotime('-1 year');
        $fecha_fin = time();

        $facturas = [];

        for ($i = 1; $i <= 50; $i++) {
            $num_factura = $faker->bothify('FAC-##########');
            $fecha = date('Y-m-d H:i:s', $faker->numberBetween($fecha_inicio, $fecha_fin));
            $tipo_documento = $tipos_documento[array_rand($tipos_documento)];
            $vencimiento = $faker->numberBetween(1, 30);
            $cliente = $clientes[array_rand($clientes)]->codigo;
            $vendedor = $vendedores[array_rand($vendedores)]->cedula;

            $facturas[] = [
                'num_factura' => $num_factura,
                'fecha' => $fecha,
                'tipo_documento' => $tipo_documento,
                'vencimiento' => $vencimiento,
                'cliente' => $cliente,
                'vendedor' => $vendedor,
            ];
        }

        $this->db->table('factura')->insertBatch($facturas);
    }
}
