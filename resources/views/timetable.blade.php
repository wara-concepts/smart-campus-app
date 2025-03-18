<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Timetable List') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container-fluid px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4">Timetable Entries</h2>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Day</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Instructor</th>
                                <th>Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($timetables as $timetable)
                                <tr>
                                    <td>{{ $timetable->course->name }}</td>
                                    <td>{{ $timetable->day }}</td>
                                    <td>{{ $timetable->start_time }}</td>
                                    <td>{{ $timetable->end_time }}</td>
                                    <td>{{ $timetable->instructor }}</td>
                                    <td>{{ $timetable->location }}</td>
                                    <td>
                                        <a href="{{ route('timetable.edit', $timetable->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('timetable.destroy', $timetable->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('timetable.create') }}" class="btn btn-primary mt-3">Add Timetable</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
