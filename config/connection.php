<?php

class Connection {

	private $host = "";
	private $user = "";
	private $pass = "";
	private $db = "";

	public function __construct() {
		if(file_exists("set/cnf.php")){include"set/cnf.php";}
		elseif(file_exists("../set/cnf.php")){include"../set/cnf.php";}
		elseif(file_exists("../../set/cnf.php")){include"../../set/cnf.php";}
		elseif(file_exists("../../../set/cnf.php")){include"../../../set/cnf.php";}
		
		$this->host = $host;
		$this->user = $us;
		$this->pass = $ps;
		$this->db = $db;
		
	}

	public function openConnection() {
		$connect = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
		return $connect;
	}

}

?>