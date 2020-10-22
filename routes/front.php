<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'front.home.show');

Route::name('front.')->group(function(){

});