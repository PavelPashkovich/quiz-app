<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    Now you can <a href="{{ route('main.quizzes.index') }}" style="color: #2563eb">choose a quiz</a> to play or <a href="#" style="color: #2563eb">create a new</a> quiz!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
