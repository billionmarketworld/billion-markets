<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit; 
use App\Models\Withdraw;
use App\Models\Investment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Notice;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        
        $totalDeposit = Deposit::where('user_id', $userId)->where('status', 'Approved')->sum('amount');
        $totalInvestment = $totalDeposit; 
        $totalWithdraw = Withdraw::where('user_id', $userId)->where('status', 'Approved')->sum('amount');
        
        $user = User::find($userId);
        $bonusBalance = $user ? $user->bonus_balance : 0;

        // 🎯 ডাটাবেজ থেকে লেটেস্ট অ্যাক্টিভ নোটিশটি তোলা হলো
        $notice = Notice::where('is_active', true)->latest()->first();

        // ইনভেস্টমেন্ট পেজ কুয়েরি হ্যান্ডেলিং
        if ($request->query('page') === 'investment') {
            return view('user.investment', compact('totalInvestment', 'totalDeposit', 'notice'));
        }

        return view('dashboard', compact('totalInvestment', 'totalDeposit', 'totalWithdraw', 'bonusBalance', 'notice'));
    }

    public function investment()
    {
        $userId = auth()->id();
        
        // এখানেও Approved ডিপোজিটের ডেটা পাঠানো হলো
        $totalDeposit = Deposit::where('user_id', $userId)->where('status', 'Approved')->sum('amount');
        $totalInvestment = $totalDeposit;
        
        return view('user.investment', compact('totalInvestment', 'totalDeposit'));
    }

    public function deposit() {
        $deposits = Deposit::where('user_id', Auth::id())->latest()->get();
        return view('user.deposit', compact('deposits'));
    }

    public function depositStore(Request $request) {
        $request->validate(['amount' => 'required|numeric|min:1']);
        Deposit::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'status' => 'Pending',
        ]);
        return redirect()->route('deposit')->with('success', 'Deposit request submitted!');
    }

    public function withdraw() {
        $withdraws = Withdraw::where('user_id', Auth::id())->latest()->get();
        return view('user.withdraw', compact('withdraws'));
    }

    public function withdrawStore(Request $request) {
        $request->validate(['amount' => 'required|numeric|min:1']);
        Withdraw::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'status' => 'Pending',
        ]);
        return redirect()->route('withdraw')->with('success', 'Withdraw request submitted!');
    }
    public function showProfile()
    {
        // 🎯 লগইন থাকা ইউজারের সব ডাটা ডাটাবেজ থেকে নেওয়া হলো
        $user = auth()->user(); 
        
        // আপনার সাইডবারে নোটিশ দেখানোর জন্য লেটেস্ট নোটিশও পাস করছি
        $notice = \App\Models\Notice::where('is_active', true)->latest()->first();

        return view('user.profile', compact('user', 'notice'));
    }
}