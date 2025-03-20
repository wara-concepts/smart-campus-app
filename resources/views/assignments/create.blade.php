<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Assignment') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container-fluid px-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('assignments.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700">Assignment Title:</label>
                        <input type="text" name="title" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Course:</label>
                        <select name="course_id" class="w-full border rounded p-2" required>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Status:</label>
                        <select name="status" class="w-full border rounded p-2">
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Add Assignment
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
