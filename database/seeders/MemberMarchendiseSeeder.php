<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberMarchendiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        \App\Models\MemberMarchendise::factory()->create([
            'user_id' => 14,
            'marchendise_id' => 1,
        ]);
        \App\Models\LedgerPoint::factory()->create([
            'user_id' => 14,
            'type' => 'purchase',
            'ref_id' => '1',
            'current' => 129,
            'add' => -100,
            'final' => 29
        ]);
        
        \App\Models\MemberMarchendise::factory()->create([
            'user_id' => 15,
            'marchendise_id' => 1,
        ]);
        \App\Models\LedgerPoint::factory()->create([
            'user_id' => 15,
            'type' => 'purchase',
            'ref_id' => '2',
            'current' => 145,
            'add' => -70,
            'final' => 75
        ]);
    }
}
