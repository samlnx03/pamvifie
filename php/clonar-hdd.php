<html><body><?php require('menu.php');?>
<?php
/* 
clonar-hdd.php
iclonar un disco duro a parti de uno ya existente
el resultado empieza con -1 cuando hay algun problema
si todo va bien se regresa una cadena indicando el pid del dd por ser lento

Roles permitidos: Admin
Info requerida: nombre del hdd origen y del nuevo
Nota: comando relacionado sudo lvs lvcreate dd
Formato de info: cmd:clonarHdd+name:nombre+new=nombre
Regresa: info del volumen logico y pid del dd o "-1 poblema" si hay algun problema

*/
require_once "vmManager.php";

$vmm=VMmanager::getInstance();
require("checa_socket_ok.php");
$vmm->write("cmd:clonarHdd+name:borrame+new:borrame1");
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
