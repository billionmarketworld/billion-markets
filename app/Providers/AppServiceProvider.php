<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
       
        // ম্যানুয়ালি প্যাকেজ ও সার্ভিস ক্যাশ ফাইল লোড করা বন্ধ করা
        $this->app->instance('manifest.package', null);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Vercel বা লাইভ সার্ভারে থাকলে জোর করে HTTPS এবং /public পাথ সেট করা
        if (config('app.env') === 'production' || isset($_SERVER['HTTPS'])) {
            \URL::forceScheme('https');
            
            // Vercel-এর ভাঙা CSS/JS পাথ জোড়া দেওয়ার মেইন ট্রিক
            config(['app.asset_url' => 'https://billion-markets-live.vercel.app/public']);
        }
    }
}
