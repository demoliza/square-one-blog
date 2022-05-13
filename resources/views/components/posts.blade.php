@props(['posts'])

@foreach ($posts as $post)
    <a href="#" {{ $attributes->merge(['class' => 'block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700']) }}>
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->title }}</h5>
    </a>
@endforeach