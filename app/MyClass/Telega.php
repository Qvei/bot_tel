<?php
namespace App\MyClass;

class Telega {

    public function sendMessage($chat_id, $message){
        \Illuminate\Support\Facades\Http::post('https://api.telegram.org/bot'.env('BOT_TOKEN').'/sendMessage',[
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mod' => 'html',
            ]);
    }

}