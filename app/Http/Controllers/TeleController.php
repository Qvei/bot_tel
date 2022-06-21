<?php

namespace App\Http\Controllers;
use App\MyClass\Telega;
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
        $buttons->row(Keyboard::inlineButton(['text' => 'забруднення '.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447), 'callback_data' => "location"]);
        $buttons = [
                	'inline_keyboard' => [
					                		[
					                			[
					                				'text' => 'забруднення '.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447)),
					                				'callback_data' => 'location'
					                			],
					                		]
					                	]
					            ];
	        switch ($message){
	            case '/start':
	                $send_data = [
	                    'text'=>'івень забруднення за місцем знаходження'
	                ];
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
	                $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://api.openweathermap.org/data/2.5/air_pollution?lat=".$latitude."&lon=".$longitude."&lang=uk&appid=".env('WEATHER_KEY'),
                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_ENCODING => "",
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 30,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => "GET",
                ));
                $resp = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                $resp = json_decode($resp, true);
                foreach ($resp['list'] as $val) {
                        $ono = $val['main']['aqi'];
                        $tim = $val['dt'];
                        $wno = $val['components']['co'];
                        $lno = $val['components']['no'];
                        $qno = $val['components']['no2'];
                        $xno = $val['components']['o3'];
                        $cno = $val['components']['so2'];
                        $jno = $val['components']['pm2_5'];
                        $vno = $val['components']['pm10'];
                        $ano = $val['components']['nh3'];      
                }
        	if($ono == 1){
                        $ans = "<b>Рівень забрудненості повітря в цьому районі вважається задовільним</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F603))."\n\nЗабруднення повітря становить невеликий ризик або взагалі не становить його.\n\n<b>Оновлено:</b> ".$tim."\n\n<b>Якість повітря (AQI)</b> ".$ono."\n<b>Монооксид вуглецю (CO)</b> ".$wno."\n<b>Нітроген діоксид (NO2)</b> ".$qno."\n<b>Концентрація озону (O3)</b> ".$xno."\n<b>Діокси́д сі́рки (SO2)</b> ".$cno."\n<b>Частки пилу PM2_5</b> ".$jno."\n<b>Частки пилу PM10</b> ".$vno."\n<b>Окси́д азо́ту(II)</b> ".$lno;
                    }elseif($ono == 2){
                        $ans = "<b>Рівень забрудненості повітря в цьому районі важається прийнятним</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F60F))."\n\nОднак для деяких забруднювачів може існувати помірне занепокоєння щодо здоров'я дуже невеликої кількості людей, які надзвичайно чутливі до забруднення повітря.\n\n<b>Оновлено:</b> ".$tim."\n\n<b>Якість повітря (AQI)</b> ".$ono."\n<b>Монооксид вуглецю (CO)</b> ".$wno."\n<b>Нітроген діоксид (NO2)</b> ".$qno."\n<b>Концентрація озону (O3)</b> ".$xno."\n<b>Діокси́д сі́рки (SO2)</b> ".$cno."\n<b>Частки пилу PM2_5</b> ".$jno."\n<b>Частки пилу PM10</b> ".$vno."\n<b>Окси́д азо́ту(II)</b> ".$lno;
                    }elseif($ono == 3){
                        $ans =  "<b>Рівень забрудненості повітря в цьому районі вважається не чистим</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F612))."\n\nЧлени чутливих груп можуть відчувати наслідки для здоров'я. Населення, швидше за все, не постраждає.\n\n<b>Оновлено:</b> ".$tim."\n\n<b>Якість повітря (AQI)</b> ".$ono."\n<b>Монооксид вуглецю (CO)</b> ".$wno."\n<b>Нітроген діоксид (NO2)</b> ".$qno."\n<b>Концентрація озону (O3)</b> ".$xno."\n<b>Діокси́д сі́рки (SO2)</b> ".$cno."\n<b>Частки пилу PM2_5</b> ".$jno."\n<b>Частки пилу PM10</b> ".$vno."\n<b>Окси́д азо́ту(II)</b> ".$lno;
                    }elseif($ono == 4){
                        $ans = "<b>Рівень забрудненості повітря в цьому районі вважається дуже поганим</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F614))."\n\nКожен може почати відчувати наслідки для здоров’я; члени чутливих груп можуть відчувати більш серйозні наслідки для здоров'я.\n\n<b>Оновлено:</b> ".$tim."\n\n<b>Якість повітря (AQI)</b> ".$ono."\n<b>Монооксид вуглецю (CO)</b> ".$wno."\n<b>Нітроген діоксид (NO2)</b> ".$qno."\n<b>Концентрація озону (O3)</b> ".$xno."\n<b>Діокси́д сі́рки (SO2)</b> ".$cno."\n<b>Частки пилу PM2_5</b> ".$jno."\n<b>Частки пилу PM10</b> ".$vno."\n<b>Окси́д азо́ту(II)</b> ".$lno;
                    }elseif($ono == 5){
                        $ans = "<b>Рівень забрудненості повітря в цьому районі надзвичайно поганий</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F62D))."\n\nПопередження про стан здоров’я в надзвичайних ситуаціях. Все населення, швидше за все, постраждає.\n\n<b>Оновлено:</b> ".$tim."\n\n<b>Якість повітря (AQI)</b> ".$ono."\n<b>Монооксид вуглецю (CO)</b> ".$wno."\n<b>Нітроген діоксид (NO2)</b> ".$qno."\n<b>Концентрація озону (O3)</b> ".$xno."\n<b>Діокси́д сі́рки (SO2)</b> ".$cno."\n<b>Частки пилу PM2_5</b> ".$jno."\n<b>Частки пилу PM10</b> ".$vno."\n<b>Окси́д азо́ту(II)</b> ".$lno;
                    }
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

