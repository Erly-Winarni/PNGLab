<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Editing Video',
            'Desain Grafis',
            'Pemrograman',
            'UI/UX',
            'Fotografi',
        ];

        foreach ($categories as $c) {
            Category::create([
                'name' => $c,
                'slug' => Str::slug($c),
            ]);
        }
    }
}
