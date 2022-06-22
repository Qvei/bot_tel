<?php
namespace App\Myclass;
use App;
use Telegram;
use Telegram\Bot\Api;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Illuminate\Http\Request;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;
use Carbon\Carbon;
use DB;

class NewClass{

	

	public $latitude;
    public $longitude;
    public $api_key;

    public function __construct($latitude, $longitude, $api_key){
     $this->latitude = $latitude;
     $this->longitude = $longitude;
     $this->api_key = $api_key;
    }
        
    public function addaAnsver(){

        $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://api.openweathermap.org/data/2.5/air_pollution?lat=".$this->latitude."&lon=".$this->longitude."&lang=uk&appid=".$this->api_key,
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
                        $tim = date('Y-m-d');
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
                        return "<b>Рівень забрудненості повітря в цьому районі вважається задовільним</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F603))."\n\nЗабруднення повітря становить невеликий ризик або взагалі не становить його.\n\n<b>Оновлено:</b> ".$tim."\n\n<b>Якість повітря (AQI)</b> ".$ono."\n<b>Монооксид вуглецю (CO)</b> ".$wno."\n<b>Нітроген діоксид (NO2)</b> ".$qno."\n<b>Концентрація озону (O3)</b> ".$xno."\n<b>Діокси́д сі́рки (SO2)</b> ".$cno."\n<b>Частки пилу PM2_5</b> ".$jno."\n<b>Частки пилу PM10</b> ".$vno."\n<b>Окси́д азо́ту(II)</b> ".$lno;
                    }elseif($ono == 2){
                        return "<b>Рівень забрудненості повітря в цьому районі важається прийнятним</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F60F))."\n\nОднак для деяких забруднювачів може існувати помірне занепокоєння щодо здоров'я дуже невеликої кількості людей, які надзвичайно чутливі до забруднення повітря.\n\n<b>Оновлено:</b> ".$tim."\n\n<b>Якість повітря (AQI)</b> ".$ono."\n<b>Монооксид вуглецю (CO)</b> ".$wno."\n<b>Нітроген діоксид (NO2)</b> ".$qno."\n<b>Концентрація озону (O3)</b> ".$xno."\n<b>Діокси́д сі́рки (SO2)</b> ".$cno."\n<b>Частки пилу PM2_5</b> ".$jno."\n<b>Частки пилу PM10</b> ".$vno."\n<b>Окси́д азо́ту(II)</b> ".$lno;
                    }elseif($ono == 3){
                        return  "<b>Рівень забрудненості повітря в цьому районі вважається не чистим</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F612))."\n\nЧлени чутливих груп можуть відчувати наслідки для здоров'я. Населення, швидше за все, не постраждає.\n\n<b>Оновлено:</b> ".$tim."\n\n<b>Якість повітря (AQI)</b> ".$ono."\n<b>Монооксид вуглецю (CO)</b> ".$wno."\n<b>Нітроген діоксид (NO2)</b> ".$qno."\n<b>Концентрація озону (O3)</b> ".$xno."\n<b>Діокси́д сі́рки (SO2)</b> ".$cno."\n<b>Частки пилу PM2_5</b> ".$jno."\n<b>Частки пилу PM10</b> ".$vno."\n<b>Окси́д азо́ту(II)</b> ".$lno;
                    }elseif($ono == 4){
                        return "<b>Рівень забрудненості повітря в цьому районі вважається дуже поганим</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F614))."\n\nКожен може почати відчувати наслідки для здоров’я; члени чутливих груп можуть відчувати більш серйозні наслідки для здоров'я.\n\n<b>Оновлено:</b> ".$tim."\n\n<b>Якість повітря (AQI)</b> ".$ono."\n<b>Монооксид вуглецю (CO)</b> ".$wno."\n<b>Нітроген діоксид (NO2)</b> ".$qno."\n<b>Концентрація озону (O3)</b> ".$xno."\n<b>Діокси́д сі́рки (SO2)</b> ".$cno."\n<b>Частки пилу PM2_5</b> ".$jno."\n<b>Частки пилу PM10</b> ".$vno."\n<b>Окси́д азо́ту(II)</b> ".$lno;
                    }elseif($ono == 5){
                        return "<b>Рівень забрудненості повітря в цьому районі надзвичайно поганий</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F62D))."\n\nПопередження про стан здоров’я в надзвичайних ситуаціях. Все населення, швидше за все, постраждає.\n\n<b>Оновлено:</b> ".$tim."\n\n<b>Якість повітря (AQI)</b> ".$ono."\n<b>Монооксид вуглецю (CO)</b> ".$wno."\n<b>Нітроген діоксид (NO2)</b> ".$qno."\n<b>Концентрація озону (O3)</b> ".$xno."\n<b>Діокси́д сі́рки (SO2)</b> ".$cno."\n<b>Частки пилу PM2_5</b> ".$jno."\n<b>Частки пилу PM10</b> ".$vno."\n<b>Окси́д азо́ту(II)</b> ".$lno;
                    }
    }


     public function addWeatherAnswer(){
        return json_decode(file_get_contents("https://api.openweathermap.org/data/2.5/onecall?lat=".$this->latitude."&lon=".$this->longitude."&exclude=daily&lang=ua&appid=".$this->api_key), true);
        
    }
}