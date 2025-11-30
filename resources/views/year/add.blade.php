<x-app-layout>
    
    <div class="w-8/12 mx-auto">
        
        <form method="POST" action="{{ route('year.store') }}">
        @csrf

        <!-- Name -->

        <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2 mt-6">Add Academic Year</h2>
            <p class="text-gray-600 mb-6">Use the sidebar to navigate through your pages.</p>
            </div>


        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full py-3 bg-white" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>  
        
        
                <!-- Category -->
        <div class="mt-4">
            <x-input-label for="category" :value="__('Program_id')" />
            
                             <div class="mt-4">
                                <select name="category_id" id="category_id" class="block mt-1 w-full py-3 bg-white rounded-md shadow-sm focus:ring focus:ring-indigo-200" :value="old('category_id')" required autocomplete>
                                    <option value="">Select Program</option>
                                    
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                               

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       
        </div>


         <x-primary-button class="ms-4 mt-6">
                {{ __('Submit') }}
            </x-primary-button>


    </form>
    </div>
  
</x-app-layout>