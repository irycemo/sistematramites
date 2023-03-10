<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Enrique',
            'ubicacion' => 'Catastro',
            'status' => 'activo',
            'area' => 'Departamento De Operación Y Desarrollo De Sistemas',
            'email' => 'correo@correo.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Administrador');
    }
}
