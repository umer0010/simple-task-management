<div x-data="{
    showModal: false,
    init() {
        Livewire.on('open-edit-modal', () => {
            this.showModal = true;
        });
        
        Livewire.on('close-edit-modal', () => {
            this.showModal = false;
            this.$wire.closeModal();
        });
        
        // Watch Alpine state and sync with Livewire
        this.$watch('showModal', (value) => {
            this.$wire.show = value;
        });
    }
}" 
x-show="showModal"
x-transition>
    <!-- Modal Backdrop -->
    <div class="fixed inset-0 bg-black bg-opacity-50 z-40" 
         x-show="showModal" 
         @click="showModal = false; $wire.closeModal()"></div>
    
    <!-- Modal Content -->
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4" 
         x-show="showModal">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md" @click.stop
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
             
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900">Edit Task</h3>
                
                <div class="mt-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input wire:model="title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea wire:model="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tags</label>
                        <div class="mt-2 space-y-2">
                            @foreach($tags as $tag)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" wire:model="selectedTags" value="{{ $tag->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm">
                                    <span class="ml-2">{{ $tag->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button wire:click="updateTask" 
                        wire:loading.attr="disabled"
                        type="button" 
                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">
                    <span wire:loading.remove wire:target="updateTask">Save</span>
                    <span wire:loading wire:target="updateTask">
                        Saving...
                    </span>
                </button>
                <button @click="showModal = false; $wire.closeModal()" 
                        type="button" 
                        class="mt-3 inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>