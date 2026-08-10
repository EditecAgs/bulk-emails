<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendController;

Route::get('/', [SendController::class, 'index'])->name('send.index');
Route::post('/send/import', [SendController::class, 'import'])->name('send.import');
Route::post('/send/mails', [SendController::class, 'sendMails'])->name('send.mails');
Route::get('/send/progress', [SendController::class, 'progress'])->name('send.progress');
Route::post('/send/headers', [SendController::class, 'getHeaders'])->name('send.headers');

Route::post('/templates/store', [SendController::class, 'storeTemplate'])->name('templates.store');
Route::get('/templates/{id}', [SendController::class, 'getTemplate'])->name('templates.get');
Route::get('/templates', [SendController::class, 'getTemplates'])->name('templates.getAll');
Route::delete('/templates/{id}', [SendController::class, 'deleteTemplate'])->name('templates.delete');