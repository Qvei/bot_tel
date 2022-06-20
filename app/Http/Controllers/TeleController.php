<?php

namespace App\Http\Controllers;
use App\MyClass\Telega;
use Illuminate\Http\Request;

class TeleController extends Controller
{
    public function get_data_from_tg(Request $request){
        $content = file_get_contents("php://input", true);
        $dat = json_decode($content, true);
        $knopki = false;


        
        if(isset($dat['callback_query'])){
            $data = $dat['callback_query'];
        }else{
        	// (isset($dat['message']))
            $data = $dat['message'];
	    }

        $message = mb_strtolower(($data['text'] ?? $data['data']) , 'utf-8' );
        $method = 'sendMessage';
        $buttons = [
                	'inline_keyboard' => [
                		[
                			[
                				'text' => 'забруднення',
                				'callback_data' => 'повітря'
                			],
                		],
                		[
                			[
                				'text' => 'button2',
                				'callback_data' => '2'
                			],
                		],
                	]
                ];
        if($message['location'] !== false){

            $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => $youadress = "http://api.openweathermap.org/data/2.5/air_pollution?lat=".$message['location']['latitude']."&lon=".$message['location']['longitude']."&lang=uk&appid=".env('WEATHER_KEY'),
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


        }else{     
	        switch ($message){
	            case '/start':
	                $send_data = [
	                    'text'=>'Hi'
	                ];
	                $knopki = true;
	                break;
	            case 'повітря':

	            	$buttons = [
	                	'inline_keyboard' => [
	                		[
	                			[
	                				'text' => 'Підтвердіть відправку',
	                				'request_location' => true               		
	                			],
	                		
	                			[
	                				'text' => 'button2',
	                				'callback_data' => '2'
	                			],
	                		],
	                	]
	                ];
	                $send_data = [
	                    'text'=>'Необхідно підтвердити місцезнаходження'
	                ];
	                break;
	            default:
	                $send_data = [
	                    'text'=>'Try another text'
	                ];
	                break;
	        }
	    }
        $send_data['chat_id']= $data['chat']['id'] ?? $data['from']['id'];
        return $this->sendTelegram($method,$send_data,$buttons);
    }

    private function sendTelegram($method,$data,$buttons){

    	$telega = new Telega();
    	$text = $data['text'] ?? $data['message']['text'];
    	//$telega->sendMessage($data['chat_id'], $data['text']);
    	return $telega->sendButtons($data['chat_id'], $data['text'], json_encode($buttons));

    }

}