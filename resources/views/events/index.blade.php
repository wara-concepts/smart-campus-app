<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event Management') }}
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

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Upcoming Events</h3>
                    <a href="{{ route('events.create') }}" class="btn btn-primary">Create New Event</a>
                </div>

                @if($upcomingEvents->isEmpty())
                    <p class="text-gray-600">No upcoming events scheduled.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($upcomingEvents as $event)
                            <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                <div class="bg-gray-50 px-4 py-2 border-b">
                                    <h4 class="font-semibold text-lg truncate">{{ $event->title }}</h4>
                                    <p class="text-sm text-gray-500">
                                        <span class="inline-block mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $event->event_date_formatted }}
                                        </span>
                                        <span class="inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $event->time_range }}
                                        </span>
                                    </p>
                                </div>
                                <div class="p-4">
                                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">{{ \Illuminate\Support\Str::limit($event->description, 120) }}</p>
                                    <p class="text-sm text-gray-500 mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $event->location }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-gray-500">
                                            {{ $event->participant_count }} / {{ $event->max_participants > 0 ? $event->max_participants : '∞' }} participants
                                        </span>
                                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-secondary">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Past Events</h3>

                @if($pastEvents->isEmpty())
                    <p class="text-gray-600">No past events.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="table table-bordered table-hover w-full">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pastEvents as $event)
                                    <tr>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->event_date_formatted }} ({{ $event->time_range }})</td>
                                        <td>{{ $event->location }}</td>
                                        <td>
                                            @if($event->status == 'active')
                                                <span class="badge bg-success">Active</span>
                                            @elseif($event->status == 'canceled')
                                                <span class="badge bg-danger">Canceled</span>
                                            @else
                                                <span class="badge bg-secondary">Completed</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-secondary">View</a>
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
</x-app-layout>
 
 <!-- The  index.blade.php  file is the main view file that displays the list of upcoming and past events. The view file is divided into two sections: upcoming events and past events. 
 The upcoming events section displays a list of upcoming events. If there are no upcoming events, a message is displayed indicating that there are no upcoming events. If there are upcoming events, the event details are displayed in a grid layout. Each event is displayed in a card-like layout with the event title, date, time, description, location, and the number of participants. 
 The past events section displays a list of past events in a table format. The table displays the event title, date, location, status, and actions. The status of the event is displayed as a badge with different colors based on the status of the event. 
 The view file also includes a link to create a new event. 
 Step 7: Create the Event Details View 
 Next, let’s create the event details view file that displays the details of a specific event. 
 Create a new file named  show.blade.php  inside the  resources/views/events  directory and add the following code: -->