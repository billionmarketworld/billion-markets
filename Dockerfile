FROM serversideup/php:8.2-fpm-nginx

# রুট ইউজার হিসেবে কাজ করা
USER root

# মেমোরি লিমিট বাড়ানোর জন্য এনভায়রনমেন্ট সেট করা
ENV COMPOSER_MEMORY_LIMIT=-1

# প্রয়োজনীয় টুলস ইনস্টল করা (শুধু যা না হলেই নয়)
RUN apt-get update && apt-get install -y nodejs npm --no-install-recommends && rm -rf /var/list/apt/lists/*

# প্রজেক্টের সব ফাইল কントেনারে কপি করা
COPY --chown=www-data:www-data . /var/www/html

# ওয়ার্কিং ডিরেক্টরি সেট করা
WORKDIR /var/www/html

# কম মেমোরি খরচ করে ডিপেন্ডেন্সি ইনস্টল করা
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# লারাভেল ক্যাশ অপ্টিমাইজ করা
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# কন্টেইনার চালুর মেইন কমান্ড
CMD ["sh", "-c", "php artisan migrate --force && docker-php-entrypoint php-fpm"]