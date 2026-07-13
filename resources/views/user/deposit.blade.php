<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deposit Logs - Billion Markets</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased m-0 p-0 text-white select-none" style="background-color: #0b0204;">

    <div class="min-h-screen flex flex-col md:flex-row relative overflow-x-hidden">
        
        <!-- 📱 মোবাইল টপ বার (হ্যামবার্গার মেনু বাটনসহ) -->
        <div class="flex md:hidden items-center justify-between p-4 border-b border-gray-900/40 sticky top-0 z-50" style="background-color: #0d0305;">
            <div class="text-lg font-extrabold tracking-wide" style="color: #ff1e27;">
                ↑ Billion <span class="text-white text-sm font-bold">Markets</span>
            </div>
            <button id="menu-toggle" class="text-white text-xl p-2 focus:outline-none hover:text-[#ff1e27] transition">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <!-- 🧭 স্লাইডিং সাইডবার (ভিডিওর স্টাইলে রেডি করা) -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 border-r border-gray-900/40 flex flex-col justify-between p-6 shrink-0 transform -translate-x-full md:translate-x-0 md:static md:h-screen transition-transform duration-300 ease-in-out" style="background-color: #0d0305;">
            <div>
                <div class="flex items-center justify-between mb-8 md:mb-10">
                    <div class="text-xl font-extrabold tracking-wide" style="color: #ff1e27;">
                        ↑ Billion <span class="text-white text-base font-bold">Markets</span>
                    </div>
                    <!-- ✕ ক্লোজ বাটন -->
                    <button id="menu-close" class="md:hidden text-gray-400 hover:text-white text-lg p-1">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                
                <nav class="space-y-3">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-gray-400 hover:text-white hover:bg-red-950/20 transition">
                        <i class="fa-solid fa-house text-sm"></i><span class="text-sm font-medium">Home</span>
                    </a>
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-gray-400 hover:text-white hover:bg-red-950/20 transition">
                        <i class="fa-solid fa-chart-pie text-sm"></i><span class="text-sm font-medium">Dashboard</span>
                    </a>
                    <a href="{{ route('dashboard', ['page' => 'investment']) }}" class="flex items-center space-x-3 px-4 py-3 rounded text-gray-400 hover:text-white hover:bg-red-950/20 transition">
                        <i class="fa-solid fa-chart-line text-sm"></i><span class="text-sm font-medium">Investment</span>
                    </a>
                    <!-- একটিভ পেজ: Deposit -->
                    <a href="{{ route('deposit') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-white font-bold transition" style="background-color: #b80c14;">
                        <i class="fa-solid fa-money-bill-transfer text-sm"></i><span class="text-sm">Deposit</span>
                    </a>
                    <a href="{{ route('withdraw') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-gray-400 hover:text-white hover:bg-red-950/20 transition">
                        <i class="fa-solid fa-credit-card text-sm"></i><span class="text-sm font-medium">Withdraw</span>
                    </a>
                </nav>
            </div>
            
            <div class="space-y-4 mt-6 md:mt-0">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-center text-xs font-bold py-2.5 rounded border border-red-900/40 hover:bg-red-950/20 transition" style="color: #ff1e27;">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- 🖤 মোবাইল ওভারলে ব্যাকড্রপ -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-40 hidden md:hidden"></div>

        <!-- 💻 মূল কনটেন্ট এরিয়া -->
        <main class="flex-grow p-4 md:p-8 flex flex-col space-y-6 overflow-y-auto md:h-screen">
            
            <!-- ⚡ ফিক্সড: হেডার এরিয়া মোবাইলে নিচে নিচে নামবে (flex-col sm:flex-row) যেন বাটন ভেঙে না যায় -->
            <div class="w-full rounded-lg p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4" style="background-color: #120508; border-left: 4px solid #ff1e27;">
                <div>
                    <h2 class="text-lg font-bold text-white tracking-wide">Deposit History</h2>
                    <p class="text-xs text-gray-500 mt-0.5">View and track all your account funding records</p>
                </div>
                <button onclick="document.getElementById('depositModal').classList.remove('hidden')" class="w-full sm:w-auto px-5 py-2.5 rounded text-xs font-bold text-white transition hover:bg-red-700 text-center" style="background-color: #b80c14;">
                    <i class="fa-solid fa-plus mr-2"></i>New Deposit
                </button>
            </div>

            <!-- 📄 নিউ ডিপোজিট পপআপ মডাল (মোবাইলে স্ক্রিনের সাথে মানানসই করা) -->
            <div id="depositModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4">
                <div class="w-full max-w-md rounded-lg p-6 border border-gray-950" style="background-color: #120508;">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-base font-bold text-white uppercase tracking-wider">Request New Deposit</h3>
                        <button onclick="document.getElementById('depositModal').classList.add('hidden')" class="text-gray-500 hover:text-white transition">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>

                    <form action="{{ route('deposit.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Amount (USD)</label>
                            <input type="number" name="amount" min="1" step="any" placeholder="Enter amount (e.g. 100)" class="w-full bg-black/40 border border-gray-900 rounded px-4 py-3 text-sm text-white focus:outline-none focus:border-red-600 transition" required>
                        </div>
                        
                        <div class="pt-2">
                            <button type="submit" class="w-full py-3 rounded text-sm font-bold text-white transition hover:bg-red-700" style="background-color: #b80c14;">
                                Submit Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- 📊 টেবিল এরিয়া (overflow-x-auto দেওয়ার ফলে মোবাইলে টেবিলটি ভেঙে যাবে না, স্ক্রল করা যাবে) -->
            <div class="w-full rounded-lg overflow-hidden border border-gray-900/50" style="background-color: #120508;">
                <div class="w-full overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[600px]">
                        <thead>
                            <tr class="border-b border-gray-900 text-xs font-bold uppercase tracking-wider text-gray-400" style="background-color: #16080b;">
                                <th class="py-4 px-6">SL</th>
                                <th class="py-4 px-6">Amount</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6">Date & Time</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-950">
                            @forelse($deposits as $index => $deposit)
                                <tr class="hover:bg-red-950/5 transition">
                                    <td class="py-4 px-6 font-semibold text-gray-400">#{{ $index + 1 }}</td>
                                    <td class="py-4 px-6 font-bold text-white">${{ number_format($deposit->amount, 2) }}</td>
                                    <td class="py-4 px-6">
                                        @if($deposit->status == 'Approved')
                                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                                <i class="fa-solid fa-circle-check mr-1.5 text-[10px]"></i> Approved
                                            </span>
                                        @elseif($deposit->status == 'Rejected')
                                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                                <i class="fa-solid fa-circle-xmark mr-1.5 text-[10px]"></i> Rejected
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                                <i class="fa-solid fa-spinner fa-spin mr-1.5 text-[10px]"></i> Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-xs text-gray-400">{{ $deposit->created_at->format('Y-m-d H:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-gray-500 text-sm">
                                        <i class="fa-solid fa-folder-open block text-2xl mb-2 text-gray-700"></i>
                                        No deposit records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- ⚡ জাভাস্ক্রিপ্ট: মেনু স্লাইডিং টগল স্ক্রিপ্ট -->
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