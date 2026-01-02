<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Teacher Dashboard
          </h2>
            </x-slot>

              <div class="py-10">
                  <div class="max-w-6xl mx-auto px-6">

            
                        <div class="bg-white text-black rounded-xl shadow-lg p-6 mt-6">
                      <h3 class="text-2xl">
                                Welcome, {{ $teacher->name }}! 🎉
                                </h3>
                                <p class="opacity-90 mt-1">Here are your academic details.</p>
                            </div>

                                @if (session('success'))
                                  <div 
                                      x-data="{ show: true }" 
                                      x-show="show" 
                                      x-transition 
                                      x-init="setTimeout(() => show = false, 3000)" 
                                      class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3">
                                      {{ session('success') }}
                                    </div>
                                    @endif

            
                                  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">

                                      
                                      <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col items-center">
                                          <img 
                                              src="{{ $teacher->image ? asset('users/'.$teacher->image) : 'https://via.placeholder.com/100' }}"
                                              class="w-38 h-28 rounded-full shadow border mt-8"
                                          >

                                          <h3 class="text-xl font-bold mt-4">{{ $teacher->name }}</h3>
                                          <p class="text-gray-600 text-sm">{{ $teacher->email }}</p>

                                <button type="button" onclick="openEditModal({{ $teacher->id }})"
                                      class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold mt-4">
                                 Edit Profile
                              </button>
                            </div>

                
                                    <div class="lg:col-span-2 bg-white shadow-lg rounded-xl p-6 mb-8">
                                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Teacher Information</h3>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

         

                                            <div class="p-4 bg-gray-50 rounded-lg">
                                                <p class="text-gray-500 text-sm">Section</p>
                                                <p class="font-semibold text-gray-800">{{ $teacher->section?->name. " - ". $teacher->section?->academicYear?->category?->name ?? 'No Data'}}</p>
                                            </div>

                                              <div class="p-4 bg-gray-50 rounded-lg">
                                                  <p class="text-gray-500 text-sm">Batch Year</p>
                                                  <p class="font-semibold text-gray-800">
                                                      {{ $teacher->section?->academicYear?->name ?? 'N/A' }}
                                                  </p>
                                              </div>

                                    {{-- <div class="p-4 bg-gray-50 rounded-lg">
                                        <p class="text-gray-500 text-sm">Programs</p>
                                        <p class="font-semibold text-gray-800">
                                            {{$teacher->section->academicYear->category->name ?? 'N/A' }}
                                        </p>
                                    </div> --}}

                                </div>

                    <!-- Courses -->
                    <div class="mt-6">
                        <h4 class="text-lg font-semibold text-gray-700 mb-2  ml-3">Courses</h4>
                        
                        <div class="flex flex-wrap gap-2">
                            @foreach ($teacher->section?->academicYear?->courses ?? [] as $course)
                                <span class="px-4 py-1 bg-green-600 text-white rounded-full shadow text-sm ml-2">
                                    {{ $course->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>


      <!-- EDIT TEACHER MODAL (blur background, centered) -->
      <div id="editModal"
          class="fixed inset-0 backdrop-blur-sm bg-black/20 hidden justify-center items-center z-50">
                    <div class="bg-white w-full max-w-xl p-6 rounded-lg shadow-lg mx-4">
                      <div class="flex justify-between items-start mb-4">
                        <h2 class="text-xl font-bold">Edit Teacher</h2>
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
                  fetch(`/teachers/${id}/edit`, { credentials: 'same-origin' })
                    .then(res => {
                    console.log('edit fetch status', res.status);
                    if (!res.ok) throw new Error('Edit fetch failed: ' + res.status);
                    return res.json();
                  })
                          .then(teacher => {
                            // fill form
                            document.getElementById('edit_id').value = teacher.id ?? '';
                            document.getElementById('edit_name').value = teacher.name ?? '';
                            document.getElementById('edit_email').value = teacher.email ?? '';
                            document.getElementById('edit_section').value = teacher.section_id ?? '';
                          //   document.getElementById('edit_registration').value = teacher.registration_no ?? '';

                                     // image
                                      document.getElementById('currentImage').src = teacher.image ? `/users/${teacher.image}` : 'https://via.placeholder.com/80';

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
                                                                    if (!id) return alert('Missing teacher id');

                                                                  const fd = new FormData(form);
                                                                  fd.append('_method', 'PUT'); // this for PUT

                                                              // fetch to the exact route you have in web.php
                                                              const url = `/teachers/${id}/update`;
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
    </div>

</x-app-layout>
