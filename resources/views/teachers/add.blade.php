<x-app-layout>
    
    <div class="w-8/12 mx-auto">
        
        <form method="POST" action="{{ route('teachers.store') }}">
        @csrf

        <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2 mt-6">Add Teacher</h2>
            <p class="text-gray-600 mb-6">Use the sidebar to navigate through your pages.</p>
            </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full py-3 bg-white" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Course_id -->
        {{-- <div>
            <x-input-label for="course_id" :value="__('Course_id')" />
            <x-text-input id="course_id" class="block mt-1 w-full" type="text" name="course_id" :value="old('course_id')" required autofocus autocomplete="course_id" />
            <x-input-error :messages="$errors->get('course_id')" class="mt-2" />
        </div> --}}

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full py-3 bg-white" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full py-3 bg-white"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        
        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full py-3 bg-white"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        
          <!-- Section -->
             <div class="mt-4">
                                <x-input-label for="section_id" :value="__('Section')" />
                                <select name="section_id" id="_id" class="block mt-1 w-full py-3 bg-white rounded-md shadow-sm focus:ring focus:ring-indigo-200" :value="old('section_id')" required autocomplete>
                                    <option value="">Select Section</option>
                                    
                                    @foreach($sections as $section)
                                        <option value="{{$section->id}}">{{$section->name}}</option>
                                        @endforeach
                                </select>
          </div>

        


           <x-primary-button class="ms-4 mt-6">
                {{ __('Submit') }}
            </x-primary-button>
    </form>
    </div>
  
</x-app-layout>