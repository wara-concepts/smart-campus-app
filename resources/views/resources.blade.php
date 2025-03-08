@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Hi {{Auth::user()->name}}, You can use this page to Book Resources</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container">
                        <div class="booking-form mx-auto">
                            <h2 class="mb-4 text-center">Resource Booking Form</h2>
                            <form>
                                <div class="mb-4 form-group">
                                    <label for="studentName">Student Name</label>
                                    <input type="text" disabled="true" class="form-control" id="studentName" placeholder="{{Auth::user()->name}}" required>
                                </div>
                                <div class="mb-4 form-group">
                                    <label for="studentEmail">Student Email</label>
                                    <input type="email" disabled="true" class="form-control" id="studentEmail" placeholder="{{Auth::user()->email}}" required>
                                </div>
                                <div class="mb-4 form-group">
                                    <label for="resourceType">Resource Type</label>
                                    <select class="form-control" id="resourceType" required>
                                        <option value="" disabled selected>Select a resource</option>
                                        <option value="meeting_room">Meeting Room</option>
                                        <option value="projector">Projector</option>
                                        <option value="microphone">Microphone</option>
                                        <option value="convention_hall">Convention Hall</option>
                                        <option value="laptop">Laptop</option>
                                        <option value="tablet">Tablet</option>
                                        <option value="smart_screen">Smart Screen</option>
                                    </select>
                                </div>
                                <div class="mb-4 form-group">
                                    <label for="bookingDate">Booking Date</label>
                                    <input type="date" class="form-control" id="bookingDate" required>
                                    <small class="form-text text-muted">Bookings can be made for a minimum of 1 day and a maximum of 2 days within a 7-day span, including weekends.</small>
                                </div>
                                <button type="submit" class="mb-4 btn btn-primary btn-block">Submit Booking</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection