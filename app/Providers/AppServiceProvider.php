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
        if (config('app.env') === 'production' || isset($_SERVER['HTTPS'])) {
            \URL::forceScheme('https');
        }
    }
}
