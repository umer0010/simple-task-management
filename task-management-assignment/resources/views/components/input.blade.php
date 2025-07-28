<!-- resources/views/components/input.blade.php -->
@props([
    'type' => 'text',
    'name' => null,
    'id' => null,
    'value' => null,
])

<input 
    type="{{ $type }}"
    @if($name) name="{{ $name }}" @endif
    @if($id) id="{{ $id }}" @endif
    @if($value) value="{{ $value }}" @endif
    {{ $attributes->merge(['class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm']) }}
>