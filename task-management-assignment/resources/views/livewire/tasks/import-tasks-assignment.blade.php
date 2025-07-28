<div>
    <!-- Import Button -->
    <button wire:click="openModal" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        Import Tasks
    </button>

    <!-- Modal -->
    <div x-data="{ show: @entangle('showModal') }" x-show="show" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" @click="show = false">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                        Import Tasks from File
                    </h3>
                    
                    <div class="space-y-4">
                        @if($importStatus === 'completed')
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                Import completed successfully!
                            </div>
                        @elseif($importStatus === 'failed')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                @error('import') {{ $message }} @enderror
                            </div>
                        @else
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Select CSV/Excel File</label>
                                <input type="file" wire:model="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100">
                                @error('file') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            @if($importStatus === 'processing')
                                <div class="pt-2">
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                        <span>Importing...</span>
                                        <span>{{ $importProgress }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $importProgress }}%"></div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    @if($importStatus === 'completed' || $importStatus === 'failed')
                        <button wire:click="closeModal" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Close
                        </button>
                    @else
                        <button wire:click="closeModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                        <button wire:click="import" wire:loading.attr="disabled" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            <span wire:loading.remove wire:target="import">Import</span>
                            <span wire:loading wire:target="import">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Importing...
                            </span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>