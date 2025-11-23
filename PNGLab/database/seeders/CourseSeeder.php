<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Dasar Editing Video untuk Pemula',
                'description' => 'Belajar editing video dari dasar menggunakan software modern.',
                'category_id' => 1,
                'teacher_id' => 2,
            ],
            [
                'title' => 'Fotografi Profesional',
                'description' => 'Pelajari teknik fotografi untuk menghasilkan foto berkualitas tinggi.',
                'category_id' => 2,
                'teacher_id' => 2,
            ],
            [
                'title' => 'Desain Grafis Adobe Illustrator',
                'description' => 'Belajar membuat ilustrasi dan desain profesional dengan Illustrator.',
                'category_id' => 1,
                'teacher_id' => 3,
            ],
        ];

        foreach ($courses as $course) {
            DB::table('courses')->insert([
                'title' => $course['title'],
                'slug' => Str::slug($course['title']),
                'description' => $course['description'],
                'category_id' => $course['category_id'],
                'teacher_id' => $course['teacher_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
