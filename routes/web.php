<?php

use App\Http\Controllers\AbouteUsAdminController;
use App\Http\Controllers\AbouteUsController;
use App\Http\Controllers\AdminAdsController;
use App\Http\Controllers\IdeaController;
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

Route::get('/', [IdeaController::class,'index'])->name('idea.index');
Route::get('/ideas/{idea}/{slug?}', [IdeaController::class,'show'])->name('idea.show');
Route::get('/aboute-us',[AbouteUsController::class,'index'])->name('aboute.index');
Route::get('/admin/aboute-us',[AbouteUsAdminController::class,'index'])->name('aboute.admin.index')->middleware('admin');
Route::post('/admin/aboute-us/edit/{AbouteUs}',[AbouteUsAdminController::class,'update'])->name('aboute.admin.edit')->middleware('admin');
Route::get('/admin/ads',[AdminAdsController::class,'index'])->name('ads.admin.index')->middleware('admin');
Route::put('/admin/ads',[AdminAdsController::class,'update'])->name('ads.admin.edit')->middleware('admin');
Route::delete('/admin/ads',[AdminAdsController::class,'destroy'])->name('ads.admin.delete')->middleware('admin');



require __DIR__.'/auth.php';
