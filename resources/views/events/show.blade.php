<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            @if(session('info'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('info') }}</span>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">{{ $event->title }}</h1>
                            <p class="text-gray-500">Organized by {{ $event->organizer->name }}</p>
                        </div>
                        @if($isOrganizer)
                        <div class="flex space-x-2">
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-primary">Edit Event</a>
                            <a href="{{ route('events.attendance', $event->id) }}" class="btn btn-sm btn-secondary">Manage Attendance</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2">
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Description</h3>
                                <p class="text-gray-700 whitespace-pre-line">{{ $event->description }}</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <h3 class="text-lg font-semibold mb-2">Date & Time</h3>
                                    <p class="flex items-center text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $event->event_date_formatted }}
                                    </p>
                                    <p class="flex items-center text-gray-700 mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $event->time_range }}
                                    </p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold mb-2">Location</h3>
                                    <p class="flex items-center text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $event->location }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded border">
                            <h3 class="text-lg font-semibold mb-2">Event Status</h3>
                            <div class="mb-4">
                                @if($event->status == 'active')
                                <span class="badge bg-success">Active</span>
                                @elseif($event->status == 'canceled')
                                <span class="badge bg-danger">Canceled</span>
                                @else
                                <span class="badge bg-secondary">Completed</span>
                                @endif
                            </div>

                            <div class="mb-4">
                                <p class="text-gray-700 mb-1">
                                    Participants: {{ $event->participant_count }} /
                                    {{ $event->max_participants > 0 ? $event->max_participants : '' }}
                                </p>

                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    @if($event->max_participants > 0)
                                    <div class="bg-blue-600 h-2.5 rounded-full"
                                        style="width: {{ \min(100, ($event->participant_count / $event->max_participants) * 100) }}%">
                                    </div>
                                    @else
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 100%">
                                    </div>
                                    @endif
                                </div>
                            </div>


                            <div class="mb-4">
                                <p class="text-gray-700 mb-1">Registration Deadline:</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($event->registration_deadline)->format('F j, Y') }}</p>
                            </div>

                            @if(!$isOrganizer)
                            @if($isRegistered)
                            <form action="{{ route('events.unregister', $event->id) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="btn btn-warning w-full">Cancel Registration</button>
                            </form>
                            @elseif($event->status == 'active' && !\Carbon\Carbon::parse($event->registration_deadline)->isPast())
                            <form action="{{ route('events.register', $event->id) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="btn btn-primary w-full" {{ ($event->max_participants > 0 && $event->participant_count >= $event->max_participants) ? 'disabled' : '' }}>
                                    Register for this Event
                                </button>
                            </form>
                            @elseif($event->status == 'active' && \Carbon\Carbon::parse($event->registration_deadline)->isPast())
                            <div class="mt-4 text-center text-red-500">
                                Registration deadline has passed
                            </div>
                            @elseif($event->status == 'canceled')
                            <div class="mt-4 text-center text-red-500">
                                This event has been canceled
                            </div>
                            @elseif($event->status == 'completed')
                            <div class="mt-4 text-center text-gray-500">
                                This event has concluded
                            </div>
                            @endif
                            @endif
                        </div>
                    </div>

                    @if($isOrganizer)
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-4">Participants ({{ $event->participant_count }})</h3>

                        @if($event->participants->isEmpty())
                        <p class="text-gray-600">No participants registered yet.</p>
                        @else
                        <div class="overflow-x-auto">
                            <table class="table table-bordered table-hover w-full">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Registration Date</th>
                                        <th>Attendance Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($event->participants as $participant)
                                    <tr>
                                        <td>{{ $participant->user->name }}</td>
                                        <td>{{ $participant->user->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($participant->registration_date)->format('M d, Y h:i A') }}</td>
                                        <td>
                                            @if($participant->attendance_status == 'registered')
                                            <span class="badge bg-info">Registered</span>
                                            @elseif($participant->attendance_status == 'attended')
                                            <span class="badge bg-success">Attended</span>
                                            @else
                                            <span class="badge bg-danger">Absent</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            <div class="mt-4 text-right">
                <a href="{{ route('events.index') }}" class="btn btn-secondary">Back to Events</a>
                <a href="{{ route('events.my') }}" class="btn btn-primary">My Events</a>
            </div>
        </div>
    </div>
</x-app-layout>