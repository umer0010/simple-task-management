<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Task Management</h1>
            <livewire:tasks.create-task-assignment />
        </div>
@if (session()->has('error'))
    <div class="mb-4 px-4 py-2 bg-red-100 border border-red-400 text-red-700 rounded">
        {{ session('error') }}
    </div>
@endif
@if (session()->has('success'))
    <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif
        <livewire:tasks.task-filters-assignment 
            :search="$search"
            :filter="$filter"
            :selectedTags="$selectedTags"
            :sortField="$sortField"
            :sortDirection="$sortDirection"
        />
        

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('title')">
                            Title
                            @if($sortField === 'title')
                                @if($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('created_at')">
                            Created
                            @if($sortField === 'created_at')
                                @if($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tags
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                       <th scope="col" class="px-6 py-3 mb-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
    Actions
</th>

<livewire:tasks.import-tasks-assignment />


                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tasks as $task)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $task->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ Str::limit($task->description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $task->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($task->tags as $tag)
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $task->is_completed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $task->is_completed ? 'Completed' : 'Incomplete' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                     <button wire:click="$dispatch('open-edit-modal', {task: {{ $task->id }}})" class="text-indigo-600 hover:text-indigo-900">
            Edit
        </button>
                                    <button 
    wire:click="$dispatch('open-delete-modal', { taskId: {{ $task->id }} })" 
    class="text-red-600 hover:text-red-900"
>
    Delete
</button>
                                    <button wire:click="toggleComplete({{ $task->id }})" class="text-gray-600 hover:text-gray-900">
                                        {{ $task->is_completed ? 'Mark Incomplete' : 'Mark Complete' }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>

  <!-- At the bottom of your view -->
@foreach($tasks as $task)
    <livewire:tasks.edit-task-assignment 
        :task="$task" 
        :key="'edit-task-'.$task->id"
    />
@endforeach


@foreach($tasks as $task)
    <livewire:tasks.delete-task-assignment 
        :task="$task"
        :key="'delete-task-'.$task->id"
    />
@endforeach

<livewire:tasks.delete-task-assignment />



</div>