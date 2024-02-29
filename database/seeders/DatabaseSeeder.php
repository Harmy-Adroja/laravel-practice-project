<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Database\Seeder;


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
        // factory(App\Model\Product::class,50)->create();
        // factory(App\Model\Review::class,300)->create();
         User::factory(5)->create();
        Product::factory(5)->create();
        Review::factory(3)->create();
        
        
    }
}
