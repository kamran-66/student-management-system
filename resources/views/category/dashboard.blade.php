<x-app-layout>


    <main class="p-6">
        <div class="max-w-7xl mx-auto">
            <div class=" flex justify-between items-center">
            <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Category Dashboard</h2>
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
                    <a href="{{ route('category.add') }}" 
   class="px-4 py-2 rounded-lg font-semibold bg-green-500 text-white hover:bg-green-600">
   Add Category
</a>
</div>

            <h3 class="text-2xl font-semibold text-gray-700 mb-4">All Category Data</h3>

            <div class="overflow-x-auto bg-white border border-gray-200 shadow-sm rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Name</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach ($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $category->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                            
                            <td >
<form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
    @csrf
    @method('POST')
    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-semibold transition">
        Delete
    </button>
     <a href="{{ route('category.edit', $category->id) }}" 
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