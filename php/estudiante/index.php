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
$usuario="a0701637f";   // TEMPORAL
$q="SELECT id, usuario, maquina, inicio, fin,  now() between inicio and fin as usable from reservaciones where usuario='$usuario'";
//echo $q;
$db->consulta($q);
echo "<h1>Reservaciones</h1>\n";
echo "<table border=1><tr><th>Maq.<th>desde<th>hasta<th>acciones</tr>\n";
while($db->next_row()){
	$maq=$db->f("maquina");
	echo "<tr><td>$maq<td>{$db->f('inicio')}<td>{$db->f('fin')}<td>";
	if($db->f('usable')){
		echo "<a href='usable.php?mv=$maq'>Utilizar</a>";
	}
	else{
		echo "Cancelar Reservacion";
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

