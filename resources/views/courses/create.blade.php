<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Course') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Add a New Course</h2>

                <!-- Course Creation Form -->
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf

                    <!-- Course Name -->
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-gray-700">Course Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-indigo-300">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Course Code -->
                    <div class="mb-4">
                        <label for="code" class="block font-medium text-gray-700">Course Code</label>
                        <input type="text" id="code" name="code" value="{{ old('code') }}" required
                            class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-indigo-300">
                        @error('code')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Course Credits -->
                    <div class="mb-4">
                        <label for="credits" class="block font-medium text-gray-700">Credits</label>
                        <input type="number" id="credits" name="credits" value="{{ old('credits') }}" required
                            class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-indigo-300">
                        @error('credits')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Course Description -->
                    <div class="mb-4">
                        <label for="description" class="block font-medium text-gray-700">Course Description</label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-indigo-300">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                            class="bg-blue-500 text-white font-semibold px-4 py-2 rounded hover:bg-blue-700 transition">
                            Create Course
                        </button>

                        <a href="{{ route('courses') }}"
                            class="bg-gray-500 text-white font-semibold px-4 py-2 rounded hover:bg-gray-700 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
