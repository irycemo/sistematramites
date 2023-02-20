<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Consulta']);
        $role3 = Role::create(['name' => 'Precalificación']);
        $role4 = Role::create(['name' => 'Validación']);
        $role5 = Role::create(['name' => 'Entrega']);

        Permission::create(['name' => 'Lista de roles', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear rol', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar rol', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar rol', 'area' => 'Roles'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de permisos', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear permiso', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar permiso', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar permiso', 'area' => 'Permisos'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de usuarios', 'area' => 'Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de servicios', 'area' => 'Servicios'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear servicio', 'area' => 'Servicios'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar servicio', 'area' => 'Servicios'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar servicio', 'area' => 'Servicios'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de umas', 'area' => 'Umas'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear uma', 'area' => 'Umas'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar uma', 'area' => 'Umas'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar uma', 'area' => 'Umas'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de trámites', 'area' => 'Trámites'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear trámite', 'area' => 'Trámites'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar trámite', 'area' => 'Trámites'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar trámite', 'area' => 'Trámites'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de entradas', 'area' => 'Entradas'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear entrada', 'area' => 'Entradas'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar entrada', 'area' => 'Entradas'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar entrada', 'area' => 'Entradas'])->syncRoles([$role1]);

        Permission::create(['name' => 'Recepción', 'area' => 'Recepción'])->syncRoles([$role1]);
        Permission::create(['name' => 'Agregar documentación', 'area' => 'Recepción'])->syncRoles([$role1]);

        Permission::create(['name' => 'Entrega', 'area' => 'Entrega'])->syncRoles([$role1]);
        Permission::create(['name' => 'Finalizar', 'area' => 'Entrega'])->syncRoles([$role1]);

    }
}
