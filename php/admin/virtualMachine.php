<?php namespace profesor;

require_once "../vmManager/vmManager.php";
require_once "../estudiante/virtualMachine.php";

use vmManager\vmManager as vmManager;
use estudiante\virtualMachine as EvirtualMachine;

class virtualMachine extends EvirtualMachine {

 protected function esUsable(){	// administra la maq el admin?
	return true;
 }

 function __construct($db, $nummv){
	parent::__construct($db, $nummv);
	// asegurarse que es prof y si no es terminar.
 }
}
?>

