<?php

use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    //dump('Test laravel app');
    dump(env('DEPLOY_USER'));
    dump(env('DEPLOY_HOST'));
});
