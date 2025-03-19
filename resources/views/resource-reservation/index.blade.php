<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resource Reservation') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container-fluid px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h2 class="mb-4 text-lg font-semibold">Book Campus Resource</h2>
                    <form action="{{ route('resource-reservation.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="studentName">Student Name</label>
                            <input type="text" class="form-control" id="studentName"
                                value="{{ Auth::user()->name }}" disabled>
                        </div>

                        <div class="form-group mb-3">
                            <label for="studentEmail">Email Address</label>
                            <input type="email" class="form-control" id="studentEmail"
                                value="{{ Auth::user()->email }}" disabled>
                        </div>

                        <div class="form-group mb-3">
                            <label for="department_id">Select Department</label>
                            <select class="form-control" id="department_id" name="department_id" required>
                                <option value="">-- Select Department --</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="resource_id">Select Resource</label>
                            <select class="form-control" id="resource_id" name="resource_id" required disabled>
                                <option value="">-- Select Department First --</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-3">
                                <label for="request_date">Request Date</label>
                                <input type="date" class="form-control" id="request_date" name="request_date" 
                                    min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="request_time">Request Time</label>
                                <input type="time" class="form-control" id="request_time" name="request_time" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-3">
                                <label for="handover_date">Handover Date</label>
                                <input type="date" class="form-control" id="handover_date" name="handover_date" 
                                    min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="handover_time">Handover Time</label>
                                <input type="time" class="form-control" id="handover_time" name="handover_time" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="qty">Quantity</label>
                            <input type="number" class="form-control" id="qty" name="qty" min="1" value="1" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="purpose">Purpose</label>
                            <textarea class="form-control" id="purpose" name="purpose" rows="3" required></textarea>
                        </div>

                        <div class="mb-4">
                            <button type="button" id="check-availability-btn" class="btn btn-secondary">Check Availability</button>
                            <div id="availability-result" class="mt-2"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">Book Resource</button>
                    </form>
                </div>
            </div>

            <!-- Active Reservations -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4 text-lg font-semibold">My Active Reservations</h2>
                    
                    @if($reservations->isEmpty())
                        <p>You don't have any active reservations.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Resource</th>
                                        <th>Department</th>
                                        <th>Request Time</th>
                                        <th>Handover Time</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $reservation)
                                        <tr>
                                            <td>{{ $reservation->resource->name }}</td>
                                            <td>{{ $reservation->resource->department->department }}</td>
                                            <td>{{ \Carbon\Carbon::parse($reservation->request_dateTime)->format('M d, Y h:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($reservation->handover_dateTime)->format('M d, Y h:i A') }}</td>
                                            <td>{{ $reservation->qty }}</td>
                                            <td>
                                                @if($reservation->status == 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif($reservation->status == 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif($reservation->status == 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($reservation->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($reservation->status == 'pending' || $reservation->status == 'approved')
                                                    <form action="{{ route('resource-reservation.cancel', $reservation->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to cancel this reservation?')">Cancel</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('resource-reservation.history') }}" class="btn btn-secondary">View Reservation History</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Department selection changes
            document.getElementById('department_id').addEventListener('change', function() {
                const departmentId = this.value;
                const resourceSelect = document.getElementById('resource_id');
                
                // Reset resource dropdown
                resourceSelect.innerHTML = '<option value="">-- Select Resource --</option>';
                resourceSelect.disabled = true;
                
                if (departmentId) {
                    // Fetch resources for the selected department
                    fetch(`{{ route('resource-reservation.resources-by-department') }}?department_id=${departmentId}`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Populate resource dropdown
                        data.forEach(resource => {
                            const option = document.createElement('option');
                            option.value = resource.id;
                            option.textContent = resource.name;
                            resourceSelect.appendChild(option);
                        });
                        resourceSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error fetching resources:', error);
                    });
                }
            });

            // Check availability button
            document.getElementById('check-availability-btn').addEventListener('click', function() {
                const resourceId = document.getElementById('resource_id').value;
                const requestDate = document.getElementById('request_date').value;
                const requestTime = document.getElementById('request_time').value;
                const handoverDate = document.getElementById('handover_date').value;
                const handoverTime = document.getElementById('handover_time').value;
                const qty = document.getElementById('qty').value;
                const resultDiv = document.getElementById('availability-result');
                
                // Validate form fields
                if (!resourceId || !requestDate || !requestTime || !handoverDate || !handoverTime || !qty) {
                    resultDiv.innerHTML = '<div class="alert alert-danger">Please fill out all fields first.</div>';
                    return;
                }
                
                // Show loading indicator
                resultDiv.innerHTML = '<div class="text-center">Checking availability...</div>';
                
                // Send request to check availability
                fetch('{{ route("resource-reservation.check-availability") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({
                        resource_id: resourceId,
                        request_date: requestDate,
                        request_time: requestTime,
                        handover_date: handoverDate,
                        handover_time: handoverTime,
                        qty: qty
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.available) {
                        resultDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                    } else {
                        resultDiv.innerHTML = `<div class="alert alert-danger">${data.message}. Available: ${data.availableQty}, Requested: ${data.requestedQty}</div>`;
                    }
                })
                .catch(error => {
                    console.error('Error checking availability:', error);
                    resultDiv.innerHTML = '<div class="alert alert-danger">Error checking availability. Please try again.</div>';
                });
            });
        });
    </script>
    @endsection
</x-app-layout>