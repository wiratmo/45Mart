<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Store::factory()->create([
            'category_id' => 1,
            'name' => 'Melawai'
        ]);
        
        \App\Models\Store::factory()->create([
            'category_id' => 2,
            'name' => 'ACE'
        ]);
        
        \App\Models\Store::factory()->create([
            'category_id' => 3,
            'name' => 'Bagong Emas'
        ]);
        \App\Models\Store::factory()->create([
            'category_id' => 4,
            'name' => 'Pizza Hut'
        ]);
    }
}
