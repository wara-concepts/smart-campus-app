<x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
    {{ __('Dashboard') }}
</x-nav-link>
<x-nav-link :href="route('announcements')" :active="request()->routeIs('announcements')">
    {{ __('Announcements') }}
</x-nav-link>
<x-nav-link :href="route('resources')" :active="request()->routeIs('resources')">
    {{ __('Campus Resources') }}
</x-nav-link>
<x-nav-link :href="route('register.student.form')" :active="request()->routeIs('register.student.form')">
    {{ __('Register Students') }}
</x-nav-link>
<x-nav-link :href="route('resource-reservation.index')" :active="request()->routeIs('resource-reservation.*')">
    {{ __('Resource Reservation') }}
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
<!-- Events Dropdown -->
<x-dropdown>
    <x-slot name="trigger">
        <x-nav-link :active="request()->routeIs('courses') || request()->routeIs('timetable')">
            <button type="button" class="p-2">
                {{ __('Events') }}<br>{{ __('...') }}
            </button>
        </x-nav-link>
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
