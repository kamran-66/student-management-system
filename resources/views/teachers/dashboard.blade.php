<x-app-layout>


    <main class="p-6">
        <div class="max-w-7xl mx-auto">
            <div class=" flex justify-between items-center">
            <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Teachers Dashboard</h2>
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
                    <a href="{{ route('teachers.add') }}" 
   class="px-4 py-2 rounded-lg font-semibold {{ request()->routeIs('admin.teacher') ?  : 'bg-green-500 text-white hover:bg-green-600' }}">
   Add Teacher
</a>
</div>

            <h3 class="text-2xl font-semibold text-gray-700 mb-4">All Teachers Data</h3>

            <div class="overflow-x-auto bg-white border border-gray-200 shadow-sm rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Name</th>
                        <th class="py-2 px-4 border-b text-left">Email</th>
                        <th class="py-2 px-4 border-b text-left">Section</th>
                        <th class="py-2 px-4 border-b text-left">Courses</th>
                        <th class="py-2 px-4 border-b text-left">Academic Year</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>

                <tbody>
                     @foreach ($teachers as $teacher)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $teacher->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $teacher->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $teacher->email }}</td>
                            <td class="py-2 px-4 border-b">{{ $teacher->section->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $teacher->section->academicYear->courses->count() }}</td>
                <td class="py-2 px-4 border-b">{{ $teacher->section?->academicYear?->name ?? 'No Data' }}</td>

                         @if(Auth::user()->role === 'admin' || Auth::id() === $teacher->id)
                <td class="py-2 px-4 border-b">
                    <div class="flex space-x-4">
                        <a href="{{ route('teachers.show', $teacher->id) }}" 
                           class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm font-semibold transition">
                            View
                        </a>
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">

                    <div class="flex space-x-4">
                        <a href="{{ route('teachers.edit', $teacher->id) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-semibold transition">
                            Edit
                        </a>
                
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-semibold transition">
                                        Delete
                                    </button>
</form>

                        @endif
                        </tr>

                        @endforeach
     
                </tbody>
            </table>
        </div>
    </main>
</div>


</x-app-layout>



