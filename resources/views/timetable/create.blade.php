<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Timetable') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container-fluid px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4">Add New Timetable Entry</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('timetable.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="course_id">Select Course</label>
                            <select name="course_id" class="form-control" id="course_id">
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="day">Select Day</label>
                            <select name="day" class="form-control" id="day">
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="start_time">Start Time</label>
                            <input name="start_time" type="time" class="form-control" id="start_time" required>
                        </div>

                        <div class="form-group">
                            <label for="end_time">End Time</label>
                            <input name="end_time" type="time" class="form-control" id="end_time" required>
                        </div>

                        <div class="form-group">
                            <label for="instructor">Instructor</label>
                            <input name="instructor" type="text" class="form-control" id="instructor" required>
                        </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                            <input name="location" type="text" class="form-control" id="location" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Timetable</button>
                        <a href="{{ route('timetable') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
