<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // ইউজার লগইন করা আছে কিনা এবং সে অ্যাডমিন (is_admin == 1) কিনা চেক করা
        if (auth()->check() && auth()->user()->is_admin == 1) {
            return $next($request);
        }

        // অ্যাডমিন না হলে তাকে ইউজার ড্যাশবোর্ডে পাঠিয়ে দেওয়া এবং একটি এরর মেসেজ দেখানো
        return redirect()->route('dashboard')->with('error', 'You do not have administrator access.');
    }
}
