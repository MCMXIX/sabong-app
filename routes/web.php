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
$aRoutes = [
    'home' => '/',
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
