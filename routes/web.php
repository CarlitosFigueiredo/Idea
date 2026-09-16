<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StepController;
use App\Models\Idea;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/ideas');

Route::middleware('auth')->group(function () {

    Route::get('/ideas', [IdeaController::class, 'index'])->name('ideas.index');
    Route::post('/ideas/store', [IdeaController::class, 'store'])->name('ideas.store');

    Route::get('/ideas/{idea}', [IdeaController::class, 'show'])
        ->name('ideas.show')
        ->can('workWith', Idea::class);

    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('ideas.destroy');

    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('ideas.edit');
    Route::post('/ideas/{idea}/update', [IdeaController::class, 'update'])->name('ideas.update');
    Route::patch('/steps/{step}', [StepController::class, 'update'])->name('step.upddate');
    Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');
});

Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);
});
