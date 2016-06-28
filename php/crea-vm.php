<?php
/* 
crea-vm.php

*/
require_once "vmManager.php";

$vmm=VMmanager::getInstance();
        // valores de prueba
        $mem="mem"; $memSize="1G"; 
        $name="name"; $nameval="prueba";
	$nic="nic"; $numnics=1;
        $cdrom="cdrom";$cdromdata="systemrescuecd-x86-3.8.1.iso";
        $hd0="hd0";$hd0dd="PKR4";
        //$hd1=""; $hd1dd="";
        $vnc="vnc"; $vncval=1;
        // fin valores de prueba

$vmm->write("cmd:createVM+$name:$nameval+$nic:$numnics+$mem:$memSize+$cdrom:$cdromdata+$hd0:$hd0dd+$vnc:$vncval");
$l=$vmm->read(1024);
$li=explode("\n",$l);
foreach ($li as $iso){ 
	echo "$iso\n";
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

