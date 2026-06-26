<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Billion Markets</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased m-0 p-0 text-white select-none" style="background-color: #0b0204;">

    <div class="flex min-h-screen">
        <aside class="w-64 border-r border-gray-900/40 flex flex-col justify-between p-6 shrink-0" style="background-color: #0d0305;">
            <div>
                <div class="text-xl font-extrabold tracking-wide mb-2" style="color: #ff1e27;">
                    ↑ Billion <span class="text-white text-base font-bold">Markets</span>
                </div>
                <div class="text-2xs uppercase tracking-widest font-black text-gray-500 mb-10 px-1 bg-red-950/30 inline-block rounded border border-red-900/20">
                    👑 Control Panel
                </div>
                
                <nav class="space-y-3">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-white font-bold transition" style="background-color: #b80c14;">
                        <i class="fa-solid fa-gauge text-sm"></i><span class="text-sm">Admin Dashboard</span>
                    </a>
                    <a href="{{ route('admin.deposits.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-gray-400 hover:text-white hover:bg-red-950/20 transition">
                        <i class="fa-solid fa-money-bill-wave text-sm"></i><span class="text-sm font-medium">Manage Deposits</span>
                    </a>
                    <a href="{{ route('admin.withdraws.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-gray-400 hover:text-white hover:bg-red-950/20 transition">
                        <i class="fa-solid fa-hand-holding-dollar text-sm"></i><span class="text-sm font-medium">Manage Withdraws</span>
                    </a>
                    
                    <a href="{{ route('admin.bonus.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-gray-400 hover:text-white hover:bg-red-950/20 transition">
                        <i class="fa-solid fa-gift text-sm"></i><span class="text-sm font-medium">Manage Bonus Balance</span>
                    </a>
                    <!-- 📢 ম্যানেজ নোটিশ অপশন (সঠিক রাউট নেম সহ) -->
                    <a href="{{ route('admin.notice.index') }}" class="flex items-center space-x-3 p-3 text-gray-400 hover:text-white transition rounded hover:bg-red-950/10 {{ Request::is('admin/notice') ? 'bg-[#b80c14] text-white font-bold' : '' }}">
                        <i class="fa-solid fa-bullhorn w-5 text-center"></i> 
                        <span>Manage Notice</span>
                    </a>
                </nav>
            </div>
            
            <div class="space-y-4">
                <div class="text-xs text-gray-500 font-medium px-4">
                    Logged in as: <span class="text-gray-300 block font-semibold mt-0.5">{{ Auth::user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-center text-xs font-bold py-2.5 rounded border border-red-900/40 hover:bg-red-950/20 transition" style="color: #ff1e27;">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-grow p-8 flex flex-col space-y-6 overflow-y-auto">
            <div class="w-full rounded-lg p-5" style="background-color: #120508; border-left: 4px solid #ff1e27;">
                <h2 class="text-lg font-bold text-white tracking-wide">Hello Administrator, {{ Auth::user()->name }}!</h2>
                <p class="text-xs text-gray-500 mt-0.5">Here is the global system stats and pending actions overview.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="rounded-lg p-5 border border-gray-900/30 flex flex-col space-y-2" style="background-color: #120508;">
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Approved Deposits</span>
                    <span class="text-2xl font-black text-emerald-500">${{ number_format($totalDeposits, 2) }}</span>
                </div>
                
                <div class="rounded-lg p-5 border border-gray-900/30 flex flex-col space-y-2" style="background-color: #120508;">
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Approved Withdrawals</span>
                    <span class="text-2xl font-black text-red-500">${{ number_format($totalWithdraws, 2) }}</span>
                </div>

                <div class="rounded-lg p-5 border border-amber-500/10 flex flex-col space-y-2 bg-amber-500/5">
                    <span class="text-xs text-amber-500/70 font-bold uppercase tracking-wider">Pending Deposits</span>
                    <span class="text-2xl font-black text-amber-500">{{ $pendingDeposits }} Requests</span>
                </div>

                <div class="rounded-lg p-5 border border-blue-500/10 flex flex-col space-y-2 bg-blue-500/5">
                    <span class="text-xs text-blue-500/70 font-bold uppercase tracking-wider">Pending Withdrawals</span>
                    <span class="text-2xl font-black text-blue-500">{{ $pendingWithdraws }} Requests</span>
                </div>
            </div>
        </main>
    </div>

</body>
</html>