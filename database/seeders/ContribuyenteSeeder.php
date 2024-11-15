<?php

namespace Database\Seeders;
use App\Models\Contribuyente;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContribuyenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');

        for ($i = 0; $i < 50; $i++) {
            $tipo_documento = $faker->randomElement(['CC', 'NIT']);
            $nombres = $tipo_documento === 'NIT' ? $faker->company : $faker->firstName;
            $apellidos = $tipo_documento === 'NIT' ? '' : $faker->lastName;

            Contribuyente::create([
                'tipo_documento' => $tipo_documento,
                'documento' => $faker->unique()->numberBetween(100000000, 999999999),
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'direccion' => $faker->address,
                'telefono' => $faker->phoneNumber,
                'celular' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'usuario' => $faker->userName,
                'fecha_sistema' => now(),
            ]);
        }
    }
}
