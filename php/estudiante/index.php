<?php
require_once "virtualMachine.php";
require_once "../db/conection.php";

// AGREGAR LO DE AUTENTICACION

use estudiante\virtualMachine as virtualMachine;
use db\Conection as Conection;

echo "<html><body>\n";
require "menu.php";

$db = new Conection(); 
// lista de isos no requiere instanciar virtualMachine

echo "<div id='Mensajes'>\n";
echo "</div>\n";

echo "<div id='reservaciones'>\n";
// mostrar las reservaciones
$rids=virtualMachine::mis_reservaciones($db);
echo "<h1>Reservaciones</h1>\n";
echo "<table border=1><tr><th>Maq.<th>Reservacion<th>acciones</tr>\n";
foreach ($rids as $rid => $inforeserva){
	echo "<tr><td>".$inforeserva["name"]; 
	echo "<td>".$inforeserva["inicio"];
	echo "<br>".$inforeserva["fin"];
	if($inforeserva["esUsable"]){
		$mid=$inforeserva["mid"];
		echo "<td><a href='usable.php?mv=$mid'>Utilizar</a>";
	}
	else{
		echo "<td>Cancelar Reservacion";
	}
	echo "</tr>\n";
}
echo "</table>\n";
echo "</div>\n";

echo "<div id='NuevasReserv'>\n";
echo "Realizar nuevas reservaciones ....<br>\n";
echo "</div>\n";

?>
</body>
</html>

