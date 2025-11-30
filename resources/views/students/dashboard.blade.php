 <x-app-layout>


   <main class="p-6">
       <div class="max-w-7xl mx-auto">
            <div class=" flex justify-between items-center">

            <x-page-heading 
                heading="Students Dashboard" 
                subheading="Use the sidebar to navigate through your pages.">
                
            </x-page-heading>
            
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

          

<table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-lg mt-6">
    <thead class="bg-gray-100">
        <tr>
            <th class="py-2 px-4 border-b text-left">ID</th>
            {{-- <th class="py-2 px-4 border-b text-left">Image</th> --}}
            <th class="py-2 px-4 border-b text-left">Name</th>
            <th class="py-2 px-4 border-b text-left">Email</th>
            <th class="py-2 px-4 border-b text-left">Registration No</th>
            <th class="py-2 px-4 border-b text-left">Section</th>
            {{-- <th class="py-2 px-4 border-b text-left">Course</th> --}}
            {{-- <th class="py-2 px-4 border-b text-left">Batch Year</th> --}}
            <th class="py-2 px-4 border-b text-left">Actions</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($students as $student)
            <tr class="hover:bg-gray-50">
                
               <td class="py-2 px-4 border-b">
    <div class="flex items-center space-x-3">
        <span>{{ $student->id }}</span>

        @if($student?->image)
            <img 
                src="{{ asset('users/'.$student->image) }}" 
                class="w-10 h-10 rounded-full border border-gray-700 bg-gray-500 ml-3"
            >
        @endif
    </div>
</td>

            
                

                <td class="py-2 px-4 border-b">{{ $student->name }}</td>
                <td class="py-2 px-4 border-b">{{ $student->email }}</td>
                <td class="py-2 px-4 border-b">{{ $student->registration_no ?? 'No Data' }}</td>
                <td class="py-2 px-4 border-b">{{ $student->section?->name. " - ". $student->section->academicYear->category->name ?? 'No Data'}}</td>
                {{-- <td class="py-2 px-4 border-b">{{ $student->section?->academicYear?->courses->count() ?? 'No Data' }}</td> --}}
                {{-- <td class="py-2 px-4 border-b">{{ $student->section?->academicYear?->name ?? 'No Data' }}</td> --}}
                
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

 <div class="mt-4 flex justify-center">
    {{ $students->links() }}
</div>
</x-app-layout>
