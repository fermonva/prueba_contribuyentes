<?php

use App\Models\Contribuyente;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

beforeEach(fn () => User::factory()->create());

it('has author')->assertDatabaseHas('users', [
    'id' => 1,
]);

it('user not logged cannot access to contribuyentes page', function () {
    get('/contribuyentes')->assertRedirect('/login');
});

it('user logged can access to contribuyentes page', function () {
    actingAs(User::first())->get('/contribuyentes')->assertStatus(200);
});

it('user logged can access to create contribuyente page', function () {
    actingAs(User::first())->get('/contribuyentes/create')->assertStatus(200);
});

it('user logged can create contribuyente', function () {
    actingAs(User::first())->post('/contribuyentes', Contribuyente::factory()->raw([
        'tipo_documento' => 'CC',
        'documento' => '12345678',
        'nombres' => 'Contribuyente 1',
        'apellidos' => 'Apellido 1',
        'telefono' => '12345678',
        'celular' => '12345678',
        'direccion' => 'Direccion 1',
        'email' => 'T0D0a@gmail.com',
        'usuario' => 'usuario_prueba',
    ]))->assertRedirect('/contribuyentes')->assertSessionHas('success', 'Contribuyente creado con éxito.');
});

it('user logged can access to edit contribuyente page', function () {
    $role = Role::firstOrCreate(['name' => 'Administrador']);
    Permission::firstOrCreate(['name' => 'editar contribuyentes']);
    $role->givePermissionTo('editar contribuyentes');

    $user = User::first()->assignRole('Administrador');
    $contribuyente = Contribuyente::factory()->create();

    actingAs($user)
        ->get("/contribuyentes/{$contribuyente->id}/edit")
        ->assertStatus(200);
});

it('user logged can edit contribuyente', function () {
    // Crea un usuario y un contribuyente existente
    $user = User::first();
    $contribuyente = Contribuyente::factory()->create();

    // Realiza el test del editar
    actingAs($user)->put("/contribuyentes/{$contribuyente->id}", [
        'tipo_documento' => 'CC',
        'documento' => '87654321', // Cambiamos el documento para validar la actualización
        'nombres' => 'Contribuyente Modificado',
        'apellidos' => 'Apellido Modificado',
        'telefono' => '87654321',
        'celular' => '87654321',
        'direccion' => 'Direccion Modificada',
        'email' => 'modificado@gmail.com',
        'usuario' => 'usuario_modificado',
    ])->assertRedirect('/contribuyentes')->assertSessionHas('success', 'Contribuyente actualizado con éxito.');

    // Verifica que los cambios se hayan aplicado en la base de datos
    $this->assertDatabaseHas('contribuyentes', [
        'id' => $contribuyente->id,
        'documento' => '87654321', // Nuevo valor del documento
        'nombres' => 'Contribuyente Modificado',
        'apellidos' => 'Apellido Modificado',
        'direccion' => 'Direccion Modificada',
    ]);
});

it('user logged can delete contribuyente', function () {
    // Crea un usuario y un contribuyente existente
    $user = User::first();
    $contribuyente = Contribuyente::factory()->create();

    // Realiza el test del eliminar
    actingAs($user)
        ->delete("/contribuyentes/{$contribuyente->id}")
        ->assertRedirect('/contribuyentes')
        ->assertSessionHas('success', 'Contribuyente eliminado con éxito.');
    // Verifica que el contribuyente haya sido eliminado de la base de datos
    $this->assertDatabaseMissing('contribuyentes', ['id' => $contribuyente->id]);
});
