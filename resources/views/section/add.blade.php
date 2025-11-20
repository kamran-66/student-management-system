<x-app-layout>
    
    <div class="w-8/12 mx-auto">
        
        <form method="POST" action="{{ route('sections.add') }}">
        @csrf

        <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2 mt-6">Add Section</h2>
            <p class="text-gray-600 mb-6">Use the sidebar to navigate through your pages.</p>
        </div>


        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full py-3 bg-white" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Academic_id -->

          <div class="mt-4">
                                <x-input-label for="academic_year_id" :value="__('Academic_Year')" />
                                <select name="academic_year_id" id="_id" class="block mt-1 w-full py-3 bg-white rounded-md shadow-sm focus:ring focus:ring-indigo-200" :value="old('academic_year_id')" required autocomplete>
                                    <option value="">Select Class</option>
                                    
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                </select>
          </div>

        <!-- Course_id -->

          <div class="mt-4">
                                <x-input-label for="course_id" :value="__('Course')" />
                                <select name="course_id" id="_id" class="block mt-1 w-full py-3 bg-white rounded-md shadow-sm focus:ring focus:ring-indigo-200" :value="old('course_id')" required autocomplete>
                                    <option value="">Select Course</option>
                                    
                                    @foreach($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                </select>
          </div>

        
         <x-primary-button class="ms-4 mt-6">
                {{ __('Submit') }}
            </x-primary-button>


    </form>
    </div>
  
</x-app-layout>