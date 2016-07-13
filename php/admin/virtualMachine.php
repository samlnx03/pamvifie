<?php namespace profesor;

require_once "../vmManager/vmManager.php";
require_once "../estudiante/virtualMachine.php";

use vmManager\vmManager as vmManager;
use estudiante\virtualMachine as EvirtualMachine;

class virtualMachine extends EvirtualMachine {

 static function mis_maquinas($db){// todas las maquinas que administro
	$q="SELECT id from mvMaqVirt";
	//echo $q;
	$db->consulta($q);
	$mvids=array(); // ids de maquinas virtuales asignadas
	while($db->next_row())
        	$mvids[]=$db->f("id");
	return $mvids;
 }

 protected function esUsable(){	// administra la maq el admin?
	return true;
 }

 function __construct($db, $nummv){
	parent::__construct($db, $nummv);
	// asegurarse que es admin y si no es terminar.
 }
}
?>

