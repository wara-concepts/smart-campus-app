<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto px-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Assignments Section -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">📌 Assignments</h3>
                    
                    <table class="w-full border-collapse border border-gray-200">
                        <thead class="bg-blue-100">
                            <tr class="text-left">
                                <th class="p-2 border">Title</th>
                                <th class="p-2 border">Course</th>
                                <th class="p-2 border">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($assignments as $assignment)
                                <tr class="border">
                                    <td class="p-2">{{ $assignment->title }}</td>
                                    <td class="p-2">{{ $assignment->course }}</td>
                                    <td class="p-2 font-semibold text-{{ $assignment->status == 'Pending' ? 'yellow-500' : 'green-500' }}">
                                        {{ ucfirst($assignment->status) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-4 text-center text-gray-500">No assignments available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="{{ route('assignments.create') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                        ➕ Add Assignment
                    </a>
                </div>

                <!-- Upcoming Events Section -->
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">📅 Upcoming Events</h3>
                    
                    <table class="w-full border-collapse border border-gray-200">
                        <thead class="bg-green-100">
                            <tr class="text-left">
                                <th class="p-2 border">Name</th>
                                <th class="p-2 border">Date</th>
                                <th class="p-2 border">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr class="border">
                                    <td class="p-2">{{ $event->name }}</td>
                                    <td class="p-2">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                                    <td class="p-2">{{ ucfirst($event->status) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-4 text-center text-gray-500">No upcoming events.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="{{ route('events.create') }}" class="mt-4 inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">
                        ➕ Add Event
                    </a>
                </div>
            </div>

            <!-- Calendar Section -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mt-6">
                <h3 class="text-lg font-semibold mb-4">🗓️ Event Calendar</h3>
                <div id="calendar"></div>
            </div>

        </div>
    </div>

    <!-- Include FullCalendar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: {!! json_encode($events->map(function($event) {
                    return [
                        'title' => $event->name,
                        'start' => $event->event_date,
                        'end' => $event->event_date,
                        'color' => '#007bff'
                    ];
                })) !!},
                eventClick: function(info) {
                    alert('Event: ' + info.event.title);
                }
            });
            calendar.render();
        });
    </script>

</x-app-layout>
