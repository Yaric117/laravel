<?php

//Главная

use Illuminate\Support\Facades\Auth;

Route::get('/', 'IndexController@getIndex')->name('index');

/*
|--------------------------------------------------------------------------
| News
|--------------------------------------------------------------------------
|
| News content
|
*/

Route::group([

    'prefix' => 'news',
    'namespace' => 'News',
    'as' => 'news.'

], function () {

    //Все новости
    Route::get('/', 'IndexController@index')->name('all');

    //Категория новостей
    Route::get('/rubric/{category}', 'IndexController@category')->name('category');

    //Детальная новости
    Route::get('/rubric/{category}/{news}', 'IndexController@showOne')->name('one');
});

/*
|--------------------------------------------------------------------------
| Manager
|--------------------------------------------------------------------------
|
| Admin panel
|
*/

Route::group([

    'prefix' => 'manager',
    'namespace' => 'Admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'is_admin']

], function () {

    Route::get('/', 'IndexController@index')->name('index');
});

Route::group([

    'prefix' => 'manager',
    'namespace' => 'Admin',
    'middleware' =>  ['auth', 'is_admin']

], function () {

    //CRUD  НОВОСТИ

    //category news admin
    Route::get('news/rubric/{category}', 'NewsController@category')->name('news.category-admin');

    //basketNews
    Route::get('news/basket', 'NewsController@basket')->name('news.basket');
    Route::post('news/basket-delete', 'NewsController@deleteFromBasket')->name('news.deleteFromBasket');
    Route::post('news/basket-restore', 'NewsController@restoreFromBasket')->name('news.restoreFromBasket');

    //resources News
    Route::resource('news', 'NewsController');

    //resources User
    Route::resource('user', 'UserController');
});

Auth::routes();
