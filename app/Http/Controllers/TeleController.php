<?php

namespace App\Http\Controllers;
// use App\MyClass\CallbackMess;
// use App\MyClass\SimplyMess;
use App\MyClass\NewClass;
use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;

class TeleController extends Controller
{

    public function get_data_from_tg(Request $request){

    	$content = Telegram::getWebhookUpdates();
        $dat = json_decode($content, true);

        if(isset($dat['callback_query'])){
            // $callback_cl = new CallbackMess($dat['callback_query']['from']['id'], $dat['callback_query']['data']);
            // $send_data = $callback_cl->callmess();
            // if(strpos($dat['callback_query']['data'], '|') !== false){
            //     $explod = explode('|', $dat['callback_query']['data']);
            //     $message = $explod[0];
            //     $youtube = $explod[1];
            // }
        	$chat_id = $dat['callback_query']['from']['id'];
        	$message = $dat['callback_query']['data'];

        }elseif(isset($dat['message']['text'])){
            // $simplmes_cl = new SimplyMess($dat['message']['chat']['id'], $dat['message']['text']);
            // $send_data = $simplmes_cl->simmess();

        	$chat_id = $dat['message']['chat']['id'];
            $message = $dat['message']['text'];

        }elseif($dat['message']['location'] !== false){
            $message = 'getlocation';
            $chat_id = $dat['message']['chat']['id'];
            $latitude = $dat['message']['location']['latitude'];
            $longitude = $dat['message']['location']['longitude'];

            // $api_answers = new NewClass($latitude, $longitude, env('WEATHER_KEY'));
            //         $ans = $api_answers->addaAnsver();
            //         $wear_ans = $api_answers->addWeatherAnswer();
            //         $send_data = ['text'=> $ans."\n\n".$wear_ans];
        }

        //$message = $this->tolover($message);
        $buttons = Keyboard::make()->inline();
        $buttons->row(Keyboard::inlineButton(['text' => 'Погода і забруднення '.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447)), 'callback_data' => "location"]),
                      Keyboard::inlineButton(['text' => 'test '.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447)), 'callback_data' => "test"]),
                      Keyboard::inlineButton(['text' => 'На сайт 🌍', 'url' => "https://info-misto.com/"]));
        
	        switch ($message){
	            case '/start':
	                $send_data['text'] = 'Погода і рівень забруднення за місцем знаходження';
	                break;
	            case 'location':
	            	$btn = Keyboard::button(['text' => 'Підтвердіть відправку', 'request_location' => true]);
                	$buttons = Keyboard::make(['keyboard' => [[$btn]], 'resize_keyboard' => true, 'one_time_keyboard' => true, 'hide_keyboard' => true]);
	                $send_data['text'] = 'Очікую підтвердження..'.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447));
	                break;
	            case 'getlocation':
	            	$api_answers = new NewClass($latitude, $longitude, env('WEATHER_KEY'));
	                $ans = $api_answers->addaAnsver();
	            	$wear_ans = $api_answers->addWeatherAnswer();
                    $send_data['text'] = $ans."\n\n".$wear_ans;
	                break;
                case 'test':
                    $send_data['text'] = 'https://epic.gsfc.nasa.gov/archive/natural/2022/06/21/png/epic_1b_20220621102538.png';
                    break;
                // case 'youtube':
                //     $word1 = str_replace(" ", "%20", $repl_1_word);
                //     $url = "https://youtube.googleapis.com/youtube/v3/search?part=snippet&q=".$word1."&type=video&key=".$_ENV['YOUTUBE_API_KEY']."&maxResults=25";
                //     break;
	            default:
                    $word1 = str_replace(" ", "%20", $message);
                    $url = "https://youtube.googleapis.com/youtube/v3/search?part=snippet&q=".$word1."&type=video&key=".env('YOUTUBE_API_KEY')."&maxResults=25";
                     $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET"    
                        ));

                        $respon = curl_exec($curl);
                        

                        curl_close($curl);
                        $respon = json_decode($respon, true);
                        $buttons = Keyboard::make()->inline();
                        foreach ($respon['items'] as $items => $item) {
                            $title = $item['snippet']['title'];
                            $shrt_title = preg_replace('/^([ ]+)|([ ]){2,}/m', '$2', $shrt_title);
                            $shrt_title = mb_substr($shrt_title, 0, 30);
                            

                            $buttons->row(Keyboard::inlineButton(['text' => $shrt_title, 'callback_data' => $item['id']['videoId']]));
                        }
                        $data['text'] = 'Що є по '.$word1;
                        break;
	        }
	
            $send_data['chat_id'] = $chat_id;
        return $this->sendTelegram($send_data,$buttons);
    }

    public function tolover($text){
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

