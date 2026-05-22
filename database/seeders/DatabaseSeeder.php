<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@lms.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        Admin::create([
            'user_id' => $adminUser->id,
            'phone' => '+92-300-0000000',
            'address' => 'Admin Office, Building A',
            'bio' => 'System Administrator',
        ]);

        // Create Student Users
        for ($i = 1; $i <= 10; $i++) {
            $studentUser = User::create([
                'name' => "Student $i",
                'email' => "student$i@lms.com",
                'password' => Hash::make('password123'),
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $studentUser->id,
                'roll_number' => 'STD' . str_pad($studentUser->id, 6, '0', STR_PAD_LEFT),
                'phone' => "+92-300-000000" . $i,
                'address' => "Student Address $i",
                'date_of_birth' => now()->subYears(20 + $i % 5),
                'is_approved' => $i % 3 !== 0, // Some are pending approval
                'status' => $i % 4 === 0 ? 'blocked' : 'active',
                'total_fees' => 50000,
                'fees_paid' => $i % 2 === 0 ? 25000 : 0,
            ]);
        }

        // Create Categories
        $categories = [
            [
                'name' => 'Computer Science',
                'slug' => 'computer-science',
                'icon' => 'fas fa-laptop-code',
                'position' => 1,
            ],
            [
                'name' => 'Business Administration',
                'slug' => 'business-administration',
                'icon' => 'fas fa-briefcase',
                'position' => 2,
            ],
            [
                'name' => 'Engineering',
                'slug' => 'engineering',
                'icon' => 'fas fa-cog',
                'position' => 3,
            ],
            [
                'name' => 'Arts & Humanities',
                'slug' => 'arts-humanities',
                'icon' => 'fas fa-book',
                'position' => 4,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Create Courses
        $courseData = [
            [
                'category_id' => 1,
                'name' => 'Introduction to Python',
                'slug' => 'intro-python',
                'code' => 'CS101',
                'description' => 'Learn Python programming from scratch',
                'duration_hours' => 40,
                'credits' => 3,
                'fee' => 5000,
            ],
            [
                'category_id' => 1,
                'name' => 'Web Development with Laravel',
                'slug' => 'web-laravel',
                'code' => 'CS202',
                'description' => 'Build web applications using Laravel framework',
                'duration_hours' => 50,
                'credits' => 4,
                'fee' => 7000,
            ],
            [
                'category_id' => 1,
                'name' => 'Database Design & SQL',
                'slug' => 'database-sql',
                'code' => 'CS103',
                'description' => 'Master database design and SQL queries',
                'duration_hours' => 35,
                'credits' => 3,
                'fee' => 5500,
            ],
            [
                'category_id' => 2,
                'name' => 'Financial Accounting',
                'slug' => 'financial-accounting',
                'code' => 'BA101',
                'description' => 'Fundamentals of financial accounting',
                'duration_hours' => 45,
                'credits' => 3,
                'fee' => 4000,
            ],
            [
                'category_id' => 2,
                'name' => 'Business Management',
                'slug' => 'business-management',
                'code' => 'BA102',
                'description' => 'Principles of business management',
                'duration_hours' => 40,
                'credits' => 3,
                'fee' => 4500,
            ],
            [
                'category_id' => 3,
                'name' => 'Civil Engineering Fundamentals',
                'slug' => 'civil-eng',
                'code' => 'ENG101',
                'description' => 'Introduction to civil engineering',
                'duration_hours' => 50,
                'credits' => 4,
                'fee' => 6000,
            ],
        ];

        $admin = Admin::first();
        foreach ($courseData as $course) {
            Course::create(array_merge($course, ['created_by' => $admin->id]));
        }

        // Enroll students in courses
        $students = Student::all();
        $courses = Course::all();

        foreach ($students as $student) {
            $coursesToEnroll = $courses->random(rand(2, 4));
            foreach ($coursesToEnroll as $course) {
                $student->courses()->attach($course->id, [
                    'enrollment_status' => 'active',
                    'grade' => null,
                    'is_passed' => false,
                ]);
            }
        }
    }
}

