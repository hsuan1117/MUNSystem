git stash
git pull
php composer.phar install --no-dev
php composer.phar dump-autoload
php artisan migrate
php artisan config:clear
php artisan config:cache
php artisan cache:clear
npm install --production
npm run dev
