<?php
$globalPath = $_SERVER['GlobalPath'];
$StaticPath = $_SERVER['StaticPath'];
$msg = "";
if (!empty($_POST['alias']) && !empty($_POST['pass'])) {
    include $StaticPath . "/controller/userloginmanager.php";
    $userLoginManager = new UserLogin("");
    $userLoginManager->LoginCheck($_POST['alias'], $_POST['pass']);
}

?>
<!DOCTYPE html>
<html class="bg-black"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
         <title>SIARSIP</title>
		<link rel="Shortcut Icon" href="<?php echo $globalPath; ?>img/dishub.png" type="image/x-icon" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo $globalPath; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $globalPath; ?>css/site.css" rel="stylesheet" type="text/css">
 
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header"  align="center">
			
				<center>
				<table>
				<tr>
				<td>
				<img src="<?php echo $globalPath; ?>img/admin.png" style="width:60px; height:60px;">
				</td>
				<td style="font-size:16px; font-weight:bold; padding:10px;" align="center" valign="top">
					<span style="font-size:18px">Sistem Informasi Manajemen Dokumen dan Arsip Digital</span><br>
					</td>
				<td>
				
				
				</td>
				</tr>
				</table>
				</center>
			
			<!--<img src="<?php echo $globalPath; ?>img/HEADER_kir_login.png" >-->
			
			
			</div>
            <div class="body bg-gray" >
                <?php if (!empty($_SESSION['msgError'])) { ?> 


                    <div class="alert alert-danger alert-dismissable" style="margin-top:22px">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php
                        echo $_SESSION['msgError'];
                        unset($_SESSION['msgError']);
                        ?>

                    </div>

				<?php } else if (!empty($_SESSION['msgSuccess'])) { ?>

                    <div class="alert alert-success alert-dismissable" style="margin-top:22px">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php
                        echo $_SESSION['msgSuccess'];
                        unset($_SESSION['msgSuccess']);
                        ?>

                    </div>

			<?php } ?>
                <form  method="post" class="form-signin" role="form">
                    <h3 class="form-signin-heading" align="center">Login</h3>
                    <h5 style="color:#FF0000"><?php
                                        $_GET['msg'] = "";
					echo @$msg;
					echo $_GET['msg'];
					?></h5>
                    <div class="form-group">
                        <input name="alias" id="alias" type="text" class="form-control" placeholder="Inputkan Username" required autofocus>
                    </div>
                    <div class="form-group">
                        <input name="pass" id="alias"  type="password" class="form-control" placeholder="Inputkan kata sandi/password" required>
                    </div>          
                    <!-- <div class="form-group">
                         <input type="checkbox" name="remember_me"> Remember me
                     </div>-->
            </div> 
            <div class="footer" align="center">   
                <input type="submit" value="Login" class="btn btn-lg btn-primary btn-block"  />       
				
				<span style="font-size:10px">&copy; <?php echo date("Y"); ?>  All Right Reserved </span>
				
            </div>
        </form>
        <!-- <div class="margin text-center">
<span>Sign in using social networks</span>
<br>
<button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
<button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
<button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

</div>-->
    </div>




</body></html>

<!-- jQuery 2.0.2 -->
<script src="<?php echo $globalPath; ?>js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo $globalPath; ?>js/bootstrap.min.js" type="text/javascript"></script>  