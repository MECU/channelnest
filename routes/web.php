<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/submit-video', 'VideoController@submit')->name('videoSubmit');
Route::get('/video/{video}', 'VideoController@video')->name('video');



