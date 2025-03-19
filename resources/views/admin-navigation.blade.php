<x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
    {{ __('Dashboard') }}
</x-nav-link>
<x-nav-link :href="route('announcements')" :active="request()->routeIs('announcements')">
    {{ __('Announcements') }}
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
<!-- Resource Dropdown -->
<x-dropdown>
    <x-slot name="trigger">
        <x-nav-link :active="request()->routeIs('resource-reservation.*')">
            <button type="button" class="p-2">
                {{ __('Resource Reservation') }}<br>{{ __('...') }}
            </button>
        </x-nav-link>
    </x-slot>
    <x-slot name="content">
        <x-dropdown-link :href="route('resource-reservation.index')">
            {{ __('Reserve a Resource') }}
        </x-dropdown-link>
        <x-dropdown-link :href="route('resource-reservation.history')">
            {{ __('My Reservations') }}
        </x-dropdown-link>
    </x-slot>
</x-dropdown>
<!-- Events Dropdown -->
<x-dropdown>
    <x-slot name="trigger">
        <x-nav-link :active="request()->routeIs('register.student.form') || request()->routeIs('register.lecturer.form')">
            <button type="button" class="p-2">
                {{ __('Register') }}<br>{{ __('...') }}
            </button>
        </x-nav-link>
    </x-slot>
    <x-slot name="content">
        <x-dropdown-link :href="route('register.student.form')">
            {{ __('Student Registration') }}
        </x-dropdown-link>
        <x-dropdown-link :href="route('register.lecturer.form')">
            {{ __('Lecturer Registration') }}
        </x-dropdown-link>
    </x-slot>
</x-dropdown>
