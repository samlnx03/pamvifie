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

$db = new Conection(); 
$m=new virtualMachine($db, $mv);
$m->setUser("a0701637f");	// QUITAR AL AGREGAR LAS SESIONES

echo "<div id='Mensajes'>\n";
//echo $m->getUser();
echo "</div>\n";

echo "<div id='maquina'>\n";
echo "<h1>Su maquina</h1>\n";
$m->getVMinfo();
echo "Encendida: ".$m->isRunning()."<br>\n";
echo "<a href='encender.php?mv=$mv'>Encender</a> ";
echo " <a href='?mv=$mv'>Refresh</a>";
echo " <a href='apagar.php?mv=$mv'>Apagar</a>";
echo "</div>\n";

echo "<div id='listaIsos'>\n";
if($m->cdrom){
	$l=virtualMachine::listaIsos($db);
	echo "<h2>Lista de imagenes de CD-ROM</h2>\n";
	foreach($l as $id => $namecd){
		echo "$id: $namecd ";
		if($id!=$m->cdrom)
			echo "<a href=cambiarcd.php?mv=$mv&cd=$id>cambiar</a>";
		echo "<br>\n";
	}
}
echo "</div>\n";

?>
</body>
</html>

