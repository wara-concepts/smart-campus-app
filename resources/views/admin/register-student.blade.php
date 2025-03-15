<form method="POST" action="{{ route('register.student') }}">
    @csrf

    <div>
        <label for="name">Full Name</label>
        <input id="name" type="text" name="name" required>
    </div>

    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required>
    </div>

    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
    </div>

    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <div>
        <label for="address">Address</label>
        <input id="address" type="text" name="address" required>
    </div>

    <div>
        <label for="dob">Date of Birth</label>
        <input id="dob" type="date" name="dob" required>
    </div>

    <div>
        <label for="course">Course</label>
        <input id="course" type="text" name="course" required>
    </div>

    <input type="hidden" name="role" value="student">

    <div>
        <button type="submit">Register Student</button>
    </div>
</form>
