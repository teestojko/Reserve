<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\QRScannerController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\ShopRepresentativeLoginController;
use App\Http\Controllers\ShopRepresentative\ShopRepresentativeController;
use App\Http\Controllers\ShopRepresentative\ShopEditController;
use App\Http\Controllers\ShopRepresentative\ReservationListController;
use App\Http\Controllers\Admin\AdminEmailController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ShopOwnerCreateController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\EvaluationEditController;

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
Route::get('/home', [AuthController::class, 'index'])->name('home');
Route::get('/filter', [SearchController::class, 'filter'])->name('shops_filter');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/edit', [ShopOwnerCreateController::class, 'create'])->name('edit_create');
        Route::post('/store', [ShopOwnerCreateController::class, 'store'])->name('store');
        Route::get('/send_email', [AdminEmailController::class, 'showForm'])->name('send_email_form');
        Route::post('/send_email', [AdminEmailController::class, 'sendEmail'])->name('send_email');
        Route::get('/admin/import', [ImportController::class, 'showImport'])->name('show-import');
        Route::post('/admin/import', [ImportController::class, 'store'])->name('import-store');
        Route::get('/admin/evaluations', [EvaluationEditController::class, 'index'])->name('evaluations-index');
        Route::delete('/admin/evaluations/{evaluation}', [EvaluationEditController::class, 'destroy'])
        ->name('evaluations-destroy');
    });
});

Route::prefix('shop_representative')->name('shop_representative.')->group(function () {
    Route::get('/login', [ShopRepresentativeLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ShopRepresentativeLoginController::class, 'login']);

    Route::middleware('auth:shop_representative')->group(function () {
        Route::get('/dashboard', [ShopRepresentativeController::class, 'dashboard'])->name('dashboard');
        Route::get('/create', [ShopRepresentativeController::class, 'create'])->name('shop_create');
        Route::post('/store', [ShopRepresentativeController::class, 'store'])->name('shop_store');
        Route::get('/{id}/edit', [ShopEditController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [ShopEditController::class, 'update'])->name('update');
        Route::get('/reservation/list', [ReservationListController::class, 'reservationList'])->name('reservations_list');
        Route::get('/reservation/list/{date}', [ReservationListController::class, 'changeReservationDate'])->name('attendance_date');
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/thanks', function (Request $request) {
        return view('auth.verify_email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->intended(RouteServiceProvider::HOME);
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'メールを再送信しました');
    })->middleware('throttle:6,1')->name('verification.send');

    Route::middleware('verified')->group(function () {
        Route::get('/', [IndexController::class, 'userMyPage'])->name('user_my_page');

        Route::get('/my_page/{shop}', [MyPageController::class, 'showMyPage'])->name('myPage');
        Route::delete('/reservations/{reservation}', [MyPageController::class, 'destroyReservation'])->name('reservations.destroy');

        Route::get('/detail/{shop}', [ShopController::class, 'show'])->name('shops.show');
        Route::get('/shops/{shop}/evaluations', [ShopController::class, 'showAllEvaluations'])
        ->name('shop-all-evaluations');

        Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.show');
        Route::post('/payment/success', [PaymentController::class, 'payment'])->name('payment.process');

        Route::post('/favorites/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle.add');
        Route::delete('/favorites/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle.remove');

        Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
        Route::get('/done', [ReservationController::class, 'showThanksPage'])->name('payment.thanks');
        Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
        Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');

        Route::get('/qr_scanner/{reservationId}', [QRScannerController::class, 'generateQRCode'])->name('qr_scanner');
        Route::get('/qr_scanner/check_in/{reservationId}', [QRScannerController::class, 'showCheckInPage'])->name('show_check_in');
        Route::post('/qr_scanner/check_in/{reservationId}', [QRScannerController::class, 'confirmCheckIn'])->name('confirm_check_in');

        Route::get('/review/{shop}', [ReviewController::class, 'review'])->name('reviews.review');
        Route::get('/shops/{shop}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::post('/shops/{shop}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::delete('/reviews/index/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

        Route::get('/evaluation/{shop}', [EvaluationController::class, 'evaluation'])->name('shop-evaluation');
        Route::post('/shops/{shop}/evaluations', [EvaluationController::class, 'store'])->name('evaluations-store');
        Route::get('/evaluations/{id}/edit', [EvaluationController::class, 'edit'])->name('evaluations.edit');
        Route::put('/evaluations/{id}', [EvaluationController::class, 'update'])->name('evaluations-update');
        Route::delete('/evaluations/{id}', [EvaluationController::class, 'destroy'])->name('evaluations-destroy');
        Route::get('/shops/{shop}/evaluations', [EvaluationController::class, 'index'])->name('shop-all-evaluations');
    });
});
