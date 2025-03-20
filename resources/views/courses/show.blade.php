<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materials for ' . ($course->name ?? 'N/A')) }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto px-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <!-- Course Name -->
                <h2 class="text-2xl font-bold text-gray-900">{{ $course->name ?? 'N/A' }}</h2>

                <!-- Week Information -->
                <div class="mt-4 p-4 bg-gray-100 shadow-md rounded-lg">
                    <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded">Week Information</span>
                    <h3 class="text-lg font-bold mt-2">Automatically Managed</h3>
                </div>

                <!-- Learning Outcomes Section -->
                <div class="mt-4 p-4 bg-gray-100 shadow-md rounded-lg">
                    <span class="bg-purple-600 text-white text-xs px-2 py-1 rounded">Learning Outcome</span>
                    <h3 class="text-lg font-bold mt-2">
                        {{ $course->learning_outcome ?? 'No learning outcome available' }}
                    </h3>
                </div>

                <!-- Course Materials -->
                <div class="mt-4 p-4 bg-gray-100 shadow-md rounded-lg">
                    <span class="bg-black text-white text-xs px-2 py-1 rounded">Core Learning Materials</span>

                    @if(isset($materials) && $materials->isNotEmpty())
                        <div class="mt-2">
                            @foreach($materials as $material)
                                <div class="flex items-center bg-gray-200 p-3 rounded-lg shadow my-2">
                                    <img src="{{ asset('icons/pdf-icon.png') }}" class="w-6 h-6 mr-2" alt="PDF">
                                    <a href="{{ asset('storage/materials/' . $material->filename) }}" 
                                       class="text-blue-600 hover:underline">
                                        {{ $material->filename }}
                                    </a>
                                    <span class="ml-auto text-green-500 text-lg">✔</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 mt-4">No materials available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
