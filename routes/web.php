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

    $array = array('chat_id' => 1221534640,
   'text' => 'test');
     $curl_handle=curl_init(/*'https://api.telegram.org/bot5407668509:AAEuB3yxvJaTOD3yMumWg8l4TJnyykRkuyE/sendMessage'*/);
        curl_setopt($curl_handle, CURLOPT_URL, 'https://api.telegram.org/bot5407668509:AAEuB3yxvJaTOD3yMumWg8l4TJnyykRkuyE/sendMessage');
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $array);
        //curl_setopt($curl_handle, CURLOPT_SSLVERSION, 3);
        //curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
       // curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:64.0) Gecko/20100101 Firefox/64.0');
        $query = curl_exec($curl_handle);
        //$aew = curl_getinfo( $curl_handle );
        curl_close($curl_handle);
  
    return view('welcome');
});
