<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register Student') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container-fluid px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('register.student') }}">
                        @csrf
                        <!-- Frist Name -->
                        <div class="mt-4">
                            <x-input-label for="fname" :value="__('First Name')" />
                            <x-text-input id="fname" class="block mt-1 w-full" type="text" name="fname"
                                :value="old('fname')" required autofocus autocomplete="fname" />
                            <x-input-error :messages="$errors->get('fname')" class="mt-2" />
                        </div>

                        <!-- Last Name -->
                        <div class="mt-4">
                            <x-input-label for="lname" :value="__('Last Name')" />
                            <x-text-input id="lname" class="block mt-1 w-full" type="text" name="lname"
                                :value="old(';lname')" required autofocus autocomplete="lname" />
                            <x-input-error :messages="$errors->get('lname')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <p>Other Details</p>
                        </div>
                        <hr class="my-1">

                        <!-- Full Name -->
                        <div class="mt-4">
                            <x-input-label for="fullname" :value="__('Full Name')" />
                            <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname"
                                :value="old(';fullname')" required autofocus autocomplete="fulllname" />
                            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div class="mt-4">
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                :value="old(';address')" required autofocus autocomplete="address" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- NIC -->
                        <div class="mt-4">
                            <x-input-label for="nic" :value="__('NIC Number')" />
                            <x-text-input id="nic" class="block mt-1 w-full" type="text" name="nic"
                                :value="old(';nic')" required autofocus autocomplete="nic" />
                            <x-input-error :messages="$errors->get('nic')" class="mt-2" />
                        </div>

                        <!-- DOB -->
                        <div class="mt-4">
                            <x-input-label for="dob" :value="__('Date of Birth')" />
                            <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob"
                                :value="old(';dob')" required autofocus autocomplete="dob" />
                            <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('Phone Number')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone"
                                :value="old('phone')" required pattern="[0-9]+" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>



                        <div class="mt-4">
                            <x-input-label for="course" :value="__('Select Course')" />
                            <select id="course" name="course" class="block mt-1 w-full" required>
                                <option value="">-- Select a Course --</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('course')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-start mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Register Student') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
