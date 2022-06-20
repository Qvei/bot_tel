<?php
namespace App\MyClass;


class Telega {


    //protected $http;
    const $url = 'https://api.telegram.org/bot';

    // public function __construct($http){
    //     $this->http = $http;
    // }

    public function sendMessage($chat_id, $message){
            return \Illuminate\Support\Facades\Http::post($url . '' . env('BOT_TOKEN') . '/sendMessage',[
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mode' => 'HTML',
            ]);
    }

    public function sendButtons($chat_id, $message, $buttons){
            return \Illuminate\Support\Facades\Http::post($url . '' . env('BOT_TOKEN') . '/sendMessage',[
                    'chat_id' => $chat_id,
                    'text' => $message,
                    'parse_mode' => 'HTML',
                    'reply_markup' => $buttons,
                ]);
    }

    public function sendDocument($chat_id, $file){
            return \Illuminate\Support\Facades\Http::attach('document' . Storage::get('/public/123.png'), 'document.png')
                ->post($url . '' . env('BOT_TOKEN') . '/sendDocument',[
                    'chat_id' => $chat_id,
                    // 'text' => $message,
                    // 'parse_mode' => 'html',
                ]);
    }

}