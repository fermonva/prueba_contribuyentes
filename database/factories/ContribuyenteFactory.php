<?php

namespace Database\Factories;

use App\Models\Contribuyente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contribuyente>
 */
class ContribuyenteFactory extends Factory
{
    protected $model = Contribuyente::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipo_documento = $this->faker->randomElement(['CC', 'NIT']);
        $nombres = $tipo_documento === 'NIT' ? $this->faker->company : $this->faker->firstName;
        $apellidos = $tipo_documento === 'NIT' ? '' : $this->faker->lastName;

        return [
            'tipo_documento' => $tipo_documento,
            'documento' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'celular' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'usuario' => $this->faker->userName,
            'fecha_sistema' => now(),
        ];
    }
}
