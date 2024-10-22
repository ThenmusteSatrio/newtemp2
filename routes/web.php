<?php

use App\Http\Middleware\isLogin;
use App\Http\Middleware\loginGuard;
use App\Livewire\Car;
use App\Livewire\Dashboard;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Member;
use App\Livewire\Permintaan;
use App\Livewire\Petugas;
use App\Livewire\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/')->middleware(isLogin::class);
Route::get('/login', Login::class)->name('login')->middleware(loginGuard::class);
Route::get('/register', Register::class)->name('register')->middleware(loginGuard::class);


Route::middleware(['roleGuard:admin'])->group(function () {
    Route::get('/admin/control/panel/dashboard', Dashboard::class)->name('admin.panel.dashboard');
    Route::get('/admin/control/panel/member', Member::class)->name('admin.panel.member');
    Route::get('/admin/control/panel/petugas', Petugas::class)->name('admin.panel.petugas');
});

Route::middleware(['roleGuard:petugas'])->group(function () {
    Route::get('/petugas/control/panel/cars', Car::class)->name('admin.panel.cars');
    Route::get('/petugas/control/panel/dashboard', Dashboard::class)->name('petugas.panel.dashboard');
    Route::get('/petugas/control/panel/permintaan', Permintaan::class)->name('petugas.panel.permintaan');
});

Route::middleware(['roleGuard:member'])->group(function () {
    Route::get('/home', Home::class)->name('home');
});


Route::fallback(function () {
    return view('unauthorized');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});
