<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Action', 'Drama', 'Comedy', 'Horror', 'Romance', 'Sci-Fi'];
        foreach ($categories as $c) {
            Category::create([
                'nama_category' => $c,
                'slug' => strtolower(str_replace(' ', '-', $c)),
            ]);
        }
    }
}
