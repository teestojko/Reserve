<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ShopController;
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

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->intended(RouteServiceProvider::HOME);
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('/', [AuthController::class, 'index'])->middleware('verified');

    Route::post('/favorites/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle.add');

    Route::delete('/favorites/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle.remove');

    Route::get('/detail/{shop}', [ShopController::class, 'show'])->name('shops.show');
});
