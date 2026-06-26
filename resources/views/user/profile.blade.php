<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Profile - Billion Markets</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#0b0204] text-white font-sans antialiased selection:bg-[#b80c14]">
    <div class="flex min-h-screen">
        
        <aside class="w-64 border-r border-gray-900/40 p-6 bg-[#0d0305] flex flex-col justify-between shrink-0">
            <div>
                <div class="text-xl font-extrabold tracking-wide mb-10 flex items-center space-x-2 text-[#ff1e27]">
                    <span>↑ Billion <span class="text-white text-base font-bold">Markets</span></span>
                </div>
                
                <nav class="space-y-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 text-gray-400 hover:text-white transition rounded hover:bg-red-950/10">
                        <i class="fa-solid fa-house"></i> <span>Home</span>
                    </a>
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 text-gray-400 hover:text-white transition rounded hover:bg-red-950/10">
                        <i class="fa-solid fa-gauge"></i> <span>Dashboard</span>
                    </a>
                    <a href="{{ route('dashboard') }}?page=investment" class="flex items-center space-x-3 p-3 text-gray-400 hover:text-white transition rounded hover:bg-red-950/10">
                        <i class="fa-solid fa-chart-line"></i> <span>Investment</span>
                    </a>
                    <a href="{{ route('deposit') }}" class="flex items-center space-x-3 p-3 text-gray-400 hover:text-white transition rounded hover:bg-red-950/10">
                        <i class="fa-solid fa-wallet"></i> <span>Deposit</span>
                    </a>
                    <a href="{{ route('withdraw') }}" class="flex items-center space-x-3 p-3 text-gray-400 hover:text-white transition rounded hover:bg-red-950/10">
                        <i class="fa-solid fa-money-bill-transfer"></i> <span>Withdraw</span>
                    </a>
                </nav>
            </div>

            <div class="space-y-4 mt-auto">
                <div class="text-xs text-gray-500 font-medium px-4">
                    Logged in as: 
                    <a href="{{ route('user.profile') }}" class="text-[#ff1e27] font-bold block mt-0.5 group flex items-center space-x-1">
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fa-solid fa-angle-right text-xs text-[#ff1e27] pl-1"></i>
                    </a>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-center text-xs font-bold py-2.5 rounded border border-red-900/40 hover:bg-red-950/20 text-[#ff1e27] transition">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-grow p-8 flex flex-col space-y-6 overflow-y-auto">
            
            <div class="w-full rounded-lg p-5 bg-[#120508]" style="border-left: 4px solid #ff1e27;">
                <h2 class="text-xl font-bold text-white tracking-wide">Profile Information</h2>
                <p class="text-xs text-gray-500 mt-1">The information you provided during registration is given below</p>
            </div>

            <div class="max-w-xl bg-[#120508] rounded-lg border border-gray-900/30 overflow-hidden shadow-2xl">
                <div class="bg-gradient-to-r from-red-950/30 to-transparent p-4 border-b border-gray-900/40 flex items-center space-x-3">
                    <div class="bg-[#b80c14] p-2 rounded-full text-white w-10 h-10 flex items-center justify-center font-bold text-lg">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-200">{{ $user->name }}</h4>
                        <span class="text-xs text-gray-500">Investor Account</span>
                    </div>
                </div>

                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center border-b border-gray-900/20 pb-3">
                        <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Full Name</span>
                        <span class="text-sm font-medium text-gray-200">{{ $user->name }}</span>
                    </div>

                    <div class="flex justify-between items-center border-b border-gray-900/20 pb-3">
                        <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Email Address</span>
                        <span class="text-sm font-medium text-gray-200">{{ $user->email }}</span>
                    </div>

                    <div class="flex justify-between items-center border-b border-gray-900/20 pb-3">
                        <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Mobile Number</span>
                        <span class="text-sm font-medium text-gray-200">{{ $user->phone ?? $user->mobile ?? 'N/A' }}</span>
                    </div>

                    <div class="flex justify-between items-center pb-1">
                        <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Date of Birth</span>
                        <span class="text-sm font-medium text-gray-200">
                            {{ isset($user->dob) ? date('d M, Y', strtotime($user->dob)) : (isset($user->date_of_birth) ? date('d M, Y', strtotime($user->date_of_birth)) : 'N/A') }}
                        </span>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>
</html>