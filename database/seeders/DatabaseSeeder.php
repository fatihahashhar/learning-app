<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Create 2 user instances using the User factory.
        \App\Models\User::factory(2)->create();

        // Create 4 course instances using the Course factory.
        $courses = \App\Models\Course::factory(4)->create();

        foreach ($courses as $course) {
            // Create at least 2 Topic instances for each course.
            $topics = \App\Models\Topic::factory()->count(rand(2, 3))->create(['course_id' => $course->id]);

            // Create 2 CourseUser instances for each course and associate users and topics.
            for ($i = 0; $i < 2; $i++) {
                // Create a CourseUser instance for the current course.
                $courseUser = \App\Models\CourseUser::factory()->create(['course_id' => $course->id]);

                // Attach topics to the user associated with the CourseUser instance.
                $courseUser->user->topics()->attach($topics->pluck('id'), ['is_completed' => false]);
            }
        }

        // Seed additional data using the AdminSeeder.
        $this->call(AdminSeeder::class);
    }
}
