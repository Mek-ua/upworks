<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run()
    {
        $skills = [
            // IT & Networking
            ['name' => 'Network Administration', 'category_id' => 1],
            ['name' => 'Cybersecurity', 'category_id' => 1],
            ['name' => 'Cloud Computing', 'category_id' => 1],
            ['name' => 'IT Support', 'category_id' => 1],
            ['name' => 'System Administration', 'category_id' => 1],

            // Design & Creative
            ['name' => 'Graphic Design', 'category_id' => 2],
            ['name' => 'UI/UX Design', 'category_id' => 2],
            ['name' => '3D Modeling', 'category_id' => 2],
            ['name' => 'Brand Identity', 'category_id' => 2],
            ['name' => 'Illustration', 'category_id' => 2],

            // Writing & Translation
            ['name' => 'Content Writing', 'category_id' => 3],
            ['name' => 'Copywriting', 'category_id' => 3],
            ['name' => 'Translation', 'category_id' => 3],
            ['name' => 'Proofreading', 'category_id' => 3],
            ['name' => 'Technical Writing', 'category_id' => 3],

            // Admin Support
            ['name' => 'Data Entry', 'category_id' => 4],
            ['name' => 'Virtual Assistance', 'category_id' => 4],
            ['name' => 'Email Management', 'category_id' => 4],
            ['name' => 'Scheduling', 'category_id' => 4],
            ['name' => 'Office Management', 'category_id' => 4],

            // Customer Service
            ['name' => 'Customer Support', 'category_id' => 5],
            ['name' => 'Technical Support', 'category_id' => 5],
            ['name' => 'Client Communication', 'category_id' => 5],
            ['name' => 'Complaint Resolution', 'category_id' => 5],
            ['name' => 'Help Desk Support', 'category_id' => 5],

            // Sales & Marketing
            ['name' => 'SEO', 'category_id' => 6],
            ['name' => 'Social Media Marketing', 'category_id' => 6],
            ['name' => 'Email Marketing', 'category_id' => 6],
            ['name' => 'Lead Generation', 'category_id' => 6],
            ['name' => 'Content Marketing', 'category_id' => 6],

            // Accounting & Consulting
            ['name' => 'Financial Analysis', 'category_id' => 7],
            ['name' => 'Accounting', 'category_id' => 7],
            ['name' => 'Business Consulting', 'category_id' => 7],
            ['name' => 'Tax Preparation', 'category_id' => 7],
            ['name' => 'Auditing', 'category_id' => 7],

            // Legal
            ['name' => 'Contract Law', 'category_id' => 8],
            ['name' => 'Legal Research', 'category_id' => 8],
            ['name' => 'Intellectual Property Law', 'category_id' => 8],
            ['name' => 'Corporate Law', 'category_id' => 8],
            ['name' => 'Paralegal Services', 'category_id' => 8],

            // Engineering & Architecture
            ['name' => 'Civil Engineering', 'category_id' => 9],
            ['name' => 'Mechanical Engineering', 'category_id' => 9],
            ['name' => 'Architectural Design', 'category_id' => 9],
            ['name' => 'Electrical Engineering', 'category_id' => 9],
            ['name' => 'Structural Engineering', 'category_id' => 9],

            // Data Science & Analytics
            ['name' => 'Data Analysis', 'category_id' => 10],
            ['name' => 'Machine Learning', 'category_id' => 10],
            ['name' => 'Data Visualization', 'category_id' => 10],
            ['name' => 'Big Data', 'category_id' => 10],
            ['name' => 'Statistical Analysis', 'category_id' => 10],

            // Software Development
            ['name' => 'Java Development', 'category_id' => 11],
            ['name' => 'Python Development', 'category_id' => 11],
            ['name' => 'C++ Development', 'category_id' => 11],
            ['name' => 'Full Stack Development', 'category_id' => 11],
            ['name' => 'API Development', 'category_id' => 11],

            // Mobile Development
            ['name' => 'iOS Development', 'category_id' => 12],
            ['name' => 'Android Development', 'category_id' => 12],
            ['name' => 'React Native Development', 'category_id' => 12],
            ['name' => 'Flutter Development', 'category_id' => 12],
            ['name' => 'Mobile App Testing', 'category_id' => 12],

            // Product Management
            ['name' => 'Product Strategy', 'category_id' => 13],
            ['name' => 'Roadmap Planning', 'category_id' => 13],
            ['name' => 'User Research', 'category_id' => 13],
            ['name' => 'Product Lifecycle Management', 'category_id' => 13],
            ['name' => 'Stakeholder Management', 'category_id' => 13],

            // Game Development
            ['name' => 'Unity', 'category_id' => 14],
            ['name' => 'Unreal Engine', 'category_id' => 14],
            ['name' => '3D Animation', 'category_id' => 14],
            ['name' => 'Game Design', 'category_id' => 14],
            ['name' => 'Character Modeling', 'category_id' => 14],

            // Video & Animation
            ['name' => 'Video Editing', 'category_id' => 15],
            ['name' => '2D Animation', 'category_id' => 15],
            ['name' => '3D Animation', 'category_id' => 15],
            ['name' => 'Motion Graphics', 'category_id' => 15],
            ['name' => 'Video Production', 'category_id' => 15],

            // Music & Audio
            ['name' => 'Audio Editing', 'category_id' => 16],
            ['name' => 'Voice Acting', 'category_id' => 16],
            ['name' => 'Music Production', 'category_id' => 16],
            ['name' => 'Sound Design', 'category_id' => 16],
            ['name' => 'Podcast Editing', 'category_id' => 16],

            // Business Development
            ['name' => 'Business Strategy', 'category_id' => 17],
            ['name' => 'Partnership Development', 'category_id' => 17],
            ['name' => 'Sales Strategy', 'category_id' => 17],
            ['name' => 'Market Expansion', 'category_id' => 17],
            ['name' => 'Client Acquisition', 'category_id' => 17],

            // Human Resources
            ['name' => 'Recruitment', 'category_id' => 18],
            ['name' => 'Employee Relations', 'category_id' => 18],
            ['name' => 'Performance Management', 'category_id' => 18],
            ['name' => 'Training & Development', 'category_id' => 18],
            ['name' => 'Compensation & Benefits', 'category_id' => 18],

            // Project Management
            ['name' => 'Agile Methodology', 'category_id' => 19],
            ['name' => 'Risk Management', 'category_id' => 19],
            ['name' => 'Scrum', 'category_id' => 19],
            ['name' => 'Waterfall Methodology', 'category_id' => 19],
            ['name' => 'Project Scheduling', 'category_id' => 19],

            // Virtual Assistance
            ['name' => 'Data Management', 'category_id' => 20],
            ['name' => 'Calendar Management', 'category_id' => 20],
            ['name' => 'Travel Planning', 'category_id' => 20],
            ['name' => 'Document Preparation', 'category_id' => 20],
            ['name' => 'Email Correspondence', 'category_id' => 20],

             // Administrative Consulting (Category ID: 21)
             ['name' => 'Process Improvement', 'category_id' => 21],
             ['name' => 'Business Process Management', 'category_id' => 21],
             ['name' => 'Project Coordination', 'category_id' => 21],
 
             // Technical Writing (Category ID: 22)
             ['name' => 'Documentation', 'category_id' => 22],
             ['name' => 'User Manuals', 'category_id' => 22],
             ['name' => 'API Documentation', 'category_id' => 22],
 
             // Grant Writing (Category ID: 23)
             ['name' => 'Grant Proposal Writing', 'category_id' => 23],
             ['name' => 'Funding Research', 'category_id' => 23],
             ['name' => 'Nonprofit Development', 'category_id' => 23],
 
             // SEO & SEM (Category ID: 24)
             ['name' => 'Keyword Research', 'category_id' => 24],
             ['name' => 'Content Optimization', 'category_id' => 24],
             ['name' => 'Google Ads Management', 'category_id' => 24],
 
             // Market Research (Category ID: 25)
             ['name' => 'Survey Design', 'category_id' => 25],
             ['name' => 'Data Collection', 'category_id' => 25],
             ['name' => 'Competitive Analysis', 'category_id' => 25],
 
             // Data Entry (Category ID: 26)
             ['name' => 'Excel', 'category_id' => 26],
             ['name' => 'Data Cleaning', 'category_id' => 26],
             ['name' => 'Data Formatting', 'category_id' => 26],
 
             // E-commerce Development (Category ID: 27)
             ['name' => 'Shopify Development', 'category_id' => 27],
             ['name' => 'Magento Development', 'category_id' => 27],
             ['name' => 'Product Upload', 'category_id' => 27],
 
             // Finance & Accounting (Category ID: 28)
             ['name' => 'Financial Modeling', 'category_id' => 28],
             ['name' => 'Tax Preparation', 'category_id' => 28],
             ['name' => 'Bookkeeping', 'category_id' => 28],
 
             // Transcription (Category ID: 29)
             ['name' => 'Audio Transcription', 'category_id' => 29],
             ['name' => 'Legal Transcription', 'category_id' => 29],
             ['name' => 'Medical Transcription', 'category_id' => 29],
 
             // Customer Experience (Category ID: 30)
             ['name' => 'Customer Journey Mapping', 'category_id' => 30],
             ['name' => 'Customer Feedback Analysis', 'category_id' => 30],
             ['name' => 'Customer Service Training', 'category_id' => 30],
 
             // Career Coaching (Category ID: 31)
             ['name' => 'Resume Writing', 'category_id' => 31],
             ['name' => 'Interview Preparation', 'category_id' => 31],
             ['name' => 'Career Counseling', 'category_id' => 31],
 
             // Sales Consulting (Category ID: 32)
             ['name' => 'Sales Strategy', 'category_id' => 32],
             ['name' => 'Lead Conversion', 'category_id' => 32],
             ['name' => 'CRM Optimization', 'category_id' => 32],
 
             // Social Media Management (Category ID: 33)
             ['name' => 'Social Media Strategy', 'category_id' => 33],
             ['name' => 'Content Creation', 'category_id' => 33],
             ['name' => 'Influencer Marketing', 'category_id' => 33],
 
             // Illustration (Category ID: 34)
             ['name' => 'Digital Illustration', 'category_id' => 34],
             ['name' => 'Character Design', 'category_id' => 34],
             ['name' => 'Comic Art', 'category_id' => 34],
 
             // Photography (Category ID: 35)
             ['name' => 'Portrait Photography', 'category_id' => 35],
             ['name' => 'Event Photography', 'category_id' => 35],
             ['name' => 'Product Photography', 'category_id' => 35],
 
             // Voice Talent (Category ID: 36)
             ['name' => 'Voice Acting', 'category_id' => 36],
             ['name' => 'Narration', 'category_id' => 36],
             ['name' => 'Audiobook Recording', 'category_id' => 36],
 
             // Fashion Design (Category ID: 37)
             ['name' => 'Apparel Design', 'category_id' => 37],
             ['name' => 'Textile Design', 'category_id' => 37],
             ['name' => 'Fashion Illustration', 'category_id' => 37],
 
             // Interior Design (Category ID: 38)
             ['name' => 'Space Planning', 'category_id' => 38],
             ['name' => 'Lighting Design', 'category_id' => 38],
             ['name' => 'Furniture Selection', 'category_id' => 38],
 
             // Public Relations (Category ID: 39)
             ['name' => 'Media Relations', 'category_id' => 39],
             ['name' => 'Press Release Writing', 'category_id' => 39],
             ['name' => 'Crisis Communication', 'category_id' => 39],
 
             // Legal Research (Category ID: 40)
             ['name' => 'Case Law Research', 'category_id' => 40],
             ['name' => 'Legal Brief Writing', 'category_id' => 40],
             ['name' => 'Litigation Support', 'category_id' => 40],
        ];

        Skill::insert($skills);
    }
}
