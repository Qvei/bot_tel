<?php
namespace App\Myclass;
use App;
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

class CallbackMess
{
    public $from_id;
    public $message;

    public function __construct($from_id,$message)
    {

        $this->from_id = $from_id;
        $this->message = $message;

    }

 
    public function callmess(){

            switch ($this->message) {
                case 'location':
                    $btn = Keyboard::button(['text' => 'Підтвердіть відправку', 'request_location' => true]);
                    $buttons = Keyboard::make(['keyboard' => [[$btn]], 'resize_keyboard' => true, 'one_time_keyboard' => true, 'hide_keyboard' => true]);
                    $send_data = ['text' => 'Очікую підтвердження..'.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447))];
                    break;
                case 'test':
                    $send_data = ['text'=> 'https://epic.gsfc.nasa.gov/archive/natural/2022/06/21/png/epic_1b_20220621102538.png'];
                    break;
                default:
                    # code...
                    break;
            }
            $send_data['chat_id'] = $this->from_id;
        return $send_data;

//         $updates = $this->mess['callback_query'];
//         if(isset($updates['message']['text'])){
//         $text = $updates['message']['text'];
//         $text = preg_replace("/[^а-яА-ЯёЁіІїЇєЄa-zA-Z0-9\s\.\?\,\!\(\)\@\:\-\/]/iu", '', $text);
//         $re = mb_strtolower($text, 'UTF-8');

//         $te = preg_replace('/^([ ]+)|([ ]){2,}/m', '$2', $re);
//         $tett = explode(" ", $te);
//         $we = substr(strstr($te," "), 1);
//         $we = preg_replace("/[^а-яА-ЯёЁіІїЇєЄa-zA-Z0-9]/iu", '', $we);
//     }
//         $first_name = $updates['from']['first_name'];
//         $last_name = $updates['from']['id'];
//         $idi = DB::table('words')->get();
//         if(DB::table('inboxesss')->where('last_name','=',$last_name)->exists()){  
//         }else{
//             DB::table('inboxesss')->insertOrIgnore(['first_name' => $first_name,
//                                             'last_name' => $last_name]);
//         }
//         foreach ($idi as $keym) {
//             if(DB::table('inboxesss')->where('last_name','=', $last_name)->where('zozul','=','chacha')->exists()){
//                 $ididi = $keym->iddd_message;
//                 $adada = $ididi;   // +1

//             }else{
//             $ididi = $keym->iddd_message;   // +2
//             $ududu = $keym->ibbb_message;   // +3
//             $adada = $keym->iooo_message;   // +1
//             }
//         }
//         $deysazas = DB::table('inboxesss')->where('last_name', $last_name)->first(); 
//         $deytrdio = $deysazas->keyword;
//         $tmtdstrt = Carbon::today()->startOfDay();
//         $tmtdend = Carbon::today()->endOfDay();
//         $strtmonth = Carbon::today()->subMonths(1)->startOfDay();
//         $tmytdend = Carbon::yesterday()->endOfDay();

// //  Вивід всіх новин ------------------------------------------------------------------------------------------------------

//         switch ($updates['data']) {
//             case (DB::table('curltest')->where('titlee', $updates['data'])->exists()||DB::table('curltest3')->where('titlee', $updates['data'])->exists()||DB::table('testcurl2')->where('titlee', $updates['data'])->exists()||DB::table('technology')->where('titlee', $updates['data'])->exists()||DB::table('science')->where('titlee', $updates['data'])->exists()||DB::table('world')->where('titlee', $updates['data'])->exists()||DB::table('lviv')->where('titlee', $updates['data'])->exists()||DB::table('youtube')->where('videoId', $updates['data'])->exists()):
//                 $updfrid = $updates['from']['id'];
//                 DB::table('inboxesss')->where('last_name', $last_name)->update(['file' => $updates['data']]);
//                 $deytrd = DB::table('inboxesss')->where('last_name', $last_name)->first(); 
//                 $dick = $deytrd->dick;
//                 $dbb = $deytrd->undick;
//                 if($dbb !== 'youtube'){
//                     $xbbb = DB::table($dbb)->where('titlee', $updates['data'])->select('title','link','description','pubDate')->latest('pubDate')->get();
//                 }elseif($dbb === 'youtube'){
//                     $xbbb = DB::table($dbb)->where('videoId', $updates['data'])->select('videoId','publishedAt','title')->latest('publishedAt')->get();
//                 }else{
//                     $ans = "Щось пішло під 3 чорти...\n\nВиясняєм..";
//                     $otvi = NewClass::editMess($updfrid,$adada,$ans,$keyboard);
                    
//                     exit;

