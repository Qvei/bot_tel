<?php
namespace App\MyClass;

use Illuminate\Support\Facades\Http;

class Telega {


    protected $http;
    const $url = 'https://api.telegram.org/bot';

    public function __construct($http){
        $this->http = $http;
    }

    public function sendMessage($chat_id, $message){
            return $this->http::post($url . env('BOT_TOKEN') . '/sendMessage',[
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mod' => 'html',
            ]);
    }

    public function sendDocument($chat_id, $file){
            return $this->http::attach('document' . Storage::get('/public/123.png'), 'document.png')
                ->post($url . env('BOT_TOKEN') . '/sendDocument',[
                    'chat_id' => $chat_id,
                    // 'text' => $message,
                    // 'parse_mod' => 'html',
                ]);
    }

}