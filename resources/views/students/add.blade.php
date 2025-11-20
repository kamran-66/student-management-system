<x-app-layout>
    
    <div class="w-8/12 mx-auto">
        
        <form method="POST" action="{{ route('students.store') }}">
        @csrf

        <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2 mt-6">Add Student</h2>
            <p class="text-gray-600 mb-6">Use the sidebar to navigate through your pages.</p>
            </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full py-3 bg-white" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

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

          <!-- Registration No -->
            <div class="mt-4">
                <x-input-label for="registration_no" :value="__('Registration No')" />
                <x-text-input id="registration_no" class="block mt-1 w-full py-3 bg-white" type="text"
                    name="registration_no" :value="old('registration_no')" required />
                <x-input-error :messages="$errors->get('registration_no')" class="mt-2" />
            </div>

            <!-- Class / Teacher -->
            <div class="mt-4">
                <x-input-label for="teacher_id" :value="__('Teacher Name')" />
                <select id="teacher_id" name="teacher_id"
                    class="block mt-1 w-full py-3 bg-white rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                    required>
                    <option value="">-- Select Teacher --</option>
                    @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">({{ $teacher->name }})</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('teacher_id')" class="mt-2" />
            </div>

            <!-- Class / Section -->
            
            <div class="mt-4">
                <x-input-label for="section_id" :value="__('Section')" />
                <select id="section_id" name="section_id"
                    class="block mt-1 w-full py-3 bg-white rounded-md shadow-sm focus:ring focus:ring-indigo-200" required>
                    
                    
                    <option value="">-- Select Section --</option>

                        @foreach($sections as $section)
                        <option value="{{ $section->id }}"> ({{ $section->name }})</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('section_id')" class="mt-2" />
            </div>


  

           <x-primary-button class="ms-4 mt-6">
                {{ __('Submit') }}
            </x-primary-button>
    </form>
    </div>
  
</x-app-layout>