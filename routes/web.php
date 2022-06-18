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

Route::get('/', function ()
	\Illuminate\Support\Facades\Http::post('https://api.telegram.org/bot'.env('BOT_TOKEN').'/sendMessage',[
		'chat_id' => env('CHAT_ID'),
   		'text' => 'New test',
   		'parse_mod' => 'html'
	]);
    return view('welcome');
});
