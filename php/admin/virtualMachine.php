<?php namespace admin;

require_once "../vmManager/vmManager.php";
require_once "../estudiante/virtualMachine.php";
use vmManager\vmManager as vmManager;
use estudiante\virtualMachine;

class virtualMachine extends estudiante\virtualMachine {

 function __construct($db, $table){
	parent::__construct($db, $table);
 }
 public static function listaIsos($db){
	$vmm=vmManager::getInstance();
	//require("checa_socket_ok.php");
	$vmm->write("cmd:listaIsos");
	$l=$vmm->read(1024);
	if(strlen($l)==0)
		return;
	$li=explode("\n",$l);
	$v="";
	foreach ($li as $iso){ 
		$v=$v."('$iso'),";
        	//echo "$iso<br>\n";
	        // checar si esta en la tabla de la base de datos
	        // si no esta, agregarlo
	}
	$q="create temporary table tmpIsos select * from mvIsos where id<0";
	$db->consulta($q);
	$v=substr($v, 0, strlen($v)-1);
	$q="insert into tmpIsos (nombre) values ".$v;
	$db->consulta($q);

	//$l=str_replace("\n", "','", $l);
	//$l="'".$l."'";
	//echo $l."\n";
	$q="select nombre from mvIsos where nombre not in (select nombre from tmpIsos)";
	//$q="select nombre from mvIsos";
	$result=$db->consulta($q);
	while($row=mysqli_fetch_array($result)){
	        echo "Ya no estan en el servidor (Borrar) ". $row['nombre']."\n";
	}
        mysqli_free_result($result);
	$q="select nombre from tmpIsos where nombre not in (select nombre from mvIsos)";
	//$q="select nombre from mvIsos";
	$result=$db->consulta($q);
	while($row=mysqli_fetch_array($result)){
	        echo "Nuevos en el servidor (Agregar) ". $row['nombre']."\n";
	}
        mysqli_free_result($result);
 }
 function isRunning(){
 }
 function boot(){
 }
 function kill(){
 }
 function changeCD(){
 }
}
?>

