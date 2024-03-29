<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\UmaSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\TramiteSeeder;
use Database\Seeders\DependenciaSeeder;
use Database\Seeders\ServiciosTableSeeder;
use Database\Seeders\CategoriaServicioSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriaServicioSeeder::class);
        $this->call(UmaSeeder::class);
        $this->call(ServiciosTableSeeder::class);
        $this->call(DependenciaSeeder::class);

        /* $this->call(TramiteSeeder::class); */
        $this->call(NotariasTableSeeder::class);
        $this->call(ServiciosTableSeeder::class);
    }
}
