<?php

namespace App\Livewire;

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
        // validation logic
        $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $topic = Topic::find($this->topic->id);

        if (!$topic) {
            return 'Topic not found';
        }

        $topic->delete();
        
        // success message
        return redirect()->route('topics.index')->with('success', 'Topic deleted successfully!');
    }
}
