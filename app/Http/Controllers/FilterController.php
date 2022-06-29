<?php
namespace App\Http\Controllers;
use App;
use App\MyClass\connectClass;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Cookie;
use Session;
use Auth;



class TeslaController extends Controller
{
    
    public function get_filter_data(Request $request)
    {
    	if(isset($_SESSION['pars'])){
	$dt->connect($dbhost=$_SESSION['pars'][0],$dbname=$_SESSION['pars'][1],$username=$_SESSION['pars'][2],$password=$_SESSION['pars'][3]);
}

if(isset($_POST['localhost']) && $_POST['dbname'] !== ''){
	unset($_SESSION['pars']);
	$dt->pars($_POST['localhost'],$_POST['dbname'],$_POST['username'],$_POST['pas']);
	$dt->connect($dbhost=$_POST['localhost'],$dbname=$_POST['dbname'],$username=$_POST['username'],$password=$_POST['pas']);
	echo $dt->tables();
}

if(isset($_POST['tabll']) && $_POST['tab']==='tab'){
	echo $dt->get_cells($base = $_POST['tabll']);
}

if(isset($_POST['selll']) && isset($_POST['tabll'])){
	echo $dt->get_c($categ=$_POST['selll'],$base=$_POST['tabll']);
}

if(isset($_POST['tabll']) && isset($_POST['vals']) && isset($_POST['ca1'])){
	echo $dt->get_dbres($cats = $_POST['ca1'],$vals = $_POST['vals'],$table = $_POST['tabll']);
}

if(isset($_POST['dawadu'])){
	$uniqidd = uniqid();
	$newProject = fopen(session_id().".xls", "w");
	fwrite($newProject, $_SESSION['tabldatar']);
	echo session_id();
} 
       
       }
     
}