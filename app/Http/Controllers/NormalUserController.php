<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NormalUserController extends Controller
{
    /**
     * Display Index Page
     */
    public function index()
    {
        $courses = auth()->user()->courses;
        $courseCompletionRatios = [];

        foreach ($courses as $course) {
            $courseCompletionRatios[$course->id] = $this->completionRatio($course);
        }

        return view('user/index', compact('courses', 'courseCompletionRatios'));
    }


    /**
     * Display Course Detail Page.
     */
    public function courseDetailPage(Course $course)
    {
        $topics = Topic::orderBy('created_at', 'asc')
            ->where('course_id', $course->id)->get();

        $courseCompletionRatios = [];

        $courseCompletionRatios[$course->id] = $this->completionRatio($course);

        return view('user/course_detail_user', compact('course', 'topics', 'courseCompletionRatios'));
    }

    /**
     * Display Topic Detail Page.
     */
    public function topicDetailPage(Topic $topic)
    {
        $user = auth()->user();
        return view('user/topic_detail_user', compact('topic', 'user'));
    }

    public function completedTopic(User $user)
    {
        // Get the value (either 'complete' or 'incomplete') from the request
        $value = request()->has('complete') ? 'complete' : 'incomplete';

        // Get the topic ID from the request
        $topicId = request('complete') ?? request('incomplete');

        // Validate that the value is either 'complete' or 'incomplete'
        if ($value === 'complete') {
            // Update the 'is_completed' column to 1
            $user->topics()->updateExistingPivot($topicId, ['is_completed' => 1]);
        } else {
            // Update the 'is_completed' column to 0
            $user->topics()->updateExistingPivot($topicId, ['is_completed' => 0]);
        }
        return redirect()->back()->with('success', 'Completion status updated.');
    }

    public function completionRatio(Course $course)
    {
        $course_topics = Topic::where('course_id', $course->id)->pluck('id')->toArray();
        $allTopicsCount = count($course_topics);

        $completedTopicsCount = User::find(Auth::user()->id)
            ->topics()
            ->where('is_completed', 1)
            ->whereIn('topic_id', $course_topics)
            ->count();

        // Check if there exists topic in the specified course
        if ($allTopicsCount != 0) {
            $completion = ($completedTopicsCount / $allTopicsCount) * 100;

            return (round($completion, 2));
        } else {
            return 'N/A';
        }
    }
}
