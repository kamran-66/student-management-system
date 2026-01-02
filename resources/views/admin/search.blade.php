<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search Results
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if($search)
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Your search results for: "{{ $search }}"
            </h3>
        @endif
            
            <div class="mb-6">

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


         @if($users->count() > 0)

             <div class="overflow-x-auto bg-white border border-gray-200 shadow-sm rounded-lg mt-8">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Name</th>
                        <th class="py-2 px-4 border-b text-left">Email</th>
                        <th class="py-2 px-4 border-b text-left">Role</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->role }}</td>
                           <td> <form action="{{ route('admin.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">


                    @csrf
                    @method('POST')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-semibold transition">
                        Delete
                    </button>
                    <a href="{{ route('admin.edit', $user->id) }}" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-semibold transition">
                        Edit
                    </a>
                </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

                  <div class="mt-4 flex justify-center">
                    {{ $users->links() }}
                </div>
            </div>
        @else
            <p class="text-gray-500">No users found.</p>
        @endif

</div>

</x-app-layout>
