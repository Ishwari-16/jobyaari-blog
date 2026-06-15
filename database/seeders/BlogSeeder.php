<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        $blogTitles = [
            '10 Essential Career Tips for 2024',
            'How to Ace Your Next Job Interview',
            'Resume Writing Mistakes to Avoid',
            'The Future of Remote Work',
            'Building Professional Networks That Matter',
            'Salary Negotiation Strategies That Work',
            'Top Skills Employers Are Looking For',
            'How to Stay Motivated During Job Search',
            'Creating a Winning LinkedIn Profile',
            'The Art of Following Up After Interviews',
            'Workplace Trends You Need to Know',
            'Balancing Work and Life Effectively',
            'How to Handle Rejection Gracefully',
            'The Importance of Soft Skills Today',
            'Career Change: When and How to Do It',
            'Mastering the Virtual Interview',
            'Building Your Personal Brand',
            'Networking Tips for Introverts',
            'How to Research Companies Before Applying',
            'The Power of Mentorship in Career Growth',
        ];

        $blogContents = [
            'In today\'s competitive job market, having the right career strategies can make all the difference. This comprehensive guide explores the most effective ways to advance your career, from continuous learning to building meaningful professional relationships. Learn how to identify growth opportunities and take proactive steps toward your career goals.',
            'Interview preparation is key to landing your dream job. This article covers everything from researching the company to practicing common interview questions. Discover techniques to showcase your skills and experience effectively, and learn how to make a lasting impression on hiring managers.',
            'Your resume is often the first impression you make on potential employers. Avoid these common mistakes that could cost you opportunities. We\'ll cover formatting errors, typos, and content issues that can hurt your chances, along with tips to create a polished, professional resume.',
            'Remote work has transformed the modern workplace. Explore the benefits and challenges of working from home, along with best practices for staying productive and maintaining work-life balance. Learn how to set up an effective home office and communicate effectively with remote teams.',
            'Professional networking is more than just collecting contacts. It\'s about building meaningful relationships that can advance your career. Discover strategies for networking both online and offline, and learn how to nurture professional connections over time.',
            'Negotiating salary can be intimidating, but it\'s an essential skill. This guide provides proven strategies for discussing compensation confidently. Learn how to research market rates, articulate your value, and negotiate terms that reflect your worth.',
            'Employers are looking for specific skills in today\'s job market. Stay competitive by developing these in-demand abilities. We\'ll cover both technical and soft skills that can set you apart from other candidates and help you succeed in your career.',
            'Job searching can be challenging and sometimes discouraging. This article offers practical advice for maintaining motivation throughout the process. Learn how to set realistic goals, celebrate small wins, and stay focused on your long-term career objectives.',
            'LinkedIn is a powerful tool for job seekers and professionals. Optimize your profile to attract opportunities and showcase your expertise. We\'ll cover profile optimization, networking strategies, and content creation tips to build your professional brand.',
            'Following up after an interview shows professionalism and interest. Learn the best practices for timing and content of follow-up communications. Discover how to reinforce your qualifications and keep yourself top of mind with hiring managers.',
        ];

        $blogImages = [
            'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&q=80', // Career Tips
            null,
            null,
            null,
            null,
            'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&q=80', // Salary Negotiation
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
        ];

        foreach ($blogTitles as $index => $title) {
            $category = $categories[$index % $categories->count()];
            $content = $blogContents[$index % count($blogContents)];
            $image = $blogImages[$index] ?? null;
            $slug = Str::slug($title);

            Blog::firstOrCreate(
                ['slug' => $slug],
                [
                    'title' => $title,
                    'slug' => $slug,
                    'short_description' => Str::limit($content, 150),
                    'content' => $content . ' ' . str_repeat('This comprehensive guide provides actionable insights and practical advice to help you succeed in your career journey. Whether you\'re just starting out or looking to advance to the next level, these strategies will help you achieve your professional goals. ', 3),
                    'category_id' => $category->id,
                    'image' => $image,
                    'published_at' => now()->subDays(rand(1, 60)),
                    'is_featured' => $index < 5,
                ]
            );
        }
    }
}
