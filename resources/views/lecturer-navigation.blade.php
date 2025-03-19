<x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
    {{ __('Dashboard') }}
</x-nav-link>
<x-nav-link :href="route('announcements')" :active="request()->routeIs('announcements')">
    {{ __('Announcements') }}
</x-nav-link>
<!-- Resource Booking Page, Added by Nuski to Navigation Bar -->
<x-nav-link :href="route('resources')" :active="request()->routeIs('resources')">
    {{ __('Campus Resources') }}
</x-nav-link>
<!-- Academics Dropdown -->
<x-dropdown>
    <x-slot name="trigger">
        <x-nav-link :active="request()->routeIs('courses') || request()->routeIs('timetable')">
            <button type="button" class="p-2">
                {{ __('Academics') }}<br>{{ __('...') }}
            </button>
        </x-nav-link>
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
