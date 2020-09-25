php composer.phar install --no-dev
php composer.phar dump-autoload
php artisan migrate:refresh --seed
php artisan config:clear
php artisan config:cache
php artisan cache:clear
php artisan key:generate
chown www-data:www-data -R *
chmod 755 -R *
npm install --production
npm run dev
