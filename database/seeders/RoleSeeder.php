<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin Sistemas']);
        $role2 = Role::create(['name' => 'Gerente']);
        $role3 = Role::create(['name' => 'Jefe de Area']);
        $role4 = Role::create(['name' => 'Coor. Area']);
        $role5 = Role::create(['name' => 'Asesor']);

        Permission::create(['name' => 'users.index'])->syncRoles([$role1, $role3, $role4]);
        Permission::create(['name' => 'users.create'])->syncRoles([$role1, $role3, $role4]);
        Permission::create(['name' => 'users.edit'])->syncRoles([$role1, $role3, $role4]);
        Permission::create(['name' => 'users.destroy'])->syncRoles([$role1, $role3, $role4]);

        Permission::create(['name' => 'sedes.create'])->syncRoles([$role1, $role3, $role4, $role5]);

        Permission::create(['name' => 'empresa.index'])->syncRoles([$role1, $role3, $role4, $role5]);
        Permission::create(['name' => 'empresa.create'])->syncRoles([$role1, $role3, $role4, $role5]);
        Permission::create(['name' => 'empresa.edit'])->syncRoles([$role1, $role3, $role4, $role5]);
        Permission::create(['name' => 'empresa.destroy'])->syncRoles([$role1, $role3, $role4]);

        Permission::create(['name' => 'agendas.index'])->syncRoles([$role3, $role4, $role5]);
        Permission::create(['name' => 'agendas.create'])->syncRoles([$role3, $role4, $role5]);

        Permission::create(['name' => 'reportes.index'])->syncRoles([$role1, $role2, $role4, $role5]);


    }
}
