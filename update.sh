git stash
git pull
composer install --no-dev
composer dump-autoload
php artisan migrate
php artisan config:clear
php artisan config:cache
php artisan cache:clear
npm install --production
npm run dev
