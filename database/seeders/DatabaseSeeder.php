<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Product::factory(60)->create();
        $orders = \App\Models\Order::factory(15)->create();

        foreach ($orders as $order) {
            $order->products()->attach([
                rand(1, 20),
                rand(21, 40),
                rand(41, 60),
            ]);
        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
