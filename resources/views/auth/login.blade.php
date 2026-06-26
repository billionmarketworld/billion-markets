<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background-color: #0b0204;">
        
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold tracking-wide" style="color: #ff1e27;">
                <span class="text-white">↑</span> Billion <span style="color: #00e676;">Markets</span>
            </h1>
            <p class="text-xs text-gray-400 mt-1">Secure Trading & Investment Gateway</p>
        </div>

        <div class="w-full sm:max-w-md mt-2 px-8 py-8 shadow-2xl rounded-xl border border-gray-900" style="background-color: #120508;">
            
            <h2 class="text-2xl font-bold text-white mb-6">Sign In</h2>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 rounded-md bg-red-900/50 border border-red-600 text-sm text-red-200">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label class="block font-medium text-sm text-gray-400 mb-2">Username or Email</label>
                    <input id="email" class="block mt-1 w-full rounded-md border-0 text-white focus:ring-2 focus:ring-red-600 p-3" 
                           style="background-color: #1a0a0e;" type="text" name="email" :value="old('email')" placeholder="Enter username or email" required autofocus />
                </div>

                <div class="mt-4">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block font-medium text-sm text-gray-400">Password</label>
                        @if (Route::has('password.request'))
                            <a class="text-sm hover:underline" style="color: #ff1e27;" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    <input id="password" class="block mt-1 w-full rounded-md border-0 text-white focus:ring-2 focus:ring-red-600 p-3" 
                           style="background-color: #1a0a0e;" type="password" name="password" placeholder="********" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-800 text-red-600 focus:ring-red-500" name="remember" style="background-color: #1a0a0e;">
                        <span class="ml-2 text-sm text-gray-400">Remember me</span>
                    </label>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full text-white font-bold py-3 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" 
                            style="background-color: #ff1e27; box-shadow: 0 4px 14px rgba(255, 30, 39, 0.4);">
                        Sign In
                    </button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-400">
                        Don't have an account? 
                        <a class="font-semibold hover:underline" style="color: #ff1e27;" href="{{ route('register') }}">
                            Create New Account
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>