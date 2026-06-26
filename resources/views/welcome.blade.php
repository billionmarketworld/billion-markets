<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Billion Markets - Invest in Future</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-[#0b0204] text-white font-sans antialiased selection:bg-[#b80c14]">

    <!-- 🌐 পরিচ্ছন্ন হেডার সেকশন -->
    <header class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center border-b border-gray-900/30">
        <div class="text-xl font-extrabold tracking-wide text-[#ff1e27]">
            ↑ Billion <span class="text-white text-base font-bold">Markets</span>
        </div>
        
        <div class="flex items-center space-x-4">
            @auth
                <span class="text-xs text-gray-400 font-medium">Hi, <span class="text-gray-200 font-bold">{{ Auth::user()->name }}</span></span>
                <a href="{{ route('dashboard') }}" class="bg-[#b80c14] hover:bg-[#ff1e27] text-white text-xs font-bold px-5 py-2.5 rounded transition duration-200 shadow-lg shadow-red-900/20">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-400 hover:text-white transition">Login</a>
                <a href="{{ route('register') }}" class="bg-[#b80c14] hover:bg-[#ff1e27] text-white text-xs font-bold px-5 py-2.5 rounded transition duration-200">Register</a>
            @endauth
        </div>
    </header>

    <!-- 🚀 হিরো বা মেইন কন্টেন্ট সেকশন -->
    <main class="max-w-7xl mx-auto px-6 pt-16 pb-24 flex flex-col justify-center min-h-[70vh] relative">
        
        <!-- 🔥 টপ ছোট ট্যাগ বাটন (পরিচ্ছন্ন স্টাইলে) -->
        <div class="inline-flex items-center space-x-2 bg-red-950/20 border border-red-900/30 px-3 py-1.5 rounded-full w-fit mb-6">
            <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
            </span>
            <span class="text-xs font-semibold text-[#ff1e27] tracking-wide uppercase">World Class Investment Platform</span>
        </div>

        <!-- টাইটেল এবং বিবরণ -->
        <div class="max-w-2xl space-y-4">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight leading-tight">
                Invest Today for a <br>
                <span class="text-[#ff1e27]">Billion Dollar</span> Future
            </h1>
            <p class="text-sm text-gray-400 font-medium leading-relaxed">
                Billion Markets is a secure, automated, and lightning-fast smart platform for investing, fund management, and buying and selling crypto assets.
            </p>
        </div>

        <!-- 🎯 গেট স্টার্টেড বাটন (যা এখন আর হিজিবিজি বা ফুল স্ক্রিন চওড়া নয়) -->
        <div class="mt-8">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-[#b80c14] to-[#ff1e27] hover:from-[#ff1e27] hover:to-[#b80c14] text-white font-bold text-sm px-8 py-3.5 rounded shadow-xl shadow-red-900/20 transition-all duration-300 transform hover:-translate-y-0.5">
                <span>Get Started</span>
                <i class="fa-solid fa-arrow-up-right-from-square text-xs opacity-80"></i>
            </a>
        </div>

        <!-- 📊 স্ট্যাটাস কাউন্টার গ্রিড (যা এখন সুন্দরভাবে ৪ কলামে ভাগ করা) -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-20 border-t border-gray-900/20 pt-10 max-w-4xl">
            <div class="flex flex-col space-y-1">
                <span class="text-2xl md:text-3xl font-black text-white tracking-tight">20,000+</span>
                <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Satisfied Investors</span>
            </div>
            <div class="flex flex-col space-y-1">
                <span class="text-2xl md:text-3xl font-black text-white tracking-tight">120+</span>
                <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Advanced Features</span>
            </div>
            <div class="flex flex-col space-y-1">
                <span class="text-2xl md:text-3xl font-black text-white tracking-tight">91.5%</span>
                <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Predictive Accuracy</span>
            </div>
            <div class="flex flex-col space-y-1">
                <span class="text-2xl md:text-3xl font-black text-white tracking-tight">24/7</span>
                <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Expert Support</span>
            </div>
        </div>

    </main>

</body>
</html>