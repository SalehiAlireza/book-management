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
        $categories = ['Fiction', 'Science', 'History', 'Technology', 'Philosophy'];
        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }
        Category::factory(10)->create();
    }
}
