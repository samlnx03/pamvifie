<?php namespace db;

use \mysqli as mysqli;
	
    class Conection{

        public $mysql = NULL;
	private $resultSet;
	private $row;

	public function __construct(){ $this->conectarDB();}

        public function conectarDB(){
            if(!isset($this->mysql)){
                $this->mysql = (new mysqli("localhost", "a0701637f", "thanatos37", "a0701637f")) or die(mysqli_connect__error);
            }
        }

        public function consulta($query){
            $result = ($this->mysql->query($query))or die ("MYSQL Error: ".$this->mysql->error);
	    $this->resultSet=$result;
            return $result;
        }
        
        public function desconectarDB(){
            mysqli_close($mysql);
        }
	public function next_row(){
		$this->row=mysqli_fetch_array($this->resultSet);
		return $this->row;
	}
	public function f($campo){
		return $this->row[$campo];
	}
    }
?>
