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

    public function index(Course $course, Request $request)
    {
        $user = auth()->user();

        $keyword = $request->get('search');

        if ($request->has('action') && $request->input('action') === 'clear') {
            return redirect()->route('topics.index', [$course->id]);
        }

        if (!empty($keyword)) {
            $topics = Topic::where('title', 'LIKE', "%$keyword%")
                ->where('course_id', $course->id)
                ->orderBy('created_at', 'asc')
                ->paginate(10);
        } else {
            $topics = Topic::where('course_id', $course->id)
                ->paginate(10);
        }

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
        // Validation passed, create the new user
        $request->validate([
            'title' => 'required|string|max:255|unique:courses,title',
            'contents' => 'required|min:5',
        ]);

        // Check if the title already exists in the database
        $existingTitle = Topic::where('title', $request->title)->first();

        if ($existingTitle) {
            // Topic title already exists, return with an error message
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['title' => 'The title has already been taken.']);
        }

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
