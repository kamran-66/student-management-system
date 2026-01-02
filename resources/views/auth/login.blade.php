<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg overflow-hidden">
            
            <!-- Header with gradient -->
            <div class="bg-indigo-600 text-white py-8 px-6 text-center">
                <h1 class="text-3xl font-bold mb-2">Welcome Back!</h1>
                <p class="text-sm">Login to your College Management Account</p>
            </div>

            <!-- Login Form -->
            <div class="px-8 py-6">
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2" for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2" for="password">Password</label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="remember" class="rounded border-gray-300">
                            <span class="text-gray-700 text-sm">Remember Me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-600 hover:text-indigo-800" href="{{ route('password.request') }}">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit"
                            class="w-full py-2 px-4 bg-indigo-600  text-white font-semibold rounded-lg shadow hover:from-indigo-700 hover:to-purple-700 transition">
                            Login
                        </button>
                    </div>
                </form>

                <!-- Register link -->
                @if (Route::has('register'))
                    <p class="mt-6 text-center text-gray-600 text-sm">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:text-purple-600 font-semibold">Register</a>
                    </p>
                @endif
            </div>
                <!-- Footer (Same as Homepage) -->
        <footer class="bg-gray-100 py-6 mt-auto">
            <div class="max-w-4xl mx-auto px-4 text-center text-gray-600 mt-5">
                &copy; {{ date('Y') }} College Students Data Management System. All rights reserved.
            </div>
        </footer>

    </div>
        </div>
        
    </div>
    
</x-guest-layout>
