<div class="container">
    <h2>Add Timetable Entry</h2>

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

        <div class="mb-3">
            <label for="day" class="form-label">Day</label>
            <select id="day" name="day" class="form-control">
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Time</label>
            <input type="text" id="time" name="time" class="form-control" placeholder="e.g., 10:00 AM - 11:30 AM" required>
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">Course</label>
            <select id="course_id" name="course_id" class="form-control">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="instructor" class="form-label">Instructor</label>
            <input type="text" id="instructor" name="instructor" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="room" class="form-label">Room</label>
            <input type="text" id="room" name="room" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Save Timetable</button>
        <a href="{{ route('timetable') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

