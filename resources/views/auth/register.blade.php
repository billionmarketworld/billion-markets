<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 pb-6" style="background-color: #0b0204;">
        
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold tracking-wide" style="color: #ff1e27;">
                <span class="text-white">↑</span> Billion <span style="color: #00e676;">Markets</span>
            </h1>
            <p class="text-xs text-gray-400 mt-1">Secure Trading & Investment Gateway</p>
        </div>

        <div class="w-full sm:max-w-2xl mt-2 px-8 py-8 shadow-2xl rounded-xl border border-gray-900" style="background-color: #120508;">
            
            <h2 class="text-2xl font-bold text-white mb-6 text-center sm:text-left">Create New Account</h2>

            @if ($errors->any())
                <div class="mb-4 p-3 rounded-md bg-red-900/50 border border-red-600 text-sm text-red-200">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <div>
                        <label class="block font-medium text-sm text-gray-400 mb-1">Full Name</label>
                        <input id="name" class="block mt-1 w-full rounded-md border-0 text-white focus:ring-2 focus:ring-red-600 p-2.5" 
                               style="background-color: #1a0a0e;" type="text" name="name" :value="old('name')" placeholder="Enter full name" required autofocus />
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-400 mb-1">Username</label>
                        <input id="username" class="block mt-1 w-full rounded-md border-0 text-white focus:ring-2 focus:ring-red-600 p-2.5" 
                               style="background-color: #1a0a0e;" type="text" name="username" :value="old('username')" placeholder="Unique username" required />
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-400 mb-1">Date of Birth</label>
                        <input id="dob" class="block mt-1 w-full rounded-md border-0 text-white focus:ring-2 focus:ring-red-600 p-2.5" 
                               style="background-color: #1a0a0e;" type="date" name="dob" :value="old('dob')" required />
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-400 mb-1">Mobile Number</label>
                        <input id="mobile" class="block mt-1 w-full rounded-md border-0 text-white focus:ring-2 focus:ring-red-600 p-2.5" 
                               style="background-color: #1a0a0e;" type="text" name="mobile" :value="old('mobile')" placeholder="e.g. +88017xxxxxxxx" required />
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block font-medium text-sm text-gray-400 mb-1">Email Address</label>
                        <input id="email" class="block mt-1 w-full rounded-md border-0 text-white focus:ring-2 focus:ring-red-600 p-2.5" 
                               style="background-color: #1a0a0e;" type="email" name="email" :value="old('email')" placeholder="Enter email address" required />
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-400 mb-1">Password</label>
                        <input id="password" class="block mt-1 w-full rounded-md border-0 text-white focus:ring-2 focus:ring-red-600 p-2.5" 
                               style="background-color: #1a0a0e;" type="password" name="password" placeholder="********" required autocomplete="new-password" />
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-400 mb-1">Confirm Password</label>
                        <input id="password_confirmation" class="block mt-1 w-full rounded-md border-0 text-white focus:ring-2 focus:ring-red-600 p-2.5" 
                               style="background-color: #1a0a0e;" type="password" name="password_confirmation" placeholder="********" required />
                    </div>

                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full text-white font-bold py-3 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" 
                            style="background-color: #ff1e27; box-shadow: 0 4px 14px rgba(255, 30, 39, 0.4);">
                        Register
                    </button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-400">
                        Already have an account? 
                        <a class="font-semibold hover:underline" style="color: #ff1e27;" href="{{ route('login') }}">
                            Sign In
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>