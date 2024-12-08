<?php

namespace Database\Seeders;

use App\Models\Contribuyente;
use Illuminate\Database\Seeder;

class ContribuyenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contribuyente::factory()->count(100)->create();
    }
}
