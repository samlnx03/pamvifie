<?php
/* 
lista-vms.php
obtiene una lista de los scripts que definen maquinas virtuales
da oportunidad de actualizar la tabla respectiva en la base de datos

*/
require_once "vmManager.php";

$vmm=VMmanager::getInstance();
$vmm->write("cmd:listaVMs");
$l=$vmm->read(1024);
$li=explode("\n",$l);
foreach ($li as $iso){ 
	echo "$iso<br>\n";
	// checar si esta en la tabla de la base de datos
	// si no esta, agregarlo
}
// checar que todos los isos referenciados en la mv's existan

// checar si los iso de la tabla estan en la lista de isos
// si alguno no esta poner null en la maquina que lo referencie
// 	y eliminarlo de la tabla de isos



/*
echo "<html><body>\n";
echo "<textarea rows='20' cols='40'>\n";
echo $l;
echo "</textarea>";
echo "</body></html>\n";
*/
?>

