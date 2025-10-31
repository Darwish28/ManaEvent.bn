<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::view('/events/theatre-performance', 'events.theatre-performance')->name('events.theatre-performance');
Route::view('/events/food-festival', 'events.food-festival')->name('events.food-festival');
Route::view('/events/donation', 'events.donation')->name('events.donation');
Route::view('/events/firework-show', 'events.firework-show')->name('events.firework-show');
Route::view('/about', 'about')->name('about');
Route::view('/faq', 'faq')->name('faq');
Route::view('/settings', 'settings')->name('settings');
Route::view('/', 'home')->name('home');
Route::view('/contact', 'contact')->name('contact');


Route::get('/', function () {
    return view('splash');
})->name('splash');

Route::get('/home', function () {
    return view('home');
})->name('home');



Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('settings/two-factor', TwoFactor::class)
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

require __DIR__.'/auth.php';

// Event Submission Routes 
use App\Http\Controllers\EventSubmissionController as PublicEventSubmissionController;
use App\Http\Controllers\Admin\EventSubmissionController as AdminEventSubmissionController;
// 🟡 Public form submission
Route::post('/submit-event', [PublicEventSubmissionController::class, 'store'])
    ->name('submit.event');

// 🔵 Admin routes
Route::get('/admin/event-submissions', [AdminEventSubmissionController::class, 'index']);
Route::put('/admin/event-submissions/{id}', [AdminEventSubmissionController::class, 'update']);
Route::delete('/admin/event-submissions/{id}', [AdminEventSubmissionController::class, 'destroy']);

// Admin Dashboard routes 
use App\Http\Controllers\Admin\DashboardController;

Route::get('/admin/dashboard/stats', [DashboardController::class, 'stats']);

//Submit Your Event routes
use App\Http\Controllers\SubmitYourEventController;
// ✅ Route to show the submit event form
Route::get('/submit-event', [SubmitYourEventController::class, 'create'])
    ->name('submit-event'); // ✅ FIXED (hyphen version to match Blade)

// ✅ Route to handle form submission
Route::post('/submit-event', [SubmitYourEventController::class, 'store'])
    ->name('submit-event.store');
    
 //Register routes
use App\Http\Controllers\AuthController;

// GET is your Livewire page (already exists)
Route::get('/register', \App\Livewire\Auth\Register::class)->name('register');

// ADD this POST route to match your form action
Route::post('/register', [AuthController::class, 'register'])
    ->name('register.perform');

// Registrations 
use App\Http\Controllers\RegisterController;

// Registration form
Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');

// Handle registration submission
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Login routes 
use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// settings routes 

Route::middleware(['auth'])->group(function () {
    Route::get('/settings/profile', Profile::class)->name('settings.profile');
});

// Admin Registered users 
use App\Http\Controllers\AdminUserController;
Route::get('/api/users', [AdminUserController::class, 'index']);

// 🔴 THIS MUST STAY AT THE VERY BOTTOM
// Admin routes (wildcard)
Route::view('/admin/{any?}', 'layouts.admin')->where('any', '.*');
