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
    Route::post('/questions/{review}','QuestionController@store');
    Route::get('/questions/{review}/create','QuestionController@create');
    Route::get('/reviews/{review}/questions/{question}/answers/create','QuestionController@answercreate');
    Route::delete('/reviews/{review}/questions/{question}/answers/{answer}/replies/{reply}','QuestionController@replydelete');
    Route::post('/reviews/{review}/questions/{question}/answers/{answer}/replies','QuestionController@replystore');
    Route::get('/reviews/{review}/questions/{question}/answers/{answer}','QuestionController@show');
    Route::delete('/reviews/{review}/questions/{question}/answers/{answer}','QuestionController@answerdelete');
    Route::post('/reviews/{review}/questions/{question}/answers','QuestionController@answerstore');
    Route::delete('/reviews/{review}/questions/{question}','QuestionController@delete');
    Route::put('/reviews/{review}', 'ReviewController@update');
    Route::get('/reviews/{review}', 'ReviewController@show');
    Route::delete('/reviews/{review}', 'ReviewController@delete');
    Route::get('/users/{user}/mypage/edit', 'UserController@edit');
    Route::get('/users/{user}/mypage', 'UserController@mypage');
    Route::put('users/{user}','UserController@update');
});
Auth::routes(['verify' => true]);