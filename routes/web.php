<?php

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

//VUE ROUTES
Route::get('/login', function () {
    return view('login');
})->name('login');

$aRoutes = [
    'home'     => '/',
    'register' => '/register',
    'fight'    => '/fight',
    //ADD ROUTES HERE FROM VUE ROUTER
];

foreach ($aRoutes as $sRouteName => $sVueRoute) {
    Route::get($sVueRoute, function () {
        return view('dashboard');
    })->name($sRouteName);
}

// TODO: UPDATE CSRF TOKEN UNDER App\Http\Middleware/VerifyCsrfToken.php
Route::namespace('App\Services\User\Controllers')->prefix('/api/user')->group(function () {
    Route::post('/register', 'UserController@createUser');
    Route::post('/login', 'UserController@login');
    Route::get('/logout', 'UserController@logout');
});


Route::namespace('App\Services\Bet\Controllers')->prefix('/api/bet')->group(function () {
    Route::post('/', 'BetController@addBet');
});