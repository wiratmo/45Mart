<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarchendiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Marchendise::factory()->create([
            'name' => "Fraying Pan",
            'point' => 100,
        ]);
        \App\Models\Marchendise::factory()->create([
            'name' => "Rice Cooker",
            'point' => 150,
        ]);
        \App\Models\Marchendise::factory()->create([
            'name' => "Knife",
            'point' => 70,
        ]);
    }
}
