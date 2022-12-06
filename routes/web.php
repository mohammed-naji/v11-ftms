<?php

use App\Http\Controllers\RelationController;
use Illuminate\Support\Facades\Route;

Route::get('profile', [RelationController::class, 'profile']);
