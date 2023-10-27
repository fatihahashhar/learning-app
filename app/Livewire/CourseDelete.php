<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class CourseDelete extends Component
{
    public $id;
    public $title;
    public $description;

    public $course;

    public function render()
    {
        $this->title = $this->course->title;
        $this->description = $this->course->description;

        return view('admin/livewire.course-delete');
    }

    public function deleteCourse()
    {
        // validation logic
        $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $course = Course::find($this->course->id);

        if (!$course) {
            return 'Course not found';
        }

        $course->delete();
        
        // success message
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}
