<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container-fluid px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4">Available Courses</h2>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('courses') }}" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                   placeholder="Search by name or description"
                                   value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>

                    @if($courses->isEmpty())
                        <div class="alert alert-warning">No courses available.</div>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Course Name</th>
                                    <th>Course Code</th>
                                    <th>Credits</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <td>{{ $course->id }}</td>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->code }}</td>
                                        <td>{{ $course->credits }}</td>
                                        <td>{{ $course->description }}</td>
                                        <td>
                                            <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    <a href="{{ route('courses.create') }}" class="btn btn-primary">Add New Course</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
