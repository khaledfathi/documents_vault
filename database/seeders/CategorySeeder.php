<?php

namespace Database\Seeders;

use App\Features\Documents\Infrastructure\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'unspecified',
        ]);
    }
}
