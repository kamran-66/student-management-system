<x-app-layout>

    <div class="w-8/12 mx-auto">
    
<form action="{{route('category.update', $category->id)}}" method="POST">
    @csrf
    @method('PUT')


    <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2 mt-6">Edit Category</h2>
            <p class="text-gray-600 mb-6">Use the sidebar to navigate through your pages.</p>
            </div>

      <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" value="{{ old('name',$category->name) }}" class="block mt-1 w-full py-3 bg-white" type="text" name="name"  required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>


           <x-primary-button class="ms-4 mt-6">
                {{ __('Submit') }}
            </x-primary-button>
    </form>
    </div>
 </form>

</div>

 </x-app-layout>