//                 }
//                 foreach ($xbbb as $keywer) {
//                     if($dbb === 'youtube'){
//                         $l = $keywer->publishedAt;
//                         $p = $keywer->videoId;
//                     }else{
//                         $l = $keywer->link ?? "невідомо";
//                         $p = $keywer->pubDate ?? "невідомо";
//                     } 
//                 }
//                 $keyboard = Keyboard::make()->inline();
//                 if($dbb === 'youtube'){
//                     $keyboard->row(Keyboard::inlineButton([
//                             'text'          => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F519)).' Назад',
//                             'callback_data' => $dick]),
//                            Keyboard::inlineButton([
//                             'text'          => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F3E0)).' Завантажити',
//                             'callback_data' => 'download '.$updates['data']]));
//                     $ans = "Опубліковано: ".Carbon::parse($l)->diffForHumans()."\n\nhttps://www.youtube.com/watch?v=".$p;
                        
//                 }else{
//                     $keyboard->row(Keyboard::inlineButton([
//                             'text'          => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F519)).' Назад',
//                             'callback_data' => $dick]),
//                            Keyboard::inlineButton([
//                             'text'          => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F3E0)).' Всі новини',
//                             'callback_data' => 'newsss']));
//                     $ans = "Опубліковано: ".Carbon::parse($p)->diffForHumans()."\n\nЛінк: ".$l;
//                 }
//                 return NewClass::editMess($updfrid,$adada,$ans,$keyboard);
                
//                 break;
            
//     //  Головне Меню ----------------------------------------------------------------------------------------------------

//             case ($updates['data'] === "mentos"):
//                 $updfrid = $updates['from']['id'];
//                 $buttons = DB::table('buttonsmenu2')->first();
//                 $keyboard =  NewClass::addButton($buttons);
//                 $keyboard->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x2757)).' Інструкція користування', 'callback_data' => "info"]));
//                 if($last_name === $_ENV['YOUR_MESSAGE_ID']){
//                     $keyboard->row(
//                         Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x274C)).' news', 'callback_data' => "alldell"]),
//                         Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x274C)).' telegram', 'callback_data' => "merrdell"]));
//                 }
//                     $ans = "<b>Головне меню</b>";
//                     return NewClass::editMess($updfrid,$adada,$ans,$keyboard);
                    
//                     break;
//             case ($updates['data'] === "alldell"||$updates['data'] === "merrdell"||$updates['data'] === "info"):
//                 $updfrid = $updates['from']['id'];
//                 $mona = ['curltest3','curltest','testcurl2','technology','science','world','youtube'];
//                 if($updates['data'] === "alldell"){
//                     $ans = 'Видалено все, заповнити Xiaomi!';
//                 foreach ($mona as $key) {
//                     DB::table($key)->truncate();
//                 }
//                 }elseif($updates['data'] === "merrdell"){
//                     $ans = 'видалено телеграм message телеграм таблицю';
//                     DB::table('inboxes')->truncate();
//                 }else{
//                     $ans = "Ви можете шукати будь що ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F50E))."\n\nПриклад\n\nвведіть <b>новини Covid-19</b> (покаже все по темі)\nвведіть <b>Youtube запорожець</b> \n\nТакож ви можете сказати боту щоб повідомив про новину ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4E8))."\n\nНапишіть: <b>повідомити MIUI 12</b>\n\nі бот повідомить вас як тільки з'являться якісь новини про MIUI 12\n\n Щоб перезавантажити бота введіть команду: /start";
//                 }
//                 $keyboard = Keyboard::make()->inline()->row(Keyboard::inlineButton(['text' => 'назад', 'callback_data' => 'mentos']));
//                 return NewClass::editMess($updfrid,$adada,$ans,$keyboard);
                    
//                 break;

//     //  Меню Смартфонів, Новин, Повітря -----------------------------------------------------------------------------------

//             case ($updates['data'] === "phonsss"||$updates['data'] === "newsss"||$updates['data'] === "jakistpov"||$updates['data'] === "rajon"):
//                 $updfrid = $updates['from']['id'];
//                 DB::table('inboxesss')->where('last_name', $last_name)->update(['ffick' => $updates['data']]);
//                     if($updates['data'] === "phonsss"){
//                         $ans = 'Розділ Xiaomi смартфонів';
//                         $img = iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F1));
//                         $buttns = DB::table('buttonsmenuxiaomi')->get();
//                     }elseif($updates['data'] === "newsss"){
//                         $ans = 'Розділ Новин';
//                         $buttns = DB::table('buttonsmenunews')->get();
//                     }elseif($updates['data'] === "jakistpov"){
//                         $ans = 'Розділ Якості повітря';
//                         $buttns = DB::table('buttonsrajoni')->get();
//                     }

