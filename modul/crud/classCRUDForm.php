<?php

class konfigurasi_form {
	public function __construct(){
		try {
			if(file_exists("set/cnf.php")){include"set/cnf.php";}
			elseif(file_exists("../set/cnf.php")){include"../set/cnf.php";}
			elseif(file_exists("../../set/cnf.php")){include"../../set/cnf.php";}
			elseif(file_exists("../../../set/cnf.php")){include"../../../set/cnf.php";}
			
			
			//echo"<br>tes =$host";
			//$host="localhost";
			$dbname=$db;
			//$us="root";
			//$ps="";

			$this->db = new PDO('mysql:host='.$host.';dbname='.$dbname.'',''.$us.'',''.$ps.'');
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

public function redirect_login($link){
	header("location:pages/".$link);
}
public function is_log(){
		if (isset($_SESSION['id']) && isset($_SESSION['nama']) && isset($_SESSION['username']) && isset($_SESSION['level']) && isset($_SESSION['kabupaten'])) {
			return true;
		}
}
public function redirect_out($link){
		header("location:$link");
		session_unset();
		session_destroy();
		unset($_SESSION['id']);$_SESSION['id']="";
		unset($_COOKIE['PHPSESSID']);
}
public function redirect($link){
	header("location:".$link);
}

public function logout(){
	header("location:index.php");
}


//======================================= INSERT DATA ===============================================================

//Read All data
public function readAll($tabel){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel");
		$query->execute();//echo"SELECT * FROM $tabel";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//======================================= INSERT DATA ===============================================================

//1 kolom
public function insert1form($tabel,$a){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//2 kolom
public function insert2form($tabel,$a,$b){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//8 kolom
public function insert8form($tabel,$a,$b,$c,$d,$e,$f,$g,$h){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h')");
		$query->execute();//echo"<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//9 kolom
public function insert9form($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i')");
		$query->execute();//echo"<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//10 kolom
public function insert10form($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j')");
		$query->execute();//echo"<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//11 kolom
public function insert11form($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k')");
		$query->execute();
		//echo "<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//12 kolom
public function insert12form($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l){
	try {
		$query = $this->db->prepare('INSERT INTO '.$tabel.' VALUES(null,"'.$a.'","'.$b.'","'.$c.'","'.$d.'","'.$e.'","'.$f.'","'.$g.'","'.$h.'","'.$i.'","'.$j.'","'.$k.'","'.$l.'")');
		$query->execute();//echo'INSERT INTO '.$tabel.' VALUES(null,"'.$a.'","'.$b.'","'.$c.'","'.$d.'","'.$e.'","'.$f.'","'.$g.'","'.$h.'","'.$i.'","'.$j.'","'.$k.'","'.$l.'")';
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//14 kolom
public function insert14form($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n')");
		$query->execute();//echo"<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//15 kolom
public function insert15form($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o')");
		$query->execute();echo"<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//16 kolom
public function insert16form($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p')");
		$query->execute();//echo"<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//17 kolom
public function insert17form($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q')");
		$query->execute();//echo"<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//18 kolom
public function insert18form($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q,$r){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r')");
		$query->execute();//echo"<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//20 kolom
public function insert20form($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q,$r,$s,$t){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t')");
		$query->execute();//echo"<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//21 kolom
public function insert21form($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q,$r,$s,$t,$u){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u')");
		$query->execute();//echo"<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//22 kolom
public function insert22form($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q,$r,$s,$t,$u){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u', CURRENT_TIMESTAMP)");
		$query->execute();//echo"<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u','$v')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//23 kolom
public function insert23form($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q,$r,$s,$t,$u,$v,$w){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u','$v','$w')");
		$query->execute();//echo"<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u','$v','$w')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//27 kolom
public function insert27form($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q,$r,$s,$t,$u,$v,$w,$x,$y,$z,$aa){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u','$v','$w','$x','$y','$z','$aa')");
		$query->execute();//echo"<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u','$v','$w')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


}
?>
