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

    /*\App\User::create([
        'name' => 'Константин',
        'email' => 'archvile.bk@ya.ru',
        'password' => 'foo'
    ]);*/


    //dd(\App\User::search('Mr.')->get()->pluck('name'));
    dd(\App\User::search('Dr.')->get()->pluck('name'));


    return view('welcome');
});
