<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => 'Administrador']);
        $roleSuperAdmin =Role::create(['name' => 'Super Usuario']);

        $adminUser = User::query()->create([
            'name' => 'fermonva',
            'email'=> 'admin@gmail.com',
            'password' => '123456789',
            'email_verified_at' => now()
        ]);

        $superUser = User::query()->create([
            'name' => 'superuser',
            'email'=> 'correo@correo.com',
            'password' => '123456789',
            'email_verified_at' => now()
        ]);

        $adminUser->assignRole($roleAdmin);
        $superUser->assignRole($roleSuperAdmin);

        $permissionAdmin = Permission::whereIn('name', ['ver contribuyentes', 'ver roles'])->get();
        $roleAdmin->syncPermissions($permissionAdmin);
    }
}
