<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendController;

Route::get('/', [SendController::class, 'index'])->name('send.index');
Route::post('/send/import', [SendController::class, 'import'])->name('send.import');
Route::post('/send/mails', [SendController::class, 'sendMails'])->name('send.mails');
Route::get('/send/progress', [SendController::class, 'progress'])->name('send.progress');
Route::post('/send/headers', [SendController::class, 'getHeaders'])->name('send.headers');