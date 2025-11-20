<x-app-layout>

    <div class="w-8/12 mx-auto">
    
<form action="{{route('admin.update', $users->id)}}" method="POST">
    @csrf
    @method('PUT')

      <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2 mt-6">Edit User</h2>
            <p class="text-gray-600 mb-6">Use the sidebar to navigate through your pages.</p>
            </div>



      <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" value="{{ old('name',$users->name) }}" class="block mt-1 w-full" type="text" name="name"  required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" value="{{ old('email',$users->email) }}" class="block mt-1 w-full" type="email" name="email"  required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


           <x-primary-button class="ms-4 mt-6">
                {{ __('Submit') }}
            </x-primary-button>
    </form>
    </div>
 </form>

</div>

 </x-app-layout>











