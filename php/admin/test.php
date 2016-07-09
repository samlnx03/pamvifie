<?php
require_once "virtualMachine.php";
require_once "../db/conection.php";

use estudiante\virtualMachine as virtualMachine;
use db\Conection as Conection;

$db = new Conection(); 
//$vm  = new virtualMachine($db, "usuarios");
//echo "permiso samuelP: ".$vm->getPermisoUsuario();
virtualMachine::listaIsos($db);
?>

