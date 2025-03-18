<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

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

                        <x-slot name="content">
                            <x-dropdown-link :href="route('courses')">
                                {{ __('My Courses') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('timetable')">
                                {{ __('Timetable') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    <x-nav-link :href="route('announcements')" :active="request()->routeIs('announcements')">
                        {{ __('Announcements') }}
                    </x-nav-link>

                    <x-nav-link :href="route('resources')" :active="request()->routeIs('resources')">
                        {{ __('Campus Resources') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Section (Notifications + Profile) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <!-- Notifications -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="relative p-2 text-gray-600 hover:text-gray-800 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V10A6 6 0 006 10v4c0 .386-.149.747-.405 1.01L4 17h5m6 0a3 3 0 11-6 0"></path>
                            </svg>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-500 rounded-full"></span>
                            @endif
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-2">
                            <h3 class="text-sm font-semibold">Notifications</h3>
                        </div>
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <x-dropdown-link :href="'#'">
                                {{ $notification->data['message'] }}
                            </x-dropdown-link>
                        @empty
                            <p class="text-gray-500 text-center p-2">No new notifications</p>
                        @endforelse
                    </x-slot>
                </x-dropdown>

                <!-- Profile -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                            <div class="flex items-center">
                            <img class="h-8 w-8 rounded-full object-cover" 
                                src="{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}" alt="User Avatar">
                                <span class="ml-2">{{ Auth::user()->name}}</span>
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
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
