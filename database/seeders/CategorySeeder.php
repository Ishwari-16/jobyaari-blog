<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Career Tips',
                'slug' => 'career-tips',
                'description' => 'Expert advice and tips to advance your career and achieve professional success.',
            ],
            [
                'name' => 'Job Search',
                'slug' => 'job-search',
                'description' => 'Strategies and resources to help you find your dream job effectively.',
            ],
            [
                'name' => 'Interview Prep',
                'slug' => 'interview-prep',
                'description' => 'Comprehensive guides to ace your interviews and land the job.',
            ],
            [
                'name' => 'Resume Building',
                'slug' => 'resume-building',
                'description' => 'Tips and templates to create a standout resume that gets noticed.',
            ],
            [
                'name' => 'Workplace Culture',
                'slug' => 'workplace-culture',
                'description' => 'Insights into modern workplace dynamics and how to thrive in any environment.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
