<?php
session_start();

if(file_exists("set/cnf.php")){include"set/cnf.php";}
elseif(file_exists("../set/cnf.php")){include"../set/cnf.php";}
elseif(file_exists("../../set/cnf.php")){include"../../set/cnf.php";}
elseif(file_exists("../../../set/cnf.php")){include"../../../set/cnf.php";}

include 'variable.php';   
$sql = "UPDATE tbl_user SET password='".md5('unilak')."' WHERE id_user='".$_GET['alias']."'";	
$qry = mysql_query($sql, $koneksi) or die ("Gagal update".mysql_error());

?>
<?php $link= $_SERVER['GlobalPath'].'dev/userkelola/';?>
<script type="text/javascript">alert('Reset password for <?php echo $ses_nama; ?> success!');</script>
<meta http-equiv='refresh' content='0; url=<?php echo $link; ?>'>