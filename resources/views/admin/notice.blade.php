<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Notice - Billion Markets</title>
    <!-- Tailwind CSS এবং FontAwesome আইকন -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#0b0204] text-white flex h-screen overflow-hidden">

    <!-- 📊 বাম পাশের সাইডবার (Sidebar) -->
    <aside class="w-64 bg-[#120508] border-r border-gray-900/40 p-6 flex flex-col justify-between shrink-0">
        <div class="space-y-6">
            <!-- লোগো/টাইটেল সেকশন -->
            <div class="flex items-center space-x-2">
                <span class="text-red-500 font-black text-xl tracking-wider">↑ Billion</span>
                <span class="text-white text-sm font-bold uppercase tracking-widest bg-red-950/40 px-2 py-0.5 rounded border border-red-900/30">Control Panel</span>
            </div>

            <!-- মেনু লিংক সমূহ -->
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
                
                <a href="{{ route('admin.bonus.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded text-gray-400 hover:text-white hover:bg-red-950/20 transition">
                    <i class="fa-solid fa-gift text-sm"></i><span class="text-sm font-medium">Manage Bonus Balance</span>
                </a>

                <!-- 📢 নোটিশ পেজে আছেন তাই এই বাটনটি লাল হয়ে এক্টিভ থাকবে -->
                <a href="{{ route('admin.notice.index') }}" class="flex items-center space-x-3 px-4 py-3 text-white font-bold transition rounded" style="background-color: #b80c14;">
                    <i class="fa-solid fa-bullhorn text-sm"></i><span class="text-sm font-medium">Manage Notice</span>
                </a>
            </nav>
        </div>

        <!-- লগআউট এবং ইউজার ইনফো -->
        <div class="pt-4 border-t border-gray-900/40 space-y-3">
            <div class="text-xs text-gray-500">
                Logged in as:<br><span class="text-gray-300 font-bold">{{ Auth::user()->name }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left flex items-center space-x-3 px-4 py-2 text-xs text-red-500 hover:text-red-400 hover:bg-red-950/10 rounded transition">
                    <i class="fa-solid fa-right-from-bracket"></i><span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- 🖥️ ডান পাশের মেইন কন্টেন্ট এরিয়া -->
    <main class="flex-grow p-8 flex flex-col space-y-6 overflow-y-auto">
        
        <div class="w-full rounded-lg p-5 bg-[#120508]" style="border-left: 4px solid #ff1e27;">
            <h2 class="text-xl font-bold text-white tracking-wide">Manage Dashboard Scroll Notice</h2>
            <p class="text-xs text-gray-500 mt-1">সব ইউজারের ড্যাশবোর্ডের স্ক্রলিং নোটিশটি এখান থেকে পরিবর্তন বা বন্ধ করতে পারবেন।</p>
        </div>

        <!-- নোটিশ ফর্ম কার্ড -->
        <div class="max-w-2xl bg-[#120508] p-6 rounded-lg border border-gray-900/30">
            @if(session('success'))
                <div class="bg-green-900/30 text-green-400 p-3 rounded mb-4 text-sm border border-green-900/50">
                    <i class="fa-solid fa-circle-check mr-1"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.notice.update') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs text-gray-400 font-bold uppercase tracking-wider mb-2">Notice Message</label>
                    <textarea name="content" rows="4" class="w-full bg-[#0d0305] border border-gray-800 rounded p-3 text-white text-sm focus:outline-none focus:border-red-500" placeholder="এখানে নোটিশের লেখাটি লিখুন...">{{ $notice->content ?? '' }}</textarea>
                </div>

                <div class="flex items-center space-x-2 py-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ ($notice->is_active ?? true) ? 'checked' : '' }} class="w-4 h-4 accent-[#b80c14]">
                    <label for="is_active" class="text-sm text-gray-400 selection:bg-transparent">Active (টিক দেওয়া থাকলে ড্যাশবোর্ডে নোটিশ শো করবে)</label>
                </div>

                <button type="submit" class="bg-[#b80c14] hover:bg-red-700 text-white font-bold px-6 py-2.5 rounded transition text-xs uppercase tracking-wider">
                    Save Notice
                </button>
            </form>
        </div>
    </main>

</body>
</html>