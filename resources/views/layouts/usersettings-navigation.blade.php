<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button
            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
            <div>
                <span>Hello</span>
                <span>{{ Auth::user()->first_name }}
                    {{ Auth::user()->last_name }}</span>
                <span class="badge badge-pill badge-dark">
                    @if (Auth::user()->usertype == 'admin')
                        <p>Admin</p>
                    @elseif(Auth::user()->usertype == 'lecturer')
                        <p>Lecturer</p>
                    @elseif(Auth::user()->usertype == 'student')
                        <p>Student</p>
                    @endif
                </span>
            </div>
            <div class="ms-1">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </button>
    </x-slot>
    <x-slot name="content">
        <x-dropdown-link :href="route('profile.edit')">
            {{ __('Profile') }}
        </x-dropdown-link>
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
        <!--Add Admin Navigation Links Here -->
        @if (Auth::user()->usertype == 'admin')
            <x-dropdown-link :href="route('view.users')">
                {{ __('User Management') }}
            </x-dropdown-link>
            <x-dropdown-link :href="route('view.students')">
                {{ __('Student Management') }}
            </x-dropdown-link>
            <x-dropdown-link :href="route('view.lecturers')">
                {{ __('Lecturer Management') }}
            </x-dropdown-link>
            <!--Add Lecturer Navigation Links Here -->
        @elseif(Auth::user()->usertype == 'lecturer')
            <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>
            <!--Add Student Navigation Links Here -->
        @elseif(Auth::user()->usertype == 'student')
            <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>
        @endif
    </x-slot>
</x-dropdown>
