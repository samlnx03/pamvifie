<?php
/* 
borrar-hdd.php
obtiene informacion de un disco duro
el resultado empieza con -1 cuando hay algun problema
si todo va bien se regresa una cadena que tiene el tamaño y el status (o significa en uso)

Roles permitidos: Admin
Info requerida: nombre
Nota: verificar que no esta asociado a ninguna mv, comando relacionado sudo lvremove -f fie_vg/name
Formato de info: cmd:borrarHdd+name:nombre

*/
require_once "vmManager.php";

$vmm=VMmanager::getInstance();
$vmm->write("cmd:borrarHdd+name:borrame");
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

