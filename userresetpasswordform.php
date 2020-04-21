<aside class="right-side">
<?php

include $_SERVER['StaticPath']."/controller/userkelolamanager.php";
include $_SERVER['StaticPath']."/variable.php";


$id = $_SESSION['SES_id_user'];
if(!empty($_GET['id']) )
{
	$id = strip_tags($_GET['id']);	
}

$mgr = new UserKelola($id);
$data = $mgr->GetAllUserKelola();
$title = $mgr->GetTitle();
$flag = "";

$repoUser = new UserKelolaRepo();

$data_user = $repoUser->GetUserKelolaById($id); 
//echo $id;

$pass='';

if($pass==''){$pass='unilak'; $flag='new';}

?>                
                <section class="content-header">
                    <h1>
                       User
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Kelola user</li>
                    </ol>
                </section>
                <?php if(!empty($_SESSION['msgError'])){ ?>
                <div class="col-md-12">
                <div class="alert alert-danger alert-dismissable" style="margin-top:22px">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $_SESSION['msgError']; unset($_SESSION['msgError']);?>
				</div>
                </div>
                <?php } else if(!empty($_SESSION['msgSuccess'])) { ?>
                <div class="col-md-12">
                <div class="alert alert-success alert-dismissable" style="margin-top:22px">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $_SESSION['msgSuccess']; unset($_SESSION['msgSuccess']);?>
				</div>
                </div>
                <?php } ?>
                <section class="content">
                    <div class="box box-primary">
                        
                        <div class="box-header">
                            <h3 class="box-title"><?php echo $title;?></h3>
                        </div><!-- /.box-header -->
                        
                    	<div class="box-body">
                    	<form  role="form" method="post" action="http://<?php pola('ref/','usergantipasssword/');?>" id="jkForm">
                            <div class="form-horizontal">        
									<div class="form-group">
                                        <label class="col-sm-2 control-label">Alias/username</label>
                                        <div class="col-sm-10">
                                        <input type="text" id="alias" name="alias" class="form-control input-sm" 
											   style="width:200px" value="<?php echo $ses_alias; ?>" disabled='disabled' >
                                        </div>
									</div>
									<div class="form-group">									
										<label class="col-sm-2 control-label">Password/kata sandi baru</label>
                                        <div class="col-sm-10">
                                        <input type="password" id="password" name="password" class="form-control input-sm"  style="width:200px" size="8"  value="" >
										<?php if($flag=='new'){ echo "<span style='font-size:10px'>*Password max 8 character : <b>unilak</b></span>"; } ?>
                                        </div>
										
									</div>
									
									<div class="form-group">
                                    <input type="hidden" name="id_user" id="id_user" value="<?php echo $ses_id_user; ?>"/>
                                    
                                    
                                        <div class="col-sm-2">
                                            <input type="submit" class="btn btn-primary" value ="Simpan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </form>
	                     </div>
	                </div>
                </section>
                
               
            </aside><!-- /.right-side -->
            
		 <!-- DATA TABES SCRIPT -->
        <script src="<?php echo $globalPath;?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo $globalPath;?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        
        <!-- AdminLTE App -->
		<script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
            });
			
			$(document).ready(function(){
				$('#jkForm').bootstrapValidator({
					feedbackIcons: {
						valid: 'glyphicon glyphicon-ok',
						invalid: 'glyphicon glyphicon-remove',
						validating: 'glyphicon glyphicon-refresh'
					},
					fields:{
						'nama':{ validators:{ notEmpty:{ message:'Nama tidak boleh kosong' } } },
						'no_hp':{ validators:{ notEmpty:{ message:'No HP tidak boleh kosong' } } } 
						
					}
				});
			});
        </script>