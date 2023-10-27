<?php

namespace App\Livewire;

use Livewire\Component;

class TopicDelete extends Component
{
    public $title;
    public $description;
    public $showModal = false;

    public function render()
    {
        return view('admin/livewire.topic-delete');
    }

    public function hideModal()
    {
        // This method is called when the "Cancel" button is clicked
        $this->emit('hideModal');
    }

    public function deleteTopic()
    {
        // validation logic
        $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        
        // Add code to delete the topic here

        // Topic::delete([
        //     'title' => $this->title,
        //     'description' => $this->description,
        // ]);

        // Close the modal
        $this->dispatchBrowserEvent('closeModal');

        // success message
        session()->flash('success', 'Topic deleted successfully');
    }
}
