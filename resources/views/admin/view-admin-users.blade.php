<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Users') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">First Name</th>
                            <th class="border border-gray-300 px-4 py-2">Last Name</th>
                            <th class="border border-gray-300 px-4 py-2">Email</th>
                            <th class="border border-gray-300 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($adminUsers as $user)
                            <tr class="text-center">
                                <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->first_name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->last_name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                <td class="border border-gray-300 px-4 py-2"><!-- Edit Button -->
                                    <form action="{{ route('adminusers.edit', $user->id) }}" method="GET" class="inline">
                                        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">
                                            Edit
                                        </button>
                                    </form>

                                    <!-- Delete Button with Confirmation -->
                                    <form action="{{ route('adminusers.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this)" class="bg-red-500 text-white px-3 py-1 rounded">
                                            Delete
                                        </button>
                                    </form></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(button) {
            if (confirm("Are you sure you want to delete this user?")) {
                button.closest('form').submit();
            }
        }
    </script>
</x-app-layout>
