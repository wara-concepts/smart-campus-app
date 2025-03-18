<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Event') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container-fluid px-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('events.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700">Event Title:</label>
                        <input type="text" name="title" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Date:</label>
                        <input type="date" name="date" class="w-full border rounded p-2" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Add Event
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
