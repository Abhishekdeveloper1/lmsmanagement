<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course_categorie; // Ensure this line is present

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $categories = [
            ['name' => 'Executive'],
            ['name' => 'Basic'],
            ['name' => 'Advanced'],
        ];

        Course_categorie::insert($categories);
    }
}
