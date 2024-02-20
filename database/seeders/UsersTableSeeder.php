<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        $role1 = Role::create(['name' => 'Quimico']);
        $role2 = Role::create(['name' => 'Recepcionista']);

        // Crear permisos
        $permission1 = Permission::create(['name' => 'editar resultados']);
        $permission2 = Permission::create(['name' => 'registrar ordenes']);

        // Asignar permisos a roles
        $role1->givePermissionTo($permission1);
        $role2->givePermissionTo($permission2);

        // Crear usuarios
        $user1 = User::create([
            'name' => 'Químico',
            'email' => 'jesusquechulab@gmail.com',
            'password' => bcrypt('QuechuLAB_Q')
        ]);

        $user2 = User::create([
            'name' => 'Recepcionista',
            'email' => 'jluisg140@gmail.com',
            'password' => bcrypt('QuechuLAB_R')
        ]);

        // Asignar roles a usuarios
        $user1->assignRole($role1);
        $user2->assignRole($role2);
    }
}

