<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::group([
    'prefix'=>'To-Do-List',
    'middleware'=>['auth']
] ,function(){
    Route::get('/all.task', [App\Http\Controllers\WorksController::class, 'index'])->name('work.index');
    Route::get('/create.task', [App\Http\Controllers\WorksController::class, 'create'])->name('work.create');
    Route::post('/add.task', [App\Http\Controllers\WorksController::class, 'store'])->name('work.store');
    Route::post('/Change.status/{id}', [App\Http\Controllers\WorksController::class, 'ChangeStatus'])->name('work.status');
    Route::get('/show.status', [App\Http\Controllers\WorksController::class, 'show'])->name('work.show');
    Route::post('/delete.task/{id}', [App\Http\Controllers\WorksController::class, 'destroy'])->name('work.destroy');
    Route::get('/edit.task/{id}', [App\Http\Controllers\WorksController::class, 'edit'])->name('work.edit');
    Route::put('/update.task/{id}', [App\Http\Controllers\WorksController::class, 'update'])->name('work.update');


});


