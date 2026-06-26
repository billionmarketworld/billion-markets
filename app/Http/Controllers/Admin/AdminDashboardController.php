<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Models\Notice;

class AdminDashboardController extends Controller
{
    // ড্যাশবোর্ড ইনডেক্স
    public function index()
    {
        $totalDeposits = Deposit::where('status', 'Approved')->sum('amount');
        $totalWithdraws = Withdraw::where('status', 'Approved')->sum('amount');
        $pendingDeposits = Deposit::where('status', 'Pending')->count();
        $pendingWithdraws = Withdraw::where('status', 'Pending')->count();

        return view('admin.dashboard', compact('totalDeposits', 'totalWithdraws', 'pendingDeposits', 'pendingWithdraws'));
    }

    // নতুন যোগ করা মেথড (যা missing ছিল)
    public function deposits() 
    {
        $deposits = Deposit::all();
        return view('admin.deposits', compact('deposits'));
    }

    public function updateDepositStatus(Request $request, $id) {
        $deposit = Deposit::findOrFail($id);
        $deposit->status = $request->status;
        $deposit->save();
        return back()->with('success', 'Deposit updated!');
    }

    public function withdraws() {
        $withdraws = Withdraw::all();
        return view('admin.withdraws', compact('withdraws'));
    }

    public function updateWithdrawStatus(Request $request, $id) {
        $withdraw = Withdraw::findOrFail($id);
        $withdraw->status = $request->status;
        $withdraw->save();
        return back()->with('success', 'Withdraw updated!');
    }

    public function manageBonus()
    {
        // সব ইউজারদের তুলে আনুন (যদি ডাটাবেজে ইউজার থাকে তবেই এটি কাজ করবে)
        $users = \App\Models\User::all();
        
        // ডাটা আদৌ আসছে কি না চেক করার জন্য
        if ($users->isEmpty()) {
            // যদি ডাটা না থাকে, তবে মেসেজ দিবে
            return view('admin.manage_bonus', ['users' => collect()]);
        }

        return view('admin.manage_bonus', compact('users'));
    }

    public function updateBonus(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->bonus_balance = $request->bonus_balance;
        $user->save();
        return back()->with('success', 'Bonus updated!');
    }
    // নোটিশ এডিট করার পেজ ভিউ
    public function editNotice()
    {
        $notice = Notice::latest()->first();
        return view('admin.notice', compact('notice'));
    }

    // নোটিশ ডাটাবেজে সেভ বা আপডেট করার মেথড
    public function updateNotice(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        Notice::updateOrCreate(
            ['id' => 1], // আইডি ১ নম্বরেই সবসময় ডাটা ওভাররাইট/আপডেট হবে
            [
                'content' => $request->content,
                'is_active' => $request->has('is_active') ? true : false
            ]
        );

        return redirect()->back()->with('success', 'Notice updated successfully!');
    }
}