<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white max-w-7xl mx-auto sm:px-6 lg:px-8 shadow-sm sm:rounded-lg">
            <div class="py-12 overflow-hidden bg-white border-b border-gray-200">
            <div class="relative">
                <div class="absolute left-0">
                    You're logged in!
                </div> 
                <div class="absolute right-0">
                    <a href="{{url("/posts");}}" type="button" class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"> View My Posts</a> 

                    <a href="{{url("/posts/create");}}" type="button" class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"> + Create Post</a> 
                </div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
