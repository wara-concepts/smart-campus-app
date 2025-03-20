<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Announcement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label>Title</label>
                        <input type="text" name="title" class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label>Category</label>
                        <input type="text" name="category" class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label>Publish Date</label>
                        <input type="date" name="publish_date" class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label>Content</label>
                        <textarea name="content" class="w-full p-2 border rounded"></textarea>
                    </div>
                    <div>
                        <label>Attachment</label>
                        <input type="file" name="attachment" class="w-full p-2 border rounded">

                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
