FROM serversideup/php:8.2-fpm-nginx

# রুট ইউজার হিসেবে কন্টেন্ট কপি করা
USER root

# প্রয়োজনীয় এক্সটেনশন এবং টুলস ইনস্টল করা
RUN apt-get update && apt-get install -y nodejs npm

# প্রজেক্টের সব ফাইল কন্টেনারে কপি করা
COPY --chown=www-data:www-data . /var/www/html

# ওয়ার্কিং ডিরেক্টরি সেট করা
WORKDIR /var/www/html

# ডিপেন্ডেন্সি ইনস্টল করা
RUN composer install --no-dev --optimize-autoloader

# লারাভেল ক্যাশ ক্লিয়ার ও অপ্টিমাইজ করা
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# কন্টেইনার চালুর পর মাইগ্রেশন রান এবং সচল রাখা
CMD ["sh", "-c", "php artisan migrate --force && ssu-entrypoint-init"]