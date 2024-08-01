<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\MemberPoint::factory()->create([
            'user_id' => 9,
            'store_id' => 1,
            'transaction_price' => 1_067_890,
            'point' => 3
        ]);
        \App\Models\LedgerPoint::factory()->create([
            'user_id' => 9,
            'type' => 'top up',
            'ref_id' => '1',
            'current' => 0,
            'add' => 3,
            'final' => 3
        ]);
        \App\Models\MemberPoint::factory()->create([
            'user_id' => 12,
            'store_id' => 2,
            'transaction_price' => 3_767_840,
            'point' => 7
        ]);
        \App\Models\LedgerPoint::factory()->create([
            'user_id' => 12,
            'type' => 'top up',
            'ref_id' => 2,
            'current' => 0,
            'add' => 7,
            'final' => 7
        ]);
        \App\Models\MemberPoint::factory()->create([
            'user_id' => 12,
            'store_id' => 1,
            'transaction_price' => 2_767_840,
            'point' => 9
        ]);
        \App\Models\LedgerPoint::factory()->create([
            'user_id' => 12,
            'type' => 'top up',
            'ref_id' => 3,
            'current' => 7,
            'add' => 9,
            'final' => 16
        ]);
        \App\Models\MemberPoint::factory()->create([
            'user_id' => 12,
            'store_id' => 3,
            'transaction_price' => 1_767_840,
            'point' => 1
        ]);
        \App\Models\LedgerPoint::factory()->create([
            'user_id' => 12,
            'type' => 'top up',
            'ref_id' => 4,
            'current' => 16,
            'add' => 1,
            'final' => 17
        ]);
        \App\Models\MemberPoint::factory()->create([
            'user_id' => 14,
            'store_id' => 4,
            'transaction_price' => 12_967_890,
            'point' => 129
        ]);
        \App\Models\LedgerPoint::factory()->create([
            'user_id' => 14,
            'type' => 'top up',
            'ref_id' => '5',
            'current' => 0,
            'add' => 129,
            'final' => 129
        ]);
        \App\Models\MemberPoint::factory()->create([
            'user_id' => 15,
            'store_id' => 4,
            'transaction_price' => 14_567_890,
            'point' => 145
        ]);
        \App\Models\LedgerPoint::factory()->create([
            'user_id' => 15,
            'type' => 'top up',
            'ref_id' => '6',
            'current' => 0,
            'add' => 145,
            'final' => 145
        ]);


    }
}
