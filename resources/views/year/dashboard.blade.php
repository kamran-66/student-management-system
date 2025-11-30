<x-app-layout>


    <main class="p-6">
        <div class="max-w-7xl mx-auto">
            <div class=" flex justify-between items-center">
            {{-- <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Batch Year Dashboard</h2>
            <p class="text-gray-600 mb-6">Use the sidebar to navigate through your pages.</p>
            </div> --}}

                <x-page-heading
                heading="Welcome to Batch Year Dashboard"
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
                    <a href="{{ route('year.add') }}" 
   class="px-4 py-2 rounded-lg font-semibold bg-green-500 text-white hover:bg-green-600">
   Add Academic Year
</a>
</div>

            <div class="overflow-x-auto bg-white border border-gray-200 shadow-sm rounded-lg mt-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Batch Year</th>
                        <th class="py-2 px-4 border-b text-left">Program</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach ($batches as $class)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $class->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $class->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $class->category->name ??'No Data' }}</td>
                    
                            </td>

</td>
                            
                            <td >
<form action="{{ route('year.destroy', $class->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
    @csrf
    @method('POST')
    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-semibold transition">
        Delete
    </button>
     <a href="{{ route('year.edit', $class->id) }}" 
       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-semibold transition">
        Edit
    </a>
</form>


                        </tr>

                        @endforeach
     
                </tbody>
            </table>
        </div>
    </main>
</div>

</x-app-layout>