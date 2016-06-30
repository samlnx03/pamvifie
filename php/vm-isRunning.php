<html><body><?php require('menu.php');?>
<?php
/* 
vm-isRunning.php	saber si una vm esta corriendo

*/
require_once "vmManager.php";

$vmm=VMmanager::getInstance();
        // valores de prueba
        $name="name"; $nameval="prueba";

$vmm->write("cmd:vmIsRunning+$name:$nameval");
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
