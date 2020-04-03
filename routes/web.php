<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\YandexController;
use App\Http\Controllers\Auth\MailruController;
use App\Http\Controllers\Auth\VkController;

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
    return view('welcome');
});

Route::prefix('yandex')->group(function () {
    Route::get('/auth', [YandexController::class, 'auth'])->name('oauth.yandex.auth');
    Route::get('/callback', [YandexController::class, 'callback'])->name('oauth.yandex.callback');
    Route::get('/info', [YandexController::class, 'info'])->name('oauth.yandex.info');
});

Route::prefix('vk')->group(function () {
    Route::get('/auth', [VkController::class, 'auth'])->name('oauth.vk.auth');
    Route::get('/callback', [VkController::class, 'callback'])->name('oauth.vk.callback');
    Route::get('/info', [VkController::class, 'info'])->name('oauth.vk.info');
});
