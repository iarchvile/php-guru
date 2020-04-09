<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $post = new App\Pattern\Post();

    $post->title = 'This is a title';

    $post->foo = 'bar';

    $post->zzz = 'bare';

    unset($post->zzz);

    \View::share([
        'post' => $post,
    ]);

    return view('welcome');
});
