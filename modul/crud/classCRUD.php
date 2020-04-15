<?php




class konfigurasi {
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

public function cek_login($username,$password){

		$pass = md5($password);
		try {
			$select_data = $this->db->prepare("SELECT * FROM `tbl_user` WHERE `user_username`='$username' and `user_password`='$pass'  LIMIT 1");
			$select_data->execute();//echo"SELECT * FROM `tbl_user` WHERE `user_username`=$username `user_password`=$pass LIMIT 1";
			$userRow = $select_data->fetch(PDO::FETCH_ASSOC);
			if ($select_data->rowCount() == 1) {

						$_SESSION['id'] = $userRow['id_user'];
						$_SESSION['nik'] = $userRow['user_nik'];
						$_SESSION['idBidang'] = $userRow['id_bidang'];
						$_SESSION['nama'] = $userRow['user_nama'];
						$_SESSION['username'] = $userRow['user_username'];
						$_SESSION['level'] = $userRow['user_level'];
						$_SESSION['email'] = $userRow['user_email'];
						$_SESSION['foto'] = $userRow['user_foto'];
						return true;
			}


		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}

public function redirect_login(){
	header("location:index.php");
}
public function is_log(){
		if (isset($_SESSION['id']) && isset($_SESSION['nama']) && isset($_SESSION['username']) && isset($_SESSION['level']) && isset($_SESSION['kabupaten'])) {
			return true;
		}
}
public function redirect_out($link){

		session_unset();
		session_destroy();
		unset($_SESSION['id']);$_SESSION['id']="";
		unset($_COOKIE['PHPSESSID']);
		header("location:$link");
}
public function redirect($link){
	header("location:".$link);
}

public function logout(){

	header("location:index.php");
}
//Read Data LAPORAN LAUT
public function readSumPenerimaan($table,$tgl,$where){
	try {
		$query = $this->db->prepare("SELECT SUM(`bkp_murni`)as bkp_murni, SUM(`kasda_murni`)AS kasda_murni, SUM(`bkp_piutang`) AS bkp_piutang , SUM(`kasda_piutang`) as kasda_piutang FROM `$table` WHERE  `tgl_penerimaan`='$tgl' $where");
		$query->execute();//echo"<br><br>SELECT SUM(`bkp_murni`)as bkp_murni, SUM(`kasda_murni`)AS kasda_murni, SUM(`bkp_piutang`) AS bkp_piutang , SUM(`kasda_piutang`) as kasda_piutang FROM `$table` WHERE  `tgl_penerimaan`='$tgl' $where";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumPenerimaanBetweenLike($table,$between,$range1,$range2,$where){
	try {
		$query = $this->db->prepare("SELECT SUM(`bkp_murni`)as bkp_murni, SUM(`kasda_murni`)AS kasda_murni, SUM(`bkp_piutang`) AS bkp_piutang , SUM(`kasda_piutang`) as kasda_piutang FROM `$table` WHERE  ($between BETWEEN  '$range1' AND  '$range2') $where");
		$query->execute();//echo"<br><br>SELECT SUM(`bkp_murni`)as bkp_murni, SUM(`kasda_murni`)AS kasda_murni, SUM(`bkp_piutang`) AS bkp_piutang , SUM(`kasda_piutang`) as kasda_piutang FROM `$table` WHERE  ($between BETWEEN '$range1' AND  '$range2') $where";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readAllDscLimit2($tabel,$order,$limit1,$limit2){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel ORDER BY $order DESC LIMIT $limit1,$limit2");
		$query->execute();//echo"SELECT * FROM $tabel WHERE `$a`='$aa' ORDER BY $order DESC LIMIT $limit1,$limit2";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readAllDscLimit2_REV($tabel,$order,$limit1,$limit2){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel where `type_akun`!='Super Administrator' and `type_akun`!='Operator' ORDER BY $order DESC LIMIT $limit1,$limit2");
		$query->execute();//echo"SELECT * FROM $tabel WHERE `$a`='$aa' ORDER BY $order DESC LIMIT $limit1,$limit2";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readSumWhere($table,$sum,$a,$aa){
	try {
		$query = $this->db->prepare("SELECT SUM(`$sum`)as $sum FROM `$table` WHERE  `$a`='$aa'");
		$query->execute();//echo"<br><br>SELECT SUM(`$sum`)as $sum FROM `$table` WHERE  `$a`='$aa'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//CEK ROW
public function readRowWhere($table,$a,$aa){
	try {
		$query = $this->db->prepare("SELECT * FROM `$table` WHERE  `$a`='$aa'");
		$query->execute();//echo"<br><br>SELECT SUM(`$sum`)as $sum FROM `$table` WHERE  `$a`='$aa'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


public function readSumPenerimaan2($table,$tgl,$where){
	try {
		$query = $this->db->prepare("SELECT SUM(`bkp_murni`)as bkp_murni, SUM(`kasda_murni`)AS kasda_murni, SUM(`bkp_piutang`) AS bkp_piutang , SUM(`kasda_piutang`) as kasda_piutang FROM `$table` WHERE  `tgl_penerimaan`='$tgl' $where");
		$query->execute();//echo"<br><br>SELECT SUM(`bkp_murni`)as bkp_murni, SUM(`kasda_murni`)AS kasda_murni, SUM(`bkp_piutang`) AS bkp_piutang , SUM(`kasda_piutang`) as kasda_piutang FROM `$table` WHERE  `tgl_penerimaan`='$tgl' $where";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}




//Read Data
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
//Select Semua Kolom Dari Tabel order by ASC
public function readAllAsc($tabel,$order){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel ORDER BY $order ASC");
		$query->execute();//echo"SELECT * FROM $tabel ORDER BY $order ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select Semua Kolom Dari Tabel order by DESC
public function readAllDsc($tabel,$order){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel ORDER BY $order DESC");
		$query->execute();
		return $query;//echo"<br>tes swl = SELECT * FROM $tabel ORDER BY $order DESC";
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readAllDscLimitNoId($tabel,$order,$limit){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel ORDER BY $order DESC LIMIT $limit");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//Select Semua Kolom Dari Tabel order by DESC
public function readAllDscLimit($tabel,$order,$kondisi,$id){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE $kondisi='$id' ORDER BY $order DESC LIMIT 5");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi where 3 ASC
public function readAllWhereAsc3($tabel,$a,$aa,$b,$bb,$c,$cc,$kolom){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE $a='$aa' AND $b='$bb' AND $c='$cc' ORDER BY $kolom ASC");
		$query->execute();//echo"<br>readAllWhereAsc3 = SELECT * FROM $tabel WHERE $a='$aa' AND $b='$bb' AND $c='$cc' ORDER BY $kolom ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi where 4 OR
public function readAllWhereOr4($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE $a='$aa' OR $b='$bb' OR $c='$cc' OR $d='$dd'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


public function readAllWhereDescLimit6($tabel,$a,$aa,$kolom){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE $a='$aa' ORDER BY $kolom DESC LIMIT 6");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi SUM where 3 ASC
public function readAllSum6Where3Asc($tabel,$sumA,$sumAA,$sumB,$sumBB,$sumC,$sumCC,$sumD,$sumDD,$sumE,$sumEE,$sumF,$sumFF,$a,$aa,$b,$bb,$c,$cc,$kolom){
	try {
		$query = $this->db->prepare("SELECT SUM($sumA) as $sumAA, SUM($sumB) as $sumBB, SUM($sumC) as $sumCC, SUM($sumD) as $sumDD, SUM($sumE) as $sumEE, SUM($sumF) as $sumFF, `$tabel`.* FROM $tabel WHERE $a='$aa' AND $b='$bb' AND $c='$cc' ORDER BY $kolom ASC");
		$query->execute();//echo"<br><br>SELECT SUM($sumA) as $sumAA, SUM($sumB) as $sumBB, SUM($sumC) as $sumCC, SUM($sumD) as $sumDD, SUM($sumE) as $sumEE, SUM($sumF) as $sumFF, `$tabel`.* FROM $tabel WHERE $a='$aa' AND $b='$bb' AND $c='$cc' ORDER BY $kolom ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi arsip
public function readAllArsip($pengguna){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_arsip`,`tbl_jenis_berkas`,`tbl_kardus`,`tbl_barcode` WHERE `tbl_arsip`.`id_barcode`=`tbl_barcode`.`id_barcode` AND `tbl_arsip`.`id_jenis_berkas`=`tbl_jenis_berkas`.`id_jenis_berkas` AND `tbl_arsip`.`id_kardus`=`tbl_kardus`.`id_kardus` AND `tbl_arsip`.`id_pengguna`='$pengguna' ORDER BY `tbl_arsip`.`id_arsip` DESC;");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi arsip where
public function readAllArsipWhere($pengguna,$id){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_arsip`,`tbl_jenis_berkas`,`tbl_kardus`,`tbl_barcode` WHERE `tbl_arsip`.`id_barcode`=`tbl_barcode`.`id_barcode` AND `tbl_arsip`.`id_jenis_berkas`=`tbl_jenis_berkas`.`id_jenis_berkas` AND `tbl_arsip`.`id_kardus`=`tbl_kardus`.`id_kardus` AND `tbl_arsip`.`id_pengguna`='$pengguna'  AND `tbl_arsip`.`id_arsip`='$id' ");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi SUM where 3 ASC
public function readAllSum6Where4Asc($tabel,$sumA,$sumAA,$sumB,$sumBB,$sumC,$sumCC,$sumD,$sumDD,$sumE,$sumEE,$sumF,$sumFF,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$kolom){
	try {
		$query = $this->db->prepare("SELECT SUM($sumA) as $sumAA, SUM($sumB) as $sumBB, SUM($sumC) as $sumCC, SUM($sumD) as $sumDD, SUM($sumE) as $sumEE, SUM($sumF) as $sumFF, `$tabel`.* FROM $tabel WHERE $a='$aa' AND $b='$bb' AND $c='$cc' AND $d='$dd' ORDER BY $kolom ASC");
		$query->execute();//echo"SELECT SUM($sumA) as $sumAA, SUM($sumB) as $sumBB, SUM($sumC) as $sumCC, SUM($sumD) as $sumDD, SUM($sumE) as $sumEE, SUM($sumF) as $sumFF, `$tabel`.* FROM $tabel WHERE $a='$aa' AND $b='$bb' AND $c='$cc' AND $d='$dd' ORDER BY $kolom ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi SUM where 3 ASC
public function readAllSum6Where4Desc($tabel,$sumA,$sumAA,$sumB,$sumBB,$sumC,$sumCC,$sumD,$sumDD,$sumE,$sumEE,$sumF,$sumFF,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$kolom){
	try {
		$query = $this->db->prepare("SELECT SUM($sumA) as $sumAA, SUM($sumB) as $sumBB, SUM($sumC) as $sumCC, SUM($sumD) as $sumDD, SUM($sumE) as $sumEE, SUM($sumF) as $sumFF, `$tabel`.* FROM $tabel WHERE $a='$aa' AND $b='$bb' AND $c='$cc' AND $d='$dd' ORDER BY $kolom DESC");
		$query->execute();//echo"SELECT SUM($sumA) as $sumAA, SUM($sumB) as $sumBB, SUM($sumC) as $sumCC, SUM($sumD) as $sumDD, SUM($sumE) as $sumEE, SUM($sumF) as $sumFF, `$tabel`.* FROM $tabel WHERE $a='$aa' AND $b='$bb' AND $c='$cc' AND $d='$dd' ORDER BY $kolom ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//Select dengan kondisi where 1 ASC
public function readAllWhereAsc1($tabel,$a,$aa,$kolom){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel` WHERE `$a`='$aa'  ORDER BY `$kolom` ASC");
		$query->execute();//echo"SELECT * FROM `$tabel` WHERE `$a`='$aa'  ORDER BY `$kolom` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi where 2 ASC
public function readAllWhereAsc2($tabel,$a,$aa,$b,$bb,$kolom){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE $a='$aa'  AND $b='$bb'  ORDER BY $kolom ASC");
		$query->execute();//echo"<br><br>SELECT * FROM $tabel WHERE $a='$aa'  AND $b='$bb'  ORDER BY $kolom ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumAllWhereAsc2Not($tabel,$sum,$a,$aa,$b,$bb,$c,$cc,$kolom){
	try {
		$query = $this->db->prepare("SELECT SUM($sum) as $sum FROM $tabel WHERE $a='$aa'  AND $b='$bb'  AND $c!='$cc'  ORDER BY $kolom ASC");
		$query->execute();//echo"<br><br>SELECT SUM($sum) as $sum FROM $tabel WHERE $a='$aa'  AND $b='$bb'  ORDER BY $kolom ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readSumAllWhereAsc($tabel,$sum,$a,$aa,$kolom){
	try {
		$query = $this->db->prepare("SELECT SUM($sum) as $sum FROM $tabel WHERE $a='$aa'   ORDER BY $kolom ASC");
		$query->execute();//echo"<br><br>SELECT SUM($sum) as $sum FROM $tabel WHERE $a='$aa'   ORDER BY $kolom ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllWhere2($tabel,$a,$aa,$b,$bb){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE $a='$aa'  AND $b='$bb'  ");
		$query->execute();//echo"<br><br>readAllWhere2 = SELECT * FROM $tabel WHERE $a='$aa'  AND $b='$bb' ";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllWhere3($tabel,$a,$aa,$b,$bb,$c,$cc){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE $a='$aa'  AND $b='$bb'  AND $c='$cc'");
		$query->execute();//echo"<br><br>readAllWhere2 = SELECT * FROM $tabel WHERE $a='$aa'  AND $b='$bb'  AND $c='$cc' ";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readAllWhere3Asc($tabel,$a,$aa,$b,$bb,$c,$cc,$asc){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE $a='$aa'  AND $b='$bb'  AND $c='$cc' ORDER BY $asc ASC");
		$query->execute();//echo"<br><br>readAllWhere2 =SELECT * FROM $tabel WHERE $a='$aa'  AND $b='$bb'  AND $c='$cc' ORDER BY $asc ASC ";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllWhere4($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE $a='$aa'  AND $b='$bb'  AND $c='$cc' AND $d='$dd'");
		$query->execute();//echo"<br><br>readAllWhere2 = SELECT * FROM $tabel WHERE $a='$aa'  AND $b='$bb'  AND $c='$cc' AND $d='$dd'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllWhereDesc2($tabel,$a,$aa,$b,$bb,$kolom){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE $a='$aa'  AND $b='$bb'  ORDER BY $kolom DESC");
		$query->execute();//echo"SELECT * FROM $tabel WHERE $a='$aa'  AND $b='$bb'  ORDER BY $kolom ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//Select dengan kondisi sum where 2
public function readAllSum2Where4($tabel,$sA,$sAA,$sB,$sBB,$a,$aa,$b,$bb,$c,$cc,$d,$dd){
	try {
		$query = $this->db->prepare("SELECT SUM($sA) AS $sAA, SUM($sB) AS $sBB, `$tabel`.* FROM $tabel WHERE $a='$aa'  AND $b='$bb'  AND $c='$cc'  AND $d='$dd' ");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllSum4WhereBetween($tabel,$sA,$sAA,$sB,$sBB,$sC,$sCC,$sD,$sDD,$a,$aa,$between,$range1,$range2){
	try {
		$query = $this->db->prepare("SELECT SUM($sA) AS $sAA, SUM($sB) AS $sBB, SUM($sC) AS $sCC, SUM($sD) AS $sDD,   `$tabel`.* FROM $tabel WHERE $a='$aa' AND ($between BETWEEN '$range1' AND '$range2') ");
		$query->execute();//echo"<br><br>SELECT SUM($sA) AS $sAA, SUM($sB) AS $sBB, SUM($sC) AS $sCC, SUM($sD) AS $sDD,   `$tabel`.* FROM $tabel WHERE $a='$aa' AND ($between BETWEEN '$range1' AND '$range2') ";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllSum4WhereLike($tabel,$sA,$sAA,$sB,$sBB,$sC,$sCC,$sD,$sDD,$a,$aa,$aLike,$aaLike){
	try {
		$query = $this->db->prepare("SELECT SUM($sA) AS $sAA, SUM($sB) AS $sBB, SUM($sC) AS $sCC, SUM($sD) AS $sDD,   `$tabel`.* FROM $tabel WHERE $a='$aa' AND `$aLike` LIKE '$aaLike' ");
		$query->execute();//echo"SELECT SUM($sA) AS $sAA, SUM($sB) AS $sBB, SUM($sC) AS $sCC, SUM($sD) AS $sDD,   `$tabel`.* FROM $tabel WHERE $a='$aa' AND `$aLike` LIKE '$aaLike' ";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//count sederhana
public function countAll($tabel){
	try {
		$query = $this->db->prepare("SELECT COUNT(*) as jumlah FROM $tabel");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function countAll_REV($tabel){
	try {
		$query = $this->db->prepare("SELECT COUNT(*) as jumlah FROM $tabel WHERE `type_akun`!='Super Administrator' and `type_akun`!='Operator' ");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function getResi($date){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_resi` WHERE `tgl_resi` like '$date%' ORDER BY `tgl_resi` DESC ");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan count hitung record
public function readAllCountWhere($tabel,$kolomcount,$kolom,$like){
	try {
		$query = $this->db->prepare("SELECT COUNT($kolomcount) AS TOTAL_RECORD FROM $tabel WHERE $kolom LIKE '%$like%'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan count hitung record UNTK MENENTUKAN RECORD USER
public function readAllCountWhereUser($tabel,$kolomcount,$kolom,$like){
	try {
		$query = $this->db->prepare("SELECT COUNT($kolomcount) AS TOTAL_RECORD FROM $tabel WHERE $kolom LIKE '$like%'");
		$query->execute();//echo"SELECT COUNT($kolomcount) AS TOTAL_RECORD FROM $tabel WHERE $kolom LIKE '$like%'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan count hitung record UNTK MENENTUKAN RECORD USER
public function readAllCountWhereUser2($tabel,$kolomcount,$kolom,$id){
	try {
		$query = $this->db->prepare("SELECT COUNT($kolomcount) AS TOTAL_RECORD FROM $tabel WHERE `$kolom` ='$id'");
		$query->execute();//echo"SELECT COUNT($kolomcount) AS TOTAL_RECORD FROM $tabel WHERE $kolom LIKE '$like%'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//Select dengan count hitung record UNTK MENENTUKAN RECORD USER
public function readAllWhereLikeDsc($tabel,$kolom,$like){
	try {
		$query = $this->db->prepare("SELECT $kolom FROM $tabel WHERE $kolom LIKE '$like%'  ORDER BY `$kolom` DESC");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//Select dengan kondisi where
public function readAllBy($tabel,$kolom,$id){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel` WHERE `$kolom`='$id'");
		$query->execute();//echo"<br>readAllBy = SELECT * FROM $tabel WHERE $kolom='$id'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readAllByH($tabel,$id){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel` where  `id_bidang`='$id'");
		$query->execute();//echo"<br>SELECT * FROM `$tabel` where  `id_bidang`='$id'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllByDesc($tabel,$kolom,$id,$order){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE $kolom=:id  ORDER BY $order DESC");
		$query->execute(array(":id"=>$id));
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllByAsc($tabel,$kolom,$id,$order){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE $kolom=:id  ORDER BY $order ASC");
		$query->execute(array(":id"=>$id));
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}



//Select dengan DISCTINT YEAR
public function readAllDisctintYearDesc($tabel,$kolom){
	try {
		$query = $this->db->prepare("SELECT DISTINCT YEAR(`$kolom`) AS tahun FROM `$tabel` ORDER BY `$kolom` DESC ");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan DISCTINT YEAR
public function readAllDisctintYearAsc($tabel,$kolom){
	try {
		$query = $this->db->prepare("SELECT DISTINCT YEAR(`$kolom`) AS tahun FROM `$tabel` ORDER BY `$kolom` Asc ");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan DISCTINT MONTH
public function readAllDisctintMonthAsc($tabel,$kolom){
	try {
		$query = $this->db->prepare("SELECT DISTINCT MONTH(`$kolom`) AS bulan FROM `$tabel` ORDER BY `$kolom` Asc ");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan DISCTINT MONTH
public function readAllDisctintMonthWhereAsc_1($tabel,$kolom,$a,$aa){
	try {
		$query = $this->db->prepare("SELECT DISTINCT MONTH(`$kolom`) AS bulan FROM `$tabel` WHERE YEAR(`$a`)='$aa' ORDER BY `$kolom` Asc ");
		$query->execute();
		return $query;//echo"SELECT DISTINCT MONTH(`$kolom`) AS bulan FROM `$tabel` WHERE YEAR(`$a`)='$aa' ORDER BY `$kolom` Asc ";
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}




//Select dengan DISCTINT
public function readAllDisctintDesc($tabel,$kolom){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `$kolom` FROM `$tabel` ORDER BY `$kolom` DESC ");
		$query->execute();
		return $query;//echo"<br>tes SELECT DISTINCT `$kolom` FROM `$tabel` ORDER BY `$kolom` DESC ";
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan DISCTINT
public function readAllDisctintWhereBetweenDesc($tabel,$range1,$range2,$between,$kolom){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `$kolom` FROM  `$tabel` WHERE ($between BETWEEN '$range1' AND '$range2')  ORDER BY `$kolom` DESC ");
		$query->execute();
		return $query;//echo"<br>tes SELECT DISTINCT `$kolom` FROM  `$tabel` WHERE ($between BETWEEN '$range1' AND '$range2')  ORDER BY `$kolom` DESC ";
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//Select dengan DISCTINT
public function readAllDisctintWhereLikeDesc($tabel,$kolom,$a,$aa){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `$kolom` FROM `$tabel` WHERE `$a` LIKE '$aa' ORDER BY `$kolom` DESC ");
		$query->execute();//echo"SELECT DISTINCT `$kolom` FROM `$tabel` WHERE `$a` LIKE '$aa' ORDER BY `$kolom` DESC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllDisctintWhereAsc($tabel,$kolom,$a,$aa,$asc){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `$kolom` FROM `$tabel` WHERE `$a` = '$aa' ORDER BY `$asc` ASC ");
		$query->execute();//echo"SELECT DISTINCT `$kolom` FROM `$tabel` WHERE `$a` = '$aa' ORDER BY `$asc` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllDisctintWhere2Asc($tabel,$distinct,$a,$aa,$b,$bb,$asc){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `$distinct` FROM `$tabel` WHERE `$a` = '$aa' and `$b` = '$bb' ORDER BY `$asc` ASC ");
		$query->execute();//echo"SELECT DISTINCT `$distinct` FROM `$tabel` WHERE `$a` = '$aa' and `$b` = '$bb' ORDER BY `$asc` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllDisctintWhereDesc($tabel,$kolom,$a,$aa,$asc){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `$kolom` FROM `$tabel` WHERE `$a` = '$aa' ORDER BY `$asc` desc ");
		$query->execute();//echo"SELECT DISTINCT `$kolom` FROM `$tabel` WHERE `$a` = '$aa' ORDER BY `$asc` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}



public function readAllRekening($a){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `tbl_master_skpd`.`id_rekening`, `tbl_rekening`.* FROM `tbl_master_skpd`,`tbl_rekening` WHERE `tbl_rekening`.`id_rekening`=`tbl_master_skpd`.`id_rekening` and `tbl_master_skpd`.`id_skpd` = '$a' ORDER BY `tbl_master_skpd`.`id_rekening` ASC ");
		$query->execute();//echo"SELECT DISTINCT `tbl_master_skpd`.`id_rekening`, `tbl_rekening`.* FROM `tbl_master_skpd`,`tbl_rekening` WHERE `tbl_rekening`.`id_rekening`=`tbl_master_skpd`.`id_rekening` and `tbl_master_skpd`.`id_skpd` = '$a' ORDER BY `tbl_master_skpd`.`id_rekening` ASC ";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllRekeningRealisasi($a,$b){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `tbl_master_skpd`.`id_rekening`, `tbl_rekening`.* FROM `tbl_master_skpd`,`tbl_rekening` WHERE `tbl_rekening`.`id_rekening`=`tbl_master_skpd`.`id_rekening` and (`tbl_master_skpd`.`id_skpd` BETWEEN '$a' AND '$b') ORDER BY `tbl_master_skpd`.`id_rekening` ASC ");
		$query->execute();//echo"SELECT DISTINCT `tbl_master_skpd`.`id_rekening`, `tbl_rekening`.* FROM `tbl_master_skpd`,`tbl_rekening` WHERE `tbl_rekening`.`id_rekening`=`tbl_master_skpd`.`id_rekening` and `tbl_master_skpd`.`id_skpd` = '$a' ORDER BY `tbl_master_skpd`.`id_rekening` ASC ";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllRekening2($a,$b){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `tbl_master_skpd`.`id_sub_rekening`, `tbl_sub_rekening`.* FROM `tbl_master_skpd`,`tbl_sub_rekening` WHERE `tbl_sub_rekening`.`id_sub_rekening`=`tbl_master_skpd`.`id_sub_rekening` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_rekening` = '$b' ORDER BY `tbl_master_skpd`.`id_rekening` ASC");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


public function readAllRekening2Realisasi($a,$aA,$b){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `tbl_master_skpd`.`id_sub_rekening`, `tbl_sub_rekening`.* FROM `tbl_master_skpd`,`tbl_sub_rekening` WHERE `tbl_sub_rekening`.`id_sub_rekening`=`tbl_master_skpd`.`id_sub_rekening` and (`tbl_master_skpd`.`id_skpd` BETWEEN '$a' AND '$aA') and `tbl_master_skpd`.`id_rekening` = '$b' ORDER BY `tbl_master_skpd`.`id_rekening` ASC");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllRekening3($a,$b){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `tbl_master_skpd`.`id_sub_rekening`, `tbl_sub_sub_rekening`.* FROM `tbl_master_skpd`,`tbl_sub_sub_rekening` WHERE `tbl_sub_sub_rekening`.`id_sub_sub_rekening`=`tbl_master_skpd`.`id_sub_sub_rekening` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"<br>readAllRekening3 == SELECT DISTINCT `tbl_master_skpd`.`id_sub_rekening`, `tbl_sub_sub_rekening`.* FROM `tbl_master_skpd`,`tbl_sub_sub_rekening` WHERE `tbl_sub_sub_rekening`.`id_sub_sub_rekening`=`tbl_master_skpd`.`id_sub_sub_rekening` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllRekening3Realisasi($a,$aA,$b){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `tbl_master_skpd`.`id_sub_rekening`, `tbl_sub_sub_rekening`.* FROM `tbl_master_skpd`,`tbl_sub_sub_rekening` WHERE `tbl_sub_sub_rekening`.`id_sub_sub_rekening`=`tbl_master_skpd`.`id_sub_sub_rekening` and (`tbl_master_skpd`.`id_skpd` BETWEEN '$a' AND '$aA') and `tbl_master_skpd`.`id_sub_rekening` = '$b' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"<br>SELECT DISTINCT `tbl_master_skpd`.`id_sub_rekening`, `tbl_sub_sub_rekening`.* FROM `tbl_master_skpd`,`tbl_sub_sub_rekening` WHERE `tbl_sub_sub_rekening`.`id_sub_sub_rekening`=`tbl_master_skpd`.`id_sub_sub_rekening` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllRekening4($a,$b){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `tbl_master_skpd`.`id_master_skpd`, `tbl_sub_sub_sub_rekening`.* FROM `tbl_master_skpd`,`tbl_sub_sub_sub_rekening` WHERE `tbl_sub_sub_sub_rekening`.`id_sub_sub_sub_rekening`=`tbl_master_skpd`.`id_sub_sub_sub_rekening` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC");
		$query->execute();//echo"<br>SELECT DISTINCT `tbl_master_skpd`.`id_master_skpd`, `tbl_sub_sub_sub_rekening`.* FROM `tbl_master_skpd`,`tbl_sub_sub_sub_rekening` WHERE `tbl_sub_sub_sub_rekening`.`id_sub_sub_sub_rekening`=`tbl_master_skpd`.`id_sub_sub_sub_rekening` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllRekening4Realisasi($a,$aA,$b){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `tbl_master_skpd`.`id_master_skpd`, `tbl_sub_sub_sub_rekening`.* FROM `tbl_master_skpd`,`tbl_sub_sub_sub_rekening` WHERE `tbl_sub_sub_sub_rekening`.`id_sub_sub_sub_rekening`=`tbl_master_skpd`.`id_sub_sub_sub_rekening` and (`tbl_master_skpd`.`id_skpd` BETWEEN '$a' AND '$aA') and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC");
		$query->execute();//echo"<br>SELECT DISTINCT `tbl_master_skpd`.`id_master_skpd`, `tbl_sub_sub_sub_rekening`.* FROM `tbl_master_skpd`,`tbl_sub_sub_sub_rekening` WHERE `tbl_sub_sub_sub_rekening`.`id_sub_sub_sub_rekening`=`tbl_master_skpd`.`id_sub_sub_sub_rekening` and (`tbl_master_skpd`.`id_skpd` BETWEEN '$a' AND '$aA') and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//Select dengan kondisi DISTINCT where BETWEEN ASC ANTARA 2 TANGGAL
public function readAllByDistinctBetweenAsc($tabel,$a,$kolom,$id,$range1,$range2,$between,$asc){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `$a`,* FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2') AND $kolom=:id ORDER BY $asc ASC");
		$query->execute(array(":id"=>$id));
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi DISTINCT  BETWEEN ASC ANTARA 2 TANGGAL
public function readAllByDistinctBetweenAsc2($tabel,$a,$range1,$range2,$between,$asc){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `$a` FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2')  ORDER BY $asc ASC");
		$query->execute(); //echo"SELECT DISTINCT `$a` FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2')  ORDER BY $asc ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllByDistinctBetweenWhereAsc2($tabel,$distinct,$a,$aa,$between,$range1,$range2,$asc){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `$distinct` FROM $tabel WHERE `$a`='$aa' AND ($between BETWEEN '$range1' AND '$range2')  ORDER BY $asc ASC");
		$query->execute(); //echo"SELECT DISTINCT `$a` FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2')  ORDER BY $asc ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//Select dengan kondisi DISTINCT  BETWEEN ASC ANTARA 2 TANGGAL
public function readAllByDistinctBetweenDesc2($tabel,$a,$range1,$range2,$between,$desc){
	try {
		$query = $this->db->prepare("SELECT DISTINCT `$a` FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2')  ORDER BY $desc DESC");
		$query->execute(); //echo"SELECT DISTINCT `$a` FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2')  ORDER BY $asc ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//Select dengan kondisi where BETWEEN ANTARA 2 TANGGAL
public function readAllByBetween($tabel,$kolom,$id,$range1,$range2,$between){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2') AND $kolom=:id");
		$query->execute(array(":id"=>$id));
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi where BETWEEN ANTARA 2 TANGGAL
public function readAllByBetween2($tabel,$kolom,$id,$range1,$range2,$a,$aa,$between){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2') AND $a='$aa' and $kolom=:id");
		$query->execute(array(":id"=>$id));


		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//Select dengan kondisi where BETWEEN ANTARA 2 TANGGAL ORDER BY DESC
public function readAllByBetweenDesc($tabel,$kolom,$id,$range1,$range2,$between,$order){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2') AND $kolom=:id ORDER BY $order DESC");
		$query->execute(array(":id"=>$id));
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi where BETWEEN ANTARA 2 TANGGAL ORDER BY ASC
public function readAllByBetweenAsc($tabel,$kolom,$id,$range1,$range2,$between,$order){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2') AND $kolom=:id ORDER BY $order ASC");
		$query->execute(array(":id"=>$id));
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readAllBetweenAsc($tabel,$range1,$range2,$between,$order){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2')  ORDER BY $order ASC");
		$query->execute(array());
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi SUM 1 BETWEEN ANTARA 2 TANGGAL ORDER BY ASC
public function readAllByBetweenSum1Asc($tabel,$sum1,$kolom,$id,$range1,$range2,$between,$order){
	try {
		$query = $this->db->prepare("SELECT SUM($sum1) as $sum1 FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2') AND $kolom=:id ORDER BY $order ASC");
		$query->execute(array(":id"=>$id));
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//Select dengan kondisi SUM 1 BETWEEN ANTARA 2 TANGGAL ORDER BY ASC
public function readAllByBetweenSumWhereAsc($tabel,$sum1,$between,$range1,$range2,$a,$aa,$order){
	try {
		$query = $this->db->prepare("SELECT SUM($sum1) as $sum1 FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2') AND `$a`='$aa'  ORDER BY $order ASC");
		$query->execute(array());/*echo"<br>SELECT SUM($sum1) as $sum1 FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2') AND `$a`='$aa'  ORDER BY $order ASC";*/
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi SUM 1
public function readAllSumWhere($tabel,$sum,$a,$aa){
	try {
		$query = $this->db->prepare("SELECT SUM($sum) as $sum FROM $tabel WHERE `$a` LIKE '$aa%' ");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi SUM Where
public function readAllSumWhere1($tabel,$sum,$a,$aa){
	try {
		$query = $this->db->prepare("SELECT SUM($sum) as $sum FROM $tabel WHERE `$a`='$aa' ");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllSumWhereNot($tabel,$sum,$a,$aa,$b,$bb){
	try {
		$query = $this->db->prepare("SELECT SUM($sum) as $sum FROM $tabel WHERE `$a`='$aa' and `$b`!='$bb' ");
		$query->execute();//echo"<br>SELECT SUM($sum) as $sum FROM $tabel WHERE `$a`='$aa' and `$b`!='$bb'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi SUM 2
public function readAllSumWhereLike($tabel,$sum,$a,$aa,$like,$like2){
	try {
		$query = $this->db->prepare("SELECT SUM($sum) as $sum FROM $tabel WHERE `$a`='$aa' AND `$like` LIKE '$like2%' ");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi SUM 2 BETWEEN ANTARA 2 TANGGAL ORDER BY ASC
public function readAllByBetweenSum2Asc($tabel,$sum1,$sum2,$kolom,$id,$range1,$range2,$between,$order){
	try {
		$query = $this->db->prepare("SELECT SUM($sum1) as $sum1, SUM($sum2) as $sum2 FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2') AND $kolom=:id ORDER BY $order ASC");
		$query->execute(array(":id"=>$id));
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek($a,$b,$c,$d){
	try {
		$query = $this->db->prepare("SELECT sum(`penerimaan`) as JUMLAH , `tbl_penerimaan`.`id_master_skpd` as ID_MASTER_SKPD FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`penerimaan`) as JUMLAH FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRekRealisasi($a,$aA,$b,$c,$d){
	try {
		$query = $this->db->prepare("SELECT sum(`penerimaan`) as JUMLAH , `tbl_penerimaan`.`id_master_skpd` as ID_MASTER_SKPD FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and (`tbl_master_skpd`.`id_skpd` BETWEEN '$a' AND '$aA') and `tbl_master_skpd`.`id_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`penerimaan`) as JUMLAH FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRekTarget($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_target`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_target`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRekTargetRincianPerubahan($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`nilai_target`) as JUMLAH, `tbl_rincian_target_perubahan`.* FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRekTargetPerubahan($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"<br><br>SELECT sum(`nilai_target`) as JUMLAH FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readRekTargetPerubahan($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT `tbl_rincian_target_perubahan`.* ,`tbl_rincian_target_perubahan`.`nilai_target` AS JUMLAH FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"<br><br>SELECT `tbl_rincian_target_perubahan`.*  FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readRekTargetPerubahan2($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT `tbl_rincian_target_perubahan`.* ,`tbl_rincian_target_perubahan`.`nilai_target` AS JUMLAH FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC");
		$query->execute();//echo"<br><br>SELECT `tbl_rincian_target_perubahan`.*  FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readRekTargetPerubahan3($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT `tbl_rincian_target_perubahan`.* ,`tbl_rincian_target_perubahan`.`nilai_target` AS JUMLAH FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC");
		$query->execute();//echo"<br><br>SELECT `tbl_rincian_target_perubahan`.*  FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


public function readSumRekTargetPerubahan3($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC");
		$query->execute();//echo"<br><br>SELECT sum(`nilai_target`) as JUMLAH FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRekTargetPerubahan4($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC");
		$query->execute();//echo"<br><br>SELECT sum(`nilai_target`) as JUMLAH FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readSumRekTargetPerubahan2($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target_perubahan`) as JUMLAH FROM `tbl_target_perubahan` WHERE  `tbl_target_perubahan`.`id_skpd`='$a' and `tbl_target_perubahan`.`id_rekening`='$b' AND `tbl_target_perubahan`.`tahun`='$c' ");
		$query->execute();//echo"SELECT sum(`nilai_target`) as JUMLAH FROM `tbl_target_perubahan` WHERE  `tbl_target_perubahan`.`id_rekening`='$b' AND `tbl_target_perubahan`.`tahun`='$c'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRekDataTarget($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_target`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_target`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRekPenerimaan($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT `penerimaan` as JUMLAH, `tbl_penerimaan`.* FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_penerimaan`.`tgl_penerimaan`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT `penerimaan` as JUMLAH, `tbl_penerimaan`.* FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_penerimaan`.`tgl_penerimaan`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


public function readSumRekTargetRealisasi($a,$aA,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and (`tbl_master_skpd`.`id_skpd` BETWEEN '$a' and '$aA') and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_target`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' AND `tbl_target`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


public function readSumRek2($a,$b,$c,$d){
	try {
		$query = $this->db->prepare("SELECT sum(`penerimaan`) as JUMLAH , `tbl_penerimaan`.`id_master_skpd` as ID_MASTER_SKPD FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`penerimaan`) as JUMLAH FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek2Realisasi($a,$aA,$b,$c,$d){
	try {
		$query = $this->db->prepare("SELECT sum(`penerimaan`) as JUMLAH , `tbl_penerimaan`.`id_master_skpd` as ID_MASTER_SKPD FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and (`tbl_master_skpd`.`id_skpd` BETWEEN '$a' AND '$aA') and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`penerimaan`) as JUMLAH FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}



public function readSumRek2Target($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b'  AND `tbl_target`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`penerimaan`) as JUMLAH FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek2TargetPerubahan($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH, `tbl_rincian_target_perubahan`.* FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b'  AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`penerimaan`) as JUMLAH FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek2DataTarget($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b'  AND `tbl_target`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"<br><br>SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b'  AND `tbl_target`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek2Penerimaan($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT `penerimaan` as JUMLAH, `tbl_penerimaan`.* FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b'  AND `tbl_penerimaan`.`tgl_penerimaan`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`penerimaan`) as JUMLAH FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek2TargetRealisasi($a,$aA,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and (`tbl_master_skpd`.`id_skpd` BETWEEN '$a' AND '$aA') and `tbl_master_skpd`.`id_sub_sub_rekening` = '$b'  AND `tbl_target`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`penerimaan`) as JUMLAH FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek3($a,$b,$c,$d){
	try {
		$query = $this->db->prepare("SELECT sum(`penerimaan`) as JUMLAH , `tbl_penerimaan`.`id_master_skpd` as ID_MASTER_SKPD FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`penerimaan`) as JUMLAH FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek3Realisasi($a,$aA,$b,$c,$d){
	try {
		$query = $this->db->prepare("SELECT sum(`penerimaan`) as JUMLAH , `tbl_penerimaan`.`id_master_skpd` as ID_MASTER_SKPD FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and (`tbl_master_skpd`.`id_skpd` BETWEEN '$a' AND '$aA') and `tbl_master_skpd`.`id_sub_sub_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`penerimaan`) as JUMLAH FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


public function readSumRek3Target($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_sub_rekening` = '$b' AND `tbl_target`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`penerimaan`) as JUMLAH FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek3TargetPerubahan($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH, `tbl_rincian_target_perubahan`.* FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC");
		$query->execute();//echo"<br>SELECT sum(`nilai_target`) as JUMLAH, `tbl_rincian_target_perubahan`.* FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek3DataTarget($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_sub_rekening` = '$b' AND `tbl_target`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC");
		$query->execute();//echo"<br>SELECT sum(`nilai_target`) as JUMLAH, `tbl_rincian_target_perubahan`.* FROM `tbl_master_skpd`,`tbl_rincian_target_perubahan` WHERE `tbl_rincian_target_perubahan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_sub_rekening` = '$b' AND `tbl_rincian_target_perubahan`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


public function readSumRek3Penerimaan($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT `penerimaan` as JUMLAH, `tbl_penerimaan`.* FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_sub_rekening` = '$b' AND `tbl_penerimaan`.`tgl_penerimaan`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT `penerimaan` as JUMLAH, `tbl_penerimaan`.* FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_sub_sub_rekening` = '$b' AND `tbl_penerimaan`.`tgl_penerimaan`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek3TargetRealisi($a,$aA,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and (`tbl_master_skpd`.`id_skpd` BETWEEN '$a' AND '$aA') and `tbl_master_skpd`.`id_sub_sub_sub_rekening` = '$b' AND `tbl_target`.`tahun`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_sub_rekening` ASC");
		$query->execute();//echo"SELECT sum(`penerimaan`) as JUMLAH FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a' and `tbl_master_skpd`.`id_sub_rekening` = '$b' and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$c' AND '$d') ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek4($a,$b,$c,$d){
	try {
		$query = $this->db->prepare("SELECT sum(`penerimaan`) as JUMLAH, `tbl_penerimaan`.`id_master_skpd` as ID_MASTER_SKPD FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a'  and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$b' AND '$c') AND `tbl_master_skpd`.`id_rekening`='$d' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"<br><br>SELECT sum(`penerimaan`) as JUMLAH, `tbl_penerimaan`.`id_master_skpd` as ID_MASTER_SKPD FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a'  and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$b' AND '$c') AND `tbl_master_skpd`.`id_rekening`='$d' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek4Penerimaan($a,$b,$c){
	try {
		$query = $this->db->prepare("SELECT sum(`penerimaan`) as JUMLAH, `tbl_penerimaan`.`id_master_skpd` as ID_MASTER_SKPD FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a'  and `tbl_penerimaan`.`tgl_penerimaan`= '$b' AND `tbl_master_skpd`.`id_rekening`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"<br><brSELECT sum(`penerimaan`) as JUMLAH, `tbl_penerimaan`.`id_master_skpd` as ID_MASTER_SKPD FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a'  and `tbl_penerimaan`.`tgl_penerimaan`= '$b' AND `tbl_master_skpd`.`id_rekening`='$c' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek4Realisasi($a,$aA,$b,$c,$d){
	try {
		$query = $this->db->prepare("SELECT sum(`penerimaan`) as JUMLAH, `tbl_penerimaan`.`id_master_skpd` as ID_MASTER_SKPD FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and (`tbl_master_skpd`.`id_skpd` BETWEEN '$a' AND '$aA')  and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$b' AND '$c') AND `tbl_master_skpd`.`id_rekening`='$d' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"<br><br>SELECT sum(`penerimaan`) as JUMLAH, `tbl_penerimaan`.`id_master_skpd` as ID_MASTER_SKPD FROM `tbl_master_skpd`,`tbl_penerimaan` WHERE `tbl_penerimaan`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a'  and (`tbl_penerimaan`.`tgl_penerimaan`BETWEEN '$b' AND '$c') AND `tbl_master_skpd`.`id_rekening`='$d' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumDenda($id,$id2,$a,$aA){
	try {
		$query = $this->db->prepare("SELECT sum(`denda`) as JUMLAH FROM `tbl_denda` WHERE `tbl_denda`.`id_skpd`='$id' AND `tbl_denda`.`id_rekening`='$id2' and (`tbl_denda`.`tgl_denda` BETWEEN '$a' AND '$aA')   ORDER BY `tbl_denda`.`id_denda` ASC");
		$query->execute();//echo"<br><br>SELECT sum(`denda`) as JUMLAH FROM `tbl_denda` WHERE `tbl_denda`.`id_skpd`='$id' AND `tbl_denda`.`id_rekening`='$id2' and (`tbl_denda`.`tgl_denda` BETWEEN '$a' AND '$aA')   ORDER BY `tbl_denda`.`id_denda` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readSumSubDenda($id,$id2,$id3,$a,$aA){
	try {
		$query = $this->db->prepare("SELECT sum(`denda`) as JUMLAH FROM `tbl_denda` WHERE `tbl_denda`.`id_skpd`='$id' AND `tbl_denda`.`id_rekening`='$id2'  AND `tbl_denda`.`id_sub_rekening`='$id3' and (`tbl_denda`.`tgl_denda` BETWEEN '$a' AND '$aA')   ORDER BY `tbl_denda`.`id_denda` ASC");
		$query->execute();//echo"<br><br>SELECT sum(`denda`) as JUMLAH FROM `tbl_denda` WHERE `tbl_denda`.`id_skpd`='$id' AND `tbl_denda`.`id_rekening`='$id2'  AND `tbl_denda`.`id_sub_rekening`='$id3' and (`tbl_denda`.`tgl_denda` BETWEEN '$a' AND '$aA')   ORDER BY `tbl_denda`.`id_denda` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}



public function readSumRek4Target($a,$d,$e){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a'   AND `tbl_master_skpd`.`id_rekening`='$d' AND `tbl_target`.`tahun`='$e' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"<br><br>SELECT sum(`nilai_target`) as JUMLAH FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a'   AND `tbl_master_skpd`.`id_rekening`='$d' AND `tbl_target`.`tahun`='$e' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readSumRek4TargetPerubahan($a,$d,$e){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target_perubahan`) as JUMLAH, `tbl_target_perubahan`.* FROM `tbl_target_perubahan` WHERE `tbl_target_perubahan`.`id_skpd` = '$a'   AND `tbl_target_perubahan`.`id_rekening`='$d' AND `tbl_target_perubahan`.`tahun`='$e' ORDER BY `id_target_perubahan` ASC");
		$query->execute();//echo"<br><br>SELECT sum(`nilai_target_perubahan`) as JUMLAH, `tbl_target_perubahan`.* FROM `tbl_target_perubahan` WHERE `tbl_target_perubahan`.`id_skpd` = '$a'   AND `tbl_target_perubahan`.`id_rekening`='$d' AND `tbl_target_perubahan`.`tahun`='$e' ORDER BY `id_target_perubahan` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}



public function readSumRek4DataTarget($a,$d,$e){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_data_target`) as JUMLAH, `tbl_data_target`.* FROM `tbl_data_target` WHERE `tbl_data_target`.`id_skpd` = '$a'   AND `tbl_data_target`.`id_rekening`='$d' AND `tbl_data_target`.`tahun`='$e' ORDER BY `id_data_target` ASC");
		$query->execute();//echo"<br><br>SELECT sum(`nilai_data_target`) as JUMLAH, `tbl_data_target`.* FROM `tbl_data_target` WHERE `tbl_data_target`.`id_skpd` = '$a'   AND `tbl_data_target`.`id_rekening`='$d' AND `tbl_data_target`.`tahun`='$e' ORDER BY `id_data_target` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readSumRek4DataTargetDenda($a,$d,$e){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target_denda`) as JUMLAH, `tbl_target_denda`.* FROM `tbl_target_denda` WHERE `tbl_target_denda`.`id_skpd` = '$a'   AND `tbl_target_denda`.`id_rekening`='$d' AND `tbl_target_denda`.`tahun`='$e' ORDER BY `id_data_target` ASC");
		$query->execute();//echo"<br><br>SELECT sum(`nilai_target_denda`) as JUMLAH, `tbl_target_denda`.* FROM `tbl_target_denda` WHERE `tbl_target_denda`.`id_skpd` = '$a'   AND `tbl_target_denda`.`id_rekening`='$d' AND `tbl_target_denda`.`tahun`='$e' ORDER BY `id_data_target` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readSumRek4TargetRealisasi($a,$aA,$d,$e){
	try {
		$query = $this->db->prepare("SELECT sum(`nilai_target`) as JUMLAH, `tbl_target`.* FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and (`tbl_master_skpd`.`id_skpd` BETWEEN '$a' AND '$aA')   AND `tbl_master_skpd`.`id_rekening`='$d' AND `tbl_target`.`tahun`='$e' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC");
		$query->execute();//echo"<br><br>SELECT sum(`nilai_target`) as JUMLAH FROM `tbl_master_skpd`,`tbl_target` WHERE `tbl_target`.`id_master_skpd`=`tbl_master_skpd`.`id_master_skpd` and `tbl_master_skpd`.`id_skpd` = '$a'   AND `tbl_master_skpd`.`id_rekening`='$d' AND `tbl_target`.`tahun`='$e' ORDER BY `tbl_master_skpd`.`id_sub_sub_rekening` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi SUM 2 where ORDER BY ASC
public function readAllBySum2Where1Asc($tabel,$sum1,$sum2,$kolom,$id,$order){
	try {
		$query = $this->db->prepare("SELECT SUM($sum1) as $sum1, SUM($sum2) as $sum2 FROM $tabel WHERE $kolom=:id ORDER BY $order ASC");
		$query->execute(array(":id"=>$id));//echo"SELECT SUM($sum1) as $sum1, SUM($sum2) as $sum2 FROM $tabel WHERE $kolom='$id' ORDER BY $order ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi SUM 3 BETWEEN ANTARA 2 TANGGAL ORDER BY ASC
public function readAllByBetweenSum3Asc($tabel,$sum1,$sum2,$sum3,$kolom,$id,$range1,$range2,$between,$order){
	try {
		$query = $this->db->prepare("SELECT SUM($sum1) as $sum1, SUM($sum2) as $sum2,SUM($sum3) as $sum3 FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2') AND $kolom=:id ORDER BY $order ASC");
		$query->execute(array(":id"=>$id));
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi SUM 4 BETWEEN ANTARA 2 TANGGAL ORDER BY ASC
public function readAllByBetweenSum4Asc($tabel,$sum1,$sum2,$sum3,$sum4,$kolom,$id,$range1,$range2,$between,$order){
	try {
		$query = $this->db->prepare("SELECT SUM($sum1) as $sum1, SUM($sum2) as $sum2,SUM($sum3) as $sum3,SUM($sum4) as $sum4 FROM $tabel WHERE ($between BETWEEN '$range1' AND '$range2') AND $kolom=':id' ORDER BY $order ASC");
		$query->execute(array(":id"=>$id));
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi SUM 4 BETWEEN ANTARA 2 TANGGAL ORDER BY ASC
public function readAllBySum11where2YearAsc($tabel,$sum1,$sum2,$sum3,$sum4,$sum5,$sum6,$sum7,$sum8,$sum9,$sum10,$sum11,$a,$aa,$b,$bb,$order){
	try {
		$query = $this->db->prepare("SELECT SUM($sum1) as $sum1, SUM($sum2) as $sum2,SUM($sum3) as $sum3,SUM($sum4) as $sum4,SUM($sum5) as $sum5,SUM($sum6) as $sum6,SUM($sum7) as $sum7,SUM($sum8) as $sum8,SUM($sum9) as $sum9,SUM($sum10) as $sum10,SUM($sum11) as $sum11 FROM $tabel WHERE $a=':aa' OR $b LIKE '$bb%' ORDER BY $order ASC");

		$query->execute(array(":aa"=>$aa));//echo"SELECT SUM($sum1) as $sum1, SUM($sum2) as $sum2,SUM($sum3) as $sum3,SUM($sum4) as $sum4,SUM($sum5) as $sum5,SUM($sum6) as $sum6,SUM($sum7) as $sum7,SUM($sum8) as $sum8,SUM($sum9) as $sum9,SUM($sum10) as $sum10,SUM($sum11) as $sum11 FROM $tabel WHERE $a='$aa' OR $b LIKE '$bb%' ORDER BY $order ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi SUM 4 BETWEEN ANTARA 2 TANGGAL ORDER BY ASC
public function readAllBySum11where($tabel,$sum1,$sum2,$sum3,$sum4,$sum5,$sum6,$sum7,$sum8,$sum9,$sum10,$sum11,$b,$bb,$order){
	try {
		$query = $this->db->prepare("SELECT `$tabel`.`id_kabupaten` as kabupaten , SUM($sum1) as $sum1, SUM($sum2) as $sum2,SUM($sum3) as $sum3,SUM($sum4) as $sum4,SUM($sum5) as $sum5,SUM($sum6) as $sum6,SUM($sum7) as $sum7,SUM($sum8) as $sum8,SUM($sum9) as $sum9,SUM($sum10) as $sum10,SUM($sum11) as $sum11 FROM $tabel WHERE $b LIKE '$bb%' ORDER BY $order ASC");
	// echo"SELECT SUM($sum1) as $sum1, SUM($sum2) as $sum2,SUM($sum3) as $sum3,SUM($sum4) as $sum4,SUM($sum5) as $sum5,SUM($sum6) as $sum6,SUM($sum7) as $sum7,SUM($sum8) as $sum8,SUM($sum9) as $sum9,SUM($sum10) as $sum10,SUM($sum11) as $sum11 FROM $tabel WHERE $b LIKE '$bb%' ORDER BY $order ASC";
		$query->execute(array(":bb"=>$bb));
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi SUM 4 BETWEEN ANTARA 2 TANGGAL ORDER BY ASC
public function readAllByWhere2BetweenSum6Asc($tabel,$sum1,$sum2,$sum3,$sum4,$sum5,$sum6,$kolom,$id,$range1,$range2,$where1,$kondisi1,$where2,$kondisi2,$between,$order){
	try {
		$query = $this->db->prepare("SELECT SUM($sum1) as $sum1, SUM($sum2) as $sum2,SUM($sum3) as $sum3,SUM($sum4) as $sum4,SUM($sum5) as $sum5,SUM($sum6) as $sum6 FROM $tabel WHERE $where1='$kondisi1' AND $where2='$kondisi2' AND ($between BETWEEN '$range1' AND '$range2') AND $kolom=:id ORDER BY $order ASC");
		$query->execute(array(":id"=>$id));
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//Select dengan kondisi where iner join atau pencarian penggabungan 2 tabel
public function readAllTabel2($tabel,$tabel2,$kolom){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` ");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllTabel2DistinctWhereDesc($tabel,$tabel2,$kolom,$a,$aa,$dist){
	try {
		$query = $this->db->prepare("SELECT DISTINCT(`$dist`) as $dist FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom`  AND `$tabel`.`$a`='$aa'  ORDER BY $dist DESC");
		$query->execute();//echo"<br><br>SELECT DISTINCT(`$dist`) as $dist FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom`  AND `$tabel`.`$a`='$aa'  ORDER BY $dist DESC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllTabel2DistinctWhereAsc($tabel,$tabel2,$kolom,$a,$aa,$dist){
	try {
		$query = $this->db->prepare("SELECT DISTINCT(`$dist`) as REKENING, `$tabel2`.* FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom`  AND `$tabel`.`$a`='$aa'  ORDER BY `$dist` ASC");
		$query->execute();//echo"<br><br>SELECT DISTINCT(`$dist`) as REKENING, `$tabel`.* FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom`  AND `$tabel`.`$a`='$aa'  ORDER BY `$dist` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllTabel2DistinctWhereAsc_2($tabel,$tabel2,$kolom,$a,$aa,$dist){
	try {
		$query = $this->db->prepare("SELECT DISTINCT(`$dist`) as $dist FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom`  AND `$tabel`.`$a`='$aa'  ORDER BY `$dist` ASC");
		$query->execute();//echo"<br><br>readAllTabel2DistinctWhereAsc_2 = SELECT DISTINCT(`$dist`) as $dist FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom`  AND `$tabel`.`$a`='$aa'  ORDER BY `$dist` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllDistinctWhereAsc($tabel,$a,$aa,$dist){
	try {
		$query = $this->db->prepare("SELECT DISTINCT(`$dist`) as REKENING FROM `$tabel` WHERE  `$tabel`.`$a`='$aa'  ORDER BY `$dist` ASC");
		$query->execute();//echo"<br><br>SELECT DISTINCT(`$dist`) as REKENING FROM `$tabel` WHERE  `$tabel`.`$a`='$aa'  ORDER BY `$dist` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readAllDistinctWhereDesc($tabel,$a,$aa,$dist){
	try {
		$query = $this->db->prepare("SELECT DISTINCT(`$dist`) as `$dist`  FROM `$tabel` WHERE  `$tabel`.`$a`='$aa'  ORDER BY `$dist` DESC");
		$query->execute();//echo"<br><br>SELECT DISTINCT(`$dist`) as `$dist`  FROM `$tabel` WHERE  `$tabel`.`$a`='$aa'  ORDER BY `$dist` DESC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllTabel2DistinctDesc($tabel,$tabel2,$kolom,$dist){
	try {
		$query = $this->db->prepare("SELECT DISTINCT year(`$dist`) as $dist FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom`   ORDER BY $dist DESC");
		$query->execute();//echo"<br><br>SELECT DISTINCT(`$dist`) as $dist FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom`   ORDER BY $dist DESC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}



//Select dengan kondisi where iner join atau pencarian penggabungan 2 tabel
public function readAllTabel2Desc($tabel,$tabel2,$kolom,$desc){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` ORDER BY $desc DESC");
		$query->execute();//echo"SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` ORDER BY $desc DESC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readAllTabel2DescLimit($tabel,$tabel2,$kolom,$desc,$limit1,$limit2){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` ORDER BY `$tabel`.`$desc` DESC LIMIT $limit1,$limit2");
		$query->execute();//echo"SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` ORDER BY `$tabel`.`$desc` DESC LIMIT $limit1,$limit2";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readAllTabel2DescWhere2Limit($tabel,$tabel2,$kolom,$w1,$ww1,$w2,$ww2,$desc,$limit1,$limit2){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` and (`$w1`='$ww1' or `$w2`='$ww2') ORDER BY `$tabel`.`$desc` DESC LIMIT $limit1,$limit2");
		$query->execute();//echo"SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` and (`$w1`='$ww1' or `$w2`='$ww2') ORDER BY `$tabel`.`$desc` DESC LIMIT $limit1,$limit2";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function getKelayakanIzin($bidang){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_pendaftaran`='Y' and
			`tbl_validasi`.`validasi_kelayakan`='0'  and `tbl_proses_master`.`id_bidang`='$bidang'");
		$query->execute();/*echo"SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_pendaftaran`='Y' and
			`tbl_validasi`.`validasi_kelayakan`='0'  and `tbl_proses_master`.`id_bidang`='$bidang'";*/
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function getKelayakanIzinAdmin(){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_pendaftaran`='Y' and
			`tbl_validasi`.`validasi_kelayakan`='0'  ");
		$query->execute();/*echo"SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_pendaftaran`='Y' and
			`tbl_validasi`.`validasi_kelayakan`='0'   ";*/
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function getUndangan($bidang){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_undangan`='N' and
			`tbl_validasi`.`validasi_survey`='Y'  and `tbl_proses_master`.`id_bidang`='$bidang'");
		$query->execute();/*echo"SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_undangan`='N' and
			`tbl_validasi`.`validasi_survey`='Y'  and `tbl_proses_master`.`id_bidang`='$bidang'";*/
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function getUndanganAdmin(){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_undangan`='N' and
			`tbl_validasi`.`validasi_survey`='Y' ");
		$query->execute();/*echo"SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_undangan`='N' and
			`tbl_validasi`.`validasi_survey`='Y'";*/
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function getPenomoran($bidang){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_kelayakan`='Y' and `tbl_validasi`.`validasi_penomoran`='N' and `tbl_proses_master`.`id_bidang`='$bidang'");
		$query->execute();/*echo"SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_kelayakan`='$kelayakan'  and `tbl_proses_master`.`id_bidang`='$bidang'";*/
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function getPenomoranAdmin(){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_kelayakan`='Y' and `tbl_validasi`.`validasi_penomoran`='N' ");
		$query->execute();/*echo"SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_kelayakan`='$kelayakan' ";*/
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function getTolakPerizinan($bidang){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_kelayakan`='N'  and `tbl_proses_master`.`id_bidang`='$bidang'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function getTolakPerizinanAdmin(){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_kelayakan`='N' ");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function getPerizinan($bidang){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_kelayakan`='Y' and `tbl_validasi`.`validasi_penomoran`='Y' and `tbl_proses_master`.`id_bidang`='$bidang'");
		$query->execute();/*echo"SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_kelayakan`='$kelayakan'  and `tbl_proses_master`.`id_bidang`='$bidang'";*/
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function getPerizinanAdmin(){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_kelayakan`='Y' and `tbl_validasi`.`validasi_penomoran`='Y'");
		$query->execute();/*echo"SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_kelayakan`='$kelayakan'  ";*/
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function getPenyerahan(){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_kelayakan`='Y' and `tbl_validasi`.`validasi_penomoran`='Y'  and `tbl_validasi`.`validasi_penyerahan`='N' ");
		$query->execute();/*echo"SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_kelayakan`='$kelayakan'  and `tbl_proses_master`.`id_bidang`='$bidang'";*/
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function getPenyerahan2(){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_kelayakan`='Y' and `tbl_validasi`.`validasi_penomoran`='Y'  and `tbl_validasi`.`validasi_penyerahan`='Y'  ");
		$query->execute();/*echo"SELECT * FROM `tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi`,`tbl_validasi`,
			`tbl_pengurusan` where `tbl_pendaftaran`.`id_pendaftaran`=`tbl_proses_master`.`id_pendaftaran` and
			`tbl_resi`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` and `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and
			`tbl_pengurusan`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and `tbl_validasi`.`id_pengurusan`=`tbl_proses_master`.`id_pengurusan` and
			`tbl_validasi`.`validasi_kelayakan`='$kelayakan'  and `tbl_proses_master`.`id_bidang`='$bidang'";*/
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//Select dengan kondisi where iner join atau pencarian penggabungan 2 tabel
public function readAllTabel3Desc($tabel,$tabel2,$tabel3,$kolom,$kolom2,$desc){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2`,`$tabel3` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` and `$tabel2`.`$kolom2`=`$tabel3`.`$kolom2`  ORDER BY `$tabel`.`$desc` DESC");//echo"SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` and `$tabel2`.`$kolom2`=`$tabel3`.`$kolom2`  ORDER BY `$tabel`.`$desc` DESC";
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi where iner join atau pencarian penggabungan 2 tabel
public function readAllTabel3WhereDesc($tabel,$tabel2,$tabel3,$kolom,$kolom2,$a,$aa,$desc){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2`,`$tabel3` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` and `$tabel2`.`$kolom2`=`$tabel3`.`$kolom2` AND `$tabel`.`$a`='$aa' ORDER BY `$desc` DESC");
		//echo"SELECT * FROM `$tabel`,`$tabel2`,`$tabel3` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` and `$tabel2`.`$kolom2`=`$tabel3`.`$kolom2` AND `$tabel`.`$a`='$aa' ORDER BY `$desc` DESC";
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//Select dengan kondisi where iner join atau pencarian penggabungan 2 tabel
public function readAllTabel4Desc($tabel,$tabel2,$tabel3,$tabel4,$kolom,$kolom2,$kolom3,$desc){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2`,`$tabel3`,`$tabel4` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` and `$tabel2`.`$kolom2`=`$tabel3`.`$kolom2`   and `$tabel`.`$kolom3`=`$tabel4`.`$kolom3` ORDER BY `$tabel`.`$desc` DESC");

		//echo"SELECT * FROM `$tabel`,`$tabel2`,`$tabel3`,`$tabel4` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` and `$tabel2`.`$kolom2`=`$tabel3`.`$kolom2`   and `$tabel`.`$kolom3`=`$tabel4`.`$kolom3` ORDER BY `$tabel`.`$desc` DESC";
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllTabel4WhereDesc($tabel,$tabel2,$tabel3,$tabel4,$kolom,$kolom2,$kolom3,$a,$aa,$desc){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2`,`$tabel3`,`$tabel4` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` and `$tabel2`.`$kolom2`=`$tabel3`.`$kolom2`   and `$tabel`.`$kolom3`=`$tabel4`.`$kolom3` and $a='$aa' ORDER BY `$tabel4`.`$desc` DESC");

		//echo"SELECT * FROM `$tabel`,`$tabel2`,`$tabel3`,`$tabel4` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` and `$tabel2`.`$kolom2`=`$tabel3`.`$kolom2`   and `$tabel`.`$kolom3`=`$tabel4`.`$kolom3` and $a='$aa' ORDER BY `$tabel4`.`$desc` DESC";
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi where iner join atau pencarian penggabungan 2 tabel
public function readAllTabel2NotDesc($tabel,$tabel2,$kolom,$desc){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`!=`$tabel2`.`$kolom` ORDER BY $desc DESC ");
		$query->execute();//echo"SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`!=`$tabel2`.`$kolom` ORDER BY $desc DESC ";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}



//Select dengan kondisi where iner join atau pencarian penggabungan 2 tabel
public function readAllTabel2Where2($tabel,$tabel2,$kolom,$a,$aa){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tabel`.`$a`='$aa'");
		$query->execute();//echo"SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tabel`.`$a`='$aa'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//Select dengan kondisi where iner join atau pencarian penggabungan 2 tabel
public function readAllTabel2Where2A($tabel,$tabel2,$kolom,$a,$aa){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$a`='$aa'");
		$query->execute();//echo"SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$a`='$aa'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi where iner join atau pencarian penggabungan 2 tabel
public function readAllTabel2Where2Asc($tabel,$tabel2,$kolom,$a,$aa,$asc){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tabel`.`$a`='$aa' ORDER BY `$tabel`.`$asc` ASC");
		$query->execute();//echo"<BR>SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tabel`.`$a`='$aa' ORDER BY `$tabel`.`$asc` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function getInsertPenyerahan($a,$b,$c,$d,$e,$f,$g){
	try {
		$query = $this->db->prepare("INSERT INTO `tbl_penyerahan` (`id_penyerahan`, `no_resi`, `id_pengurusan`, `id_user`, `nama_penerima`, `alamat_penerima`, `no_telp`, `tgl_penyerahan`, `keterangan_penyerahan`) VALUES (NULL, '$a', '$b', '$c', '$d', '$e', '$f', CURRENT_TIMESTAMP, '$g')");
		$query->execute();//echo"<BR>SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tabel`.`$a`='$aa' ORDER BY `$tabel`.`$asc` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//Select dengan kondisi where iner join atau pencarian penggabungan 2 tabel where 3
public function readAllTabel2Where3($tabel,$tabel2,$kolom,$a,$aa,$b,$bb){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tabel`.`$a`='$aa' AND `$tabel`.`$b`='$bb'");
		$query->execute();//echo"<br>SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tabel`.`$a`='$aa' AND `$tabel`.`$b`='$bb'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//Select dengan kondisi where iner join atau pencarian penggabungan 2 tabel where 3
public function readAllTabel2Where3A($tabel,$tabel2,$kolom,$a,$aa,$b,$bb){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND  `$a`='$aa' AND  `$b`='$bb'");
		$query->execute();//echo"<br>SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND  `$a`='$aa' AND  `$b`='$bb'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function getDataProsesFo($a,$b){
	try {
		$query = $this->db->prepare("SELECT * FROM `tbl_resi`,`tbl_validasi` WHERE `tbl_resi`.`no_resi`=`tbl_validasi`.`no_resi` and `tbl_validasi`.`id_pengurusan`=1 and `tbl_validasi`.`validasi_undangan`='Y'");
		$query->execute();//echo"<br>SELECT * FROM `tbl_proses_master`,`tbl_pengurusan`,`tbl_validasi` WHERE `tbl_proses_master`.`id_pengurusan`=`tbl_pengurusan`.`id_pengurusan` and `tbl_proses_master`.`id_pendaftaran`=`tbl_validasi`.`id_pendaftaran` and `tbl_proses_master`.`id_pengurusan`=`tbl_validasi`.`id_pengurusan` AND `tbl_proses_master`.`id_pendaftaran`='$a' AND `tbl_proses_master`.`id_bidang`='$b' and `tbl_validasi`.`validasi_kelayakan`='Y'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function getDataUndangan($idbidang,$survey,$undangan,$limit1,$limit2){
	try {
		$query = $this->db->prepare("SELECT DISTINCT(`tbl_pendaftaran`.`id_pendaftaran`) as ID, `tbl_pendaftaran`.* FROM `tbl_validasi`,`tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi` WHERE `tbl_pendaftaran`.`id_pendaftaran`=`tbl_resi`.`id_pendaftaran` and `tbl_validasi`.`no_resi`=`tbl_resi`.`no_resi` and `tbl_proses_master`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` AND `tbl_validasi`.`validasi_survey`='$survey' AND `tbl_validasi`.`validasi_undangan`='$undangan' and `tbl_proses_master`.`id_bidang`='$idbidang' ORDER BY id_validasi DESC LIMIT $limit1,$limit2");
		$query->execute();//echo"<br>SELECT DISTINCT(`tbl_pendaftaran`.`id_pendaftaran`) as ID, `tbl_pendaftaran`.* FROM `tbl_validasi`,`tbl_pendaftaran`,`tbl_proses_master`,`tbl_resi` WHERE `tbl_pendaftaran`.`id_pendaftaran`=`tbl_resi`.`id_pendaftaran` and `tbl_validasi`.`no_resi`=`tbl_resi`.`no_resi` and `tbl_proses_master`.`id_pendaftaran`=`tbl_pendaftaran`.`id_pendaftaran` AND `tbl_validasi`.`validasi_survey`='$survey' AND `tbl_validasi`.`validasi_undangan`='$undangan' and `tbl_proses_master`.`id_bidang`='$idbidang' ORDER BY id_validasi DESC LIMIT $limit1,$limit2";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readAllTabel2Where3OrderbyLimit($tabel,$tabel2,$kolom,$a,$aa,$b,$bb,$order,$by,$limit1,$limit2){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tabel`.`$a`='$aa' AND `$tabel`.`$b`='$bb' ORDER BY $order $by LIMIT $limit1,$limit2");
		$query->execute();// echo"<br>SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tabel`.`$a`='$aa' AND `$tabel`.`$b`='$bb' ORDER BY $order $by LIMIT $limit1,$limit2";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function readAllTabel2Where3b($tabel,$tabel2,$kolom,$a,$aa,$b,$bb){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tabel`.`$a`='$aa' AND `$b`='$bb'");
		$query->execute();//echo"<br><br>readAllTabel2Where3b = SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tabel`.`$a`='$aa' AND `$b`='$bb'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Select dengan kondisi where iner join atau pencarian penggabungan 2 tabel where 4
public function readAllTabel2Where4($tabel,$tabel2,$kolom,$tA,$a,$aa,$tB,$b,$bb,$tC,$c,$cc){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tA`.`$a`='$aa' AND `$tB`.`$b`='$bb' AND `$tC`.`$c`='$cc'");
		$query->execute();//echo"SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tA`.`$a`='$aa' AND `$tB`.`$b`='$bb' AND `$tC`.`$c`='$cc'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllTabel2SumWhere4Between($tabel,$tabel2,$kolom,$sum,$tA,$a,$aa,$tB,$b,$bb,$c,$reng1,$reng2){
	try {
		$query = $this->db->prepare("SELECT SUM(`$sum`) as $sum FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tA`.`$a`='$aa' AND `$tB`.`$b`='$bb' AND (`$c` BETWEEN '$reng1' AND '$reng2')");
		$query->execute();//echo"<br><br>SELECT SUM(`$sum`) as $sum FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tA`.`$a`='$aa' AND `$tB`.`$b`='$bb' AND (`$c` BETWEEN '$reng1' AND '$reng2')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllTabel2SumWhere2($tabel,$tabel2,$kolom,$sum,$tA,$a,$aa,$tB,$b,$bb){
	try {
		$query = $this->db->prepare("SELECT SUM(`$sum`) as $sum FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND year(`$tA`.`$a`)='$aa' AND `$tB`.`$b`='$bb'");
		$query->execute();//echo"<br><br>SELECT SUM(`$sum`) as $sum FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND year(`$tA`.`$a`)='$aa' AND `$tB`.`$b`='$bb'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//Select dengan kondisi where iner join atau pencarian penggabungan 2 tabel where 4
public function readAllTabel2Where4Like($tabel,$tabel2,$kolom,$tA,$a,$aa,$tB,$b,$bb,$tC,$c,$cc){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tA`.`$a`='$aa' AND `$tB`.`$b`='$bb' AND `$tC`.`$c` like '%$cc%'");
		$query->execute();//echo"SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tA`.`$a`='$aa' AND `$tB`.`$b`='$bb' AND `$tC`.`$c` like '%$cc%';";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function readAllTabel2WhereLikeAsc($tabel,$tabel2,$kolom,$tA,$a,$aa,$tB,$b,$bb,$tAsc,$asc){
	try {
		$query = $this->db->prepare("SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tA`.`$a`='$aa' AND `$tB`.`$b` like '%$bb%' ORDER BY `$tAsc`.`$asc` ASC");
		$query->execute();//echo"<br> SELECT * FROM `$tabel`,`$tabel2` WHERE `$tabel`.`$kolom`=`$tabel2`.`$kolom` AND `$tA`.`$a`='$aa' AND `$tB`.`$b` like '%$bb%' ORDER BY `$tAsc`.`$asc` ASC";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


public function sumWhere3($tabel,$sum,$a,$aA,$b,$bB,$c,$cC){
	try {
		$query = $this->db->prepare("SELECT SUM($sum) as $sum FROM $tabel WHERE `$a`='$aA' AND `$b`='$bB' AND `$c`='$cC'");
		$query->execute();//echo"<br><br>SELECT SUM($sum) as $sum FROM $tabel WHERE `$a`='$aA' AND `$b`='$bB'  AND `$c`='$cC'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function sumWhere4($tabel,$sum,$a,$aA,$b,$bB,$c,$cC,$d,$dD){
	try {
		$query = $this->db->prepare("SELECT SUM($sum) as $sum FROM $tabel WHERE `$a`='$aA' AND `$b`='$bB' AND `$c`='$cC'  AND `$d`='$dD'");
		$query->execute();//echo"<br><br>sumWhere4 SELECT SUM($sum) as $sum FROM $tabel WHERE `$a`='$aA' AND `$b`='$bB'  AND `$c`='$cC'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function sumPenumpang($tabel,$kolom){
	try {
		$query = $this->db->prepare("SELECT SUM($kolom) as $kolom FROM $tabel");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function sumPenumpangByKab($tabel,$kolom,$kondisi){
	try {
		$query = $this->db->prepare("SELECT SUM($kolom) as $kolom FROM $tabel WHERE id_kabupaten='$kondisi'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//Pakai LIKE
public function readAllLike($tabel,$kondisi1,$kondisi2,$kondisi3,$clue1,$clue2,$clue3){
	try {
		$query = $this->db->prepare("SELECT * FROM $tabel WHERE $kondisi1 LIKE '%$clue1%' OR $kondisi2 LIKE '%$clue2%' OR $kondisi3 LIKE '%$clue3%' AND status='Y'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//Insert Data
public function insert2kolom($tabel,$a){
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

//3 kolom
public function insert3kolom($tabel,$a,$b){
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
public function insert2kolomNotNull($tabel,$a,$b){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES('$a','$b')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//4 kolom
public function insert4kolom($tabel,$a,$b,$c){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c')");
		$query->execute();//echo"<br>INSERT INTO $tabel VALUES(null,'$a','$b','$c')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//4 kolom
public function insert4kolomFull($tabel,$aa,$bb,$cc,$dd,$a,$b,$c){
	try {
		$query = $this->db->prepare("INSERT INTO `$tabel` (`$aa`,`$bb`,`$cc`,`$dd`) VALUES(null,'$a','$b','$c')");
		$query->execute();//echo"<br>INSERT INTO $tabel (`$aa`,`$bb`,`$cc`,`$dd`) VALUES(null,'$a','$b','$c')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//3 kolom
public function insert3kolomFull($tabel,$aa,$bb,$cc,$a,$b){
	try {
		$query = $this->db->prepare("INSERT INTO `$tabel` (`$aa`,`$bb`,`$cc`,`tgl_resi`) VALUES(null,'$a','$b',CURRENT_TIMESTAMP)");
		$query->execute();//echo"<br>INSERT INTO $tabel (`$aa`,`$bb`,`$cc`,`$dd`) VALUES(null,'$a','$b','$c')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//5 kolom
public function insert1($tabel,$a,$b,$c,$d){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function insert1_1($tabel,$a,$b,$c,$d,$e){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e')");
		$query->execute();//echo"INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


//6 kolom
public function insert2($tabel,$a,$b,$c,$d,$e,$f){
	$options = [
	    	'cost' => 12,
	    	'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
	$password = password_hash($d, PASSWORD_BCRYPT, $options);

	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES('$a','$b','$c','$password','$e','$f')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function insertPassword9($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j){
	$options = [
	    	'cost' => 12,
	    	'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
	$password = password_hash($d, PASSWORD_BCRYPT, $options);

	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES('$a','$b','$c','$password','$e','$f','$g','$h','$i','$j')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function insertPassword7($tabel,$a,$b,$c,$d,$e,$f){

	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a',PASSWORD('$b'),'$c','$d','$e','$f')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


public function insert2_1($tabel,$a,$b,$c,$d,$e,$f){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES('$a','$b','$c','$d','$e','$f')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//7 kolom
public function insert3($tabel,$b,$c,$d,$e,$f,$g){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$b','$c','$d','$e','$f','$g')");
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
public function insert08($tabel,$a,$b,$c,$d,$e,$f,$g){
	$options = [
	    	'cost' => 12,
	    	'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
	$password = password_hash($d, PASSWORD_BCRYPT, $options);
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES('$a','$b','$c','$password','$e','$f','$g','1')");
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
public function insert4($tabel,$a,$b,$c,$d,$e,$f,$g,$h){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function insertNull5($tabel,$a,$b,$c,$d,$e){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e')");
		$query->execute();//echo"<br><br>INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function insert4_1($tabel,$a,$b,$c,$d,$e,$f,$g){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function insert7null($tabel,$a,$b,$c,$d,$e,$f){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//9 kolom
public function insert5($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES('$a','$b','$c','$d','$e','$f','$g','$h','$i')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//9 kolom null
public function insert9null($tabel,$a,$b,$c,$d,$e,$f,$g,$h){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//10 kolom
public function insert6($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//11 kolom
public function insert7($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//12 kolom
public function insert8($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//13 kolom
public function insert9($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//15 null kolom
public function insert14null($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//15 null kolom
public function insert15null($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o')");
		$query->execute();//echo"INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//14 kolom
public function insert10($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//16 kolom
public function insert11($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

//17 kolom
public function insert17($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q')");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//21 null kolom
public function insert21null($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q,$r,$s,$t,$u){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u')");
		$query->execute();//echo "<br />INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
//22 null kolom
public function insert22null($tabel,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q,$r,$s,$t,$u,$v){
	try {
		$query = $this->db->prepare("INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u','$v')");
		$query->execute();//echo "<br />INSERT INTO $tabel VALUES(null,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u','$v')";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////
//Update Data //////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
public function updateStatus($tabel , $where ,$kondisi,$nilai){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET status='$nilai' WHERE $where='$kondisi'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updateWhere2($tabel , $a,$aa,$wA,$wAA,$wb,$wBB){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET `$a`='$aa' WHERE $wA='$wAA' and $wb='$wBB'");
		$query->execute();//echo"UPDATE $tabel SET `$a`='$aa' WHERE $wA='$wAA' and $wb='$wBB'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}




public function updateById_1($tabel,$a,$aa,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa' WHERE $kolom='$id'");
		$query->execute();//echo"<br>UPDATE $tabel SET $a='$aa' WHERE $kolom='$id'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function updateById_1Where3($tabel,$a,$aa,$kolom,$id,$kolom2,$id2,$kolom3,$id3){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa' WHERE $kolom='$id' and $kolom2='$id2' and $kolom3='$id3'");
		$query->execute();//echo"<br>UPDATE $tabel SET $a='$aa' WHERE $kolom='$id' and $kolom2='$id2' and $kolom3='$id3'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function updateById_2($tabel,$a,$aa,$b,$bb,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa' ,$b='$bb' WHERE $kolom='$id'");
		$query->execute();//echo"UPDATE $tabel SET $a='$aa' ,$b='$bb' WHERE $kolom='$id'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updateById_2Password($tabel,$a,$aa,$b,$bb,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a=PASSWORD('$aa') ,$b='$bb' WHERE $kolom='$id'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updateById_10($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$e,$ee,$f,$ff,$g,$gg,$h,$hh,$i,$ii,$j,$jj,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee',$f='$ff',$g='$gg',$h='$hh',$i='$ii',$j='$jj' WHERE $kolom='$id'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


public function updateById_5($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$e,$ee,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee' WHERE $kolom='$id'");
		$query->execute(); //echo "UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee' WHERE $kolom='$id'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updateById_4($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd' WHERE $kolom='$id'");
		$query->execute();//echo"UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd' WHERE $kolom='$id'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function updateById_3($tabel,$a,$aa,$b,$bb,$c,$cc,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc' WHERE $kolom='$id'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updateById_3Password($tabel,$a,$aa,$b,$bb,$c,$cc,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a=PASSWORD('$aa'),$b='$bb',$c='$cc' WHERE $kolom='$id'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updateById_6($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$e,$ee,$f,$ff,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee',$f='$ff' WHERE $kolom='$id'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updateById_7($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$e,$ee,$f,$ff,$g,$gg,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee',$f='$ff',$g='$gg' WHERE $kolom='$id'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


public function updateById_8($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$e,$ee,$f,$ff,$g,$gg,$h,$hh,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee',$f='$ff',$g='$gg',$h='$hh' WHERE $kolom='$id'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updateById_11($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$e,$ee,$f,$ff,$g,$gg,$h,$hh,$i,$ii,$j,$jj,$k,$kk, $kolom,$id){
	try {
		$query = $this->db->prepare('UPDATE '.$tabel.' SET '.$a.'="'.$aa.'",'.$b.'="'.$bb.'",'.$c.'="'.$cc.'",'.$d.'="'.$dd.'",'.$e.'="'.$ee.'",'.$f.'="'.$ff.'",'.$g.'="'.$gg.'",'.$h.'="'.$hh.'",'.$i.'="'.$ii.'",'.$j.'="'.$jj.'",'.$k.'="'.$kk.'" WHERE '.$kolom.'="'.$id.'"');
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updateById_12($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$e,$ee,$f,$ff,$g,$gg,$h,$hh,$i,$ii,$j,$jj,$k,$kk,$l,$ll, $kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee',$f='$ff',$g='$gg',$h='$hh',$i='$ii',$j='$jj',$k='$kk',$l='$ll' WHERE $kolom='$id'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}


public function updateById_17($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$e,$ee,$f,$ff,$g,$gg,$h,$hh,$i,$ii,$j,$jj,$k,$kk,$l,$ll,$m,$mm,$n,$nn,$o,$oo,$p,$pp,$q,$qq,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee',$f='$ff',$g='$gg',$h='$hh',$i='$ii',$j='$jj',$k='$kk',$l='$ll',$m='$mm',$n='$nn',$o='$oo',$p='$pp',$q='$qq' WHERE $kolom='$id'");
		$query->execute();//echo"UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee',$f='$ff',$g='$gg',$h='$hh',$i='$ii',$j='$jj',$k='$kk',$l='$ll',$m='$mm',$n='$nn',$o='$oo',$p='$pp',$q='$qq' WHERE $kolom='$id'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updateById_14($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$e,$ee,$f,$ff,$g,$gg,$h,$hh,$i,$ii,$j,$jj,$k,$kk,$l,$ll,$m,$mm,$n,$nn,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee',$f='$ff',$g='$gg',$h='$hh',$i='$ii',$j='$jj',$k='$kk',$l='$ll',$m='$mm',$n='$nn' WHERE $kolom='$id'");
		$query->execute();//echo"UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee',$f='$ff',$g='$gg',$h='$hh',$i='$ii',$j='$jj',$k='$kk',$l='$ll',$m='$mm',$n='$nn',$o='$oo' WHERE $kolom='$id'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updateById_15($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$e,$ee,$f,$ff,$g,$gg,$h,$hh,$i,$ii,$j,$jj,$k,$kk,$l,$ll,$m,$mm,$n,$nn,$o,$oo,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee',$f='$ff',$g='$gg',$h='$hh',$i='$ii',$j='$jj',$k='$kk',$l='$ll',$m='$mm',$n='$nn',$o='$oo' WHERE $kolom='$id'");
		$query->execute();//echo"UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee',$f='$ff',$g='$gg',$h='$hh',$i='$ii',$j='$jj',$k='$kk',$l='$ll',$m='$mm',$n='$nn',$o='$oo' WHERE $kolom='$id'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updateById_16($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$e,$ee,$f,$ff,$g,$gg,$h,$hh,$i,$ii,$j,$jj,$k,$kk,$l,$ll,$m,$mm,$n,$nn,$o,$oo,$p,$pp,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee',$f='$ff',$g='$gg',$h='$hh',$i='$ii',$j='$jj',$k='$kk',$l='$ll',$m='$mm',$n='$nn',$o='$oo',$p='$pp' WHERE $kolom='$id'");
		$query->execute();//echo"UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee',$f='$ff',$g='$gg',$h='$hh',$i='$ii',$j='$jj',$k='$kk',$l='$ll',$m='$mm',$n='$nn',$o='$oo' WHERE $kolom='$id'";
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}




public function updateById_9($tabel,$a,$aa,$b,$bb,$c,$cc,$d,$dd,$e,$ee,$f,$ff,$g,$gg,$h,$hh,$i,$ii,$kolom,$id){
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$aa',$b='$bb',$c='$cc',$d='$dd',$e='$ee',$f='$ff',$g='$gg',$h='$hh',$i='$ii' WHERE `$kolom`='$id'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updatePW($tabel,$kondisi,$nilai,$a,$b){
	$options = [
	    	'cost' => 12,
	    	'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
	$password = password_hash($b, PASSWORD_BCRYPT, $options);
	try {
		$query = $this->db->prepare("UPDATE $tabel SET $a='$password' WHERE $kondisi='$nilai'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updateMaster($kondisi,$nilai,$a,$b,$c){
	try {
		$query = $this->db->prepare("UPDATE master SET `id_kabupaten`='$a',`mode_master`='$b',`rincian`='$c' WHERE $kondisi='$nilai'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function updateLintas($kondisi , $nilai ,$a,$b){
	try {
		$query = $this->db->prepare("UPDATE lintas SET lintas='$a' , jurusan='$b' WHERE $kondisi='$nilai'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////////
//Delete Data //////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
public function deleteById($tabel,$kondisi,$id){
	try {
		$query = $this->db->prepare("DELETE FROM $tabel WHERE $kondisi='$id'");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

// function untuk buat digit 00001
public function digit($n,$digit){

	$x = strlen($n);

	if($x>$digit){$t=$x;}else{$t = $digit - $x;}
	$m = "";
	for($i=1;$i<=$t;$i++){
		$m =$m."0";
	}
	$m=$m."$n";
	return $m;
}

//cek kontak

public function cek_kontak($id_kabupaten){
	try {
		$query = $this->db->prepare("SELECT * FROM dishub_kontak WHERE id_kabupaten='$id_kabupaten' LIMIT 1");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}

public function cek_regulasi(){
	try {
		$query = $this->db->prepare("SELECT COUNT(*) as jumlah FROM dishub_regulasi  LIMIT 1");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}
public function cek_kecelakaan(){
	try {
		$query = $this->db->prepare("SELECT COUNT(*) as jumlah FROM dishub_kecelakaan  LIMIT 1");
		$query->execute();
		return $query;
	}
	catch (PDOException $e) {
		$error = $e->getMessage();
		echo "<script>alert('$error')</script>";
		return false;
	}
}



}


function adddate($vardate,$added)
{
$data = explode("-", $vardate);
$date = new DateTime();
$date->setDate($data[0], $data[1], $data[2]);
$date->modify("".$added."");
$day= $date->format("Y-m-d");
return $day;
}

?>
