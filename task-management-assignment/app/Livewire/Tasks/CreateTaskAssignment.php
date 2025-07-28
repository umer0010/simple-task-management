<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class CreateTaskAssignment extends Component
{
    public $isOpen = false;
    public $title = '';
    public $description = '';
    public $selectedTags = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'selectedTags' => 'array',
    ];

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['title', 'description', 'selectedTags']);
    }

    public function createTask()
    {
        $this->validate();

        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
        ]);

        if (!empty($this->selectedTags)) {
            $task->tags()->attach($this->selectedTags);
        }

        $this->closeModal();
        $this->dispatch('task-created');
    }

    public function render()
    {
        $tags = Tag::all();
        return view('livewire.tasks.create-task-assignment', compact('tags'));
    }
}
