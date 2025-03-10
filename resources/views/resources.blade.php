<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Resources') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="container-fluid px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4">Book Campus Resource</h2>
                    <form>
                        <div class="form-group">
                            <label for="studentName">Student Name</label>
                            <input type="text" class="form-control" id="studentName" placeholder="{{Auth::User()->name}}" disabled="true">
                        </div>
                        <div class="form-group">
                            <label for="studentEmail">Email Address</label>
                            <input type="email" class="form-control" id="studentEmail" placeholder="{{Auth::User()->email}}" disabled="true">
                        </div>
                        <div class="form-group">
                            <label for="resourceSelect">Select Resource</label>
                            <select class="form-control" id="resourceSelect">
                                <option value="studyRoom" selected>Study Room A</option>
                                <option value="conferenceRoom">Conference Room B</option>
                                <option value="computerLab">Computer Lab</option>
                                <option value="gym">Campus Gym</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bookingDate">Booking Date</label>
                            <input type="date" class="form-control" id="bookingDate" value="2025-03-15">
                        </div>
                        <div class="form-group">
                            <label for="bookingTime">Booking Time</label>
                            <input type="time" class="form-control" id="bookingTime" value="10:00">
                        </div>
                        <button type="submit" class="btn btn-primary">Book Resource</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
