<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserAccountController;
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

Route::get('/',[IndexController::class, 'index'])->name('main');
Route::get('/Hello',[IndexController::class,'show'])->name('show');
Route::resource('listing', ListingController::class)->only(['show','index']);


Route::get('login',[\App\Http\Controllers\AuthController::class, 'create'])->name('login');
Route::post('login',[\App\Http\Controllers\AuthController::class , 'store'])->name('login.store');
Route::delete('logout',[\App\Http\Controllers\AuthController::class , 'destroy'])->name('logout');

Route::resource('user-account', UserAccountController::class)->only(['create','store']);

Route::prefix('realtor')->name('realtor.')->middleware('auth')->group(function(){
    Route::name('listing.restore')->put('listing/{listing}/restore',
    [\App\Http\Controllers\RealtorListingController::class, 'restore']
    )->withTrashed();

   Route::resource('listing',\App\Http\Controllers\RealtorListingController::class)->only(['index','destroy','edit','update', 'store', 'create'])->withTrashed(['show','edit','update']);
});
