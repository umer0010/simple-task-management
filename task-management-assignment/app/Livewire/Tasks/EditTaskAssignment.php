<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Task;
use App\Models\Tag;

class EditTaskAssignment extends Component
{
    public $show = false;
    public $task;
    public $title;
    public $description;
    public $selectedTags = [];
    public $isUpdating = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'selectedTags' => 'array',
    ];

    protected $listeners = [
        'open-edit-modal' => 'openModal',
        'close-edit-modal' => 'closeModal'
    ];

    public function mount($task)
    {
        $this->task = $task;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->selectedTags = $task->tags->pluck('id')->toArray();
    }

    public function openModal()
    {
        $this->show = true;
        $this->dispatch('edit-modal-opened');
    }

    public function closeModal()
    {
        $this->show = false;
        $this->isUpdating = false;
        $this->dispatch('edit-modal-closed');
    }

    public function updateTask()
    {
        $this->isUpdating = true;
        
        try {
            $this->validate();

            $this->task->update([
                'title' => $this->title,
                'description' => $this->description,
            ]);

            $this->task->tags()->sync($this->selectedTags);

            $this->dispatch('task-updated')->to(TaskListAssignment::class);
        } finally {
            $this->dispatch('close-edit-modal');
        }
    }

    public function render()
    {
        return view('livewire.tasks.edit-task-assignment', [
            'tags' => Tag::all(),
        ]);
    }
}