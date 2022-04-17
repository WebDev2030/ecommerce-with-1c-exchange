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

Route::get('/', function () {
    return view('welcome');
});

Route::any('/exchange', [\App\Http\Controllers\Exchenge::class, 'catalogIn'])
    ->middleware(config('protocolExchange1C.middleware'))
    ->name('1sProtocolCatalog');;

//
//Route::group(
//    [
//        'namespace'  => 'Mavsan\LaProtocol\Http\Controllers',
//        'middleware' => config('protocolExchange1C.middleware'),
//    ],
//    function () {
//        Route::match(
//            ['get', 'post'],
//            '/exchange',
//            [\App\Http\Controllers\Exchenge::class, 'catalogIn']
//        )->name('1sProtocolCatalog');
//    }
//);
