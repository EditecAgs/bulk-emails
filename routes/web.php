<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendController;

Route::get('/', [SendController::class, 'index'])->name('send.index');
Route::post('/send/import',[SendController::class,'import'])->name('send.import');
Route::post('send/mails',[SendController::class,'send'])->name('send.mails');
Route::get('/progress', [SendController::class, 'progress'])->name('send.progress');
