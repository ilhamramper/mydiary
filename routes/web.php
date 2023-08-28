<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\EmojiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/diary', [DiaryController::class, 'index'])->name('diary.index');
Route::get('/trash', [DiaryController::class, 'trash'])->name('diary.trash');
Route::get('/diary/create', [DiaryController::class, 'create'])->name('diary.create');
Route::post('/diary', [DiaryController::class, 'store'])->name('diary.store');
Route::get('/diary/{id}/edit', [DiaryController::class, 'edit'])->name('diary.edit');
Route::delete('/diary/{id}', [DiaryController::class, 'destroy'])->name('diary.destroy');
Route::put('/diary/{id}', [DiaryController::class, 'update'])->name('diary.update');
Route::post('/diary/{id}/restore', [DiaryController::class, 'restore'])->name('diary.restore');
Route::delete('/diary/{id}/force-delete', [DiaryController::class, 'forceDelete'])->name('diary.forceDelete');
Route::get('/emoji', [EmojiController::class, 'index'])->name('emoji.index');
Route::get('/emoji/create', [EmojiController::class, 'create'])->name('emoji.create');
Route::post('/emoji', [EmojiController::class, 'store'])->name('emoji.store');
Route::delete('/emoji/{id}', [EmojiController::class, 'destroy'])->name('emoji.destroy');
Route::get('/check-emoji/{unicodeHex}', [EmojiController::class, 'checkEmoji'])->name('emoji.check');
