<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Investment - Billion Markets</title>
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
                    
                    <a href="{{ route('dashboard') }}?page=investment" class="flex items-center space-x-3 p-3 bg-[#b80c14] text-white font-bold rounded shadow-lg shadow-red-900/20">
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
                    <a href="{{ route('user.profile') }}" class="text-gray-300 font-bold block mt-0.5 hover:text-[#ff1e27] transition duration-200 group flex items-center space-x-1">
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fa-solid fa-angle-right text-xs text-gray-500 group-hover:text-[#ff1e27] transition pl-1"></i>
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
                <h2 class="text-xl font-bold text-white tracking-wide">Welcome Back, {{ Auth::user()->name }}!</h2>
                <p class="text-xs text-gray-500 mt-1">Here is your investment and transaction overview for today.</p>
            </div>

            @if(isset($notice) && $notice->content)
            <div class="w-full bg-[#120508] border border-red-900/30 rounded-lg p-3 flex items-center space-x-3 overflow-hidden my-1">
                <span class="bg-[#b80c14] text-white text-xs font-bold uppercase px-3 py-1 rounded shrink-0 animate-pulse">
                    <i class="fa-solid fa-bullhorn mr-1"></i> Notice
                </span>
                <marquee class="text-sm font-medium text-gray-300 tracking-wide" behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();">
                    {{ $notice->content }}
                </marquee>
            </div>
            @endif

            <div class="pt-2">
                <h3 class="text-lg font-bold text-gray-400 uppercase tracking-wider text-xs">My Investment Overview</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
                <div class="rounded-lg p-6 border border-gray-900/30 flex flex-col space-y-1 bg-[#120508] max-w-sm relative overflow-hidden transition hover:border-red-500/20">
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Deposit</span>
                    
                    <span class="text-2xl font-extrabold text-white tracking-tight whitespace-nowrap">
                        $ {{ number_format($totalDeposit ?? 0, 2) }}
                    </span>
                    
                    <i class="fa-solid fa-wallet absolute right-4 bottom-4 text-3xl text-gray-800/10"></i>
                </div>
            </div>

        </main>
    </div>
</body>
</html>