<?php
session_start();
include $_SERVER['StaticPath']."/controller/htaccessfunc.php";

        $page=$_GET['i'];
        if(!file_exists($page.".php")){
                echo "<meta http-equiv='refresh' content='0; url=Error.php'>";
        }else{
                include "$page.php"; 
        }
?>
