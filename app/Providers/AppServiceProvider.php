<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Vercel-এর রিড-অনলি ফাইল সিস্টেমের জন্য রানটাইম ক্যাশ রাইট বন্ধ করা
        $this->app->useBootstrapCachePath('/tmp/bootstrap/cache');
        
        // ম্যানুয়ালি প্যাকেজ ও সার্ভিস ক্যাশ ফাইল লোড করা বন্ধ করা
        $this->app->instance('manifest.package', null);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
