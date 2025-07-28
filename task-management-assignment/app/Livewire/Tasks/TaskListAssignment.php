<?php
namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Task;
use Livewire\WithPagination;
use App\Jobs\CompleteTaskJob;

class TaskListAssignment extends Component
{
    use WithPagination;

    public $search = '';
    public $filter = 'all';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $selectedTags = [];
    public $editingTaskId = null;
    public $confirmingDeletion = false;
    public $taskToDelete;

    protected $queryString = [
        'search' => ['except' => ''],
        'filter' => ['except' => 'all'],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'selectedTags' => ['except' => []],
    ];

    protected $listeners = [
        'task-created' => '$refresh',
        'task-updated' => '$refresh',
        'task-deleted' => '$refresh',
        'close-edit-modal' => 'closeEditModal',
'task-deleted' => 'handleTaskDeleted',
    ];

    public function editTask($taskId)
    {
        $this->editingTaskId = $taskId;
    }

    public function closeEditModal()
    {
        $this->editingTaskId = null;
    }

   public function confirmDelete($taskId)
{
    $this->taskToDelete = $taskId;
    $this->confirmingDeletion = true;
}


    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function toggleComplete($taskId)
    {
        $task = Task::find($taskId);
        
        if ($task->is_completed) {
            $task->update(['is_completed' => false, 'completed_at' => null]);
        } else {
            CompleteTaskJob::dispatch($task);
            $task->update(['is_completed' => true]);
        }
        
        $this->dispatch('task-updated');
    }

    public function render()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filter === 'completed', function ($query) {
                $query->where('is_completed', true);
            })
            ->when($this->filter === 'incomplete', function ($query) {
                $query->where('is_completed', false);
            })
            ->when($this->selectedTags, function ($query) {
                $query->whereHas('tags', function ($q) {
                    $q->whereIn('id', $this->selectedTags);
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.tasks.task-list-assignment', [
            'tasks' => $tasks,
        ]);
    }

   public function handleTaskDeleted()
{
   
    session()->flash('success', 'Task deleted successfully');
}
}