<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Announcements') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900">Latest Announcements</h3>

                @if($announcements->isEmpty())
                    <p class="mt-4 text-gray-600">No announcements available at the moment.</p>
                @else
                    <div class="mt-4 space-y-4">
                        @foreach($announcements as $announcement)
                            <div class="border-b pb-4">
                                <h4 class="text-lg font-semibold text-gray-800">{{ $announcement->title }}</h4>
                                <p class="text-sm text-gray-500">Published on {{ $announcement->created_at->format('F j, Y') }}</p>
                                <p class="mt-2 text-gray-700">{{ $announcement->content }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
