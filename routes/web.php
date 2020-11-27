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

    //factory(App\User::class, 100)->create();

    /*$names = [
        'Новый Год начинается с сюрпризов!',
        'Праздник чистого добра!',
        'Время чистых чудес!',
        'Новый Год в чистоте!',
        'Стирайте старое, получайте новое!',
        'Новогодние чудеса — это просто!',
        'Подари Новогоднее чудо!',
        'Новый год — время добрый дел!',
        'Новогодние чудеса от чистого сердца!',
        'Стань частью новогоднего чуда!',
    ];

    foreach ($names as $key => $name) {
        \App\User::create([
            'name' => $name,
            'email' => $key.'zarchvile.bk@ya.ru',
            'password' => 'foo'
        ]);
    }*/


    //dd(\App\User::search('Mr.')->get()->pluck('name'));
    dd(\App\User::search('Константин')->get()->pluck('name'));


    return view('welcome');
});
