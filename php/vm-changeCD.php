<html><body><?php require('menu.php');?>
<?php
/* 
vm-changeCD.php	envia señal a proceso de mv

*/
require_once "vmManager.php";

$vmm=VMmanager::getInstance();
require("checa_socket_ok.php");
        // valores de prueba
        $name="name"; 
	$nameval="prueba";	// ESTE VALOR SE DEBE DE OBTENER DE CONSULTA A LA TABLA
				// NO LO DEBE ESCRIBIR NUNCA EL USUARIO FINAL
				// SE DEBE VALIDAR EL ROL DEL USUARIO

$vmm->write("cmd:vmChangeCD+$name:$nameval+newcdrom:ubuntu-14.04.1-server-amd64.iso");
$l=$vmm->read(1024);
echo "$l<br>\n";

/*
echo "<html><body>\n";
echo "<textarea rows='20' cols='40'>\n";
echo $l;
echo "</textarea>";
echo "</body></html>\n";
*/
?>

</body></html>
