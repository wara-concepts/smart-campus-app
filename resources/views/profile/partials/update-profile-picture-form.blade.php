<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Picture') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Upload a new profile picture.') }}
        </p>
    </header>

    <form action="{{ route('profile.update.picture') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf

        <div>
            <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
            <input type="file" name="profile_picture" id="profile_picture" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
        </div>

        @if (Auth::user()->profile_picture)
            <div class="mt-4">
                <p class="text-sm text-gray-600">Current Profile Picture:</p>
                <img src="{{ asset(Storage::url('profile_pictures/' . Auth::user()->profile_picture)) }}" alt="Profile Picture" class="w-20 h-20 rounded-full border">
            </div>
        @endif

        <div class="flex items-center gap-4">
            <button type="submit"  class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 btn btn-primary" >
                Upload
            </button>
        </div>
    </form>
</section>
