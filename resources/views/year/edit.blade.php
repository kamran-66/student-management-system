<x-app-layout>

    <div class="w-8/12 mx-auto">
    
<form action="{{route('year.update', $classes->id)}}" method="POST">
    @csrf
    @method('PUT')


    <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2 mt-6">Edit Course</h2>
            <p class="text-gray-600 mb-6">Use the sidebar to navigate through your pages.</p>
            </div>

      <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" value="{{ old('name',$classes->name) }}" class="block mt-1 w-full py-3 bg-white" type="text" name="name"  required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>


          {{-- <div class="mt-4">
                                <x-input-label for="course_id" :value="__('Course')" />
                                <select name="course_id" id="course_id" class="block mt-1 w-full py-3 bg-white rounded-md shadow-sm focus:ring focus:ring-indigo-200" :value="old('course_id')" required autocomplete>
                                    <option value="">Select Section</option>
                                    
                                    @foreach($courses as $course)
                                        <option value="{{$course->id}}" @selected($classes->course_id==$course->id )>{{$course->name}}</option>
                                        @endforeach
                                </select>
          </div> --}}

        


           <x-primary-button class="ms-4 mt-6">
                {{ __('Submit') }}
            </x-primary-button>
    </form>
    </div>
 </form>

</div>

 </x-app-layout>

