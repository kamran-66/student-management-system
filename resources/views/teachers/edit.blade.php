<x-app-layout>

    <div class="w-8/12 mx-auto">
    
<form action="{{route('teachers.update', $teacher->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')


    <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2 mt-6">Edit Teacher</h2>
            <p class="text-gray-600 mb-6">Use the sidebar to navigate through your pages.</p>
            </div>

              <!-- Image -->
        <div>
            <x-input-label for="image" :value="__('Profile Image')" />
            <x-text-input id="image"  value="{{ old('image',$teacher->image) }}"  class="border p-2 w-full" type="file" name="image"   required autofocus autocomplete="image" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                  @if($teacher->image)
                    <img src="{{ asset('users/'.$teacher->image) }}" class="w-24 mt-3 rounded">
                @endif
        <div>

      <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" value="{{ old('name',$teacher->name) }}" class="block mt-1 w-full py-3 bg-white" type="text" name="name"  required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" value="{{ old('email',$teacher->email) }}" class="block mt-1 w-full py-3 bg-white" type="email" name="email"  required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

          <!-- Section -->
              <div class="mt-4">
                                <x-input-label for="section_id" :value="__('Section')" />
                                <select name="section_id" id="section_id" class="block mt-1 w-full py-3 bg-white rounded-md shadow-sm focus:ring focus:ring-indigo-200" :value="old('section_id')" required autocomplete>
                                    <option value="">Select Section</option>
                                    
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}" @selected($teacher->section_id == $section->id)>{{ $section->name }}
</option>

                                        @endforeach
                                </select>
          </div>


           <x-primary-button class="ms-4 mt-6">
                {{ __('Submit') }}
            </x-primary-button>
    </form>
    </div>
 </form>

</div>


 </x-app-layout>











