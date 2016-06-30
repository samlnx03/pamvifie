<html><body><?php require('menu.php');?>
<?php
/* 
info-hdd.php
obtiene informacion de un disco duro
el resultado empieza con -1 cuando hay algun problema
si todo va bien se regresa una cadena que tiene el tamaño y el status (o significa en uso)

Roles permitidos: Admin
Info requerida: nombre del hdd a verificar
Nota: comando relacionado sudo lvs 
Formato de info: infoHdd+name:nombre
Regresa: info del volumen logico o "-1 poblema" si hay algun problema

*/
require_once "vmManager.php";

$vmm=VMmanager::getInstance();
require("checa_socket_ok.php");
$vmm->write("cmd:infoHdd+name:borrame");
$l=$vmm->read(1024);
echo $l;

/*
echo "<html><body>\n";
echo "<textarea rows='20' cols='40'>\n";
echo $l;
echo "</textarea>";
echo "</body></html>\n";
*/
?>

</body></html>
