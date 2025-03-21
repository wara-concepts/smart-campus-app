<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container-fluid px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4">Edit Course</h2>

                    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="block font-bold">Course Name</label>
                            <input type="text" name="name" id="name" value="{{ $course->name }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="code" class="block font-bold">Course Code</label>
                            <input type="text" name="code" id="code" value="{{ $course->code }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="credits" class="block font-bold">Credits</label>
                            <input type="number" name="credits" id="credits" value="{{ $course->credits }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="block font-bold">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ $course->description }}</textarea>
                        </div>

                        <!-- Display Existing Materials -->
                        <div class="mb-3">
                            <label class="block font-bold">Existing Materials</label>
                            <ul>
                                @foreach($course->materials ?? [] as $material)
                                    <li>
                                        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank">
                                            {{ $material->title }}
                                        </a>
                                        <form action="{{ route('materials.destroy', ['id' => $material->id]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">[Delete]</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mb-3">
                            <label for="week_id" class="block font-bold">Select Week</label>
                            <select id="week_id" name="week_id" class="form-control">
                                <option value="">-- Select a Week --</option>
                                @for ($i = 1; $i <= 12; $i++) <!-- Assuming 12 weeks -->
                                    <option value="{{ $i }}">Week {{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="learning_outcome" class="block font-bold">Learning Outcome</label>
                            <input type="text" id="learning_outcome" name="learning_outcome" class="form-control" readonly>
                        </div>

                        <!-- Upload New Materials -->
                        <div class="mb-3">
                            <label class="block font-bold">Upload New Materials</label>
                            <input type="file" name="materials[]" class="form-control" multiple>
                        </div>

                        <button type="submit" class="btn btn-success">Update Course</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const weekSelect = document.getElementById("week_id");
        const learningOutcomeInput = document.getElementById("learning_outcome");

        if (weekSelect && learningOutcomeInput) { // Ensure elements exist
            weekSelect.addEventListener("change", function () {
                let selectedWeek = weekSelect.value;
                if (selectedWeek) {
                    learningOutcomeInput.value = `Learning Outcome for Week ${selectedWeek}`;
                } else {
                    learningOutcomeInput.value = "";
                }
            });
        }
    });
</script>
