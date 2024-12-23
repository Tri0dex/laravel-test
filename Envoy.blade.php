@servers(['production' => ['germanstar@77.222.40.238']])

@task('deploy', ['on' => 'production'])
    cd /home/g/germanstar/laravel-test
    set -e
    echo "Deploying..."
{{--    $HOME/bin/composer -v--}}
{{--    composer -v--}}
    git pull origin main
    php artisan down
    $HOME/bin/composer install --no-dev --optimize-autoloader

    php artisan migrate --force
    php artisan config:cache
    php artisan event:cache
    php artisan route:cache
    php artisan view:cache

    php artisan up
    echo "Done"
@endtask
