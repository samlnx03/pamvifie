<?php namespace estudiante;

require_once "../vmManager/vmManager.php";
use vmManager\vmManager as vmManager;

class virtualMachine {
 protected $db;		// objeto base de datos para checar permisos del usuario
 protected $table="usuarios";	// tabla en la db para checar permiso
 protected $campo="tipo";	// campo de la tabla
 protected $permiso;  	// Admin, Profesor, Estudiante

 protected $name;	// nombre de la maquina virtual
 protected $id;
 protected $cdrom;
 protected $mem;
 protected $memUnit;
 protected $nic;

 protected $user;

 public function setUser($u){ 
	$this->user=$u;
	$this->setPermisoUsuario();
 }

 public function getUser(){ return $this->user; }

 protected function esUsable(){	// hay una reservacion lista para usar?
	// hacer el query para saber si el usuario tiene una reservacion
        $user=$this->user;
	$q=" SELECT R.id from reservaciones R left join mvMaqVirt M on R.maquina=M.id where now() between inicio and fin and usuario='$user' and M.name='{$this->name}'";
	echo $q;
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
	// if no hay session usuario exit
	//$this->setUser($_SESSION['usuario']);	// este debe ser en produccion
	$this->db = $db;
 	$q="select id, name,cdrom,mem,memUnit, nic from mvMaqVirt where id=$nummv";
	$db->consulta($q);
	$db->next_row();
	$this->id=$db->f("id");
	$this->name=$db->f("name");
	$this->cdrom=$db->f("cdrom");
	$this->mem=$db->f("mem");
	$this->memUnit=$db->f("memUnit");
	$this->nic=$db->f("nic");
 }
 public function getVMinfo(){
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

 public function getPermisoUsuario(){return $this->permiso;}

 private function setPermisoUsuario(){
	$q="SELECT {$this->campo} FROM ".$this->table." WHERE usuario = '{$this->user}'";
	//echo "$q<br>\n";
	$result=$this->db->consulta($q);
	if($result->num_rows > 0){
        	$row = mysqli_fetch_array($result);
	        $this->permiso = $row['tipo'];
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
 public function isRunning(){
	if(!$this->esUsable())
		return NULL;
	// usar la api
	$vmm=vmManager::getInstance();
	$vmm->write("cmd:vmIsRunning+name:{$this->name}");
	$l=$vmm->read(1024);
	return $l;
 }
 public function boot(){
	if(!$this->esUsable())
		return NULL;
	// usar la api
	$vmm=vmManager::getInstance();
	$vmm->write("cmd:vmStart+name:{$this->name}");
	$l=$vmm->read(1024);
	return $l;
 }
 public function kill(){
	if(!$this->esUsable())
		return NULL;
	// usar la api
	$vmm=vmManager::getInstance();
	$vmm->write("cmd:vmKill+name:{$this->name}+signal:SIGTERM");
	$l=$vmm->read(1024);
	return $l;
 }
 public function changeCD($nuevo){
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

