<?php
require("../secret.php");
class VMmanager  {
	protected static $instance;
	var $address=IP;
	var $port=PORT;
	var $error;
	var $errmsg;
	var $socket;
	var $is_connected;

	public static function getInstance() {
		if( !self::$instance ) {
			self::$instance = new self(); 
		}
		return self::$instance;
	}

	function __construct() {
		$this->error=0;
		$this->is_connected=false;
		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if ($this->socket === false){
			$this->error=1;
	    		$this->errmsg=socket_strerror(socket_last_error());
		} 
		$this->connect();
	}
	function connect(){
		if ($this->is_connected) return;
		if (! $this->error) {
			$result = socket_connect($this->socket, $this->address, $this->port);
			if ($result === false) {
				$this->error=2;
				$this->errmsg=socket_strerror(socket_last_error($this->socket));
			}
			else
				$this->is_connected=true;
		}
		//echo "conectado al server\n";
	}

	function disconnect(){ 
		//echo "desconectando del server\n";
		if(!$this->is_connected)
			return;
		$this->is_connected=false;
		$this->write("disconnect");
		socket_shutdown($this->socket,2);
		socket_close($this->socket);
	}

	function __destruct(){
		if($this->is_connected) {
			$this->is_connected=false;
			socket_shutdown($this->socket,2);
			socket_close($this->socket);
		}
	}

	function any_error(){return $this->error;}
	function get_err_msg(){return $this->errmsg;}

	function write($m){
		if(substr($m,-1)!="\n") $m=$m."\n";
		socket_write($this->socket, $m, strlen($m));
	}
	function read($nbytes){return socket_read($this->socket, $nbytes);}

	function is_running($gpo, $num){
		$this->write("is_running $gpo $num");
		return $this->read(2);
	}
	function boot($gpo, $num){
		$this->write("boot $gpo $num");
	}
	function kill($gpo, $num){
		$this->write("kill $gpo $num");
	}
}

?>
