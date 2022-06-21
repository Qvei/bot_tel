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
        	$chat_id = $dat['callback_query']['from']['id'];
        	$message = mb_strtolower($dat['callback_query']['data'] , 'utf-8' );
            $data = $dat['callback_query'];
        }elseif(isset($dat['message']['text'])){
        	$chat_id = $dat['message']['chat']['id'];
        	$message = mb_strtolower($dat['message']['text'] , 'utf-8' );
            $data = $dat['message'];
            
        }elseif($dat['message']['location'] !== false){
        	$chat_id = $dat['message']['chat']['id'];
        	$message = 'getlocation'; 
        	$latitude = $dat['message']['location']['latitude'];
        	$longitude = $dat['message']['location']['longitude'];
        }

        //$message = mb_strtolower(($data['text'] ?? $data['data']) , 'utf-8' );
        $method = 'sendMessage';
        $buttons = Keyboard::make()->inline();
        $buttons->row(Keyboard::inlineButton(['text' => 'забруднення '.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447)), 'callback_data' => "location"]));
        
	        switch ($message){
	            case '/start':
	                $send_data = [ 'text' => 'Рівень забруднення за місцем знаходження' ];
	                break;
	            case 'location':
	            	$btn = Keyboard::button([
                    'text' => 'Підтвердіть відправку',
                    'request_location' => true]);
                	$buttons = Keyboard::make([
                    'keyboard' => [[$btn]],
                    'resize_keyboard' => true,
                    'one_time_keyboard' => true,
                    'hide_keyboard' => true 
                	]);
	                $send_data = ['text' => 'Ви тут'.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447))];
	                break;
	            case 'getlocation':
	            	$url = "http://api.openweathermap.org/data/2.5/air_pollution?lat=".$latitude."&lon=".$longitude."&lang=uk&appid=".env('WEATHER_KEY');
	            	$wear = new NewClass($url);
	                $ans = $wear->addaAnsver();
	    //         	$url2 = "https://api.openweathermap.org/data/2.5/onecall?lat=".$latitude."&lon=".$longitude."&exclude=daily&lang=ua&appid=43e065ad26518fd849c6d783c39ab43b";
					// $result = json_decode(file_get_contents($url), true);
				
                    $send_data = [
	                    'text'=> $ans,
	                ];
	                break;
	            default:
	                $send_data = [
	                    'text'=>'Try another text'
	                ];
	                break;
	        }
	    
        $send_data['chat_id'] = $chat_id;

        return $this->sendTelegram($method,$send_data,$buttons);
    }

    private function sendTelegram($method,$data,$buttons){

    	return Telegram::sendMessage([
        	'chat_id' => $data['chat_id'],
                    'text' => $data['text'],
                    'parse_mode' => 'HTML',
                    'reply_markup' => json_encode($buttons),
        ]);


    	
    }

}

