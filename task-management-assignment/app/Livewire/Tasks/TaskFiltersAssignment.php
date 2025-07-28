<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Tag;

class TaskFiltersAssignment extends Component
{
    public $search = '';
    public $filter = 'all';
    public $selectedTags = [];
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $allTags;

    protected $queryString = [
        'search' => ['except' => ''],
        'filter' => ['except' => 'all'],
        'selectedTags' => ['except' => []],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function mount()
    {
        $this->allTags = Tag::all();
    }

    public function updatedSearch()
    {
        $this->dispatch('update-search', search: $this->search);
    }

    public function updatedFilter()
    {
        $this->dispatch('update-filter', filter: $this->filter);
    }

    public function updatedSelectedTags()
    {
        $this->dispatch('update-selected-tags', selectedTags: $this->selectedTags);
    }

    public function updatedSortField()
    {
        $this->dispatch('update-sort-field', sortField: $this->sortField);
    }

    public function updatedSortDirection()
    {
        $this->dispatch('update-sort-direction', sortDirection: $this->sortDirection);
    }

    public function render()
    {
        return view('livewire.tasks.task-filters-assignment');
    }
}