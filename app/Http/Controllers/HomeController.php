<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ড্যাশবোর্ড পেজ লোড হওয়ার সময় টোটাল ডিপোজিট হিসাব করে পাঠানো
    public function index()
    {
        $totalDeposit = Deposit::where('user_id', auth()->id())
                               ->where('status', 'Approved')
                               ->sum('amount');

        return view('dashboard', compact('totalDeposit'));
    }
}