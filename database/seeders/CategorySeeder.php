<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'IT & Networking'],
            ['name' => 'Design & Creative'],
            ['name' => 'Writing & Translation'],
            ['name' => 'Admin Support'],
            ['name' => 'Customer Service'],
            ['name' => 'Sales & Marketing'],
            ['name' => 'Accounting & Consulting'],
            ['name' => 'Legal'],
            ['name' => 'Engineering & Architecture'],
            ['name' => 'Data Science & Analytics'],
            ['name' => 'Software Development'],
            ['name' => 'Mobile Development'],
            ['name' => 'Product Management'],
            ['name' => 'Game Development'],
            ['name' => 'Video & Animation'],
            ['name' => 'Music & Audio'],
            ['name' => 'Business Development'],
            ['name' => 'Human Resources'],
            ['name' => 'Project Management'],
            ['name' => 'Virtual Assistance'],
            ['name' => 'Administrative Consulting'],
            ['name' => 'Technical Writing'],
            ['name' => 'Grant Writing'],
            ['name' => 'SEO & SEM'],
            ['name' => 'Market Research'],
            ['name' => 'Data Entry'],
            ['name' => 'E-commerce Development'],
            ['name' => 'Finance & Accounting'],
            ['name' => 'Transcription'],
            ['name' => 'Customer Experience'],
            ['name' => 'Career Coaching'],
            ['name' => 'Sales Consulting'],
            ['name' => 'Social Media Management'],
            ['name' => 'Illustration'],
            ['name' => 'Photography'],
            ['name' => 'Voice Talent'],
            ['name' => 'Fashion Design'],
            ['name' => 'Interior Design'],
            ['name' => 'Public Relations'],
            ['name' => 'Legal Research'],
        ];

        Category::insert($categories);
    }
}
