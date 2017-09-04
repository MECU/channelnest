<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/submit-video', 'VideoController@videoSubmit')->name('videoSubmit');
Route::get('/video/{video}', 'VideoController@video')->name('video');

Route::get('/video-check', 'VideoController@videoCheck')->name('videoCheck');



