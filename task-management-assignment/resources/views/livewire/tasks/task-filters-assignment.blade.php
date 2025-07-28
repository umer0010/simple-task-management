<!-- resources/views/livewire/tasks/task-filters-assignment.blade.php -->
<div class="mb-6 bg-gray-50 p-4 rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Search Input -->
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search" 
                id="search" 
                placeholder="Search tasks..."
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >
        </div>

        <!-- Status Filter -->
        <div>
            <label for="filter" class="block text-sm font-medium text-gray-700">Status</label>
            <select 
                wire:model.live="filter" 
                id="filter" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >
                <option value="all">All Tasks</option>
                <option value="completed">Completed</option>
                <option value="incomplete">Incomplete</option>
            </select>
        </div>

        <!-- Tags Filter -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Tags</label>
            <select 
                wire:model.live="selectedTags" 
                multiple
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >
                @foreach($allTags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Sort Options -->
        <div>
            <label for="sort" class="block text-sm font-medium text-gray-700">Sort By</label>
            <select 
                wire:model.live="sortField" 
                id="sort" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >
                <option value="created_at">Created Date</option>
                <option value="title">Title</option>
            </select>
        </div>
    </div>
</div>