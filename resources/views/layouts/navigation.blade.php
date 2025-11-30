<nav x-data="{ open: false }" class="bg-white border-b border-gray-200"> 
    <!-- Primary Navigation Menu --> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
         <div class="flex justify-between h-16"> <div class="flex">
                <!-- Logo -->
                <div class="flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/college.png') }}" class="h-12" alt="College Logo">
                    </a>
                </div>

                <!-- Navigation Links -->
                
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex text-grey">
                
                <!-- Student Links -->
                   {{-- @if(Auth::user()->role === 'student')
                    <x-nav-link :href="route('students.studentdashboard')" :active="request()->routeIs('students')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @endif


                    <!-- Teacher Links -->
                    @if(Auth::user()->role === 'teacher')
                    <x-nav-link :href="route('teachers.teacherdashboard')" :active="request()->routeIs('teacher')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @endif --}}

                    <!-- Admin Links -->
               
                {{-- @if(Auth::user()->role === 'admin')
               
                <x-nav-link :href="route('admin.admindashboard')" :active="request()->routeIs('admindashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>


                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin')">
                        {{ __('Admin') }}
                    </x-nav-link>

                    
                    <x-nav-link :href="route('students.dashboard')" :active="request()->routeIs('students')">
                        {{ __('Students') }}
                    </x-nav-link>

                    
                    <x-nav-link :href="route('teachers.dashboard')" :active="request()->routeIs('teachers')">
                        {{ __('Teachers') }}
                    </x-nav-link>        

                    
                    <x-nav-link :href="route('sections.dashboard')" :active="request()->routeIs('section')">
                        {{ __('Sections') }}
                    </x-nav-link>


                    <x-nav-link :href="route('year.dashboard')" :active="request()->routeIs('year')">
                        {{ __('Batch Year') }}
                    </x-nav-link>

                     <x-nav-link :href="route('courses.dashboard')" :active="request()->routeIs('courses')">
                        {{ __('Courses') }}
                      </x-nav-link>

                       <x-nav-link :href="route('category.dashboard')" :active="request()->routeIs('categories')">
                        {{ __('Programs') }}
                    </x-nav-link>

                     @endif

                </div>
            </div> --}}

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-230">
               <x-dropdown align="right" width="48">

    <x-slot name="trigger">
     <button class="flex items-center space-x-2 px-3 py-2 text-sm font-medium rounded-md hover:bg-white/10 transition">
    <div>{{ Auth::user()->name }}</div>
    <div class="ms-2">

        <!-- Elegant dropdown icon -->
         <svg class="w-4 h-4 text-grey opacity-80" fill="none" stroke="currentColor"
            stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
             stroke-linejoin="round">
            <path d="M19 9l-7 7-7-7" />
        </svg>
    </div>
</button>

    </x-slot>

    <x-slot name="content">

         @php 
        $role = Auth::user()->role;
        $id   = Auth::id();
    @endphp

    {{-- Dynamic Edit Profile Route Based on Role --}}
    @if ($role === 'student')
        <x-dropdown-link :href="route('students.edit', $id)">
            Edit Profile
        </x-dropdown-link>

    @elseif ($role === 'teacher')
        <x-dropdown-link :href="route('teachers.edit', $id)">
            Edit Profile
        </x-dropdown-link>

    @elseif ($role === 'admin')
        <x-dropdown-link :href="route('admin.edit', $id)">
            Edit Profile
        </x-dropdown-link>
    @endif


        <x-dropdown-link :href="route('profile.edit')">
            {{ __('Change Password') }}
        </x-dropdown-link>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>

    </x-slot>
</x-dropdown>

            </div>

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

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
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
    </div>
</nav>
