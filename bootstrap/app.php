<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we create a custom application class to bypass Vercel's read-only
| filesystem restriction by routing the cache directory to /tmp.
|
*/

class VercelApplication extends Illuminate\Foundation\Application
{
    public function bootstrapPath($path = '')
    {
        // লারাভেল যখনই ক্যাশ ফাইল লিখতে বা পড়তে যাবে, আমরা তাকে /tmp ফোল্ডারে পাঠিয়ে দেব
        if (str_contains($path, 'cache')) {
            $tmpCachePath = '/tmp/bootstrap/cache';
            if (!file_exists($tmpCachePath)) {
                @mkdir($tmpCachePath, 0775, true);
            }
            return '/tmp/bootstrap/' . $path;
        }

        return parent::bootstrapPath($path);
    }
}

// ডিফল্ট Application-এর বদলে আমাদের কাস্টম VercelApplication ইন্সট্যান্স তৈরি করছি
$app = new VercelApplication(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
*/

return $app;