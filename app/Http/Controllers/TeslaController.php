<?php
namespace App\Http\Controllers;
use App;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Cookie;
use Session;
use Auth;



class TeslaController extends Controller
{
    
    public function get_data(Request $request)
    {
    	$data = 'test';
        //$data = Http::post('https://owner-api.teslamotors.com/'.$request->oauth.'/'.$request->token);
        
        echo $data;
       // echo $data->access_token;
       //$data = json_encode($data, true);
        

       
       }
     
}