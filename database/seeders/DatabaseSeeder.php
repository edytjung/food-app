<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin\Product\Product;
use App\Models\Slider;
use App\Models\WhyChooseUs;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserSeeder::class);
        $this->call(WhyChooseUsTitleSeeder::class);
        Slider::factory(10)->create();
        WhyChooseUs::factory(3)->create();
        $this->call(ProductCategorySeeder::class);
        Product::factory(10)->create();
    }
}
