<?php
namespace App\Myclass;
use App;
//use App\Myclass\NewClass;
use Telegram\Bot\Api;
use Telegram;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Inbox;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;

use DB;
use Session;
use Carbon\Carbon;


 class SimplyMess
    {  

    function __construct($chat_id, $message){

        $this->chat_id = $chat_id;
        $this->message = $message;

    }
 
    public function simmess(){

        switch ($this->message){
                case '/start':
                    $send_data = [ 'text' => 'Погода і рівень забруднення за місцем знаходження' ];
                    break;
                default:
                    $send_data = ['text'=>'Оберіть щоь..'];
                    break;
        }
        $send_data['chat_id'] = $this->chat_id;
        return $send_data;
//         $updates = $this->mess;
//         $ibbb_message = $updates['message']['message_id'];
//         DB::table('words')->where('id',1)->update(['iddd_message' => $ibbb_message+1]);
//         DB::table('words')->where('id',1)->update(['ibbb_message' => $ibbb_message+3]);
//         DB::table('words')->where('id',1)->update(['iooo_message' => $ibbb_message+1]);
//         $update_id  = $updates['update_id'];
//         $message_id = $updates['message']['message_id'];
//         $from_id    = $updates['message']['from']['id'];
//         $is_bot     = $updates['message']['from']['is_bot'];
//         $chat_id    = $updates['message']['chat']['id'];
//         $first_name = $updates['message']['chat']['first_name'];
//         $last_name  = $updates['message']['from']['id'];
//         $text       = $updates['message']['text'];
//         $text = preg_replace("/[^а-яА-ЯёЁіІїЇєЄa-zA-Z0-9\s\/\-]/iu", '', $text);
//         $re = mb_strtolower($text, 'UTF-8');
//         $te = preg_replace('/^([ ]+)|([ ]){2,}/m', '$2', $re);
//         $tett = explode(" ", $te);
//         $break = $te;
//         $we = substr(strstr($break," "), 1);
//         $we = preg_replace("/[^а-яА-ЯёЁіІїЇєЄa-zA-Z0-9\s]/iu", '', $we);
//         $inbox = new Inbox;
//         $inbox->update_id  = $update_id;
//         $inbox->message_id = $message_id;
//         $inbox->from_id    = $from_id;
//         $inbox->is_bot     = $is_bot;
//         $inbox->chat_id    = $chat_id;
//         $inbox->first_name = $first_name;
//         $inbox->last_name  = $last_name;
//         $inbox->text       = $text;
//         $inbox->save();
//         $youtube = 'youtube';
//         if(!DB::table('inboxesss')->where('last_name',$last_name)->exists()){
        
//             DB::table('inboxesss')->insertOrIgnore(['first_name' => $first_name ?? 'guest',
//                                             'last_name' => $last_name]);
//         }
//         $remoteImage = 'http://vap.in.ua/storage/app/public/noname.jpg';
//         $remoteImag = 'http://vap.in.ua/storage/app/public/giphy.gif';
//         $filename = '200217aquos02.jpg';
//         $momog = 0;
//         $messasa = 0;
//         $tmtdstrtt = Carbon::today()->startOfDay();
//         $tmytdend = Carbon::yesterday()->endOfDay();
//         $tmtdendd = Carbon::today()->endOfDay();
//         $strtmont = Carbon::today()->subMonths(1)->startOfDay();

// //  Борькині теревеньки -----------------------------------------------------------------------------------------------------

//         $coms = ['/start', '/redmi', '/visits', '/ukrnews', '/xiaomi'];
//         $strcoms = "/start /visits /xiaomi 9S redmi note 8 pro mi 8";
        
//         if($break === ''||$break === ' '){
//             $keyboard = Keyboard::make()->inline()->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F3E0)).' Меню', 'callback_data' => "mentos"]));
//             $ans = "Напишіть щось внятне..";
//             return NewClass::sendMess($chat_id,$ans,$keyboard);       
//             exit;
//         }
//         $osl = 0;
//         $asl = 0;
//         switch($break){
//             case TRUE:
//                 if((strpos($break, 'новини') !== false||strpos($break, 'novini') !== false||strpos($break, 'novunu') !== false||strpos($break, 'novinu') !== false||strpos($break, 'novuni') !== false||strpos($break, 'novosti') !== false||strpos($break, 'news') !== false||strpos($break, 'nowosti') !== false||strpos($break, 'новости') !== false) && (count($tett)>1)){
//                     if($we != ''){
//                          $key = $key = "https://news.google.com/rss/search?q=".$we."?&hl=uk&gl=UA&ceid=UA:uk";
//                     }else{
//                         $keyboard = Keyboard::make()->inline()->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F3E0)).' Меню', 'callback_data' => "mentos"]));
//                         $ans = "Напишіть щось внятне..";
//                         return NewClass::sendMess($chat_id,$ans,$keyboard);
//                     exit;
//                     }
//                     $xml = simplexml_load_file($key);
//                     $contt = $xml->channel->item;
//                     $cont = $xml->channel->item;
//                     if($contt !== false){
//                         foreach ($cont as $itt) {
//                             $title = $itt->title;
//                             $description = $itt->description;
//                             $link = $itt->link;
//                             $pubDate = $itt->pubDate;
//                             $datee = Carbon::parse($pubDate)->toDateTimeString();
                           
//                             $rrext = mb_substr($title, 0, 20);
//                             if(DB::table('testcurl2')->where('title',$title)->exists()){     
//                             }else{
//                             DB::table('testcurl2')->insertOrIgnore(['title' => $title,
//                                                                 'titlee'  => $rrext,
//                                                                 'description'  => strip_tags($description),
//                                                                 'link'  => strip_tags($link),
//                                                                 'pubDate' => $datee]);
//                         }
//                     }

//                 $tosia = DB::table('testcurl2')->where('title','like','%'.$we.'%')->orWhere('link','like','%'.$we.'%')->get();
//                 foreach($tosia as $mmll){
//                     $dae= $mmll->pubDate;
//                 if($dae >= $tmtdstrtt){
//                         $osl++;
//                 }
//                 if($dae <= $tmtdstrtt){
//                         $asl++;
//                     }
//                 }
//                 if($osl !== 0){
//                    $tola = DB::table('testcurl2')->select('title','titlee','pubDate','link')->where('title','like','%'.$we.'%')->orWhere('link','like','%'.$we.'%')->where('pubDate', '>=', $tmtdstrtt)->where('pubDate', '<=', $tmtdendd)->take(5)->latest('pubDate')->get();
//                    DB::table('inboxesss')->where('last_name', $last_name)
//                                                 ->update(['keyword' => $we,
//                                                           'dick' => 'ukrnews 0',
//                                                           'undick' => 'testcurl2']);
//                     $buttons = DB::table('buttonsukrjustnews2')->select('2','3','4','5','6')->first();
                    
//                     $keyboard = NewClass::addButton($buttons);
//                    foreach($tola as $itt){
//                         $ddata = $itt->pubDate;
//                         $titlle = $itt->title;
//                         $ddext = $itt->titlee;
//                         $keyboard->row(Keyboard::inlineButton([
//                             'text' => $titlle,
//                             'callback_data' => $ddext
//                         ]));
//                     }
//                     $keyboard->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F0)).' Розділ новин', 'callback_data' => "newsss"]),
//                           Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F1)).' Розділ Xiaomi', 'callback_data' => "phonsss"]),
//                           Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x2601)).' Якість повітря', 'callback_data' => "jakistpov"]));
//                     $ans = "Новини за сьогодні про ".$we." - ".$osl." шт. \n".$asl."  за останній час";
//                     return NewClass::sendMess($chat_id,$ans,$keyboard);    
//                 }elseif($osl === 0){
//                    $tola = DB::table('testcurl2')->select('title','titlee','pubDate')->where('title','like','%'.$we.'%')->orWhere('link','like','%'.$we.'%')->where('pubDate', '>=', $strtmont)->take(5)->latest('pubDate')->get();
//                    DB::table('inboxesss')->where('last_name', $last_name)
//                                                 ->update(['keyword' => $we,
//                                                           'dick' => 'yestukrnews 0',
//                                                           'undick' => 'testcurl2']);
//                     $buttons = DB::table('buttonsyestukrnews2')->select('2','3','4','5','6')->first();
                    
//                     $keyboard = NewClass::addButton($buttons);
//                    foreach($tola as $itt){
//                         $ddata = $itt->pubDate;
//                         $titlle = $itt->title;
//                         $ddext = $itt->titlee;
//                         $keyboard->row(Keyboard::inlineButton([
//                             'text' => $titlle,
//                             'callback_data' => $ddext
//                         ]));
//                     }
                    
//                     $keyboard->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F0)).' Розділ новин', 'callback_data' => "newsss"]),
//                           Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F1)).' Розділ Xiaomi', 'callback_data' => "phonsss"]),
//                           Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x2601)).' Якість повітря', 'callback_data' => "jakistpov"]));
//                     $ans = 'Немає '.$we.' новин за сьогодні, ось '.$asl.' за останній час';
//                     return NewClass::sendMess($chat_id,$ans,$keyboard);
//                 }else{
//                     $keyboard = Keyboard::make()->inline()->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F3E0)).' Меню', 'callback_data' => "mentos"]));
//                     $ans = "Нажаль нема ".$we." новин ні за сьогодні, ні за вчора, ні за останній час..\n\nЯкась не популярна тема..\n\nСпробуйте ще щось...";
//                     return NewClass::sendMess($chat_id,$ans,$keyboard);
//                 }
//                 }else{
//                     $keyboard = Keyboard::make()->inline()->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F3E0)).' Меню', 'callback_data' => "mentos"]));
//                     $ans = "Нажаль нема ".$we." новин..\n\nСпробуйте ще щось";
//                     return NewClass::sendMess($chat_id,$ans,$keyboard);
//                 }  
//             }elseif((strpos($break, 'новини') !== false||strpos($break, 'novini') !== false||strpos($break, 'novunu') !== false||strpos($break, 'novinu') !== false||strpos($break, 'novuni') !== false||strpos($break, 'novosti') !== false||strpos($break, 'news') !== false||strpos($break, 'nowosti') !== false||strpos($break, 'новости') !== false) && (count($tett)==1)){
//                 $keyboard = Keyboard::make()->inline()->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F3E0)).' Меню', 'callback_data' => "mentos"]));
//                 $ans = "про що?";
//                 return NewClass::sendMess($chat_id,$ans,$keyboard);
//             }
//         case TRUE: 
//                 if(strpos($break, $youtube) !== false){
//                     if(count($tett) > 1){
//                         $me = str_replace(" ", "%20", $we);
//                     }elseif((strpos($break, $youtube) !== false) && (count($tett) == 1)){
//                         $keyboard = Keyboard::make()->inline()->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F3E0)).' Меню', 'callback_data' => "mentos"]));
//                         $ans = "Що шукаєм?";
//                         return NewClass::sendMess($chat_id,$ans,$keyboard);
//                     exit;
//                     }
//                     DB::table('inboxesss')->where('last_name', $last_name)->update(['keyword' => strtolower($me),
//                                                                                     'dick' => 'youtube 0',
//                                                                                     'undick' => $youtube]);
//                         $curl = curl_init();
//                         curl_setopt_array($curl, array(
//                             CURLOPT_URL => "https://youtube.googleapis.com/youtube/v3/search?part=snippet&q=".$me."&type=video&key=AIzaSyCYqK8RFEGJFO-hhJ4lm_cumbVkWSVmlTE&regionCode=UA&relevanceLanguage=uk&maxResults=25",
//                             CURLOPT_RETURNTRANSFER => true,
//                             CURLOPT_FOLLOWLOCATION => true,
//                             CURLOPT_ENCODING => "",
//                             CURLOPT_MAXREDIRS => 10,
//                             CURLOPT_TIMEOUT => 30,
//                             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                             CURLOPT_CUSTOMREQUEST => "GET"    
//                         ));
//                         $respon = curl_exec($curl);
//                         $err = curl_error($curl);
//                         $resp = json_decode($respon, true);
//                         if (curl_errno($curl)) {
//                             $keyboard = Keyboard::make()->inline()->row(
//                             Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F1)).' Розділ Xiaomi', 'callback_data' => "phonsss"]),
//                             Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F0)).' Розділ новин', 'callback_data' => "newsss"]),
//                             Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x2601)).' Якість повітря', 'callback_data' => "jakistpov"]));
//                             $ans = 'все прогуляв... Новини?'; 
//                             return NewClass::sendMess($chat_id,$ans,$keyboard);                            
//                             exit;
//                         } else {
//                             $resultStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//                             if ($resultStatus == 200) {

//                             } else {
//                                 $keyboard = Keyboard::make()->inline()->row(
//                                 Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F1)).' Розділ Xiaomi', 'callback_data' => "phonsss"]),
//                                 Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F0)).' Розділ новин', 'callback_data' => "newsss"]),
//                                 Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x2601)).' Якість повітря', 'callback_data' => "jakistpov"]));
//                                 $ans = 'все прогуляв... Новини?'; 
//                                 return NewClass::sendMess($chat_id,$ans,$keyboard);
//                                 exit;
//                             }
//                         }

//                         curl_close($curl);
                       
//                         $keyboard = Keyboard::make()->inline();
//                         $arr = DB::table('buttonsyoutube')->where('knopka','!=','1')->pluck('callback');
//                         $marr = DB::table('buttonsyoutube')->where('knopka','!=','1')->pluck('knopka'); 
//                         $butrt = NewClass::addaButt($keyboard,$marr,$arr);
                        
//                         foreach ($resp['items'] as $chgjf => $keyxza) {
//                             $ttit = $keyxza['snippet']['title'];
//                             $chatitle = $keyxza['snippet']['channelTitle'] ?? 'Пусто';
//                             $ttitl = preg_replace("/[^а-яА-ЯёЁіІїЇєЄa-zA-Z0-9\s]/iu", "", $ttit);
//                             $ttitl = preg_replace('/^([ ]+)|([ ]){2,}/m', '$2', $ttitl);
//                             $chatitle = mb_strtolower($chatitle);
//                             $ttitl = mb_strtolower($ttitl);
//                             $rrext = mb_substr($ttitl, 0, 30);
//                             if(DB::table($youtube)->where('videoId',$keyxza['id']['videoId'])->exists()){
//                             }else{
//                             DB::table($youtube)->insertOrIgnore(['title' => $ttitl,
//                                                                   'channelTitle' => $chatitle,
//                                                                   'videoId' => $keyxza['id']['videoId'],
//                                                                   'channelId' => $keyxza['snippet']['channelId'],
//                                                                   'publishedAt' => $keyxza['snippet']['publishedAt']]);
//                             } 
//                         }
//                         $yout = DB::table($youtube)->where('title','like','%'.$we.'%')->orWhere('channelTitle','like','%'.$we.'%')->skip(0)->take(5)->latest('publishedAt')->get();
//                         foreach ($yout as $vava) {
//                             $keyboard->row(Keyboard::inlineButton(['text' => $vava->title, 'callback_data' => $vava->videoId]));
//                         }
//                         $keyboard->row(
//                                 Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F1)).' Розділ Xiaomi', 'callback_data' => "phonsss"]),
//                                 Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F0)).' Розділ новин', 'callback_data' => "newsss"]),
//                                 Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x2601)).' Якість повітря', 'callback_data' => "jakistpov"]));
//                                 $ans = 'Знайдено по запиту '.$we;
//                                 return NewClass::sendMess($chat_id,$ans,$keyboard);
//                 }
                   
//         default:
//         break;
//         } 
//     switch ($tett) {
//         case TRUE:
//             $keg = DB::table('words')->get();
//             foreach ($keg as $ke) {
//                 $cas = $ke->words;
//                 $sc = $ke->schet;
//                 $ss = $ke->comtitl;
//                 $sx = $ke->loarntitl;
//             }
            
//                 if(strpos($break, 'повідомити') === false && strpos($break, '/start') === false && strpos($break, 'news') === false && strpos($break, $youtube) === false && strpos($break, 'новини') === false && strpos($break, 'новости') === false ){
//                     $sc++;
//                     $cas = $cas." ".$break;
//                     Session::put('dialss', $sc);
//                     $scget = Session::get('dials', $sc);
//                     DB::table('words')->where('id', 1)->update(['words' => $cas, 'schet' => $scget]);
//                     $keyboard = Keyboard::make()->inline()->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F3E0)).' Меню', 'callback_data' => "mentos"]));
//                     $ans = "This bot can search not only Youtube videos, he can search News and do many other things..\n\nFor search in Youtube you need to write word <b>YOUTUBE</b> before your search request...\n\nFor example if you searching videos about <b>".$break."</b> you need to write first word Youtube (bot needs to know where to search in google (for news), or in youtube..)\n\nSo if you want find videos with <b>".$break."</b>, full request must be <b>Youtube ".$break."</b>\n\nAnd if you want find News from google about <b>".$break."</b> full request must be <b>News ".$break."</b>";
//                     return NewClass::sendMess($chat_id,$ans,$keyboard);
//                     exit;
//                 }
            

//             break;
//             } 

//         if((strpos($te, 'повідомити') !== false) && (count($tett)>=2)){
//             $chass = Carbon::now();
//             $messasa++;
//             DB::table('inboxesss')->where('last_name',$last_name)->update(['timestart' => $chass,
//                                                                              'chattt_id' => $chat_id,
//                                                                              'word' => $we,
//                                                                              'momog' => $momog,
//                                                                              'messaas' => $messasa]);
//             $ans = 'Добре, коли що почую про '.$we.' повідомлю...';
//             $keyboard = Keyboard::make()->inline()->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F3E0)).' Меню', 'callback_data' => "mentos"])); 
//             return NewClass::sendMess($chat_id,$ans,$keyboard);        
            
//         }elseif((strpos($te, 'повідомити') !== false) && (count($tett)<2)){
//             $ans = 'Повідомити про що?...';
//             $keyboard = Keyboard::make()->inline()->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F3E0)).' Меню', 'callback_data' => "mentos"])); 
//             return NewClass::sendMess($chat_id,$ans,$keyboard); 
//             exit;
//         }
//         if(DB::table('inboxesss')->where('last_name',$last_name)->where('messaas','>',0)->exists()){
//             $poviddd = DB::table('inboxesss')->where('last_name',$last_name)->first();
//             $povid = $poviddd->word;
//             DB::table('inboxesss')->where('last_name',$last_name)->update(['messaas' => 0]);
//             return Telegram::sendMessage([
//                         'chat_id' => $_ENV['YOUR_MESSAGE_ID'],
//                         'text' => 'Повідомити про '.$povid,
//                     ]); 
//             exit;
//         }
//         if(DB::table('inboxesss')->where('last_name',$last_name)->where('word','!=',NULL)->where('momog',0)->exists()){
//             $mopss = DB::table('inboxesss')->where('last_name',$last_name)->first();
//             $slowo = $mopss->word;
//             $vremjaj = $mopss->timestart;
//             $kudaslat = $mopss->chattt_id;
//             $tasla = $mopss->momog;
            
//             if(DB::table('testcurl2')->where('title','like','%'.$slowo.'%')->where('pubDate','>=',$vremjaj)->exists()){
//                 $otakoi = DB::table('testcurl2')->where('title','like','%'.$slowo.'%')->where('pubDate','>=',$vremjaj)->get();
//                 $keyboard = Keyboard::make()->inline(); 
//                 foreach ($otakoi as $keya) {
//                     $keyboard->row(Keyboard::inlineButton([
//                                 'text'          => $keya->title,
//                                 'callback_data' => $keya->titlee]));
//                 }
//                 $keyboard->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F0)).' Розділ новин', 'callback_data' => "newsss"]),
//                             Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F1)).' Розділ Xiaomi', 'callback_data' => "phonsss"]),
//                             Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x2601)).' Якість повітря', 'callback_data' => "jakistpov"]));
//                 $momog++;
//                 DB::table('inboxesss')->where('last_name',$last_name)->update(['momog' => $momog]);
//                 return Telegram::sendMessage([
//                             'chat_id' => $kudaslat,
//                             'text' => 'Ось '.$slowo.' за останній час',
//                             'reply_markup' => $keyboard
//                         ]);
                
//             }
//             exit;
//         }
    }
}

