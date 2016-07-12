<?php namespace profesor;

require_once "../vmManager/vmManager.php";
require_once "../estudiante/virtualMachine.php";

use vmManager\vmManager as vmManager;
use estudiante\virtualMachine as EvirtualMachine;

class virtualMachine extends EvirtualMachine {

 protected function esUsable(){	// administra la maq el prof?
	// hacer el query para saber si el usuario administra la maquina
	$q="SELECT mv_id FROM maquinas_asignadas M LEFT JOIN usuarios U on M.profesor=U.usuario WHERE M.mv_id='{$this->id}' AND usuario='{$this->user}' AND tipo='profesor'";
	echo $q."<br>\n";
	$result=$this->db->consulta($q);
	if($result->num_rows > 0){ // prof si puede usar la maquina
		//echo "usable<br>\n";
	        $u=true;
	}
	else{
		//echo "NO usable<br>\n";
	        $u=false;
	}
        mysqli_free_result($result);
	return $u;
 }

 function __construct($db, $nummv){
	parent::__construct($db, $nummv);
	// asegurarse que es prof y si no es terminar.
 }
}
?>

