<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Assignment') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container-fluid px-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('assignments.update', $assignment->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700">Assignment Title:</label>
                        <input type="text" name="title" value="{{ $assignment->title }}" 
                               class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Course:</label>
                        <select name="course_id" class="w-full border rounded p-2" required>
                            <option value="" disabled>Select a Course</option> <!-- Ensure a course is selected -->
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $assignment->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Status:</label>
                        <select name="status" class="w-full border rounded p-2">
                            <option value="Pending" {{ $assignment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ $assignment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Deadline:</label>
                        <input type="date" name="deadline" value="{{ $assignment->deadline }}" 
                               class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Current Submission:</label>
                        @if($assignment->submission)
                            <a href="{{ asset('storage/' . $assignment->submission) }}" target="_blank" class="text-blue-500">
                                View Submission
                            </a>
                        @endif
                        <input type="file" name="submission" class="w-full border rounded p-2">
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
