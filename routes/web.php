<?php

use Illuminate\Support\Facades\Route;
use App\MyClass\Telega;

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
	$message = '<h4>Hello</h4>';
	$telega = new Telega();
	$telega->sendMessage(env('CHAT_ID'), $message);
    return view('welcome');
});
