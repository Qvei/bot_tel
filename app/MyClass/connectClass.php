<?php
namespace App\MyClass;

class connectClass{
  
    public $dbhost;
    public $dbname;
    public $username;
    public $password;
    public $categ;
    public $base;
    public $check;
    public $table;
    public $cats;
    public $vals;
   


    public function connect($dbhost,$dbname,$username,$password){
      global $db;
        $this->dbhost = $dbhost;
        $this->dbname = $dbname; 
        $this->username = $username;
        $this->password = $password;

          $con = "mysql:host=".$this->dbhost.";dbname=".$this->dbname;
          $db = new PDO($con, $this->username, $this->password);
          $db->exec("set names utf8");
          if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
           echo "Щось пішло під три чорти...";
          }

        return $db;
  }

  public function get_c($categ,$base){
      global $db;
      $this->categ = $categ;
      $this->base = $base;
      $getcategory = $db->query("SELECT DISTINCT ".$this->categ." FROM ".$this->base);
      $asd = [];
      foreach($getcategory as $f=>$j){ 
        $asd .= '<option value="'.$j[$categ].'">'.$j[$categ].'</option>';
      }
      return $asd;
  }

  public function get_cells($base){
    global $db;
    $this->base = $base;
    $cellsl = [];
    $geta = $db->query("SELECT * FROM ".$this->base." LIMIT 1");
    $getx = array_keys($geta->fetch(PDO::FETCH_ASSOC));
    foreach ($getx as $ed) {
        $cellsl .='<option value="'.$ed.'">'.$ed.'</option>';
    }
    return $cellsl;
  }

  public function get_dbres($cats,$vals,$table){
    global $db;
    $this->cats = $cats;
    $this->vals = $vals;
    $this->table = $table;
    $queryd = "SELECT * FROM ".$this->table." WHERE ".$this->cats[0]." IN ('".$this->vals[0]."','".$this->vals[1]."','".$this->vals[2]."')";
    if($this->cats[1]){
      for($i=1;$i<count($this->cats);$i++){
        $queryd .= " OR ".$this->cats[$i]." IN ('".$this->vals[0]."','".$this->vals[1]."','".$this->vals[2]."')";
      }
    }
    $getfiles = $db->query($queryd);
      $countfiles = $getfiles->rowCount();
      $gototable = $getfiles->fetchAll(PDO::FETCH_ASSOC);
      $ge = $db->query("SELECT * FROM ".$this->table." LIMIT 1");
      $fields = array_keys($ge->fetch(PDO::FETCH_ASSOC));
      if ($gototable) {
        global $db;
        foreach($fields as $column_name){
            $name .= '<th>'.$column_name.'</th>';
        }
        foreach ($gototable as $row){
            foreach($row as $col_name => $val){
            $vallls .='<td>'.$val.'</td>';    
             }
            $vallls ='<tr>'.$vallls.'</tr>';
        }
      }

      $_SESSION['tabldatar'] = '<table class="table table-bordered" cellspacing="0"><caption style="caption-side:top;">'.$countfiles.' matches!</caption><thead><tr>'.$name.'</tr></thead><tbody>'.$vallls.'</tbody></table>';
      
      return $_SESSION['tabldatar'];
  }

  public function tables(){
    global $db;
    $das = $db->query("show tables")->fetchAll(PDO::FETCH_NUM);
    $tos = [];
    foreach ($das as $key) {
      $tos .='<option value="'.$key[0].'">'.$key[0].'</option>';
    }
    return $tos;
  }

  public function pars($dbhost,$dbname,$username,$pas){
    $this->dbhost = $dbhost;
    $this->dbname = $dbname;
    $this->username = $username;
    $this->password = $pas;
    if(isset($_POST['localhost'])){
        return $_SESSION['pars'] = [$this->dbhost,$this->dbname,$this->username,$this->password];
    }else{
        return 'ok';
    }
  }
}

$dt = new connectClass;


?>