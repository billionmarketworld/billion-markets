FROM serversideup/php:8.2-fpm-nginx

# রুট ইউজার হিসেবে কন্টেন্ট কপি করা
USER root

# প্রয়োজনীয় এক্সটেনশন এবং টুলস ইনস্টল করা
RUN apt-get update && apt-get install -y nodejs npm

# প্রজেক্টের সব ফাইল কন্টেনারে কপি করা
COPY --chown=www-data:www-data . /var/www/html

# ওয়ার্কিং ডিরেক্টরি সেট করা
WORKDIR /var/www/html

# ডিপেন্ডেন্সি ইনস্টল এবং ফ্রন্টএন্ড বিল্ড করা (মিক্স বা ভাইট যেকোনো একটি রান হবে)
RUN composer install --no-dev --optimize-autoloader
RUN npm install && (npm run build || npm run prod || npm run dev || echo "No build script found, skipping")

# লারাভেল ক্যাশ ক্লিয়ার ও অপ্টিমাইজ করা
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# অ্যাপ্লিকেশন রান করার কমান্ড
CMD ["php", "artisan", "migrate", "--force"]