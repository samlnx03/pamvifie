<html><body><?php require('menu.php');?>
<?php
/* 
crea-hdd.php

el resultado empieza con -1 cuando hay algun problema
si todo va bien se regresa una cadena que tiene el mensaje de salida del comando lvcreate

Roles permitidos: Admin
Info requerida: nombre del hdd a crear y tamaño
Nota: comando relacionado sudo lvcreate
Formato de info: cmd:crearHdd+name:nombre
Regresa: info del volumen logico o "-1 poblema" si hay algun problema

*/
require_once "vmManager.php";

$vmm=VMmanager::getInstance();
$vmm->write("cmd:crearHdd+name:borrame+size:1G");
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
