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

/** VUE ROUTES **/
Route::get('/login', function () {
    return view('login');
})->middleware(['userLoginCheck'])->name('login');

$aRoutes = [
    'home'     => '/',
    'register' => '/register',
    'fight'    => '/fight',
    'betting'  => '/betting'
    //ADD ROUTES HERE FROM VUE ROUTER
];

foreach ($aRoutes as $sRouteName => $sVueRoute) {
    Route::get($sVueRoute, function () {
        return view('dashboard');
    })->middleware(['userAuth'])->name($sRouteName);
}
/** -- END VUE ROUTES -- **/

/** API ROUTES **/
// TODO: UPDATE CSRF TOKEN UNDER App\Http\Middleware/VerifyCsrfToken.php
Route::namespace('App\Services\User\Controllers')->prefix('/api/user')->group(function () {
    Route::post('/login', 'UserController@login')->middleware(['userLoginCheck']);
    Route::middleware(['userAuth'])->group(function() {
        Route::post('/register', 'UserController@createUser');
        Route::get('/logout', 'UserController@logout');
    });
});

//BET API ROUTES
Route::namespace('App\Services\Bet\Controllers')->prefix('/api/bet')->group(function () {
    Route::post('/', 'BetController@addBet');
});

Route::namespace('App\Services\Fight\Controllers')->prefix('/api/fight')->group(function () {
    Route::post('/', 'FightController@addFight');
    Route::post('/update', 'FightController@updateFight');
});
