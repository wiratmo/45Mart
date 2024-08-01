<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::factory()->create([
            
            'name' => 'Optics',
            'point_criteria' => 300_000,
            'employee_id' => '1',
        ]);
    \App\Models\Category::factory()->create(
        [
            'name' => 'Furniture',
            'point_criteria' => 500_000,
            'employee_id' => '2',
        ]);
    \App\Models\Category::factory()->create(
        [
            'name' => 'Jewellery',
            'point_criteria' => 1_000_000,
            'employee_id' => '3',
        ]);
    \App\Models\Category::factory()->create(
        [
            'name' => 'Food',
            'point_criteria' => 100_000,
            'employee_id' => '2',
        ]
    );
    }
}
