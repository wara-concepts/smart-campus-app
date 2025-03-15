<div class="container">
    <h2 class="mb-4">Timetable</h2>

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
            @foreach($timetables as $timetable)
                <tr>
                    <td>{{ $timetable->day }}</td>
                    <td>{{ $timetable->time }}</td>
                    <td>{{ $timetable->course->name }}</td>
                    <td>{{ $timetable->instructor }}</td>
                    <td>{{ $timetable->room }}</td>
                    <td>
                        <a href="{{ route('timetable.edit', $timetable->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('timetable.destroy', $timetable->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('timetable.create') }}" class="btn btn-primary">Add New Timetable Entry</a>
</div>
