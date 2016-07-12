<?php
require_once "virtualMachine.php";
require_once "../db/conection.php";

// AGREGAR LO DE AUTENTICACION

use profesor\virtualMachine as virtualMachine;
use db\Conection as Conection;

echo "<html><body>\n";
require "menu.php";

$db = new Conection(); 
// lista de isos no requiere instanciar virtualMachine

echo "<div id='Mensajes'>\n";
echo "</div>\n";

echo "<div id='asignadas'>\n";
// mostrar las reservaciones
$usuario="samuelP";   // TEMPORAL
$q="SELECT mv_id from maquinas_asignadas where profesor='$usuario'";
//echo $q;
$db->consulta($q);
echo "<h1>Maquinas asignadas</h1>\n";
$mvids=array(); // ids de maquinas virtuales asignadas
while($db->next_row())
	$mvids[]=$db->f("mv_id");

foreach ($mvids as $maq){
	echo "maq: $maq <a href=encender.php?mv=$maq>Encender</a><br>\n";
	$m=new virtualMachine($db, $maq);
	$m->setUser("samuelP"); // QUITAR EN PRODUCCION
	$mva[]=$m;
	$m->getVMinfo();
	echo "Encendida: ".$m->isRunning()."<br>\n";
	echo "<br>\n";
}
echo "</div>\n";

echo "<div id='gestion'>\n";
echo "Realizar otras gestiones ....<br>\n";
echo "</div>\n";

?>
</body>
</html>

