<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @include('layouts.logo-navigation')
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <!--CODE FROM NUWAN BRANCH -->


                    <!--Add Admin Navigation Links Here -->
                    @if(Auth::user()->usertype == 'admin')

                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Academics Dropdown -->
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-6 text-gray-800 hover:text-gray-800 focus:outline-none">
                                <span>Academics</span>
                                <svg class="ms-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>


                        <!-- Academics Dropdown -->
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-6 text-gray-800 hover:text-gray-800 focus:outline-none">
                                    <span>Academics</span>
                                    <svg class="ms-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('courses')">
                                    {{ __('My Courses') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('timetable')">
                                    {{ __('Timetable') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('results')">
                                    {{ __('Exam Results') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>

                        <x-nav-link :href="route('announcements')" :active="request()->routeIs('announcements')">
                            {{ __('Announcements') }}
                        </x-nav-link>


                        <x-nav-link :href="route('resource-reservation.index')" :active="request()->routeIs('resource-reservation.*')">
                            {{ __('Resource Reservation') }}
                        </x-nav-link>


                        <!-- Event Management Dropdown -->
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-6 text-gray-800 hover:text-gray-800 focus:outline-none">
                                    <span>Events</span>
                                    <svg class="ms-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('events.index')">
                                    {{ __('All Events') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('events.my')">
                                    {{ __('My Events') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('events.create')">
                                    {{ __('Create Event') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>


                        <!-- Resource Booking Page, Added by Nuski to Navigation Bar -->
                        <x-nav-link :href="route('resources')" :active="request()->routeIs('resources')">
                            {{ __('Campus Resources') }}
                        </x-nav-link>

                        <x-nav-link :href="route('register.student.form')" :active="request()->routeIs('register.student.form')">
                            {{ __('Register Students') }}
                        </x-nav-link>

                        <x-nav-link :href="route('register.lecturer.form')" :active="request()->routeIs('register.lecturer.form')">
                            {{ __('Register Lecturer') }}
                        </x-nav-link>

                        <!--Add Lecturer Navigation Links Here -->
                        @elseif(Auth::user()->usertype == 'lecturer')


                        <!--Add Student Navigation Links Here -->
                        @elseif(Auth::user()->usertype == 'student')

                        @endif



                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>Hello {{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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

                    <x-nav-link :href="route('announcements')" :active="request()->routeIs('announcements')">
                        {{ __('Announcements') }}
                    </x-nav-link>
                    <!-- Resource Booking Page, Added by Nuski to Navigation Bar -->
                    <x-nav-link :href="route('resources')" :active="request()->routeIs('resources')">
                        {{ __('Campus Resources') }}
                    </x-nav-link>

                    <x-nav-link :href="route('register.student.form')" :active="request()->routeIs('register.student.form')">
                        {{ __('Register Students') }}
                    </x-nav-link>

                    <x-nav-link :href="route('register.lecturer.form')" :active="request()->routeIs('register.lecturer.form')">
                        {{ __('Register Lecturer') }}
                    </x-nav-link>
                
                <!--Add Lecturer Navigation Links Here -->
                @elseif(Auth::user()->usertype == 'lecturer')


                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();

<!--CODE FROM NUWAN BRANCH END ASASASASASASAS -->



                    <!--Add Admin Navigation Links Here -->
                    @if (Auth::user()->usertype == 'admin')
                        @include('admin-navigation')
                        <!--Add Lecturer Navigation Links Here -->
                    @elseif(Auth::user()->usertype == 'lecturer')
                        @include('lecturer-navigation')
                        <!--Add Student Navigation Links Here -->
                    @elseif(Auth::user()->usertype == 'student')
                        @include('student-navigation')
                    @endif
                </div>
            </div>


            <!-- Right Section (Notifications + Profile) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <!-- Notifications -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>
                                <span>Hello</span>
                                <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
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
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <svg class="ml-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
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
                    <!--CODE FROM Nuski BRANCH -->
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                    <!--CODE FROM Nuski BRANCH -->
                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

            <!-- Settings Dropdown -->
            <div class="flex items-center ml-auto">
                @include('layouts.usersettings-navigation')

            </div>
        </div>
    </div>
    {{-- <!-- Hamburger -->
    <div class="-me-2 flex items-center sm:hidden">
        <button @click="open = ! open"
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    {{-- <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('resources')" :active="request()->routeIs('resources')">
                    {{ __('Campus Resources') }}
                </x-responsive-nav-link>
            </div>
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div> --}}
</nav>
