<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;

class CourseUpdate extends Component
{
    public $id;
    public $title;
    public $description;

    public $course;

    public function render()
    {

        $this->title = $this->course->title;
        $this->description = $this->course->description;

        return view('admin/livewire.course-update');
    }

    public function updateCourse()
    {

        // validation logic
        $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // Find the course by ID
        $course = Course::find($this->course->id);

        if (!$course) {
            return 'Course not found';
        }

        // Update the course properties
        $course->title = $this->title;
        $course->description = $this->description;

        if ($course->isDirty()) {
            if ($course->save()) {
                return redirect()->route('topics.index', $course->id)->with('success', 'Course updated successfully!');
            } else {
                return redirect()->route('topics.index', $course->id)->with('error', 'Topic cannot be updated!');
            }
        } else {
            return redirect()->route('topics.index', $course->id)->with('info', 'No changes were made');
        }
    }
}
