<?php
namespace App\Http\Controllers;
use App;
use App\MyClass\connectClass;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Cookie;
use Session;
use Auth;



class FilterController extends Controller
{
    
    public function get_filter_data(Request $request)
    {
    	if(isset($_SESSION['pars'])){
	$dt->connect($dbhost=$_SESSION['pars'][0],$dbname=$_SESSION['pars'][1],$username=$_SESSION['pars'][2],$password=$_SESSION['pars'][3]);
}

if(isset($request->localhost) && $request->dbname !== ''){
	unset($_SESSION['pars']);
	$dt->pars($request->localhost,$request->dbname,$request->username,$request->pas);
	$dt->connect($dbhost=$request->localhost,$dbname=$request->dbname,$username=$request->username,$password=$request->pas);
	echo $dt->tables();
}

if(isset($request->tabll) && $request->tab==='tab'){
	echo $dt->get_cells($base = $request->tabll);
}

if(isset($request->selll) && isset($request->tabll)){
	echo $dt->get_c($categ=$request->selll,$base=$request->tabll);
}

if(isset($request->tabll) && isset($request->vals) && isset($request->ca1)){
	echo $dt->get_dbres($cats = $request->ca1,$vals = $request->vals,$table = $request->tabll);
}

if(isset($_POST['dawadu'])){
	$uniqidd = uniqid();
	$newProject = fopen(session_id().".xls", "w");
	fwrite($newProject, $_SESSION['tabldatar']);
	echo session_id();
} 
       
       }
     
}