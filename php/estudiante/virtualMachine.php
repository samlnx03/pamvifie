<?php namespace estudiante;

require_once "../vmManager/vmManager.php";
use vmManager\vmManager as vmManager;

class virtualMachine {
 var $name;	// nombre de la maquina virtual
 var $db;		// objeto base de datos para checar permisos del usuario
 var $table="usuarios";	// tabla en la db para checar permiso
 var $campo="tipo";	// campo de la tabla
 var $permiso;  	// Admin, Profesor, Estudiante

 var $cdrom;
 var $mem;
 var $memUnit;
 var $nic;

 protected function esUsable(){	// hay una reservacion lista para usar?
        //$user=$_SESSION['usuario'];	// este debe ser en produccion
        $user="samuelP"; // esto es temporal, sustituir con el anterior
	//	$mname=$this->mname;
	// hacer el query para saber si el usuario tiene una reservacion
	$q=" SELECT R.id from reservaciones R left join mvMaqVirt M on R.maquina=M.id where now() between inicio and fin and usuario='$user' and M.name='{$this->name}'";
	//echo $q;
	$result=$this->db->consulta($q);
	if($result->num_rows > 0){ // estudiante si puede usar la maquina
		//echo "usable<br>\n";
	        $u=true;
	}
	else{
		//echo "NO usable<br>\n";
	        $u=false;
	}
        mysqli_free_result($result);
	return $u;
 }

 function __construct($db, $nummv){
	$this->db = $db;
 	$q="select name,cdrom,mem,memUnit, nic from mvMaqVirt where id=$nummv";
	$db->consulta($q);
	$db->next_row();
	$this->name=$db->f("name");
	$this->cdrom=$db->f("cdrom");
	$this->mem=$db->f("mem");
	$this->memUnit=$db->f("memUnit");
	$this->nic=$db->f("nic");
	$this->setPermisoUsuario();
	//echo "constructor: <br>\n";
	//$this->getVMinfo();
	//echo "exit from constructor: <br>\n";
 }
 function getVMinfo(){
	echo "nombre: ".
	$this->name.
	"<br>\n"."cdrom: ".
	$this->cdrom.
	"<br>\n"." mem: ".
	$this->mem.
	$this->memUnit.
	"<br>\n"."nic(s): ".
	$this->nic.
	"<br>\n"." permiso: ".
	$this->permiso.
	"<br>\n";
 }
 function getPermisoUsuario(){return $this->permiso;}
 function setPermisoUsuario(){
        //$user=$_SESSION['usuario'];
        $user="samuelP";
	$result=$this->db->consulta("SELECT {$this->campo} FROM ".$this->table." WHERE usuario = '$user'");
	if($result->num_rows > 0){
        	$row = mysqli_fetch_array($result);
	        $this->permiso = $row['tipo'];
		// asegurarse que es estudiante y si no es terminar.
        	mysqli_free_result($result);
	}
 }
 public static function listaIsos($db){
	$q="select id,nombre from mvIsos";
	$result=$db->consulta($q);
	$aRet=array();
	while($row=mysqli_fetch_array($result)){
		$aRet[$row['id']]=$row['nombre'];
	}
        mysqli_free_result($result);
	return $aRet;
 }
 function isRunning(){
	if(!$this->esUsable())
		return NULL;
	// usar la api
	$vmm=vmManager::getInstance();
	$vmm->write("cmd:vmIsRunning+name:{$this->name}");
	$l=$vmm->read(1024);
	return $l;
 }
 function boot(){
	if(!$this->esUsable())
		return NULL;
	// usar la api
	$vmm=vmManager::getInstance();
	$vmm->write("cmd:vmStart+name:{$this->name}");
	$l=$vmm->read(1024);
	return $l;
 }
 function kill(){
	if(!$this->esUsable())
		return NULL;
	// usar la api
	$vmm=vmManager::getInstance();
	$vmm->write("cmd:vmKill+name:{$this->name}+signal:SIGTERM");
	$l=$vmm->read(1024);
	return $l;
 }
 function changeCD($nuevo){
	if(!$this->esUsable())
		return NULL;
	// usar la api
	$q="select id, nombre from mvIsos where id=$nuevo";
	$this->db->consulta($q);
	$this->db->next_row();
	$nuevo=$this->db->f("nombre");
	$vmm=vmManager::getInstance();
	$vmm->write("cmd:vmChangeCD+name:{$this->name}+newcdrom:$nuevo");
	$l=$vmm->read(1024);
	if(substr($l,0,2)!="-1"){
		$q="UPDATE mvMaqVirt set cdrom={$this->db->f('id')} where name='{$this->name}'";
		$this->db->consulta($q);
	}
	return $l;
 }
}
?>

