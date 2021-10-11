<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', [App\Http\Controllers\apiController::class, 'test'])->name('test');
Route::get('/test2', [App\Http\Controllers\apiController::class, 'test2'])->name('test2');

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function() {
    //
    Route::get('getSchedule/', [App\Http\Controllers\generalController::class, 'all'])->name('all');

    Route::get('getAllItem/', [App\Http\Controllers\itemController::class, 'getAll'])->name('getAllI');
    Route::get('removeItem/{j_id}', [App\Http\Controllers\itemController::class, 'remove'])->name('remove');
    Route::post('updateItem/', [App\Http\Controllers\itemController::class, 'update'])->name('updateI');
    Route::post('saveItem/', [App\Http\Controllers\itemController::class, 'save'])->name('saveI');

    ////////

    Route::get('getAllHoliday/', [App\Http\Controllers\holidayController::class, 'getAll'])->name('getAllH');
    Route::get('removeHoliday/{j_id}', [App\Http\Controllers\holidayController::class, 'remove'])->name('removeH');
    Route::post('updateHoliday/', [App\Http\Controllers\holidayController::class, 'update'])->name('updateH');
    Route::post('saveHoliday/', [App\Http\Controllers\holidayController::class, 'save'])->name('saveH');
});
