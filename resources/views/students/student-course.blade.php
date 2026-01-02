<x-app-layout>
  <main class="p-6">
    <div class="max-w-7xl mx-auto">
      <div class="flex justify-between items-center">
        <x-page-heading heading="Course Students Dashboard" subheading="Use the sidebar to navigate through your pages." />
        
        @if (session('success'))
          <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
               class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3">
            {{ session('success') }}
          </div>
        @endif

        <a href="{{ route('students.add') }}" class="px-4 py-2 rounded-lg font-semibold bg-green-600 text-white hover:bg-green-700">
          Add Student
        </a>
      </div>


      <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-lg mt-6">
        <thead class="bg-gray-100">
          <tr>
            <th class="py-2 px-4 border-b text-left">ID</th>
            <th class="py-2 px-4 border-b text-left">Name</th>
            <th class="py-2 px-4 border-b text-left">Email</th>
            <th class="py-2 px-4 border-b text-left">Registration No</th>
            <th class="py-2 px-4 border-b text-left">Courses</th>
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
                    <img src="{{ asset('users/'.$student->image) }}" class="w-10 h-10 rounded-full border border-gray-700 bg-gray-500 ml-3">
                  @endif
                </div>
              </td>
              <td class="py-2 px-4 border-b">{{ $student->name }}</td>
              <td class="py-2 px-4 border-b">{{ $student->email }}</td>
              <td class="py-2 px-4 border-b">{{ $student->registration_no ?? 'No Data' }}</td>
              <td class="py-2 px-4 border-b">
                
                @foreach ($student->courses as $course)
                    {{ $course->name }}, 
                @endforeach
              </td>

              <td class="py-2 px-4 border-b">
                <div class="flex space-x-2">
                  <a href="{{ route('students.stview', $student->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm font-semibold">View</a>

                  <button type="button" onclick="openEditModal({{ $student->id }})"
                          class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-semibold">
                    Edit
                  </button>

                  <form action="{{ route('students.delete', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-semibold">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="mt-4 flex justify-center">
        {{ $students->links() }}
      </div>
    </div>
  </main>

  <!-- EDIT STUDENT MODAL (blur background, centered) -->
  <div id="editModal"
       class="fixed inset-0 backdrop-blur-sm bg-black/20 hidden justify-center items-center z-50">
    <div class="bg-white w-full max-w-xl p-6 rounded-lg shadow-lg mx-4">
      <div class="flex justify-between items-start mb-4">
        <h2 class="text-xl font-bold">Edit Student</h2>
        <button type="button" onclick="closeModal()" class="text-gray-600 hover:text-gray-900">✕</button>
      </div>

      <form action="{{ route('students.courseupdate', $student->id) }}" id="editForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="edit_id">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block mb-1 font-semibold">Profile Image</label>
            <input type="file" id="edit_image" name="image" class="w-full border p-2 rounded mb-2">
            <img id="currentImage" class="w-24 rounded mb-3 block">
          </div>

          <div>
            <label class="block mb-1 font-semibold">Name</label>
            <input type="text" id="edit_name" name="name" class="w-full border p-2 rounded mb-2" required>

            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" id="edit_email" name="email" class="w-full border p-2 rounded mb-2" required>

            {{-- <label class="block mb-1 font-semibold">Section</label>
            <select id="edit_section" name="section_id" class="w-full border p-2 rounded mb-2">
              <option value="">-- Select Section --</option>

            </select> --}}

              <label class="block mb-1 font-semibold">Courses</label>

                <select id="selectCourses" name="courses[]" multiple="multiple" style="width: 100%;">
            @foreach ($courses as $course)
        <option value="{{ $course->id }}">{{ $course->name }}</option>
            @endforeach
        </select>

              {{-- <div id="edit_courses" class="grid grid-cols-2 gap-2">
                @foreach ($courses as $course)
                  <label class="flex items-center gap-2">
                    <input type="checkbox" name="courses[]" value="{{ $course->id }}">
                    {{ $course->name }}
                  </label>
                @endforeach
              </div> --}}



        </div>

        <div class="flex justify-end mt-4">
          <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-400 text-white rounded mr-2">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
        </div>
      </form>
    </div>
  </div>


  <!-- JS: open modal, close modal, submit via AJAX -->

  <script>
    // expose functions globally
   window.openEditModal = function(id) {
  fetch(`/students/${id}/studentedit`, { credentials: 'same-origin' })
    .then(res => {
      if (!res.ok) throw new Error('Edit fetch failed: ' + res.status);
      return res.json();
    })
    
.then(data => {

    const student = data.student;               
    const selected = data.selectedCourses || [];

    document.getElementById('edit_id').value = student.id;
    document.getElementById('edit_name').value = student.name;
    document.getElementById('edit_email').value = student.email;

    document.getElementById('currentImage').src =
        student.image ? `/users/${student.image}` : 'https://via.placeholder.com/80';

    // Pre-select Select2 courses
    $('#selectCourses').val(selected).trigger('change');

    // Open modal
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
})

        .catch(err => {
          console.error('openEditModal error', err);
          alert('Could not load edit form. Check console for details.');
        });
    };

    window.closeModal = function() {
      const modal = document.getElementById('editModal');
      modal.classList.add('hidden'); modal.classList.remove('flex');
    };

    // attach submit handler after DOM loaded
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('editForm');
      if (!form) return console.error('editForm not found');

      console.log(form);
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        const id = document.getElementById('edit_id').value;
        if (!id) return alert('Missing student id');
        console.log(id);
        const fd = new FormData(form);
        fd.append('student_id', id); // Laravel expects this for PUT

        // fetch to the exact route you have in web.php
        const url = form.action;
        console.log('Submitting update to', form);

        fetch(url, {
    method: "POST",
    credentials: "same-origin",
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: fd,
      })
      .then(res => res.json())
      .then(data => {
          if (data.success) {
              closeModal();
              location.reload(); // reload UI
          } else {
              alert("Update failed — check console");
              console.error(data);
          }
      })
      .catch(err => {
          console.error(err);
          alert("Update request failed");
      });

      });
    });
  </script>

</x-app-layout>
