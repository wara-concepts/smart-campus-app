<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservation History') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container-fluid px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">My Reservation History</h2>
                        <a href="{{ route('resource-reservation.index') }}" class="btn btn-primary">Back to Reservations</a>
                    </div>
                    
                    @if($reservations->isEmpty())
                        <p>You don't have any reservation history.</p>
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
                                        <th>Purpose</th>
                                        <th>Status</th>
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
                                            <td>{{ $reservation->purpose }}</td>
                                            <td>
                                                @if($reservation->status == 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif($reservation->status == 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif($reservation->status == 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @elseif($reservation->status == 'canceled')
                                                    <span class="badge bg-secondary">Canceled</span>
                                                @elseif($reservation->status == 'completed')
                                                    <span class="badge bg-info">Completed</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($reservation->status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>