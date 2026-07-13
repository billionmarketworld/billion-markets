<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Investor Dashboard - Billion Markets</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased m-0 p-0 text-white select-none" style="background-color: #0b0204;">

    <div class="min-h-screen flex flex-col md:flex-row relative overflow-x-hidden">
        
        <div class="flex md:hidden items-center justify-between p-4 border-b border-gray-900/40 sticky top-0 z-50" style="background-color: #0d0305;">
            <div class="text-lg font-extrabold tracking-wide" style="color: #ff1e27;">
                ↑ Billion <span class="text-white text-sm font-bold">Markets</span>
            </div>
            <button id="menu-toggle" class="text-white text-xl p-2 focus:outline-none hover:text-[#ff1e27] transition">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 border-r border-gray-900/40 flex flex-col justify-between p-6 shrink-0 transform -translate-x-full md:translate-x-0 md:static md:h-screen transition-transform duration-300 ease-in-out" style="background-color: #0d0305;">
            <div>
                <div class="flex items-center justify-between mb-8 md:mb-10">
                    <div class="text-xl font-extrabold tracking-wide" style="color: #ff1e27;">
                        ↑ Billion <span class="text-white text-base font-bold">Markets</span>
                    </div>
                    <button id="menu-close" class="md:hidden text-gray-400 hover:text-white text-lg p-1">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                
                <nav class="space-y-3">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-gray-400 hover:text-white hover:bg-red-950/20 transition">
                        <i class="fa-solid fa-house text-sm"></i><span class="text-sm font-medium">Home</span>
                    </a>
                    
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded transition {{ !request('page') ? 'text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-red-950/20' }}" style="{{ !request('page') ? 'background-color: #b80c14;' : '' }}">
                        <i class="fa-solid fa-chart-pie text-sm"></i><span class="text-sm">Dashboard</span>
                    </a>
                    
                    <a href="?page=investment" class="flex items-center space-x-3 px-4 py-3 rounded transition {{ request('page') == 'investment' ? 'text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-red-950/20' }}" style="{{ request('page') == 'investment' ? 'background-color: #b80c14;' : '' }}">
                        <i class="fa-solid fa-chart-line text-sm"></i><span class="text-sm">Investment</span>
                    </a>
                    
                    <a href="{{ route('deposit') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-gray-400 hover:text-white hover:bg-red-950/20 transition">
                        <i class="fa-solid fa-money-bill-transfer text-sm"></i><span class="text-sm font-medium">Deposit</span>
                    </a>
                    <a href="{{ route('withdraw') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-gray-400 hover:text-white hover:bg-red-950/20 transition">
                        <i class="fa-solid fa-credit-card text-sm"></i><span class="text-sm font-medium">Withdraw</span>
                    </a>
                </nav>
            </div>
            
            <div class="space-y-4 mt-6 md:mt-0">
                <div class="text-xs text-gray-500 font-medium px-4">
                    Logged in as: 
                    <a href="{{ route('user.profile') }}" class="text-gray-300 font-bold block mt-0.5 hover:text-[#ff1e27] transition duration-200 group flex items-center space-x-1">
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fa-solid fa-angle-right text-xs text-gray-500 group-hover:text-[#ff1e27] transition pl-1"></i>
                    </a>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-center text-xs font-bold py-2.5 rounded border border-red-900/40 hover:bg-red-950/20 transition" style="color: #ff1e27;">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </aside>

        <div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-40 hidden md:hidden"></div>

        <main class="flex-grow p-4 md:p-8 flex flex-col space-y-6 overflow-y-auto md:h-screen">
            <div class="w-full rounded-lg p-5" style="background-color: #120508; border-left: 4px solid #ff1e27;">
                <h2 class="text-lg font-bold text-white tracking-wide">Welcome Back, {{ Auth::user()->name }}!</h2>
                <p class="text-xs text-gray-500 mt-0.5">Here is your investment and transaction overview for today.</p>
            </div>
            
            @if(isset($notice) && $notice->content)
            <div class="w-full bg-[#120508] border border-red-900/30 rounded-lg p-3 flex items-center space-x-3 overflow-hidden my-3">
                <span class="bg-[#b80c14] text-white text-xs font-bold uppercase px-3 py-1 rounded shrink-0 animate-pulse">
                    <i class="fa-solid fa-bullhorn mr-1"></i> Notice
                </span>
                <marquee class="text-sm font-medium text-gray-300 tracking-wide" behavior="scroll" direction="left" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();">
                    {{ $notice->content }}
                </marquee>
            </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <div class="rounded-lg p-5 border border-gray-900/30 flex flex-col space-y-2" style="background-color: #120508;">
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Investment</span>
                    <span class="text-2xl font-black text-white">${{ number_format($totalInvestment ?? 0, 2) }}</span>
                </div>
                
                <div class="rounded-lg p-5 border border-gray-900/30 flex flex-col space-y-2" style="background-color: #120508;">
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Deposit</span>
                    <span class="text-2xl font-black text-emerald-500">${{ number_format($totalDeposit ?? 0, 2) }}</span>
                </div>
                
                <div class="rounded-lg p-5 border border-gray-900/30 flex flex-col space-y-2" style="background-color: #120508;">
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Withdraw</span>
                    <span class="text-2xl font-black text-red-500">${{ number_format($totalWithdraw ?? 0, 2) }}</span>
                </div>

                <div class="rounded-lg p-5 border border-gray-900/30 flex flex-col space-y-2" style="background-color: #120508;">
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Bonus Balance</span>
                    <span class="text-2xl font-black text-cyan-400">
                        ${{ number_format(Auth::user()->bonus_balance ?? 0, 2) }}
                    </span>
                </div>
            </div>
        </main>
    </div>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const menuClose = document.getElementById('menu-close');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        menuToggle.addEventListener('click', toggleSidebar);
        menuClose.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>