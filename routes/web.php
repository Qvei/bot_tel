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
	// $message = '<h4>Hello</h4>';
	// $telega = new Telega();
	// $telega->sendMessage(env('CHAT_ID'), $message);
    return view('welcome');
});

// Route::get('/tesla/getdata', function (){
// 	// $url = 'https://owner-api.teslamotors.com/'.$request->oauth.'/'.$request->token;
//  //                     $curl = curl_init();
//  //                        curl_setopt_array($curl, array(
//  //                            CURLOPT_URL => $url,
//  //                            CURLOPT_RETURNTRANSFER => true,
//  //                            CURLOPT_FOLLOWLOCATION => true,
//  //                            CURLOPT_ENCODING => "",
//  //                            CURLOPT_MAXREDIRS => 10,
//  //                            CURLOPT_TIMEOUT => 30,
//  //                            //CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//  //                            CURLOPT_CUSTOMREQUEST => "POST"    
//  //                        ));
//  //                        $respon = curl_exec($curl);
//  //                        curl_close($curl);
//  //                        $respon = json_decode($respon, true);

// 	echo 'yes';

// });

Route::any('/tesla', [\App\Http\Controllers\TeslaController::class, 'get_data']);
Route::any('telegramsecret',
    [\App\Http\Controllers\TeleController::class,
        'get_data_from_tg']);

