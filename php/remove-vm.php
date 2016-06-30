<html><body><?php require('menu.php');?>
<?php
/* 
remove-vm.php

*/
require_once "vmManager.php";

$vmm=VMmanager::getInstance();
require("checa_socket_ok.php");
        // valores de prueba
        $nameval="prueba";
$vmm->write("cmd:removeVM+name:$nameval");
$l=$vmm->read(1024);
echo "$l\n";

/*
echo "<html><body>\n";
echo "<textarea rows='20' cols='40'>\n";
echo $l;
echo "</textarea>";
echo "</body></html>\n";
*/
?>

</body></html>