//                     $keyboard = Keyboard::make()->inline();
//                     if($updates['data'] === "jakistpov"){
//                         $keyboard->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4CD)).' За місцем знаходження', 'callback_data' => 'location']));
//                     }
//                     foreach ($buttns as $key) {
//                         if($updates['data'] === 'phonsss'){
//                             $keyboard->row(Keyboard::inlineButton(['text' => $img.' '.$key->knopka, 'callback_data' => $key->callback]));
//                         }else{
//                             $keyboard->row(Keyboard::inlineButton(['text' => $key->knopka, 'callback_data' => $key->callback]));
//                         }
//                     }
//                     $marr = DB::table('buttonsrozdili')->where('callback','!=',$updates['data'])->pluck('knopka');  
//                     $arr = DB::table('buttonsrozdili')->where('callback','!=',$updates['data'])->pluck('callback'); 
//                     $keyboard->row(
//                         Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F519)).' '.$marr[0], 'callback_data' => $arr[0]]),
//                         Keyboard::inlineButton(['text' => $marr[1], 'callback_data' => $arr[1]]),
//                         Keyboard::inlineButton(['text' => $marr[2], 'callback_data' => $arr[2]]));

                    
//                      return NewClass::editMess($updfrid,$adada,$ans,$keyboard);
                    
//                     break;

// //  Якість Повітря вулиці (в ряд) ------------------------------------------------------------------------------------------

//             case (DB::table('buttonsrajoni')->where('knopka',$updates['data'])->exists()):
//                 $updfrid = $updates['from']['id'];
//                 DB::table('inboxesss')->where('last_name', $last_name)->update(['liick' => $updates['data']]);
//                 if($updates['data'] === "Франківський"){
//                     $ulica = 'buttonsfrankivs';
//                 }elseif($updates['data'] === "Сихівський"){
//                     $ulica = 'buttonssixiv';
//                 }elseif($updates['data'] === "Залізничний"){
//                     $ulica = 'buttonszalizn';
//                 }elseif($updates['data'] === "Шевченківський"){
//                     $ulica = 'buttonswevchen';
//                 }elseif($updates['data'] === "Личаківський"){
//                     $ulica = 'buttonslichaki';
//                 }elseif($updates['data'] === "Галицький"){
//                     $ulica = 'buttonsgalitsk';
//                 }

//                 $btn1 = DB::table($ulica)->get();
//                     $keyboard = Keyboard::make()->inline();
//                     foreach ($btn1 as $keyol) {
//                         $keyboard->row(Keyboard::inlineButton(['text' => $keyol->knopka, 'callback_data' => $keyol->callback]));
//                     }
//                     $keyboard->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F519)).' Назад', 'callback_data' => "jakistpov"]),
//                         Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F1)).' Смартфони', 'callback_data' => "phonsss"]),
//                         Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F0)).' Новини', 'callback_data' => "newsss"]));
//                 $ans = 'Оберіть найближчу до вас вулицю';
//                  return NewClass::editMess($updfrid,$adada,$ans,$keyboard);
                    
//                 break;

// //  Меню місцезнаходження ---------------------------------------------------------------------------------------------------

//             case ($updates['data'] === 'location'):
//                 DB::table('inboxesss')->where('last_name', $last_name)->update(['liick' => 'jakistpov',
//                     'keyword22' => $adada,
//                     'tatakx' => 'tatakk',
//                     'namee'  => $updates['from']['id']]);
//                 $btn = Keyboard::button([
//                     'text' => 'Підтвердіть відправку',
//                     'request_location' => true]);
//                 $keyboard = Keyboard::make([
//                     'keyboard' => [[$btn]],
//                     'resize_keyboard' => true,
//                     'one_time_keyboard' => true,
//                     'hide_keyboard' => true 
//                 ]);
//                 return Telegram::sendMessage([
//                     'chat_id' => $updates['from']['id'],
//                     'text' => 'Ви тут'.iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F447)),
//                     'hide_keyboard' => true,
//                     'reply_markup' => $keyboard
//                 ]);
//                 break;

// //  Вивід забруднення не по геолокації -------------------------------------------------------------------------------------

