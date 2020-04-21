<?php
//session
$ses_nama=$_SESSION['SES_nama']; 
$ses_alias=$_SESSION['SES_alias'];
$ses_email=$_SESSION['SES_email'];
$ses_status_user=$_SESSION['SES_status_user'];

$ses_id_user=$_SESSION['SES_id_user'];

$now = gmdate("Y-m-d H:i:s", time()+60*60*7); 

?>