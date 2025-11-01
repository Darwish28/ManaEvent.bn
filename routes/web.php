<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Moved to the top — fixes redirect issue)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\EventSubmissionController as AdminEventSubmissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminLoginController;

// ✅ Admin status API for React (Check auth session)
Route::get('/api/admin/me', function (Request $request) {
    if (auth('admin')->check()) {
        $admin = auth('admin')->user();
        return response()->json([
            'authenticated' => true,
            'user' => [
                'id' => $admin->id,
                'admin_id' => $admin->admin_id,
                'name' => $admin->name,
                'email' => $admin->email,
            ],
        ]);
    }
    return response()->json(['authenticated' => false], 200);
});

// ✅ Admin Authentication Routes
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// ✅ Admin APIs & Dashboard (Protected)
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/event-submissions', [AdminEventSubmissionController::class, 'index'])->name('admin.event-submissions.index');
    Route::put('/event-submissions/{id}', [AdminEventSubmissionController::class, 'update'])->name('admin.event-submissions.update');
    Route::delete('/event-submissions/{id}', [AdminEventSubmissionController::class, 'destroy'])->name('admin.event-submissions.destroy');
    Route::get('/dashboard/stats', [DashboardController::class, 'stats'])->name('admin.dashboard.stats');

    // ✅ React SPA Catch-All for Admin Panel
    Route::view('/{any?}', 'layouts.admin')->where('any', '.*');
});

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/

// Splash & Home
Route::get('/', fn () => view('splash'))->name('splash');
Route::get('/home', fn () => view('home'))->name('home');

// Static pages
Route::view('/about', 'about')->name('about');
Route::view('/faq', 'faq')->name('faq');
Route::view('/contact', 'contact')->name('contact');

// Event landing pages
Route::view('/events/theatre-performance', 'events.theatre-performance')->name('events.theatre-performance');
Route::view('/events/food-festival', 'events.food-festival')->name('events.food-festival');
Route::view('/events/donation', 'events.donation')->name('events.donation');
Route::view('/events/firework-show', 'events.firework-show')->name('events.firework-show');

/*
|--------------------------------------------------------------------------
| SUBMIT YOUR EVENT (Public)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\SubmitYourEventController;

Route::get('/submit-event', [SubmitYourEventController::class, 'create'])->name('submit-event');
Route::post('/submit-event', [SubmitYourEventController::class, 'store'])->name('submit-event.store');

/*
|--------------------------------------------------------------------------
| CUSTOMER AUTHENTICATION (Livewire + Controllers)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

// Login (Customer)
Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register (Customer)
Route::get('/register', \App\Livewire\Auth\Register::class)->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

// Fortify auth
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| SETTINGS (Authenticated)
|--------------------------------------------------------------------------
*/
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\TwoFactor;

Route::middleware('auth')->group(function () {
    Route::redirect('/settings', '/settings/profile');

    Route::get('/settings/profile', Profile::class)->name('settings.profile');
    Route::get('/settings/password', Password::class)->name('settings.password');
    Route::get('/settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('/settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
