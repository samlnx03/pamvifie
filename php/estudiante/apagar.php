<?php
require_once "virtualMachine.php";
require_once "../db/conection.php";

// AGREGAR LO DE AUTENTICACION

use estudiante\virtualMachine as virtualMachine;
use db\Conection as Conection;

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

echo "<div id='Mensajes'>\n";
$m=new virtualMachine($db, $mv);
$r=$m->kill();
echo $r."<br>\n";
echo "</div>\n";

echo "<div id='maquina'>\n";
echo "<a href='usable.php?mv=$mv'>Controlar</a>";
echo "</div>\n";

?>
</body>
</html>