//             case (DB::table('buttonsfrankivs')->where('callback', $updates['data'])->exists()||DB::table('buttonslichaki')->where('callback', $updates['data'])->exists()||DB::table('buttonssixiv')->where('callback', $updates['data'])->exists()||DB::table('buttonszalizn')->where('callback', $updates['data'])->exists()):
//                 DB::table('inboxesss')->where('last_name', $last_name)->update(['bbick' => $updates['data']]);
//                 $nora = DB::table('inboxesss')->where('last_name', $last_name)->first();
//                 $koka = $nora->liick;
//                 $last_word_start = strrpos($updates['data'], " ") + 1;
//                 $last_word = substr($updates['data'], $last_word_start);
//                 $obrezlastw = preg_replace('=\s\S+$=', "", $updates['data']);
//                 $updfrid = $updates['from']['id'];
//                 $youadress = "http://api.openweathermap.org/data/2.5/air_pollution?lat=".$obrezlastw."&lon=".$last_word."&lang=uk&appid=11a6e571a195073ce358513e1f5e46e8";
//                     $keyboard = Keyboard::make()->inline()
//                     ->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F519)).' Назад', 'callback_data' => $koka]),
//                           Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4C8)).' Шкала забрудненості', 'callback_data' => "wkalazabr"]));
//                     $ans = NewClass::addaAnsver($youadress);
//                     return NewClass::editMess($updfrid,$adada,$ans,$keyboard);
                    
//                 break;

// //  Шкала забруднення ------------------------------------------------------------------------------------------------------

//             case ($updates['data'] === "wkalazabr"):
//                 $deytdvd = DB::table('inboxesss')->where('last_name', $last_name)->first();
//                 $shjas = $deytdvd->bbick;
//                 $keyboard = Keyboard::make()->inline()->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F519)).' Назад', 'callback_data' => $shjas]),
//                     Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x2601)).' Повітря', 'callback_data' => "jakistpov"]));
//                 return Telegram::editMessageText([
//                     'chat_id' => $updates['from']['id'],
//                     'message_id' => $adada,
//                     'text' => "<b>(µg/m3, 24-годинне середнє значення)</b>\n\n<b>1) PM2_5: 12 (Індекс: від 0 - 50)</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F603))." Якість повітря вважається задовільною, а забруднення повітря становить невеликий ризик або взагалі не становить його\n\n<b>2) PM2_5: 12.1 – 35.4 (Індекс: від 51 - 100)</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F60F))." Якість повітря прийнятна; однак для деяких забруднювачів може існувати помірне занепокоєння щодо здоров'я дуже невеликої кількості людей, які надзвичайно чутливі до забруднення повітря.\n\n<b>3) PM2_5: 35.5 – 55.4 (Індекс: від 101 - 150)</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F612))." Члени чутливих груп можуть відчувати наслідки для здоров'я. Населення, швидше за все, не постраждає.\n\n<b>4) PM2_5: 55.5 – 150.4 (Індекс: від 151 - 200)</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F614))." Кожен може почати відчувати наслідки для здоров’я; члени чутливих груп можуть відчувати більш серйозні наслідки для здоров'я.\n\n<b>5) PM2_5: 150.5 – 250.4 (Індекс: від 201 - 300)</b> ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F62D))." Попередження про стан здоров’я в надзвичайних ситуаціях. Все населення, швидше за все, постраждає",
//                     'parse_mode' => 'HTML',
//                     'reply_markup' => $keyboard   
//                 ]);
//                 break;

// //Новини curl ---------------------------------------------------------------------------------------------------------------

