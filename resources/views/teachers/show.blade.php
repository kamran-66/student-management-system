<x-app-layout>
    <div class="max-w-7xl mx-auto">
      

        <h2 class="text-3xl font-bold text-gray-800 mb-6 mt-5">Teachers Details</h2>

        <div class="bg-white shadow rounded-lg p-6">

            <h3 class="text-xl font-semibold mb-4 text-gray-700">Personal Information</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600 w-40">Image:</th>
                           
                              <td class="py-2 px-4 border-b">
                    
                    @if($teacher?->image)
                        <img src="{{ asset('users/'.$teacher?->image) }}" class="w-10 h-10 rounded-full border border-gray-700 bg-gray-500">
                    @endif
                </td>
                        </tr>

                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600 w-40">Name:</th>
                            <td class="px-4 py-2">{{ $teacher->name }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">Email:</th>
                            <td class="px-4 py-2">{{ $teacher->email }}</td>
                        </tr>
                       
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">Section:</th>
                            <td class="px-4 py-2">{{ $teacher->section->name  ?? 'No Data'}}</td></td>
                        </tr>
                        
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600">Course:</th>
                        <td class="px-4 py-2">
                            <div class="space-x-2">
                                @foreach ($teacher->section->academicYear->courses as $course)
                                    <span class="px-3 py-1 bg-green-500 text-white rounded-lg">{{$course->name}}</span>
                                @endforeach

                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            {{-- Back Button --}}
            <div class="mt-6">
                <a href="{{ route('teachers.dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                    Back
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
