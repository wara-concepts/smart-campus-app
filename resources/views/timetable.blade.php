<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Timetable') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container-fluid px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <!-- Display any success messages -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Table for displaying timetable -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Course</th>
                                    <th>Instructor</th>
                                    <th>Room</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timetables as $timetable)
                                    <tr>
                                        <td>{{ $timetable->day }}</td>
                                        <td>{{ $timetable->time }}</td>
                                        <td>{{ $timetable->course->name }}</td>
                                        <td>{{ $timetable->instructor }}</td>
                                        <td>{{ $timetable->room }}</td>
                                        <td>
                                            <a href="{{ route('timetable.edit', $timetable->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('timetable.destroy', $timetable->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <a href="{{ route('timetable.create') }}" class="btn btn-primary">Add New Timetable Entry</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