//             case ($updates['data'] === "xianews"||$updates['data'] === "ukrnews"||$updates['data'] === "tech"||$updates['data'] === "science"||$updates['data'] === "world"||$updates['data'] === "lviv"):
//                 Telegram::sendChatAction(['chat_id' => $updates['from']['id'], 'action' => Actions::TYPING]);
//                 if($updates['data'] === "xianews"){
//                     $dt = Carbon::now();
//                     $tmytd = Carbon::yesterday();
//                     $tmrd = Carbon::tomorrow();
//                     $asssa = Carbon::today()->subDays(2);
//                     $key = 'https://news.google.com/rss/search?q=xiaomi+after:2021-'.$dt->month.'-'.$asssa->day.'+before:2021-'.$dt->month.'-'.$tmrd->day.'&hl=uk&gl=UA&ceid=UA:uk'; 
//                     $addsaa = 'buttonsxianews2';
//                     $addsd = 'curltest';
//                     $todo = '1';
//                     $modo = 'xiaominews 0';
//                     $ans = 'Новини про Xiaomi за останній час';
//                 }elseif($updates['data'] === "ukrnews"){
//                     $key = 'https://news.google.com/rss?&ceid=UA:uk&hl=uk&gl=UA';
//                     $addsaa = 'buttonsukrprim2';
//                     $addsd = 'curltest3';
//                     $todo = '1';
//                     $modo = 'ukrgol 0';
//                     $ans = 'Укр головні за останній час';
//                 }elseif($updates['data'] === "tech"){
//                     $key = 'https://news.google.com/rss/headlines/section/topic/TECHNOLOGY?&ceid=UA:uk&hl=uk&gl=UA';
//                     $addsaa = 'buttonstech2';
//                     $addsd = 'technology';
//                     $todo = '1';
//                     $modo = 'tech 0';
//                     $ans = 'Новини технологій за останній час';
//                 }elseif($updates['data'] === "science"){
//                     $key = 'https://news.google.com/rss/headlines/section/topic/SCIENCE?&ceid=UA:uk&hl=uk&gl=UA';
//                     $addsaa = 'buttonsscience2';
//                     $addsd = 'science';
//                     $todo = '1';
//                     $modo = 'science 0';
//                     $ans = 'Новини науки за останній час';
//                 }elseif($updates['data'] === "world"){
//                     $key = 'https://news.google.com/rss/headlines/section/topic/WORLD?&ceid=UA:uk&hl=uk&gl=UA';
//                     $addsaa = 'buttonsworld2';
//                     $addsd = 'world';
//                     $todo = '1';
//                     $modo = 'world 0';
//                     $ans = 'Новини в світі за останній час';
//                 }elseif($updates['data'] === "lviv"){
//                     $key = 'https://news.google.com/rss/search?q=львів&ceid=UA:uk&hl=uk&gl=UA';
//                     $addsaa = 'buttonslviv2';
//                     $addsd = 'lviv';
//                     $todo = '1';
//                     $modo = 'lviv 0';
//                     $ans = 'Новини Львова за останній час';
//                 }
//                 $updfrid = $updates['from']['id'];
//                 $xml = simplexml_load_file($key);
//                 $contt = $xml->channel->item;
//                 $buttons = DB::table($addsaa)->select('2','3','4','5','6')->first();
//                 $keyboard = NewClass::addButton($buttons);
                
//                 DB::table('inboxesss')->where('last_name', $last_name)->update(['dick' => $modo,
//                                                                                       'undick' => $addsd]);
//                 foreach ($contt as $valu) {
//                     $title = $valu->title;
//                     $description = $valu->description;
//                     $link = $valu->link;
//                     $pubDate = $valu->pubDate;
//                     $titl = strval($title);
//                     $datee = Carbon::parse($pubDate)->toDateTimeString();
//                     $rrext = mb_substr($titl, 0, 30);
//                     if(DB::table($addsd)->where('title',$title)->exists()){

//                     }else{
//                         DB::table($addsd)->insertOrIgnore(['title' => $title,
//                                                     'titlee'  => $rrext,
//                                                     'description'  => strip_tags($description),
//                                                     'link'  => strip_tags($link),
//                                                     'pubDate' => $datee]);
//                     }
//                     }
//                     $ererer = DB::table($addsd)->select('titlee','title')->skip(0)->take(5)->latest('pubDate')->get();
//                     foreach ($ererer as $value) {
//                         $keyboard->row(Keyboard::inlineButton([
//                             'text'          => $value->title,
//                             'callback_data' => $value->titlee]));    
//                     }
//                     $deytdvd = DB::table('inboxesss')->where('last_name', $last_name)->first();
//                     $shjas = $deytdvd->dick;
//                     $keyboard->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F519)).' Назад', 'callback_data' => 'newsss']),
//                         Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F3E0)).' Меню', 'callback_data' => "mentos"]));
//                      return NewClass::editMess($updfrid,$adada,$ans,$keyboard);
                    
//                 break;

//     //  Розділ смартфонів -----------------------------------------------------------------------------------------------

