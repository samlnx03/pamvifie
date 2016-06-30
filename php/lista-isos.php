<html><body><?php require('menu.php');?>
<?php
/* 
lista-isos.php
obtiene una lista de imagenes iso del server de virtualizacion para ser usada en cdrom
da oportunidad de actualizar la tabla mvIsos en la base de datos

Roles permitidos: Admin, profesor, alumno
Info requerida: ninguna
Nota: lista de isos para poner uno en el cdrom, comando relacionado bash lista-iso.sh
Formato de info: listaIsos+

*/
require_once "vmManager.php";

$vmm=VMmanager::getInstance();
$vmm->write("cmd:listaIsos");
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

</body></html>
