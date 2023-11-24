<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create(['name' => 'Computer Science']);
        Course::create(['name' => 'Software Engineering']);
        Course::create(['name' => 'Computer Systems & Networking']);
        Course::create(['name' => 'Graphics & Multimedia Technology']);
        Course::create(['name' => 'Cyber Security']);
    }
}
