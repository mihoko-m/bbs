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

Route::get('/', 'ReviewController@index');
Route::get('faculties/{faculty}', 'FacultyController@index');
Route::group(['middleware' => ['auth','verified']], function(){
    Route::post('/reviews', 'ReviewController@store');
    Route::get('/reviews/create', 'ReviewController@create');
    Route::get('/reviews/{review}/edit', 'ReviewController@edit');
    Route::get('/questions/{review}/create','QuestionController@create');
    Route::post('/questions/{review}','QuestionController@store');
    Route::put('/reviews/{review}', 'ReviewController@update');
    Route::get('/reviews/{review}', 'ReviewController@show');
    Route::delete('/reviews/{review}', 'ReviewController@delete');
    Route::get('/users/{user}/mypage', 'UserController@mypage');
});
Auth::routes(['verify' => true]);