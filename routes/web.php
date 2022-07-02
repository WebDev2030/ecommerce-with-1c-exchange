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
    App::basePath();
    $filepath = base_path() . "/storage/1cExchange/2022-06-12_15-56-35_f04f48f1fe0970b01eee0e49da09429d/import___06b74658-6f80-4081-9929-b6fce4da46a7.xml";
    $parser = new \App\Catalog\OneCExchenge\ImportFileParser($filepath);
    $parser->parse();

    return view('welcome');
});

Route::any('/exchange', [\App\Http\Controllers\Exchenge::class, 'catalogIn'])
    ->middleware(config('protocolExchange1C.middleware'))
    ->name('1sProtocolCatalog');;

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
