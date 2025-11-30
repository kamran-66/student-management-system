<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Teacher Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto px-6">

            
            <div class="bg-white text-black rounded-xl shadow-lg p-6 mt-6">
                <h3 class="text-2xl">
                    Welcome, {{ $teacher->name }}! 🎉
                </h3>
                <p class="opacity-90 mt-1">Here are your academic details.</p>
            </div>

        @if (session('success'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-transition 
        x-init="setTimeout(() => show = false, 3000)" 
        class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3"
    >
        {{ session('success') }}
    </div>
    @endif

            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">

                
                <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col items-center">
                    <img 
                        src="{{ $teacher->image ? asset('users/'.$teacher->image) : 'https://via.placeholder.com/100' }}"
                        class="w-38 h-28 rounded-full shadow border mt-8"
                    >

                    <h3 class="text-xl font-bold mt-4">{{ $teacher->name }}</h3>
                    <p class="text-gray-600 text-sm">{{ $teacher->email }}</p>

                    <a href="{{ route('teachers.edit', $teacher->id) }}"
                       class="mt-4 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow">
                       Edit Profile
                    </a>
                </div>

                
                <div class="lg:col-span-2 bg-white shadow-lg rounded-xl p-6 mb-8">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Student Information</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

         

                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-500 text-sm">Section</p>
                            <p class="font-semibold text-gray-800">{{ $teacher->section?->name. " - ". $teacher->section?->academicYear?->category?->name ?? 'No Data'}}</p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-500 text-sm">Batch Year</p>
                            <p class="font-semibold text-gray-800">
                                {{ $teacher->section?->academicYear?->name ?? 'N/A' }}
                            </p>
                        </div>

                        {{-- <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-500 text-sm">Programs</p>
                            <p class="font-semibold text-gray-800">
                                {{$teacher->section->academicYear->category->name ?? 'N/A' }}
                            </p>
                        </div> --}}

                    </div>

                    <!-- Courses -->
                    <div class="mt-6">
                        <h4 class="text-lg font-semibold text-gray-700 mb-2  ml-3">Courses</h4>
                        
                        <div class="flex flex-wrap gap-2">
                            @foreach ($teacher->section?->academicYear?->courses ?? [] as $course)
                                <span class="px-4 py-1 bg-green-600 text-white rounded-full shadow text-sm ml-2">
                                    {{ $course->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
