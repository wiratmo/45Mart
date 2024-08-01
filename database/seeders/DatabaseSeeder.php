<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Marchendise;
use App\Models\MemberMarchendise;
use App\Models\MemberPoint;
use App\Models\Store;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            StoreSeeder::class,
            MarchendiseSeeder::class,
            MemberPointSeeder::class,
            MemberMarchendiseSeeder::class,
        ]);
    }
}
