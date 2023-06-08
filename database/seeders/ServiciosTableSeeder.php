<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiciosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('servicios')->delete();
        
        \DB::table('servicios')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Cuando se trate de uno o hasta cinco tomos o libros índice',
                'tipo' => 'uma',
                'estado' => 'activo',
                'umas' => '1.00',
                'ordinario' => '104.00',
                'urgente' => '0.00',
                'extra_urgente' => '0.00',
                'material' => '2403502413',
                'clave_ingreso' => 'DC93',
                'operacion_principal' => '2403',
                'operacion_parcial' => '5024',
                'categoria_servicio_id' => 1,
                'creado_por' => 1,
                'actualizado_por' => 1,
                'created_at' => '2023-05-09 17:36:09',
                'updated_at' => '2023-05-11 13:00:12',
            ),
            1 => 
            array (
                'id' => 2,
            'nombre' => 'Copias certificadas (por página)',
                'tipo' => 'fija',
                'estado' => 'activo',
                'umas' => '0.00',
                'ordinario' => '45.00',
                'urgente' => '90.00',
                'extra_urgente' => '135.00',
                'material' => '2403064513',
                'clave_ingreso' => 'DL13',
                'operacion_principal' => '2403',
                'operacion_parcial' => '0645',
                'categoria_servicio_id' => 1,
                'creado_por' => 1,
                'actualizado_por' => 1,
                'created_at' => '2023-05-09 17:38:33',
                'updated_at' => '2023-06-07 13:52:56',
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Búsqueda de antecedente de 1 a 10',
                'tipo' => 'uma',
                'estado' => 'activo',
                'umas' => '1.00',
                'ordinario' => '104.00',
                'urgente' => '0.00',
                'extra_urgente' => '0.00',
                'material' => '2403502113',
                'clave_ingreso' => 'DC90',
                'operacion_principal' => '2403',
                'operacion_parcial' => '5021',
                'categoria_servicio_id' => 1,
                'creado_por' => 1,
                'actualizado_por' => 1,
                'created_at' => '2023-05-11 12:42:06',
                'updated_at' => '2023-06-08 11:32:30',
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'Búsqueda de bienes por índices de 11 a 20.',
                'tipo' => 'uma',
                'estado' => 'activo',
                'umas' => '2.00',
                'ordinario' => '208.00',
                'urgente' => '0.00',
                'extra_urgente' => '0.00',
                'material' => '2403502213',
                'clave_ingreso' => 'DC91',
                'operacion_principal' => '2403',
                'operacion_parcial' => '5022',
                'categoria_servicio_id' => 1,
                'creado_por' => 1,
                'actualizado_por' => NULL,
                'created_at' => '2023-05-11 12:42:31',
                'updated_at' => '2023-05-11 12:42:31',
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'Búsqueda de bienes por índices de 21 o más.',
                'tipo' => 'uma',
                'estado' => 'activo',
                'umas' => '3.00',
                'ordinario' => '312.00',
                'urgente' => '0.00',
                'extra_urgente' => '0.00',
                'material' => '2403502313',
                'clave_ingreso' => 'DC92',
                'operacion_principal' => '2403',
                'operacion_parcial' => '5023',
                'categoria_servicio_id' => 1,
                'creado_por' => 1,
                'actualizado_por' => 1,
                'created_at' => '2023-05-11 12:42:54',
                'updated_at' => '2023-06-07 13:52:02',
            ),
            5 => 
            array (
                'id' => 6,
            'nombre' => 'Copias simples (por página)',
                'tipo' => 'fija',
                'estado' => 'activo',
                'umas' => '0.00',
                'ordinario' => '27.00',
                'urgente' => '54.00',
                'extra_urgente' => '81.00',
                'material' => '2403065013',
                'clave_ingreso' => 'DL14',
                'operacion_principal' => '2403',
                'operacion_parcial' => '0650',
                'categoria_servicio_id' => 1,
                'creado_por' => 1,
                'actualizado_por' => 1,
                'created_at' => '2023-05-11 13:02:12',
                'updated_at' => '2023-06-07 13:50:40',
            ),
        ));
        
        
    }
}