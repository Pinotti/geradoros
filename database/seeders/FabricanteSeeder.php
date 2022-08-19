<?php

namespace Database\Seeders;

use App\Models\Fabricante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FabricanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fabricante::factory(50)->create();
    }
}
