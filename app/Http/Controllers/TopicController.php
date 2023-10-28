<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        $topics = Topic::orderBy('created_at', 'asc')
            ->where('course_id', $course->id)->get();

        return view('admin/topic/index', compact('course', 'topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('admin/topic/create_topic', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request, Course $course)
    {        
        Topic::create([
            'title' => $request->title,
            'contents' => $request->contents,
            'course_id' => $course->id
        ]);

        // redirect
        return redirect()->route('topics.index', $course->id)->with('success', 'Topic created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function read(Course $course, Topic $topic)
    {
        return view('admin/topic/read_topic', compact('course', 'topic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updateTopic()
    {
        return view('admin/topic/update_topic');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