//             case ($updates['data'] === "minote 0"||$updates['data'] === "minote 5"||$updates['data'] === "minote 10"||$updates['data'] === "rednote 0"||$updates['data'] === "rednote 5"||$updates['data'] === "rednote 10"||$updates['data'] === "redmii 0"||$updates['data'] === "redmii 5"||$updates['data'] === "redmii 10"||$updates['data'] === "mi 0"||$updates['data'] === "mi 5"||$updates['data'] === "mi 10"):
//                 $updfrid = $updates['from']['id'];
//                 Telegram::sendChatAction(['chat_id' => $updates['from']['id'], 'action' => Actions::TYPING]);
//                 DB::table('inboxesss')->where('last_name', $last_name)->update(['ffick' => $updates['data']]);
//                 $last_word_start = strrpos($updates['data'], " ") + 1;
//                 $last_word = substr($updates['data'], $last_word_start);
//                 $obrezlastw = preg_replace('=\s\S+$=', "", $updates['data']);
//                 $obr = intval($last_word);
//                 if($obrezlastw === "minote"){
//                     $addsaa = 'buttonsminote';
//                     $ans = 'Лінійка Xiaomi Mi Note';
//                     $cllxiaomi = DB::table('comparesss')->select('slug')->where('slug','not like','%Redmi%')->where('slug','like','%Note%')->skip($obr)->take(5)->get();
//                 }elseif($obrezlastw === "rednote"){
//                     $addsaa = 'buttonsrednote';
//                     $ans = 'Лінійка Redmi Note';
//                     $cllxiaomi = DB::table('comparesss')->select('slug')->where('slug','like','%Redmi Note%')->skip($obr)->take(5)->get();
//                 }elseif($obrezlastw === "redmii"){
//                     $addsaa = 'buttonsredmii';
//                     $ans = 'Лінійка Redmi';
//                     $cllxiaomi = DB::table('comparesss')->select('slug')->where('slug','not like','%Note%')->where('slug','like', '%Redmi%')->skip($obr)->take(5)->get();
//                 }elseif($obrezlastw === "mi"){
//                     $addsaa = 'buttonsmi';
//                     $ans = 'Лінійка Xiaomi Mi';
//                     $cllxiaomi = DB::table('comparesss')->select('slug')->where('slug','not like','%Note%')->where('slug','not like', '%Redmi%')->skip($obr)->take(5)->get();
//                 }

//                 $tarrva = DB::table('allxiabuttons')->where('callback','!=',$updates['data'])->where('callback1','!=',$updates['data'])->where('callback2','!=',$updates['data'])->pluck('knopka');
//                 $tarsax = DB::table('allxiabuttons')->where('callback','!=',$updates['data'])->where('callback1','!=',$updates['data'])->where('callback2','!=',$updates['data'])->pluck('callback');
//                 $marrxx = DB::table($addsaa)->where('callback','!=',$updates['data'])->pluck('knopka');
//                 $arraxx = DB::table($addsaa)->where('callback','!=',$updates['data'])->pluck('callback');
//                 $keyboard = Keyboard::make()->inline()
//                 ->row(
//                     Keyboard::inlineButton(['text' => $tarrva[0], 'callback_data' => $tarsax[0]]),
//                     Keyboard::inlineButton(['text' => $tarrva[1], 'callback_data' => $tarsax[1]]),
//                     Keyboard::inlineButton(['text' => $tarrva[2], 'callback_data' => $tarsax[2]]),
//                     Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F519)).' Назад', 'callback_data' => "phonsss"]));
//                 foreach ($cllxiaomi as $kev) {
//                   $keyboard->row(Keyboard::inlineButton(['text' => $kev->slug." ".iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F2)), 'callback_data' => $kev->slug]));  
//                 }
//                 $keyboard->row(Keyboard::inlineButton(['text' => $marrxx[0], 'callback_data' => $arraxx[0]]),
//                                Keyboard::inlineButton(['text' => $marrxx[1], 'callback_data' => $arraxx[1]]));
//                 return NewClass::editMess($updfrid,$adada,$ans,$keyboard);
//                 break;

// //  Всі новини (інші 5)  ----------------------------------------------------------------------------------------------------

//          case (DB::table('buttonsworld')->where('callback', $updates['data'])->exists()||DB::table('buttonsscience')->where('callback', $updates['data'])->exists()||DB::table('buttonstech')->where('callback', $updates['data'])->exists()||DB::table('buttonsxianews')->where('callback', $updates['data'])->exists()||DB::table('buttonsukrprim')->where('callback','=',$updates['data'])->exists()||DB::table('buttonslviv')->where('callback', $updates['data'])->exists()||DB::table('buttonsukrjustnews')->where('callback', $updates['data'])->exists()||DB::table('buttonsyestukrnews')->where('callback', $updates['data'])->exists()||DB::table('buttonsyoutube')->where('callback', $updates['data'])->exists()):
//                 $updfrid = $updates['from']['id'];
//                 DB::table('inboxesss')->where('last_name', $last_name)->update(['dick' => $updates['data']]);
//                 $last_word_start = strrpos($updates['data'], " ") + 1;
//                 $last_word = substr($updates['data'], $last_word_start);
//                 $obrezlastw = preg_replace('=\s\S+$=', "", $updates['data']);
//                 $obr = intval($last_word);

