<?php

namespace App\Http\Controllers;
use App\MyClass\Telega;
use Illuminate\Http\Request;

class TeleController extends Controller
{
    public function get_data_from_tg(){
        $content = file_get_contents("php://input");
        $data = json_decode($content, true);

        if(isset($data['callback_query']))
            $data = $data['callback_query'];
        if(isset($data['message']))
            $data = $data['message'];

        $message = mb_strtolower(($data['text'] ? $data['text'] : $data['data']) , 'utf-8' );
        $method = 'sendMessage';
        switch ($message){
            case '/start':
                $send_data = [
                    'text'=>'Hi'
                ];
                break;
            default:
                $send_data = [
                    'text'=>'Try another text'
                ];
        }
        $send_data['chat_id']=$data['chat']['id'];
        return $this->sendTelegram($method,$send_data);
    }

    private function sendTelegram($method,$data){

    	$telega = new Telega();
    	return $telega->sendMessage($data['chat_id'], $data['text']);

    }

}