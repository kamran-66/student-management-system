 <x-app-layout>


   <main class="p-6">
       <div class="max-w-7xl mx-auto">
            <div class=" flex justify-between items-center">
            <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Students Dashboard</h2>
            <p class="text-gray-600 mb-6">Use the sidebar to navigate through your pages.</p>
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
                    <a href="{{ route('students.add') }}" 
   class="px-4 py-2 rounded-lg font-semibold {{ request()->routeIs('admin.teacher') ?  : 'bg-green-500 text-white hover:bg-green-600' }}">
   Add Student
</a>
</div>

            <h2 class="text-2xl font-semibold text-gray-700 mb-4">All Students Dashboard</h2>

          

<table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-lg">
    <thead class="bg-gray-100">
        <tr>
            <th class="py-2 px-4 border-b text-left">ID</th>
            <th class="py-2 px-4 border-b text-left">Name</th>
            <th class="py-2 px-4 border-b text-left">Email</th>
            <th class="py-2 px-4 border-b text-left">Registration_No</th>
            <th class="py-2 px-4 border-b text-left">Section</th>
            <th class="py-2 px-4 border-b text-left">Course</th>
            <th class="py-2 px-4 border-b text-left">Academic Year</th>
            <th class="py-2 px-4 border-b text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
            <tr class="hover:bg-gray-50">
                <td class="py-2 px-4 border-b">{{ $student->id }}</td>
                <td class="py-2 px-4 border-b">{{ $student->name }}</td>
                <td class="py-2 px-4 border-b">{{ $student->email }}</td>
                <td class="py-2 px-4 border-b">{{ $student->registration_no ?? 'No Data' }}</td>
                <td class="py-2 px-4 border-b">{{ $student->section?->name ?? 'No Data'}}</td>
                <td class="py-2 px-4 border-b">{{ $student->section->course->name ?? 'No Data' }}</td>
                <td class="py-2 px-4 border-b">{{ $student->section?->academicYear?->name ?? 'No Data' }}</td>
                
                 @if(Auth::user()->role === 'admin' || Auth::id() === $student->id)

                <td class="py-2 px-4 border-b">
                    
                    <div class="flex space-x-4">
                        <a href="{{ route('students.show', $student->id) }}" 
                           class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm font-semibold transition">
                            View
                        </a>

                    <div class="flex space-x-4">
                        <a href="{{ route('students.edit', $student->id) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-semibold transition">
                            Edit
                        </a>
                
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" 
                              onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('POST')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-semibold transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
</x-app-layout>
