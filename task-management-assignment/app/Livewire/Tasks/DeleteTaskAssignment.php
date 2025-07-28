<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Task;

class DeleteTaskAssignment extends Component
{
    public $isOpen = false;
    public $taskId;
    public $taskTitle = '';
    public $isDeleting = false;
    public $show = false;

    protected $listeners = [
        'open-delete-modal' => 'openModal',
        'close-modal' => 'closeModal' // New listener
    ];

    public function openModal($taskId)
    {
        $this->resetState();
        
        if ($task = Task::find($taskId)) {
            $this->taskId = $task->id;
            $this->taskTitle = $task->title;
            $this->isOpen = true;
        }
    }

    public function resetState()
    {
        $this->isOpen = false;
        $this->taskId = null;
        $this->taskTitle = '';
        $this->isDeleting = false;
    }

    public function closeModal()
    {
        $this->resetState();
    }

    public function deleteTask()
    {
        $this->isDeleting = true;
        
        try {
            if ($task = Task::find($this->taskId)) {
                $task->delete();
                $this->dispatch('task-deleted')->to(TaskListAssignment::class);
            }
        } finally {
            $this->dispatch('close-modal'); // Dispatch event to Alpine
            $this->resetState();
        }
    }

    public function render()
    {
        return view('livewire.tasks.delete-task-assignment');
    }
}