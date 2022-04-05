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
    //ADD ROUTES HERE FROM VUE ROUTER
];

foreach ($aRoutes as $sRouteName => $sVueRoute) {
    Route::get($sVueRoute, function () {
        return view('dashboard');
    })->name($sRouteName);
}
