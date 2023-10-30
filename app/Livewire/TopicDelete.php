<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Topic;
use Livewire\Component;

class TopicDelete extends Component
{
    public $id;
    public $title;
    public $contents;

    public $topic;

    public function render()
    {
        $this->title = $this->topic->title;
        $this->contents = $this->topic->contents;

        return view('admin/livewire.topic-delete');
    }

    public function deleteTopic()
    {
        $topic = Topic::find($this->topic->id);

        if (!$topic) {
            return 'Topic not found';
        }

        $topic->delete();
        
        // success message
        return redirect()->route('courses.index')->with('success', 'Topic deleted successfully!');
    }
}
