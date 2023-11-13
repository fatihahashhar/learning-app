<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;

class CourseCreate extends Component
{
    public $title;
    public $description;
    public $showModal = false;

    public function render()
    {
        return view('admin/livewire.course-create');
    }

    public function hideModal()
    {
        // This method is called when the "Cancel" button is clicked
        $this->emit('hideModal');
    }

    public function createCourse()
    {
        Course::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        // Reset the form fields
        $this->title = '';
        $this->description = '';

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }
}
