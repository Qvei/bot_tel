<?php
namespace App\MyClass;
use App;
use Telegram;
use Telegram\Bot\Api;
use Telegram\Bot\Actions;
use Illuminate\Http\Request;
use Telegram\Bot\Keyboard\Keyboard;
use Illuminate\Support\Facades\Http;

class YoutubeClass {


    public $words;
    //public $api_key;
    const apikey = env('YOUTUBE_API_KEY');

    public function __construct($words){
        $this->words = $words;
        //$this->api_key = $api_key;
        //$api_key = env('YOUTUBE_API_KEY');
    }


    public function get_videos(){
            $url = Http::get("https://youtube.googleapis.com/youtube/v3/search?part=snippet&q=".str_replace(" ", "%20", $this->words)."&order=date&type=video&key=".apikey."&maxResults=25");
            $respon = json_decode($url, true);
            return $this->make_butt($respon);

    }

    
    private function make_butt($ite){
            $buttons = Keyboard::make()->inline();
            foreach ($ite['items'] as $it => $item) {
                $title = $item['snippet']['title'];
                $shrt_title = preg_replace('/^([ ]+)|([ ]){2,}/m', '$2', $title);
                $shrt_title = mb_substr($shrt_title, 0, 30);
                $buttons->row(Keyboard::inlineButton(['text' => $shrt_title, 'callback_data' => $item['id']['videoId'].'||youtube']));
            }
            return  $buttons;
    }
    

}