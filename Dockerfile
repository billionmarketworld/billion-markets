# ১ নম্বর ধাপ: ফ্রন্টএন্ড বিল্ড করার জন্য একটি আলাদা অস্থায়ী কন্টেইনার
FROM node:18-alpine AS frontend-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
# যদি মিক্স বা ভাইট স্ক্রিপ্ট থাকে তবে বিল্ড করবে, না থাকলে স্কিপ করবে
RUN npm run build || npm run prod || npm run dev || echo "Skipping frontend build"

# ২ নম্বর ধাপ: মূল পিএইচপি সার্ভার (যা লাইভ থাকবে)
FROM serversideup/php:8.2-fpm-nginx
USER root

# প্রজেক্টের ফাইল কপি করা
COPY --chown=www-data:www-data . /var/www/html
WORKDIR /var/www/html

# ১ নম্বর ধাপের তৈরি হওয়া ফ্রন্টএন্ড ফাইলগুলো শুধু এখানে এনে বসানো (কোনো নোড ইনস্টল হবে না)
COPY --from=frontend-builder --chown=www-data:www-data /app/public /var/www/html/public

# কম মেমোরি ব্যবহার করে কম্পোজার ইনস্টল
ENV COMPOSER_MEMORY_LIMIT=-1
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# লারাভেল ক্যাশ অপ্টিমাইজ করা
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# মাইগ্রেশন এবং সার্ভার স্টার্ট কমান্ড
CMD ["sh", "-c", "php artisan migrate --force && docker-php-entrypoint php-fpm"]