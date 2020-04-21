<aside class="right-side">
<?php
include_once $_SERVER['StaticPath']."/repository/arsipRepository.php";
include $_SERVER['StaticPath']."/controller/userkelolamanager.php";
$globalR = new arsipRepository();  
$id = '';
if(!empty($_GET['id']) )
{
	$id = strip_tags($_GET['id']);	
}

$mgr = new UserKelola($id);
$data = $mgr->GetAllUserKelola();
$title = $mgr->GetTitle();
$flag = "";

$data_user = NULL;

$namaUserKelola = "";
if(!empty($_GET['id']) )
{
 $data_user = $mgr->GetNamaUserKelola(); 
}

$pass='';
$status_pegawai=$data_user[4];
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
                    	<form  role="form" method="post" action="http://<?php pola('ref/','userkelola/');?>" id="jkForm">
                            <div class="form-horizontal">        
									<div class="form-group">
                                        <label class="col-sm-2 control-label">username</label>
                                        <div class="col-sm-10">
                                        <input type="text" id="username" name="dusername" class="form-control input-sm" 
											   style="width:200px" value="<?php echo $data_user[1]; ?>" <?php if($data_user[1]!=''){ echo "disabled='disabled'"; } ?> >
										</div>
									</div>
									<div class="form-group">	
										<label class="col-sm-2 control-label">Password/kata sandi</label>
                                        <div class="col-sm-10">
                                        <input type="password" id="password" name="password" class="form-control input-sm"  style="width:200px"  value="<?php echo $pass; ?>" >
										<?php if($flag=='new'){ echo "<span style='font-size:10px'>*Password default : <b>unilak</b></span>"; } ?>
                                        </div>
                                    </div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Nama lengkap</label>
                                        <div class="col-sm-4">
                                        <input type="text" id="nama" name="nama" class="form-control input-sm"   value="<?php echo $data_user[3]; ?>" >
                                        </div>
                                    </div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-4">
                                        <input type="text" id="nama" name="email" class="form-control input-sm"   value="<?php echo $data_user[4]; ?>" >
                                        </div>
                                    </div>
									
									<div class="form-group">	
										<label class="col-sm-2 control-label">Status user</label>
                                        <div class="col-sm-10">
										<select class="form-control" name="txtStatus_user" id="status_user" style="width:200px" >
											<option value="Admin" <?php if($data_user[5]=="Admin"){ echo "selected='selected'"; } ?> >Admin</option>
											<option value="Operator" <?php if($data_user[5]=="Operator"){ echo "selected='selected'"; } ?> >Operator</option>
											
										</select>
                                       </div>
                                    </div>
									<div class="form-group">	
										<label class="col-sm-2 control-label">Profil Akse Admin</label>
                                        <div class="col-sm-6">
										<select class="form-control" name="profilAksesAdmin" id="profilAksesAdmin"  >
											<?php
														$dTipe = $globalR->readAllAsc('tbl_akses_admin','id_akses_admin');
														while($dT=mysqli_fetch_assoc($dTipe)){
															if($data_user[6]==$dT['id_akses_admin']){
																echo'<option value="'.$dT['id_akses_admin'].'" selected>'.$dT['nama_akses_admin'].'</option>';
															}else{
																echo'<option value="'.$dT['id_akses_admin'].'">'.$dT['nama_akses_admin'].'</option>';
															}
														}
														?>
										</select>
                                       </div>
                                    </div>
									<div class="form-group" id="idOperator" style="display:none;">	
										<label class="col-sm-2 control-label">Profil Akses Operator</label>
                                        <div class="col-sm-6">
										<select class="form-control" name="ProfilAksesOperator" id="ProfilAksesOperator"  >
											
											<?php
														$dTipe = $globalR->readAllAsc('tbl_akses_operator','id_akses_operator');
														while($dT=mysqli_fetch_assoc($dTipe)){
															if($data_user[7]==$dT['id_akses_operator']){
																echo'<option value="'.$dT['id_akses_operator'].'" selected>'.$dT['nama_akses_operator'].'</option>';
															}else{
																echo'<option value="'.$dT['id_akses_operator'].'">'.$dT['nama_akses_operator'].'</option>';
															}
														}
														?>
											
										</select>
                                       </div>
                                    </div>
									
									<div class="form-group">	
										
										</div>
										<input type="hidden" name="id_user" id="id_user" value="<?php echo $data_user[0]; ?>"/>
										<input type="hidden" name="username" id="username" value="<?php echo $data_user[1]; ?>"/>
										
										<div class="form-group">
											<div class="col-sm-2">
												<input type="submit" class="btn btn-primary" value ="Simpan">
											</div>
										</div>
                                 </div>
                         </form>
	                     </div>
	                </div>
                </section>
                
                <section class="content">
                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title">Data User</h3>
                        </div><!-- /.box-header -->
                       
                        <div class="box-body table-responsive">
                        
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                               <th>Alias/username</th>
                                               <th>Nama</th>
                                               <th>Email</th>
                                               <th>Profil Admin</th>
                                               <th>Profil Operator</th>
                                              
                                               
                                               <th>Status User</th> 
                                               <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($item = mysqli_fetch_array($data)){
											$rProfilAdmin = $globalR->readData('tbl_akses_admin','id_akses_admin',$item['id_akses_admin']);
											$dProfilAdmin = mysqli_fetch_assoc($rProfilAdmin);
											
											$rProfilOp = $globalR->readData('tbl_akses_operator','id_akses_operator',$item['id_akses_operator']);
											$dProfilOp = mysqli_fetch_assoc($rProfilOp);
											
											?>
                                            <tr>
                                                <td><?php echo $item['username']; ?></td>
                                                <td><?php echo $item['nama_user']; ?></td>
                                                <td><?php echo $item['email']; ?></td>
                                                <td><?php echo $dProfilAdmin['nama_akses_admin']; ?></td>
                                                <td><?php echo $dProfilOp['nama_akses_operator']; ?></td>
                                                
                                                <td><?php echo $item['level']; ?></td>
                                                
                                                <td><a href="http://<?php pola("referensi/","userkelola/".$item['id_user']) ?>">edit</a> 
													|
													<a href="<?php echo $globalPath;?>userresetpassword.php?alias=<?php echo $item['id_user']; ?>" onclick="return confirm('Reset password <?php echo $item['nama_user']; ?> ke password awal ? (tafsir)')">Reset Password</a>
												</td>
                                            </tr>
                                        <?php }?>   
                                        </tbody>
                                        
                                    </table>
                                </div>
                    </div>										
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            
		 <!-- DATA TABES SCRIPT -->
        <script src="<?php echo $globalPath;?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo $globalPath;?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        
        <!-- AdminLTE App -->
		<script type="text/javascript">
            $(function() {
                $("#example1").dataTable({
					aaSorting: [[0, 'desc']]
				});
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
				
				$("#status_user").change(function(){
					var a = $("#status_user").val();
						
					if(a=='1'){
						$("#idOperator").hide('slow');
					}else{
						$("#idOperator").show('slow');
					}
				});
			});
        </script>