<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EducationalStatus;

class EducationalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'High School '],
            ['name' => 'Associate Degree'],
            ['name' => 'Bachelor’s Degree'],
            ['name' => 'Master’s Degree'],
            ['name' => 'Doctorate (PhD)'],
            ['name' => 'Professional Certificate'],
            ['name' => 'Vocational Training'],
            ['name' => 'Postgraduate Diploma'],
            ['name' => 'MBA (Master of Business Administration)'],
            ['name' => 'MD (Doctor of Medicine)'],
            ['name' => 'JD (Juris Doctor)'],
            ['name' => 'Technical Diploma'],
            ['name' => 'Trade Certification'],
            ['name' => 'Diploma in Nursing'],
            ['name' => 'Certificate in IT'],
        ];

        EducationalStatus::insert($statuses);
    }
}
