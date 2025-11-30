<x-app-layout>
    <div class="max-w-7xl mx-auto">
      

        <h2 class="text-3xl font-bold text-gray-800 mb-6 mt-5">Student Details</h2>

        <div class="bg-white shadow rounded-lg p-6">

            <h3 class="text-xl font-semibold mb-4 text-gray-700">Personal Information</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600 w-40">Image:</th>
                            {{-- <td class="px-4 py-2">{{ $student->image }}</td> --}}
                              <td class="py-2 px-4 border-b">
                    
                    @if($student?->image)
                        <img src="{{ asset('users/'.$student?->image) }}" class="w-10 h-10 rounded-full border border-gray-700 bg-gray-500">
                    @endif
                </td>
                        </tr>

                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600 w-40">Name:</th>
                            <td class="px-4 py-2">{{ $student->name }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">Email:</th>
                            <td class="px-4 py-2">{{ $student->email }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">Registration No:</th>
                            <td class="px-4 py-2">{{ $student->registration_no ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">Section:</th>
                            <td class="px-4 py-2">{{ $student->section?->name." - ". $student->section->academicYear->category->name ?? 'No Data' }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">Teacher:</th>
                            <td class="px-4 py-2"> {{ $student->section?->teacher->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">Batch Year:</th>
                            <td class="px-4 py-2">{{ $student->section?->academicYear?->name ?? 'No Data' }}</td>
                        </tr>

                         <tr>
                        <th class="px-4 py-2 text-left text-gray-600">Course:</th>
                        <td class="px-4 py-2">
                            <div class="space-x-2">
                              @foreach ($student->section->academicYear->courses as $course)
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
                <a href="{{ route('students.dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                    Back
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
