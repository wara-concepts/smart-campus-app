<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('events.update', $event->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Event Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $event->title) }}" required>
                            @error('title')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="5" class="form-control" required>{{ old('description', $event->description) }}</textarea>
                            @error('description')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $event->location) }}" required>
                            @error('location')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="event_date" class="block text-sm font-medium text-gray-700">Event Date</label>
                                <input type="date" name="event_date" id="event_date" class="form-control" 
                                       value="{{ old('event_date', $event->event_date) }}" min="{{ date('Y-m-d') }}" required>
                                @error('event_date')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="registration_deadline" class="block text-sm font-medium text-gray-700">Registration Deadline</label>
                                <input type="date" name="registration_deadline" id="registration_deadline" class="form-control" 
                                       value="{{ old('registration_deadline', $event->registration_deadline) }}" min="{{ date('Y-m-d') }}">
                                <p class="text-xs text-gray-500 mt-1">Leave blank to use event date as deadline</p>
                                @error('registration_deadline')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                                <input type="time" name="start_time" id="start_time" class="form-control" 
                                       value="{{ old('start_time', date('H:i', strtotime($event->start_time))) }}" required>
                                @error('start_time')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                                <input type="time" name="end_time" id="end_time" class="form-control" 
                                       value="{{ old('end_time', date('H:i', strtotime($event->end_time))) }}" required>
                                @error('end_time')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="max_participants" class="block text-sm font-medium text-gray-700">Maximum Participants</label>
                            <input type="number" name="max_participants" id="max_participants" class="form-control w-full md:w-1/3" 
                                   value="{{ old('max_participants', $event->max_participants) }}" min="0" required>
                            <p class="text-xs text-gray-500 mt-1">Use 0 for unlimited participants</p>
                            @error('max_participants')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Event Status</label>
                            <select name="status" id="status" class="form-control w-full md:w-1/3" required>
                                <option value="active" {{ old('status', $event->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="canceled" {{ old('status', $event->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-secondary mr-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>