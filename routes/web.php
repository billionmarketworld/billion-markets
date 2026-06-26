<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// হোমপেজ রাউট
Route::get('/', function () {
    return view('welcome');
});

// অথেন্টিকেটেড ইউজারদের জন্য রাউট গ্রুপ
Route::middleware(['auth', 'verified'])->group(function () {
    
    // ড্যাশবোর্ড
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // ইনভেস্টমেন্ট পেজ
    Route::get('/investment', [DashboardController::class, 'investment'])->name('investment');
    
    // ডিপোজিট রাউটস (নাম 'deposit' ই রাখা হলো)
    Route::get('/deposit', [DashboardController::class, 'deposit'])->name('deposit');
    Route::post('/deposit/store', [DashboardController::class, 'depositStore'])->name('deposit.store');
    
    // উইথড্র রাউটস (নাম 'withdraw' ই রাখা হলো)
    Route::get('/withdraw', [DashboardController::class, 'withdraw'])->name('withdraw');
    Route::post('/withdraw/store', [DashboardController::class, 'withdrawStore'])->name('withdraw.store');
    
    // প্রোফাইল ম্যানেজমেন্ট
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/my-profile', [DashboardController::class, 'showProfile'])->name('user.profile');
});

// অ্যাডমিন প্যানেলের রাউট গ্রুপ
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/deposits', [AdminDashboardController::class, 'deposits'])->name('deposits.index');
    Route::post('/deposits/{id}/status', [AdminDashboardController::class, 'updateDepositStatus'])->name('deposits.status');
    
    Route::get('/withdraws', [AdminDashboardController::class, 'withdraws'])->name('withdraws.index');
    Route::post('/withdraws/{id}/status', [AdminDashboardController::class, 'updateWithdrawStatus'])->name('withdraws.status');
    
    // বোনাস ম্যানেজমেন্ট রাউটস
    Route::get('/bonus', [AdminDashboardController::class, 'manageBonus'])->name('bonus.index');
    Route::post('/bonus/{id}/update', [AdminDashboardController::class, 'updateBonus'])->name('bonus.update');
    
    // 📢 নোটিশ কন্ট্রোল রাউটস (শুধু এই দুটি লাইনই থাকবে)
    Route::get('/notice', [AdminDashboardController::class, 'editNotice'])->name('notice.index');
    Route::post('/notice/update', [AdminDashboardController::class, 'updateNotice'])->name('notice.update');
});

require __DIR__.'/auth.php';