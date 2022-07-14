<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::resource('enquetes', SurveyController::class);
Route::resource('options', OptionController::class);

Route::post('/votes/{survey}', [VoteController::class, 'store']);
