<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Announcement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <label>Title</label>
                        <input type="text" name="title" class="w-full p-2 border rounded" value="{{ $announcement->title }}">
                    </div>

                    <div>
                        <label>Category</label>
                        <input type="text" name="category" class="w-full p-2 border rounded" value="{{ $announcement->category }}">
                    </div>

                    <div>
                        <label>Publish Date</label>
                        <input type="date" name="publish_date" class="w-full p-2 border rounded" value="{{ $announcement->publish_date }}">
                    </div>

                    <div>
                        <label>Content</label>
                        <textarea name="content" class="w-full p-2 border rounded">{{ $announcement->content }}</textarea>
                    </div>

                    <div>
                        <label>Attachment</label>
                        <input type="file" name="attachment" class="w-full p-2 border rounded">
                    </div>

                    @if($announcement->attachment)
                        <div class="mt-2">
                            <p>Current Attachment: <a href="{{ Storage::url($announcement->attachment) }}" class="text-blue-500" download>Download</a></p>
                        </div>
                    @endif

                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
