<?php

Route::group(['namespace' => 'App\Modules\Registration\Profile\Controllers', 'prefix' => 'reg/profile'], function () {
    
    Route::post('/new', 'ProfileController@insertSingleRecord');

});