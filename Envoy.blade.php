@setup
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
@endsetup

@servers([
    'production' => [env('DEPLOY_USER').'@'.env('DEPLOY_HOST')],
    'localhost' => ['127.0.0.1']
])

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

@task('local', ['on' => 'localhost'])
    echo 'local test'
@endtask
