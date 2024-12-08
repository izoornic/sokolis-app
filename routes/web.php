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
        }elseif(auth()->user()->user_tipId == 2){
            return redirect('/upravnik-pocetna');
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

    Route::get('/upravnik-pocetna', function () {
        return view('upravnik/pocetna');
    })->name('upravnik-pocetna');

    Route::get('/upravnik-zgrade', function () {
        return view('upravnik/zgrade');
    })->name('upravnik-zgrade');

    Route::get('/upravnik-stanari', function () {
        return view('upravnik/stanari');
    })->name('upravnik-stanari');

    Route::get('/upravnik-kvarovi', function () {
        return view('upravnik/kvar-prijave-pregled');
    })->name('upravnik-kvarovi');

    Route::get('/upravnik-obavestenja', function () {
        return view('upravnik/obavestenja');
    })->name('upravnik-obavestenja');

    Route::get('/upravnik-obavestenje-novo', function () {
        return view('upravnik/obavestenje-novo');
    })->name('upravnik-obavestenje-novo');

    Route::get('/sz-upravnik-obavestenja', function () {
        return view('upravnik/sz-obavestenja');
    })->name('sz-upravnik-obavestenja');

    Route::get('/sz-upravnik-obavestenje-novo', function () {
        return view('upravnik/sz-obavestenje-novo');
    })->name('sz-upravnik-obavestenje-novo');
    
});
