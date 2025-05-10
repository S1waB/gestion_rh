<!-- resources/views/components/sidebar-link.blade.php -->
@props(['active' => false, 'href' => '#'])

<a href="{{ $href }}" @class([
    'flex items-center space-x-2 px-4 py-2 rounded-md transition-colors',
    'bg-gray-900 text-white' => $active,
    'text-gray-300 hover:bg-gray-700 hover:text-white' => !$active,
])>
    {{ $slot }}
</a>