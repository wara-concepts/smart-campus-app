<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Events I'm Organizing</h3>

                @if ($organizedEvents->isEmpty())
                    <p class="text-gray-600">You haven't created any events yet.</p>
                    <div class="mt-4">
                        <a href="{{ route('events.create') }}" class="btn btn-primary">Create New Event</a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="table table-bordered table-hover w-full">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Participants</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($organizedEvents as $event)
                                    <tr>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->event_date_formatted }}</td>
                                        <td>{{ $event->location }}</td>
                                        <td>{{ $event->participant_count }} /
                                            {{ $event->max_participants > 0 ? $event->max_participants : '∞' }}</td>
                                        <td>
                                            @if ($event->status == 'active')
                                                <span class="badge bg-success">Active</span>
                                            @elseif($event->status == 'canceled')
                                                <span class="badge bg-danger">Canceled</span>
                                            @else
                                                <span class="badge bg-secondary">Completed</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('events.show', $event->id) }}"
                                                    class="btn btn-sm btn-secondary">View</a>
                                                <a href="{{ route('events.attendance', $event->id) }}"
                                                    class="btn btn-sm btn-primary">Attendance</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Events I'm Attending</h3>

                @if ($participatedEvents->isEmpty())
                    <p class="text-gray-600">You haven't registered for any events yet.</p>
                    <div class="mt-4">
                        <a href="{{ route('events.index') }}" class="btn btn-secondary">Browse Events</a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="table table-bordered table-hover w-full">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Organizer</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($participatedEvents as $event)
                                    <tr>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->event_date_formatted }}</td>
                                        <td>{{ $event->location }}</td>
                                        <td>{{ $event->organizer->name }}</td>
                                        <td>
                                            @if ($event->status == 'active')
                                                <span class="badge bg-success">Active</span>
                                            @elseif($event->status == 'canceled')
                                                <span class="badge bg-danger">Canceled</span>
                                            @else
                                                <span class="badge bg-secondary">Completed</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('events.show', $event->id) }}"
                                                class="btn btn-sm btn-secondary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="mt-4 text-right">
                <a href="{{ route('events.index') }}" class="btn btn-primary">All Events</a>
            </div>
        </div>
    </div>
</x-app-layout>
