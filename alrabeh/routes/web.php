<?php

Route::get('/', '\Modules\Foundation\Http\Controllers\PublicBaseController@welcome');



// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
