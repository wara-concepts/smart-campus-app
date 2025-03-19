<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Lecturer') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('lecturer.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700">First Name</label>
                        <input type="text" name="first_name" value="{{ $user->first_name }}" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Last Name</label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Address</label>
                        <input type="text" name="address" value="{{ $user->lecturer->address }}" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Full Name</label>
                        <input type="text" name="full_name" value="{{ $user->lecturer->full_name }}" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">NIC</label>
                        <input type="text" name="nic" value="{{ $user->lecturer->nic }}" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ $user->lecturer->phone_number }}" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">DOB</label>
                        <input type="date" name="dob" value="{{ $user->lecturer->dob }}" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="mt-4">
                        <x-input-label for="course" :value="__('Select Course')" />
                            <select id="department_id" name="department_id" class="block mt-1 w-full" required>
                                <option value="">-- Select a Course --</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ $user->lecturer->department_id == $department->id ? 'selected' : '' }}  >{{ $course->course }}</option>
                                    @endforeach
                            </select>
                    </div>

                    <div class="flex items-center justify-start mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Edit Lecturer') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
