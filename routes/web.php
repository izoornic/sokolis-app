<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserRoleIsAllowedToAccess;
use App\Models\User;
use App\Http\Controllers\HomeController;

Route::get('image/{filename}', [HomeController::class, 'index'])->name('image.displayImage');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/wellcome', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'userpremisions',
])->group(function () {
    Route::get('/dashboard', function () {
        if(auth()->user()->user_tipId == 1){
            User::getMyZgradeStanove();
            return redirect('/pocetna');
        }else{
            return redirect('/pocetna');
        }
        //return (auth()->user()->user_tipId == 1) ? redirect('/pocetna') : 
        //return view('dashboard');
    })->name('dashboard');

    Route::get('/pocetna', function () {
        return view('korisnik/pocetna');
    })->name('pocetna');

    Route::get('/prijavi-kvar', function () {
        return view('korisnik/prijavi-kvar');
    })->name('prijavi-kvar');

    Route::get('/kvar-pregled', function () {
        return view('korisnik/kvar-pregled');
    })->name('kvar-pregled');

    Route::get('/moji-racuni', function () {
        return view('korisnik/moji-racuni');
    })->name('moji-racuni');

    Route::get('/stambena-zajednica', function () {
        return view('korisnik/stambena-zajednica');
    })->name('stambena-zajednica');
    
});
