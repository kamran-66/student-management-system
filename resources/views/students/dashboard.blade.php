<x-app-layout>
  <main class="p-6">
    <div class="max-w-7xl mx-auto">
      <div class="flex justify-between items-center">
        <x-page-heading heading="Students Dashboard" subheading="Use the sidebar to navigate through your pages." />
        
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

 
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">

@foreach ($students as $student)
  <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5">

    <!-- Image (TOP CENTER like teacher) -->
    <div class="flex justify-center">
      @if($student?->image)
        <img
          src="{{ asset('users/'.$student->image) }}"
          class="w-24 h-24 rounded-full object-cover shadow-sm"
        >
      @else
        <div class="w-24 h-24 rounded-full bg-indigo-600 text-white flex items-center justify-center text-3xl font-bold shadow-sm">
          {{ strtoupper(substr($student->name, 0, 1)) }}
        </div>
      @endif
    </div>

    <!-- Info (CENTER aligned like teacher) -->
    <div class="text-center mt-4">
      <h3 class="text-lg font-semibold text-gray-800">
        {{ $student->name }}
      </h3>

      <p class="text-sm text-gray-500">
        {{ $student->email }}
      </p>

      <p class="text-sm mt-2">
        <span class="font-medium">Reg #:</span>
        {{ $student->registration_no ?? 'N/A' }}
      </p>

      <p class="text-sm">
        <span class="font-medium">Section:</span>
        {{ $student->section?->name ?? 'N/A' }}
      </p>
    </div>

    <!-- Actions (CENTER like teacher) -->
    <div class="mt-4 flex justify-center gap-2">

      <a href="{{ route('students.show', $student->id) }}"
         class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600">
        View
      </a>

      <button onclick="openEditModal({{ $student->id }})"
        class="px-3 py-1 text-sm bg-gray-500 text-white rounded hover:bg-gray-600">
        Edit
      </button>

      <form action="{{ route('students.destroy', $student->id) }}"
            method="POST"
            onsubmit="return confirm('Are you sure?');">
        @csrf @method('DELETE')
        <button type="submit"
          class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
          Delete
        </button>
      </form>

    </div>

  </div>
@endforeach

</div>

   

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

      <form id="editForm" enctype="multipart/form-data">
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

            <label class="block mb-1 font-semibold">Section</label>
            <select id="edit_section" name="section_id" class="w-full border p-2 rounded mb-2">
              <option value="">-- Select Section --</option>
              @foreach($sections as $section)
                <option value="{{ $section->id }}">{{ $section->name }}</option>
              @endforeach
            </select>

            {{-- <label class="block mb-1 font-semibold">Registration No</label>
            <input type="text" id="edit_registration" name="registration_no" class="w-full border p-2 rounded mb-2">
          </div>
        </div> --}}

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
      console.log('openEditModal id=', id);
      fetch(`/students/${id}/edit`, { credentials: 'same-origin' })
        .then(res => {
          console.log('edit fetch status', res.status);
          if (!res.ok) throw new Error('Edit fetch failed: ' + res.status);
          return res.json();
        })
        .then(student => {
          // fill form
          document.getElementById('edit_id').value = student.id ?? '';
          document.getElementById('edit_name').value = student.name ?? '';
          document.getElementById('edit_email').value = student.email ?? '';
          document.getElementById('edit_section').value = student.section_id ?? '';
        //   document.getElementById('edit_registration').value = student.registration_no ?? '';

          // image
          document.getElementById('currentImage').src = student.image ? `/users/${student.image}` : 'https://via.placeholder.com/80';

          // show modal
          const modal = document.getElementById('editModal');
          modal.classList.remove('hidden'); modal.classList.add('flex');
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

      form.addEventListener('submit', function (e) {
        e.preventDefault();
        const id = document.getElementById('edit_id').value;
        if (!id) return alert('Missing student id');

        const fd = new FormData(form);
        fd.append('_method', 'PUT'); // Laravel expects this for PUT

        // fetch to the exact route you have in web.php
        const url = `/students/${id}/update`;
        console.log('Submitting update to', url);

        fetch(url, {
          method: 'POST', // use POST with _method=PUT
          credentials: 'same-origin',
          headers: {
            'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') || {}).content || '{{ csrf_token() }}'
          },
          body: fd
        })
        .then(res => {
          console.log('update response status', res.status);
          return res.json().catch(() => ({ ok:false, status: res.status }));
        })
        .then(json => {
          console.log('update json', json);
          if (json && json.success) {
            closeModal();
            //No full reload, but to keep it simple we'll reload so UI shows changes//
            location.reload();
          } else {
            alert('Update failed — check console for details');
            console.error('Update failed response', json);
          }
        })
        .catch(err => {
          console.error('Update fetch error', err);
          alert('Update request failed — check console');
        });
      });
    });
  </script>
</x-app-layout>
