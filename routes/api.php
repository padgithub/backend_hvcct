<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('jwt')->group(function() {

    # Folder Auth
    Route::namespace('Auth')->group(function() {
        Route::get('me', 'AuthController@me');
        Route::post('logout', 'AuthController@logout');
    });

    Route::namespace('Api')->group(function() {
        # Get all info
        Route::resource('info_users', 'UserController');
        Route::resource('info_apps', 'AppController');
        Route::resource('info_scores', 'ScoreController');
        Route::resource('info_questions', 'QuestionController');
        Route::resource('info_wins', 'WinController');

        # Get every one by id
        Route::get('get_users/name', 'UserController@get_name');
        Route::get('get_apps/name', 'AppController@get_name');

        # Push notify
        Route::resource('push_notify', 'NotifyController');

        # Import Export
        Route::get('export/template_questions', 'QuestionController@exportTemplate');
        # Export all
        Route::get('export/questions', 'QuestionController@export');
        # Import
        Route::post('import/questions', 'QuestionController@import');
    });
});

# Folder Api
Route::namespace('Auth')->group(function() {
    #Web
    Route::post('login_web', 'AuthController@login')->name('login_web');
});

# Folder Api
Route::namespace('Api')->group(function() {
    #App
    Route::post('login', 'RequestController@updateApp');


    Route::get('info_app', 'RequestController@infoApp');
    Route::get('info_question/{app_id}', 'RequestController@infoQuestion');
    Route::get('info_score/{app_id}', 'RequestController@infoScore');
    Route::post('info_result', 'RequestController@infoResult');
    Route::post('info_phone', 'RequestController@infoPhone');
});
