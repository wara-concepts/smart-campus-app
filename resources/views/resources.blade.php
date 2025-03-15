<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Campus Resources') }}
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
                            <input type="text" class="form-control" id="studentName"
                                placeholder="{{ Auth::User()->name }}" disabled="true">
                        </div>
                        <div class="form-group">
                            <label for="studentEmail">Email Address</label>
                            <input type="email" class="form-control" id="studentEmail"
                                placeholder="{{ Auth::User()->email }}" disabled="true">
                        </div>

                        <div class="form-group">
                            <label for="departmentSelect">Select Department</label>
                            <select class="form-control" id="departmentSelect">
                                @if (isset($departments))
                                    @foreach ($departments as $department)
                                        <option value="{{ $department }}">{{ $department }}</option>
                                    @endforeach
                                @else
                                    <option value="exception" selected>Unable to get departments {{ $th }}
                                    </option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="resourceSelect">Select Resource</label>
                            <select class="form-control" id="resourceSelect">
                                @if (isset($resources))
                                    @foreach ($resources as $resource)
                                        <option value="{{ $resource }}">{{ $resource }}</option>
                                    @endforeach
                                @else
                                    <option value="exception" selected>Unable to get resources {{ $th }}
                                    </option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="bookingDate">Booking Date</label>
                            <input type="date" class="form-control" id="bookingDate" value="2025-03-15">
                        </div>
                        {{-- <div class="form-group">
                            <label for="bookingTime">Booking Time</label>
                            <input type="time" class="form-control" id="bookingTime" value="10:00">
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Check Availability</button>
                        <button type="submit" class="btn btn-secondary">Book Resource</button>
                    </form>
                </div>



                <div class="p-6 text-gray-900">
                    <h2 class="mb-4">Add New Resource</h2>
                    <form action="{{ route('resources.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="resourceName">Resource Name</label>
                            <input name="resourceName" class="form-control" id="resourceName" placeholder="Type the name of the resource">
                        </div>
                        <div class="form-group">
                            <label for="resourceQuantity">Resource Quantity</label>
                            <input name="resourceQuantity" type="number" class="form-control" id="resourceQuantity" placeholder="Type the quantity of the resource" min="1" max="10">
                        </div>
                        <div class="form-group">
                            <label for="departmentSelect">Select Department</label>
                            <select name="departmentSelect" class="form-control" id="departmentSelect">
                                @if (isset($departments))
                                    @foreach ($departments as $department)
                                        <option value="{{ $department }}">{{ $department }}</option>
                                    @endforeach
                                @else
                                    <option value="exception" selected>Unable to get departments {{ $th }}
                                    </option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add New Resource</button>
                    </form>
                </div>



            </div>
        </div>
    </div>
    </div>
</x-app-layout>
