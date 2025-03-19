<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold mb-4">{{ $event->title }} - Attendance Management</h2>
                    
                    @if($event->participants->isEmpty())
                        <p class="text-gray-600">No participants have registered for this event yet.</p>
                    @else
                        <form action="{{ route('events.update-attendance', $event->id) }}" method="POST">
                            @csrf
                            
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
                                                    <select name="attendance[{{ $participant->id }}]" class="form-control">
                                                        <option value="registered" {{ $participant->attendance_status == 'registered' ? 'selected' : '' }}>Registered</option>
                                                        <option value="attended" {{ $participant->attendance_status == 'attended' ? 'selected' : '' }}>Attended</option>
                                                        <option value="absent" {{ $participant->attendance_status == 'absent' ? 'selected' : '' }}>Absent</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="flex justify-end mt-6">
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-secondary mr-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">Save Attendance</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>