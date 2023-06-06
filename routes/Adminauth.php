<?php
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;


Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('guest:admin')->group(function(){
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

        //  forgot-password
        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});


Route::middleware(['auth:admin'])->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class) ->middleware(['signed', 'throttle:6,1']) ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store']) ->middleware('throttle:6,1') ->name('verification.send');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
});


    // Authenticated routes

    Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware(['auth:admin', 'verified'])->group(function(){
            Route::get('/', [AdminDashboardController::class, 'Admin_dashboard'])->name('index');
            Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    });
?>
