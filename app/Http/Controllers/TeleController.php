<?php

namespace App\Http\Controllers;
use App\MyClass\YoutubeClass;
use App\MyClass\NewClass;
use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram;
use Session;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;

class TeleController extends Controller
{

    public function get_data_from_tg(Request $request){

    	$content = Telegram::getWebhookUpdates();
        $dat = json_decode($content, true);
        
        $send_data = $this->check_query($dat);
        $buttons = $this->add_start_buttn();
        
	        switch ($send_data['message']){
	            case '/start':
	                $send_data['text'] = "🌧 Погода і рівень забруднення за місцем знаходження \n 🎞️ Пошук відео в ютубі (введіть назву відео)";
	                break;
	            case 'location':
	            	$btn = Keyboard::button(['text' => 'Підтвердіть відправку', 'request_location' => true]);
                	$buttons = Keyboard::make(['keyboard' => [[$btn]], 'resize_keyboard' => true, 'one_time_keyboard' => true, 'hide_keyboard' => true]);
	                $send_data['text'] = 'Очікую підтвердження..'.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447));
	                break;
	            case 'getlocation':
	            	$api_answers = new NewClass($send_data['latitude'], $send_data['longitude'], env('WEATHER_KEY'));
	                $ans = $api_answers->addAqiAnsver();
	            	$wear_ans = $api_answers->addWeatherAnswer();
                    $send_data['text'] = $ans."\n\n".$wear_ans;
	                break;
                case 'test':
                    $send_data['text'] = 'https://epic.gsfc.nasa.gov/archive/natural/2022/06/21/png/epic_1b_20220621102538.png';
                    break;
                case 'youtube':
                    $send_data['text'] = "\n\nhttps://www.youtube.com/watch?v=".$send_data['youtube'];
                    break;
	            default:
                    $get_buttn = new YoutubeClass($send_data['message'], env('YOUTUBE_API_KEY'));
                    $buttons = $get_buttn->get_videos();
                    $send_data['text'] = 'Що є по '.$send_data['message'];
                    break;
	        }
	
            return $this->sendTelegram($send_data,$buttons);
    }

    private function check_query($dat){
        if(isset($dat['callback_query'])){
            $mess = $dat['callback_query']['data'];
            if(strpos($mess, '||') !== false){
                $explod = explode('||', $mess);
                $mess = $explod[1];
                $youtube = $explod[0];
            }
        }elseif(isset($dat['message']['text'])){
            $mess = $dat['message']['text'];
        }elseif($dat['message']['location'] !== false){
            $mess = 'getlocation';
            $latitude = $dat['message']['location']['latitude'];
            $longitude = $dat['message']['location']['longitude'];
        }

        $chat_id = $dat['callback_query']['from']['id'] ?? $dat['message']['chat']['id'];
        $name = $dat['callback_query']['from']['first_name'] ?? $dat['message']['chat']['first_name'];

        if($mess !== '/start'){
            $message = preg_replace("/[^а-яА-ЯёЁіІїЇєЄa-zA-Z0-9\s]/iu", "", $mess);
        }else{
            $message = $mess;
        }

        return array('message' => $message, 'chat_id' => $chat_id, 'youtube' => $youtube ?? '', 'latitude' => $latitude ?? '', 'longitude' => $longitude ?? '', 'name' => $name);

    }

    private function add_start_buttn(){
        $buttons = Keyboard::make()->inline();
        return $buttons->row(Keyboard::inlineButton(['text' => 'Погода і забруднення '.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447)), 'callback_data' => "location"]),
                      Keyboard::inlineButton(['text' => 'test '.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447)), 'callback_data' => "test"]),
                      Keyboard::inlineButton(['text' => 'На сайт 🌍', 'url' => "https://info-misto.com/"]));
    }

    private function tolover($text){
        return mb_strtolower($text, 'utf-8');
    }

    private function sendTelegram($data,$buttons){
    	    return Telegram::sendMessage([
        	       'chat_id' => $data['chat_id'],
                    'text' => $data['text'],
                    'parse_mode' => 'HTML',
                    'reply_markup' => json_encode($buttons)
            ]);
    }

}

