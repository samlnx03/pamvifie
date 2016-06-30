<html><body><?php require('menu.php');?>
<?php
/* 
lista-negra-vms.php
obtiene una lista de las maquinas virtuales definidas por virsh (servidores)
da oportunidad de actualizar la tabla respectiva en la base de datos

*/
require_once "vmManager.php";

$vmm=VMmanager::getInstance();
require("checa_socket_ok.php");
$vmm->write("cmd:listaNegraVMs");
$l=$vmm->read(1024);
$li=explode("\n",$l);
foreach ($li as $iso){ 
	echo "$iso<br>\n";
	// checar si esta en la tabla de la base de datos
	// si no esta, agregarlo
}


/*
echo "<html><body>\n";
echo "<textarea rows='20' cols='40'>\n";
echo $l;
echo "</textarea>";
echo "</body></html>\n";
*/
?>

</body></html>
