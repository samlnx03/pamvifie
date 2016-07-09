<?php
require_once "virtualMachine.php";
require_once "../db/conection.php";

// AGREGAR LO DE AUTENTICACION

use estudiante\virtualMachine as virtualMachine;
use db\Conection as Conection;

//echo "nombre de mv $mv:".$db->f("name")."<br>\n";
// lista de isos no requiere instanciar virtualMachine

echo "<html><body>\n";
require "menu.php";

if(isset($_GET['mv'])) 
	$mv=$_GET['mv'];
else {
	echo "MV no especificada<br>\n";
	echo "</body></html>\n";
	exit;
}
if(isset($_GET['cd'])) 
	$cd=$_GET['cd'];
else {
	echo "CD no especificado<br>\n";
	echo "</body></html>\n";
	exit;
}
$db = new Conection(); 

echo "<div id='Mensajes'>\n";
$m=new virtualMachine($db, $mv);
$r=$m->changeCD($cd);
echo $r."<br>\n";
if($m->isRunning()=="SI")
	echo "Es necesario reiniciar la maquina<br>\n";
echo "</div>\n";

echo "<div id='maquina'>\n";
echo "<a href='usable.php?mv=$mv'>Controlar</a>";
echo "</div>\n";

?>
</body>
</html>

