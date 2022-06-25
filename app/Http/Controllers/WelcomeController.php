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
    
    public function getdata(Request $request)
    {

        $data = Http::post('https://owner-api.teslamotors.com/'.$request->oauth.'/'.$request->token);

        echo json_encode($data);
       
       }
     
}