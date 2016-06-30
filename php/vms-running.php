<html><body><?php require('menu.php');?>
<?php
/* 
vms-running.php
obtiene una lista de las maquinas virtuales que estan corriendo
no incluye los servidores virsh ni maquinas especiales

*/
require_once "vmManager.php";

$vmm=VMmanager::getInstance();
$vmm->write("cmd:vmsRunning");
$l=$vmm->read(1024);
$li=explode("\n",$l);
foreach ($li as $iso){ 
	echo "$iso<br>\n";
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
