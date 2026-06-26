<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Bonus Balance - Billion Markets</title>
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
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-gray-400 hover:text-white hover:bg-red-950/20 transition">
                        <i class="fa-solid fa-gauge text-sm"></i><span class="text-sm font-medium">Admin Dashboard</span>
                    </a>
                    <a href="{{ route('admin.deposits.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-gray-400 hover:text-white hover:bg-red-950/20 transition">
                        <i class="fa-solid fa-money-bill-wave text-sm"></i><span class="text-sm font-medium">Manage Deposits</span>
                    </a>
                    <a href="{{ route('admin.withdraws.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-gray-400 hover:text-white hover:bg-red-950/20 transition">
                        <i class="fa-solid fa-hand-holding-dollar text-sm"></i><span class="text-sm font-medium">Manage Withdraws</span>
                    </a>
                    
                    <a href="{{ route('admin.bonus.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-white font-bold transition" style="background-color: #b80c14;">
                        <i class="fa-solid fa-gift text-sm"></i><span class="text-sm">Manage Bonus Balance</span>
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
            
            @if(session('success'))
                <div class="bg-emerald-950/40 border border-emerald-500/30 text-emerald-400 p-4 rounded-lg text-sm flex items-center">
                    <i class="fa-solid fa-circle-check mr-2 text-base"></i> {{ session('success') }}
                </div>
            @endif

            <div class="w-full rounded-lg p-5" style="background-color: #120508; border-left: 4px solid #ff1e27;">
                <h2 class="text-lg font-bold text-white tracking-wide">Manage User Bonus Balances</h2>
                <p class="text-xs text-gray-500 mt-0.5">সব ইউজারের তালিকা নিচে দেওয়া হলো। সরাসরি আইডি/রো অনুযায়ী বোনাস সংখ্যা পরিবর্তন করে দিন।</p>
            </div>

            <div class="overflow-hidden rounded-lg border border-gray-900/40" style="background-color: #120508;">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-900 text-xs font-bold uppercase tracking-wider text-gray-500" style="background-color: #0d0305;">
                            <th class="p-4">User Info (Name/Email)</th>
                            <th class="p-4 text-center">Current Bonus</th>
                            <th class="p-4 text-right">Action / Update Value</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-900/60 text-sm">
                        @forelse($users as $user)
                            <tr class="hover:bg-red-950/5 transition">
                                <td class="p-4">
                                    <span class="block font-semibold text-white">{{ $user->name }}</span>
                                    <span class="text-xs text-gray-500">{{ $user->email }}</span>
                                </td>
                                
                                <td class="p-4 text-center font-black text-cyan-400 text-base">
                                    ${{ number_format($user->bonus_balance ?? 0, 2) }}
                                </td>
                                
                                <td class="p-4 text-right">
                                    <form action="{{ route('admin.bonus.update', $user->id) }}" method="POST" class="flex items-center justify-end space-x-2">
                                        @csrf
                                        <div class="relative">
                                            <span class="absolute left-3 top-1.5 text-xs text-gray-500">$</span>
                                            <input type="number" name="bonus_balance" step="0.01" min="0" 
                                                   value="{{ $user->bonus_balance ?? 0 }}" 
                                                   class="w-28 bg-black border border-gray-800 rounded px-3 pl-6 py-1 text-sm text-white focus:outline-none focus:border-red-600 font-bold transition">
                                        </div>
                                        <button type="submit" class="text-white font-bold text-xs px-4 py-1.5 rounded transition shadow-lg hover:opacity-90" style="background-color: #b80c14;">
                                            Update
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-8 text-center text-gray-600 text-sm">No registered active users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>
</html>