<?php

use App\Http\Controllers\carController;
use Illuminate\Support\Facades\Route;
 
Route::get('/', function () {
    return view('welcome');
});
Route::resource('/car', carController::class);