//                 if($obrezlastw === 'xiaominews'){
//                     $zrzrzr = DB::table('curltest')->select('titlee','title')->skip($obr)->take(5)->latest('pubDate')->get();
//                     $addsaa = 'buttonsxianews2';
//                     $ans = 'Новини Xiaomi за останній час';
//                 }elseif($obrezlastw === 'tech'){
//                     $zrzrzr = DB::table('technology')->select('titlee','title')->skip($obr)->take(5)->latest('pubDate')->get();
//                     $addsaa = 'buttonstech2';
//                     $ans = 'Новини технологій за останній час';
//                 }elseif($obrezlastw === 'science'){
//                     $zrzrzr = DB::table('science')->select('titlee','title')->skip($obr)->take(5)->latest('pubDate')->get();
//                     $addsaa = 'buttonsscience2';
//                     $ans = 'Новини науки за останній час';
//                 }elseif($obrezlastw === 'world'){
//                     $zrzrzr = DB::table('world')->select('titlee','title')->skip($obr)->take(5)->latest('pubDate')->get();
//                     $addsaa = 'buttonsworld2';
//                     $ans = 'Новини світу за останній час';
//                 }elseif($obrezlastw === 'ukrgol'){
//                     $zrzrzr = DB::table('curltest3')->select('titlee','title')->skip($obr)->take(5)->latest('pubDate')->get();
//                     $addsaa = 'buttonsukrprim2';
//                     $ans = 'Новини головні за останній час';
//                 }elseif($obrezlastw === 'ukrnews'){
//                     $zrzrzr = DB::table('testcurl2')->select('titlee','title','link')->where('title','like','%'.$deytrdio.'%')->orWhere('link','like','%'.$deytrdio.'%')->where('pubDate', '>=', $tmtdstrt)->where('pubDate', '<=', $tmtdend)->skip($obr)->take(5)->latest('pubDate')->get();
//                     $addsaa = 'buttonsukrjustnews2';
//                     $ans = 'Останні новини про '.$deytrdio;
//                 }elseif($obrezlastw === 'yestukrnews'){
//                     $zrzrzr = DB::table('testcurl2')->select('titlee','title','link')->where('title','like','%'.$deytrdio.'%')->orWhere('link','like','%'.$deytrdio.'%')->where('pubDate', '>=', $strtmonth)->skip($obr)->take(5)->latest('pubDate')->get();
//                     $addsaa = 'buttonsyestukrnews2';
//                     $ans = 'Останні новини про '.$deytrdio;
//                 }elseif($obrezlastw === 'lviv'){
//                     $zrzrzr = DB::table('lviv')->select('titlee','title')->skip($obr)->take(5)->latest('pubDate')->get();
//                     $addsaa = 'buttonslviv2';
//                     $ans = 'Новини Львова за останній час';
//                 }elseif($obrezlastw === 'youtube'){
//                     $deytrdio = str_replace("%20", " ", $deytrdio);
//                     $deytrdio = mb_strtolower($deytrdio);
//                     $zrzrzr = DB::table('youtube')->where('title','like','%'.$deytrdio.'%')->orWhere('channelTitle','like','%'.$deytrdio.'%')->skip($obr)->take(5)->latest('publishedAt')->get();
//                     $addsaa = 'buttonsyoutube2';
//                     $ans = 'Знайдено по запиту '.$deytrdio;
//                 }
//                 $get5next = NewClass::add5News($obr);
//                 $buttons = DB::table($addsaa)->select($get5next)->first();
//                 $keyboard = NewClass::addButton($buttons);
    
//                 if($obrezlastw === 'ukrnews'||$obrezlastw === 'yestukrnews'||$obrezlastw === 'youtube'){
//                         foreach($zrzrzr as $valll){
//                             if($obrezlastw === 'youtube'){
//                                 $title = $valll->title;
//                                 $title = strval($title);
//                                 $vidid = $valll->videoId;
//                                 $rrext = mb_substr($title, 0, 30);
//                                 $keyboard->row(Keyboard::inlineButton([
//                                     'text'          => $title,
//                                     'callback_data' => $vidid]));

//                             }else{
//                                 $title = $valll->title;
//                                 $title = strval($title);
//                                 $rrext = mb_substr($title, 0, 30);
//                                 $keyboard->row(Keyboard::inlineButton([
//                                     'text'          => $title,
//                                     'callback_data' => $rrext])); 
//                             }   
//                         }
//                         $keyboard->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F0)).' Hовини', 'callback_data' => "newsss"]),
//                             Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F1)).' Xiaomi', 'callback_data' => "phonsss"]),
//                             Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x2601)).' Повітря', 'callback_data' => "jakistpov"]));
//                             return NewClass::editMess($updfrid,$adada,$ans,$keyboard);
                            
                        
//                 }else{
//                     foreach($zrzrzr as  $valll){
//                         $keyboard->row(Keyboard::inlineButton([
//                             'text'          => $valll->title,
//                             'callback_data' => $valll->titlee]));  
//                     }
                    
