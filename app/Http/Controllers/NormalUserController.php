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
    public function index(Request $request)
    {
        $user = auth()->user();

        $keyword = $request->get('search');

        $allCourses = Course::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->paginate(10);

        $courseCompletionRatios = [];

        foreach ($allCourses as $course) {

            $courseCompletionRatios[$course->id] = $this->completionRatio($course);

            if (!empty($keyword)) {
                $courses = Course::where('title', 'LIKE', "%$keyword%")
                    ->orWhere('description', 'LIKE', "%$keyword%")
                    ->paginate(10);
            } else {
                $courses = $allCourses;
            }
        }

        return view('user/index', compact('courses', 'courseCompletionRatios'));
    }


    /**
     * Display Course Detail Page.
     */

    public function courseDetailPage(Course $course, Request $request)
    {
        $user = auth()->user();

        $keyword = $request->get('search');

        $courseCompletionRatios = [];
        $courseCompletionRatios[$course->id] = $this->completionRatio($course);

        // Retrieve the topic IDs based on the keyword or the course
        $query = Topic::where('course_id', $course->id);

        if (!empty($keyword)) {
            $query->where('title', 'LIKE', "%$keyword%");
        }

        $topics = $query->paginate(10);

        // Get the IDs of the topics
        $topicIds = $topics->pluck('id');

        // Get the completion status for each topic for the user
        $isCompleted = $user->topics()
            ->whereIn('topic_id', $topicIds)
            ->get()
            ->pluck('pivot.is_completed', 'pivot.topic_id');

        return view('user/course_detail_user', compact('course', 'topics', 'courseCompletionRatios', 'isCompleted'));
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
