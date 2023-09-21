<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Seeder;
use App\Models\CategoriaServicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriaServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria = CategoriaServicio::create(['nombre' => 'Certificaciones', 'concepto' => '20501', 'seccion' => '0']);

        $categoria = CategoriaServicio::create(['nombre' => 'Comercio Certificaciones', 'concepto' => '20507', 'seccion' => '6']);

        $categoria = CategoriaServicio::create(['nombre' => 'Comercio Inscripciones', 'concepto' => '20507', 'seccion' => '6']);

        $categoria = CategoriaServicio::create(['nombre' => 'Inscripciones - Propiedad', 'concepto' => '20502', 'seccion' => '1']);

        $categoria = CategoriaServicio::create(['nombre' => 'Inscripciones - Gravamenes', 'concepto' => '20510', 'seccion' => '2']);

        $categoria = CategoriaServicio::create(['nombre' => 'Cancelación - Gravamenes', 'concepto' => '20510', 'seccion' => '2']);

        $categoria = CategoriaServicio::create(['nombre' => 'Varios , Sentencias, Arrendamientos, Avisos Preventivos', 'concepto' => '20505', 'seccion' => '5']);

    }
}
