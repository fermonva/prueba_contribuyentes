<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => 'Administrador']);
        $roleSuperAdmin = Role::create(['name' => 'Super Usuario']);

        $adminUser = User::query()->create([
            'name' => 'fermonva',
            'email' => 'admin@gmail.com',
            'password' => '123456789',
            'email_verified_at' => now(),
        ]);

        $superUser = User::query()->create([
            'name' => 'superuser',
            'email' => 'correo@correo.com',
            'password' => '123456789',
            'email_verified_at' => now(),
        ]);

        $adminUser->assignRole($roleAdmin);
        $superUser->assignRole($roleSuperAdmin);

        $permissionAdmin = Permission::whereIn('name', ['ver menu contribuyentes', 'ver contribuyentes', 'ver menu roles'])->get();
        $roleAdmin->syncPermissions($permissionAdmin);
    }
}
