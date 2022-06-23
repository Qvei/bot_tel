<?php

namespace App\Http\Controllers;
use App\MyClass\NewClass;
use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Inbox;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;

class TeleController extends Controller
{

    public function get_data_from_tg(Request $request){

    	$content = Telegram::getWebhookUpdates();


    	//$lock = false;
        //$content = file_get_contents("php://input", true);
        $dat = json_decode($content, true);
        $knopki = false;


        if(isset($dat['callback_query'])) {
        	// $chat_id = $dat['callback_query']['from']['id'];
        	// $message = mb_strtolower($dat['callback_query']['data'] , 'utf-8' );
         //    $data = $dat['callback_query'];
            $mess = explode('|', $dat['callback_query']['data']);
            $message = $mess[0];
            $send_data['message_id'] = $mess[1];
            $send_data['check'] = 0;
        }elseif(isset($dat['message']['text'])){
        	// $chat_id = $dat['message']['chat']['id'];
        	// $message = mb_strtolower($dat['message']['text'] , 'utf-8' );
         //    $data = $dat['message'];
            $send_data['message_id'] = $dat['message']['message_id'];
            $message = mb_strtolower($dat['message']['text'] , 'utf-8' );
            $send_data['check'] = 1;
            
        }elseif($dat['message']['location'] !== false){
            $send_data['message_id'] = $dat['message']['message_id'];
            $send_data['check'] = 1;
            $message = 'getlocation'; 
            $latitude = $dat['message']['location']['latitude'];
            $longitude = $dat['message']['location']['longitude'];
        }


$send_data['chat_id'] = $dat['message']['chat']['id'] ?? $dat['callback_query']['from']['id'];
//$callback = mb_strtolower($dat['callback_query']['data'] ?? $dat['message']['text'], 'utf-8' );
// if (strpos($callback, '|') !== false) {
//     $mess = explode('|', $callback);
//     $message = $mess[0];
//     $send_data['message_id'] = $mess[1];
//     $send_data['check'] = 0;
// }else{
//     $send_data['message_id'] = $dat['message']['message_id'];
//     $message = $callback;
//     $send_data['check'] = 1;
// }

        // if($dat['message']['location'] !== false){
        // 	//$chat_id = $dat['message']['chat']['id'];
        // 	$message = 'getlocation'; 
        // 	$latitude = $dat['message']['location']['latitude'];
        // 	$longitude = $dat['message']['location']['longitude'];
        // }

        // $send_data['chat_id'] = $dat['message']['chat']['id'] ?? $dat['callback_query']['from']['id'];
        // //$send_data['message_id'] = $dat['message']['message_id'] ?? $dat['callback_query']['message']['message_id'];
        // $callback = mb_strtolower($dat['callback_query']['data'] ?? $dat['message']['text'], 'utf-8' );
        // if (strpos($callback, '|') !== false) {
        //     $mess = explode('|', $callback);
        //     $message = $mess[0];
        //     $send_data['message_id'] = $mess[1];
        // }else{
        //     $send_data['message_id'] = $dat['message']['message_id'];
        //     $message = $callback;
        // }

        //$message = mb_strtolower(($data['text'] ?? $data['data']) , 'utf-8' );
        $method = 'sendMessage';
        $buttons = Keyboard::make()->inline();
        $buttons->row(Keyboard::inlineButton(['text' => 'Погода і забруднення '.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447)), 'callback_data' => "location|".$send_data['message_id']]),
                      Keyboard::inlineButton(['text' => 'test '.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447)), 'callback_data' => "test|".$send_data['message_id']]),
                      Keyboard::inlineButton(['text' => 'На сайт 🌍', 'url' => "https://info-misto.com/"]));
        
	        switch ($message){
	            case '/start':
	                $send_data = [ 'text' => 'Погода і рівень забруднення за місцем знаходження' ];
	                break;
	            case 'location':
	            	$btn = Keyboard::button([ 'text' => 'Підтвердіть відправку', 'request_location' => true ]);
                	$buttons = Keyboard::make([ 'keyboard' => [[$btn]], 'resize_keyboard' => true, 'one_time_keyboard' => true, 'hide_keyboard' => true  ]);
	                $send_data = ['text' => 'Ви тут'.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447))];
	                break;
	            case 'getlocation':
	            	$api_answers = new NewClass($latitude, $longitude, env('WEATHER_KEY'));
	                $ans = $api_answers->addaAnsver();
	            	$wear_ans = $api_answers->addWeatherAnswer();
                    $send_data = [ 'text'=> $ans."\n\n".$wear_ans, ];
	                break;
                case 'test':
                    $send_data = [ 'text'=> 'https://epic.gsfc.nasa.gov/archive/natural/2022/06/21/png/epic_1b_20220621102538.png', ];
                    break;
	            default:
	                $send_data = [ 'text'=>'Try another text' ];
	                break;
	        }
	    
       // $send_data['chat_id'] = $chat_id;

        return $this->sendTelegram($method,$send_data,$buttons);
    }

    private function sendTelegram($method,$data,$buttons){

       // if($data['check'] === 1){

    	return Telegram::sendMessage([
        	'chat_id' => env('CHAT_ID'), //$data['chat_id'],
                    'text' => $data['text'],
                    'parse_mode' => 'HTML',
                    'reply_markup' => json_encode($buttons),
        ]);
   // }else{
        // return Telegram::editMessageText([
        //                 'chat_id' => $data['chat_id'],
        //                 'message_id' => $data['message_id'],
        //                 'text' => $data['text'],
        //                 'reply_markup' => json_encode($buttons),
        //             ]);
   // }


    	
    }

}

