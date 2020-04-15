<?php
include_once $_SERVER['StaticPath']."/repository/classLog.php";
$log = new prosesLog();
if(!empty($_SESSION['SES_id_user']))
{	
	$sLog = $log->catatLog("Logout ".$_SESSION['SES_nama']."",$_SESSION['SES_nama']);
    unset($_SESSION['SES_nama']);
    unset($_SESSION['SES_alias']);
   
    unset($_SESSION['SES_status_user']);
    unset($_SESSION['SES_id_user']);
    session_destroy();
	
?>
    <meta http-equiv='refresh' content='0; url=http://<?php pola('user/','login/'); ?>'>
<?php 
}
else
{
?>    
    <meta http-equiv='refresh' content='0; url=http://<?php pola('','dashboard/'); ?>'>
<?php
}
?>
