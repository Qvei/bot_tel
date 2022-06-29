<?php

use Illuminate\Support\Facades\Route;
//use App\MyClass\Telega;

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

Route::get('/', function (){
    return view('welcome');
});

Route::any('/tesla', [\App\Http\Controllers\TeslaController::class, 'get_data']);

Route::any('/telegramsecret', [\App\Http\Controllers\TeleController::class, 'get_data_from_tg']);  //->middleware(['telegases']);
Route::get('/filter', function (){
    return view('filter');
});
Route::post('/connectfilter2', [\App\Http\Controllers\FilterController::class, 'get_filter_data']);

