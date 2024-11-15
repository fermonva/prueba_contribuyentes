<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => "ver contribuyentes"]);
        Permission::create(['name' => "crear contribuyentes"]);
        Permission::create(['name' => "editar contribuyentes"]);
        Permission::create(['name' => "eliminar contribuyentes"]);

        Permission::create(['name' => "ver roles"]);
        Permission::create(['name' => "crear roles"]);
        Permission::create(['name' => "editar roles"]);
        Permission::create(['name' => "eliminar roles"]);
    }
}
