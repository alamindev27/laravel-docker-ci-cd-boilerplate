#!/bin/bash

# পুরো প্রজেক্টের ওনারশিপ আপনার বর্তমান ইউজারে ফিরিয়ে আনা
sudo chown -R $USER:$USER .

# লারাভেলের স্টোরেজ ও ক্যাশ ফোল্ডারের রাইট পারমিশন সেট করা
sudo chmod -R 775 storage bootstrap/cache public/build

# ডকার কন্টেইনারের ভেতর যেন www-data ইউজার এক্সেস পায়
sudo docker compose exec -T app chown -R www-data:www-data storage bootstrap/cache

echo "File permissions fixed successfully!"
