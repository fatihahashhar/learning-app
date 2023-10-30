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
    public $id;
    public $title;
    public $contents;

    public function index(Course $course, Topic $topic)
    {
        $topics = Topic::orderBy('created_at', 'asc')
            ->where('course_id', $course->id)->get();

        return view('admin/topic/index', compact('course', 'topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPage(Course $course)
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
    public function updatePage(Course $course, Topic $topic)
    {
        $topic = Topic::findOrFail($topic->id);
        return view('admin.topic.update_topic', ['topic' => $topic, 'course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course, Topic $topic)
    {
        $topic = Topic::find($topic->id);

        $topic->title = $request->title;
        $topic->contents = $request->contents;

        if ($topic->isDirty()) {
            if ($topic->save()) {
                return redirect()->route('topics.read', ['course' => $course->id, 'topic' => $topic->id])->with('success', 'Topic updated successfully!');
            } else {
                return redirect()->route('topics.read', ['course' => $course->id, 'topic' => $topic->id])->with('error', 'Topic cannot be updated!');
            }
        } else {
            return redirect()->route('topics.read', ['course' => $course->id, 'topic' => $topic->id])->with('info', 'No changes were made');
        }   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
