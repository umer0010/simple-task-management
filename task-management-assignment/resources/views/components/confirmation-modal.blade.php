<!-- resources/views/components/confirmation-modal.blade.php -->
@props(['wireModel' => false])

<div x-data="{ show: @entangle($attributes->wire('model')) }"
     x-show="show"
     style="display: none"
     x-on:keydown.escape.window="show = false"
     class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50">
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div x-show="show" 
         class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg sm:mx-auto"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        <div class="px-6 py-4">
            <h3 class="text-lg font-medium text-gray-900">{{ $title }}</h3>
            <div class="mt-2">
                <p class="text-sm text-gray-600">{{ $content }}</p>
            </div>
        </div>
        <div class="px-6 py-4 bg-gray-50 text-right space-x-3">
            {{ $footer }}
        </div>
    </div>
</div>