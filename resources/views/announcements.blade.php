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

                <a href="{{ route('announcements.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded inline-block mb-4">Add New</a>
                @if($announcements->isEmpty())
                    <p class="mt-4 text-gray-600">No announcements available at the moment.</p>
                @else
                    <table class="min-w-full mt-4 border-collapse">
                        <thead>
                            <tr class="bg-blue-500 text-white">
                                <th class="px-4 py-2">Notice No</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Category</th>
                                <th class="px-4 py-2">Publish Date</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($announcements as $announcement)
                                <tr class="border-t">
                                    <td class="px-4 py-2">#{{ $announcement->id }}</td>
                                    <td class="px-4 py-2">{{ $announcement->title }}</td>
                                    <td class="px-4 py-2">{{ $announcement->category }}</td>
                                    <td class="px-4 py-2">{{ $announcement->publish_date }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('announcements.show', $announcement->id) }}" class="text-blue-500">View</a> |
                                        <a href="{{ route('announcements.edit', $announcement->id) }}" class="text-green-500">Edit</a> |
                                        <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                        
                                        @if($announcement->attachment)
                                            | <a href="{{ Storage::url($announcement->attachment) }}" class="text-indigo-500" download>Download</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
