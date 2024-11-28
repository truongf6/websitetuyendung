<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Job_Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Job_CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Tạo 20 bản ghi job category
        for ($i = 1; $i <= 20; $i++) {
            Job_Category::create([
                'title' => 'Job Category ' . $i,
                'slug' => Str::slug('Job Category ' . $i),
                'desc' => 'Mô tả cho Job Category ' . $i,
                'parent_id' => null,
            ]);
        }
    }
}
