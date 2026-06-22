#!/bin/sh
set -e

cd /var/www/html

# توليد APP_KEY لو غير موجود (فقط في حالة عدم وجوده)
if [ -z "$APP_KEY" ]; then
    echo "⚠️  APP_KEY غير موجود — تأكد من إضافته في .env أو Kubernetes Secret"
fi

# الـ cache يتم بناؤه هنا — وقت التشغيل، بعد توفر متغيرات البيئة
php artisan config:cache
php artisan route:cache
php artisan view:cache

# تشغيل migrations تلقائياً عند بدء أي container (اختياري — احذف لو لا تريد)
# php artisan migrate --force

echo "✅ Laravel جاهز — بدء تشغيل supervisord"

exec "$@"
