<div x-data="{
    showModal: false,
    init() {
        // Sync with Livewire open state
        Livewire.on('open-delete-modal', () => {
            this.showModal = true;
        });
        
        // Handle close events
        Livewire.on('close-modal', () => {
            this.showModal = false;
            this.$wire.closeModal();
        });
        
        // Watch Alpine state and sync with Livewire
        this.$watch('showModal', (value) => {
            this.$wire.isOpen = value;
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
    <div class="fixed inset-0 flex items-center justify-center z-50" 
         x-show="showModal">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4" @click.stop>
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900">Delete Task</h3>
                
                <div class="mt-4">
                    @if($taskId)
                        <p>Are you sure you want to delete "{{ $taskTitle }}"?</p>
                        <p class="text-red-500 mt-2">This action cannot be undone.</p>
                    @else
                        <p>Task not found or already deleted.</p>
                    @endif
                </div>
            </div>
            
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button" 
                        wire:click="deleteTask"
                        wire:loading.attr="disabled"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">
                    <span wire:loading.remove wire:target="deleteTask">Delete</span>
                    <span wire:loading wire:target="deleteTask">
                        Deleting...
                    </span>
                </button>
                
                <button type="button" 
                        @click="showModal = false; $wire.closeModal()"
                        wire:loading.attr="disabled"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>