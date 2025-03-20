<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $announcement->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Back Button -->
                <a href="{{ route('announcements') }}" class="bg-blue-500 text-white px-4 py-2 rounded inline-flex items-center">
                    ← Back
                </a>

                <div class="mt-6 border-l-4 border-blue-500 pl-4">
                    <!-- Notice Number and Publish Date -->
                    <div class="flex justify-between items-center">
                        <!-- <p class="text-gray-600"><strong>Notice No:</strong> #{{ $announcement->id }}</p> -->
                        <p class="text-gray-600"><strong>Publish Date:</strong> {{ date('d-m-Y', strtotime($announcement->publish_date)) }}</p>
                    </div>

                    <!-- Category -->
                    <p class="text-gray-600 mt-2"><strong>Category:</strong> <span class="text-blue-500">{{ $announcement->category }}</span></p>

                    <!-- Description -->
                    <p class="mt-4 text-gray-700"><strong>Description:</strong></p>
                    <p class="text-gray-700">{{ $announcement->content }}</p>

                  <!-- Attachment -->
                @if($announcement->attachment)
                    <div class="mt-4 flex items-center">
                        <p class="text-gray-600 mr-2"><strong>Attach:</strong></p>
                        <a href="{{ asset('storage/' . $announcement->attachment) }}" download class="text-blue-600 flex items-center">
                            <i class="fas fa-file-download fa-lg p-2 bg-gray-200 rounded-full hover:bg-gray-300 transition"></i>
                            <span class="ml-2">Download</span>
                        </a>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
