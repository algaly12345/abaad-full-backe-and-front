<?php

use App\Http\Controllers\Dashboard\agent\EstateController;
use Illuminate\Support\Facades\Route;

Route::prefix('agents')->middleware(['agent'])->group(function () {
    Route::get('test', function () {
        // dd("iam agent");
    })->name('agentOk');

    Route::get('/estates', [EstateController::class,'index'])->name('estates.index');
    Route::get('/estates/create', [EstateController::class,'create'])->name('estates.create');

    // Route::get()
});
