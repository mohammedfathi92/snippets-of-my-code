<?php

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
// Route::get('/hooom', function () {
//     return view('frontend.home.index');
// });



Route::group(['prefix' => 'admin','namespace'=>'backend'], function () {
 
     


});


//Laravel-filemanager get routes overwrite
Route::group([
    'prefix' => 'laravel-filemanager',
], function () {
    $images_url = '/' . \Config::get('lfm.images_folder_name') . '/{base_path}/{image_name}';
    $files_url = '/' . \Config::get('lfm.files_folder_name') . '/{base_path}/{file_name}';
    Route::get($images_url, '\Unisharp\Laravelfilemanager\controllers\RedirectController@getImage')
        ->where('image_name', '.*');
    Route::get($files_url, '\Unisharp\Laravelfilemanager\controllers\RedirectController@getFIle')
        ->where('file_name', '.*');
});

Auth::routes();

Route::group([
    'prefix' => 'systems',
], function () {

});

//Start frontend Routes
Route::get('/', 'HomeController@index')->name('home');

Route::get('/contact-us', 'ContactsController@index')->name('contactus');



