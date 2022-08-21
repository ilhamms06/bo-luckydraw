<?php

namespace Database\Seeders;

use App\Models\Pricing;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Nonstandard\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Pricing::create([
            'id' => Uuid::uuid4(),
            'name' => 'Developer',
            'amount' => 10000,
            'expired_order' => '1 Month',
        ]);
        Pricing::create([
            'id' => Uuid::uuid4(),
            'name' => 'SMALL TEAM',
            'amount' => 20000,
            'expired_order' => '2 Month',
        ]);
        Pricing::create([
            'id' => Uuid::uuid4(),
            'name' => 'ENTERPRISE',
            'amount' => 30000,
            'expired_order' => '3 Month',
        ]);
    }
}
