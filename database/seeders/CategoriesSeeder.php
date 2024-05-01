<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           \App\Models\Category::factory(10)->create();

    //     $user1 = \App\Models\User::create([
    //         'name' => 'admin',
    //         'email' => 'admin@mail.com',
    //         'password' => bcrypt('password')
    //      ]);

    //     $user1 = \App\Models\User::create([
    //         'name' => 'admin',
    //         'email' => 'admin@mail.com',
    //         'password' => bcrypt('password')
    //     ]);
        
    //     $brand1 = \App\Models\Brand::create([
    //         'brandname' => 'Skintific'
    //     ]);

    //      $category1= \App\Models\Category::create([
    //         'name' => 'Pria'
    //     ]);

    //    $category2=  \App\Models\Category::create([
    //         'name' => 'Wanita'
    //     ]);

    //     \App\Models\Subcategory::create([
    //         'category_id' => $category1->id,
    //         'name' => 'Lotion'
    //     ]);

    //     \App\Models\Subcategory::create([
    //         'category_id' => $category2->id,
    //         'name' => 'Serum'
    //     ]);
    }
}
