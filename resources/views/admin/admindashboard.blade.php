<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900  text-xl text-gray-800 leading-tight">
                    {{ __("Welcome,You're logged in  $user->name!") }}
                </div>
            </div>
     

        <div class="bg-white shadow rounded-lg p-6 mt-6">
            

            <h3 class="text-xl mb-4 text-gray-500">Personal Information</h3>

         
                <!-- Profile + Info -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                <!-- Profile Card -->
                <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col items-center">
                  

                    <h3 class="text-xl font-bold mt-20">{{ $user->name }}</h3>
                    <p class="text-gray-600 text-sm">{{ $user->email }}</p>

                    <a href="{{ route('admin.edit', $user->id) }}"
                       class="mt-4 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
                       Edit Profile
                    </a>
                </div>


{{-- <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6"> --}}
    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">


    <!-- Students -->
     <div class="card-custom p-6  shadow-lg flex items-center gap-4">
        <div class="p-4 rounded-full bg-indigo-100 text-indigo-600">
            <i class="fas fa-user-graduate text-2xl"></i>
        </div>
        <div>
            <p class="text-muted text-sm">Total Students</p>
            <p class="text-3xl font-bold text-gray-900">{{ $student }}</p>
        </div>
    </div>

    <!-- Teachers -->
    <div class="card-custom p-6 shadow-lg flex items-center gap-4">
        <div class="p-4 rounded-full bg-green-100 text-green-600">
            <i class="fas fa-chalkboard-teacher text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Total Teachers</p>
            <p class="text-3xl font-bold">{{ $teacher }}</p>
        </div>
    </div>

    <!-- Courses -->
    <div class="card-custom p-6  shadow-lg flex items-center gap-4">
        <div class="p-4 rounded-full bg-red-100 text-purple-600">
            <i class="fas fa-book text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Total Courses</p>
            <p class="text-3xl font-bold">{{ $course }}</p>
        </div>
    </div>

    <!-- Sections -->
  <div class="card-custom p-6  shadow-lg flex items-center gap-4">
        <div class="p-4 rounded-full bg-orange-100 text-purple-600">
            <i class="fas fa-book text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Total Sections</p>
            <p class="text-3xl font-bold">{{ $section }}</p>
        </div>
    </div>

    <!-- Categories -->
    <div class="card-custom p-6  shadow-lg flex items-center gap-4">
        <div class="p-4 rounded-full bg-blue-100 text-purple-600">
            <i class="fas fa-book text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Total Categories</p>
            <p class="text-3xl font-bold">{{ $category }}</p>
        </div>
    </div>

    <!-- Academic Years -->
     <div class="card-custom p-6  shadow-lg flex items-center gap-4">
        <div class="p-4 rounded-full bg-purple-100 text-purple-600">
            <i class="fas fa-book text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Batch Year</p>
            <p class="text-3xl font-bold">{{ $academic }}</p>
        </div>
    </div>
</div>


       
</x-app-layout>