//                     $keyboard->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F519)).' Назад', 'callback_data' => "newsss"]),
//                         Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F3E0)).' Меню', 'callback_data' => "mentos"]));
//                         return NewClass::editMess($updfrid,$adada,$ans,$keyboard);
                        
                    
//                 } 
//                 break;

//             case (strpos($updates['data'], 'youtube') !== false):
//                 $deytrd = DB::table('inboxesss')->where('last_name', $last_name)->first(); 
//                 $updfrid = $updates['from']['id'];
//                 $dick = $deytrd->dick;
//                 $dick = str_replace("%20", " ", $dick);
//                 $dick = mb_strtolower($dick);
//                 $yout = DB::table('youtube')->where('title','like','%'.$dick.'%')->orWhere('channelTitle','like','%'.$dick.'%')->skip(0)->take(5)->latest('publishedAt')->get();
//                 $buttons = DB::table('buttonsyoutube2')->select('2','3','4','5','6')->first();
//                 $keyboard = NewClass::addButton($buttons);
//                         foreach ($yout as $keyxza) {
//                             $chantit = $keyxza->channelTitle;
//                             $ttit = $keyxza->title;
//                             $rrext = mb_substr($ttit, 0, 30);
//                             $keyboard->row(Keyboard::inlineButton(['text' => $rrext, 'callback_data' => $keyxza->videoId]));
//                         }
//                         $keyboard->row(
//                                 Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F1)).' Xiaomi', 'callback_data' => "phonsss"]),
//                                 Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F0)).' Новини', 'callback_data' => "newsss"]),
//                                 Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x2601)).' Повітря', 'callback_data' => "jakistpov"]));
//                                 $ans = 'Знайдено по запиту '.$dick;
//                                 return NewClass::editMess($updfrid,$adada,$ans,$keyboard);
                                
//                         break;



//             case (strpos($updates['data'], 'download') !== false):
//                 $last_word_start = strrpos($updates['data'], " ") + 1;
//                 $last_word = substr($updates['data'], $last_word_start);
//                 $keyboard = Keyboard::make()->inline()->row(Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F1)).' меню', 'callback_data' => "mentos"]));
//                 return Telegram::sendDocument(['chat_id' => $updates['from']['id'],
//                                      'caption' => 'В розробці :)',
//                                      'document' => \Telegram\Bot\FileUpload\InputFile::create("https://www.youtube.com/watch?v=".$last_word, 'video')]);
//             break;

// //  Вивід характеристик смартфонів ------------------------------------------------------------------------------------------

//             case (DB::table('comparesss')->where('slug',$updates['data'])->exists()):
//                 DB::table('inboxesss')->where('last_name', $last_name)->update(['dick' => $updates['data']]); 
//                 $deyaaa = DB::table('inboxesss')->where('last_name', $last_name)->first();
//                 $deyaaye = $deyaaa->ffick;
//                 $fotka = DB::table('comparesss')->where('slug',$updates['data'])->value('img');
//                 $upd = $updates['data'];
//                 $keyboard = NewClass::phonees($upd,$deyaaye);
//                     return Telegram::editMessageText([
//                         'chat_id' => $updates['from']['id'],
//                         'message_id' => $adada,
//                         'text' => "http://vap.in.ua/storage/app/public/".$fotka."\n\n".$updates['data'],
//                         'reply_markup' => $keyboard
//                     ]);
//                 break;
//             default:
//                 $updfrid = $updates['from']['id'];
//                 $last_word_start = strrpos($updates['data'], ' ') + 1;
//                 $last_word = substr($updates['data'], $last_word_start);
//                 $obrezlastw = preg_replace('=\s\S+$=', '', $updates['data']);  
//                 $deja = DB::table('comparesss')->where('slug',$obrezlastw)->value($last_word); 
//                 $dzxzxs = DB::table('inboxesss')->where('last_name', $last_name)->first(); 
//                 $llaaxx = $dzxzxs->dick;
//                 $deyaaye = $dzxzxs->ffick;
//                 $fotka = DB::table('comparesss')->where('slug',$obrezlastw)->value('img');
//                 $keyboard = Keyboard::make()->inline()
//                  ->row(Keyboard::inlineButton([
//                         'text'          => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F519)).' Назад',
//                         'callback_data' => $llaaxx]),
//                         Keyboard::inlineButton(['text' => iconv('UCS-4LE', 'UTF-8', pack('V', 0x1F4F2)).' До лінійки',
//                         'callback_data' => $deyaaye]));
//                 $ans = "http://vap.in.ua/storage/app/public/".$fotka."\n\n".$obrezlastw."\n\n".strip_tags($deja);
//                 return NewClass::editMess($updfrid,$adada,$ans,$keyboard);
                
//               break;    
//         }
    }
}