<!-- resources/views/components/textarea.blade.php -->
@props([
    'name' => null,
    'id' => null,
    'rows' => 3,
    'placeholder' => null
])

<textarea
    @if($name) name="{{ $name }}" @endif
    @if($id) id="{{ $id }}" @endif
    rows="{{ $rows }}"
    @if($placeholder) placeholder="{{ $placeholder }}" @endif
    {{ $attributes->merge(['class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm']) }}
>{{ $slot }}</textarea>