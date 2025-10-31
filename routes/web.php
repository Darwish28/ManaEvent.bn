<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

/*
|--------------------------------------------------------------------------
| Public Pages
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
Route::view('/events/food-festival',      'events.food-festival')->name('events.food-festival');
Route::view('/events/donation',            'events.donation')->name('events.donation');
Route::view('/events/firework-show',       'events.firework-show')->name('events.firework-show');


/*
|--------------------------------------------------------------------------
| Submit Your Event (Public)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\SubmitYourEventController;

Route::get('/submit-event',  [SubmitYourEventController::class, 'create'])
    ->name('submit-event');         // form page

Route::post('/submit-event', [SubmitYourEventController::class, 'store'])
    ->name('submit-event.store');   // form handler


/*
|--------------------------------------------------------------------------
| Authentication (Livewire views + Controllers)
|--------------------------------------------------------------------------
| GET shows Livewire pages. POST handled by controllers with distinct names.
*/
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

// Login
Route::get('/login',  \App\Livewire\Auth\Login::class)->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register',  \App\Livewire\Auth\Register::class)->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

// Fortify/other auth scaffolding
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Dashboard (Authenticated)
|--------------------------------------------------------------------------
*/
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Settings (Authenticated, Livewire)
|--------------------------------------------------------------------------
*/
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\TwoFactor;

Route::middleware('auth')->group(function () {
    // Redirect /settings -> /settings/profile
    Route::redirect('/settings', '/settings/profile');

    Route::get('/settings/profile',    Profile::class)->name('settings.profile');
    Route::get('/settings/password',   Password::class)->name('settings.password');
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


/*
|--------------------------------------------------------------------------
| Admin (Authenticated)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\EventSubmissionController as AdminEventSubmissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AdminUserController;

// Admin API outside prefix (as you had it)
Route::get('/api/users', [AdminUserController::class, 'index'])->name('api.users');

// Admin pages & APIs (secured)
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Event submissions
    Route::get('/event-submissions',          [AdminEventSubmissionController::class, 'index'])->name('admin.event-submissions.index');
    Route::put('/event-submissions/{id}',     [AdminEventSubmissionController::class, 'update'])->name('admin.event-submissions.update');
    Route::delete('/event-submissions/{id}',  [AdminEventSubmissionController::class, 'destroy'])->name('admin.event-submissions.destroy');

    // Dashboard stats API
    Route::get('/dashboard/stats', [DashboardController::class, 'stats'])->name('admin.dashboard.stats');

    // Catch-all admin shell (must be last in this group)
    Route::view('/{any?}', 'layouts.admin')->where('any', '.*');
});
