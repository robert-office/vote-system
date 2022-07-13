<?php

use App\Http\Controllers\OptionController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SurveyController::class, 'index']);
Route::resource('enquetes', SurveyController::class);


Route::resource('options', OptionController::class);
