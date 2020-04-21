<?php
include_once $_SERVER['StaticPath']."/repository/arsipRepository.php";

$arsipR = new arsipRepository(); 
$id = $_SESSION['SES_id_user'];

$aksesAdmin = $_SESSION['SES_id_akses_admin'];
$status = $_SESSION['SES_status_user'];

if(isset($_POST['btnSimpan']) and $status=='Admin'){
	$txtNama = isset($_POST['txtNama']) ? $_POST['txtNama']:"";
	if($_POST['btnSimpan']=='Simpan'){
		include_once $_SERVER['StaticPath']."/modul/crud/classCRUDForm.php";
		$form = new konfigurasi_form();
		
		$simpan = $form->insert2form('tbl_tipe_arsip',$id,$txtNama);
		$sLog = $log->catatLog("Proses tambah Tipe Arsip $txtNama",$_SESSION['SES_nama']);
		$_SESSION['msgSuccess']="Proses tambah Tipe Arsip berhasil!";
		
	}else{
		$hid = isset($_POST['hid']) ? $_POST['hid']:"";
		include_once $_SERVER['StaticPath']."/modul/crud/classCRUD.php";
		$form = new konfigurasi();

		$simpan = $form->updateById_1('tbl_tipe_arsip','nama_tipe',$txtNama,'id_tipe_arsip',$hid);
		$sLog = $log->catatLog("Proses ubah tipe Arsip $txtNama",$_SESSION['SES_nama']);
		$_SESSION['msgSuccess']="Proses ubah tipe berhasil!";
	}
}

if($status=='Super Admin'){
	$dataKini =$arsipR->readAllAsc('tbl_tipe_arsip','id_tipe_arsip');
}else{
	$dataKini =$arsipR->readDataTipe($aksesAdmin,$status);
}


$dataArsip = NULL;
?>
<span id="idProsesLog"></span>
<aside class="right-side">
    <section class="content-header">
        <h1>
            Dokumen dan Arsip
            <small>Tipe Arsip</small>        
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Tipe Arsip</li>
           
        </ol>
        
        <?php if (isset($_SESSION['msgError'])) { ?> 

            <div class="alert alert-danger alert-dismissable" style="margin-top:22px">
                <i class="fa fa-ban"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php
            print "<label>".$_SESSION['msgError']."</label>";
            unset($_SESSION['msgError']);
            ?>

            </div>

            <?php } else if (isset($_SESSION['msgSuccess'])) { ?>

            <div class="alert alert-success alert-dismissable" style="margin-top:22px">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            	<?php
	            print "<label>".$_SESSION['msgSuccess']."</label>";
	            unset($_SESSION['msgSuccess']);
           		?>
            </div>

            <?php } ?>
			
    </section>
    <!-- Main content -->
    <section class="content">
	
        <div class="box box-primary">
            <div class="box-header">
			
                <h3 class="box-title">Tipe Arsip</h3>
				<br />
				
				<div id="idAksiDelete" class="col-lg-10"></div>
            </div><!-- /.box-header -->
            <!-- form start -->
           
            
            <div class="box-body"> 
                <?php
				$disabled="disabled";
				if($status=='Admin'){
					$disabled='';
				?>
               <div class="form-group  col-md-4">
                      
						  <button type="submit" id="FormUpload" class="btn btn-primary" data-toggle="modal" data-target="#uiModal"  title="Tambah Data"><span class="fa fa-plus"></span> Tambah</button>
						   
                    </div>    
				<?php }?>	 
                                   
            </div>
			
		<hr />
		
            <div class="box-body table-responsive" style="font-size:12px">   
				<div class="row">
				<div class="col-sm-10">
                <table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info" style="font-size:12px">
                    <thead>
                        <tr>
                            <th align="left" valign="top" width="25">No</th>
                            <th align="left" valign="top">Tipe Arsip</th>
                            
                            <th align="left" valign="top" width="5%">Edit</th>
                            <th align="left" valign="top" width="5%">Delete</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($dataKini != null){$i=0;
                            while ($item = mysqli_fetch_array($dataKini)){$i++;
                                echo "<tr>";
                                    echo "<td nowrap='nowrap'>".$i."</td>";?>
                                   
                                  
                                    <td><a href="http://<?php pola('', 'dataArsip/'); ?>tipe-<?=$item['id_tipe_arsip']?>" ><?=$item['nama_tipe']?></a></td> 
						
						<td>
										<input type="hidden" name="txtEdit" id="txtEdit<?=$i?>" value="<?=$item['id_tipe_arsip']?>" />
                                            <button type="submit" <?=$disabled?> title="Edit" id="idbtnEdit<?=$i?>" class="btn btn-primary"  data-toggle="modal" data-target="#uiModal"><span class="fa fa-edit"></span></button>
						</td>
						<td>
                                       
                                         
                                       
                                            <button type="submit" alt="Delete" <?=$disabled?> id="idDelete_<?=$i?>" onclick="hapus('<?=$item['nama_tipe']?>','<?=$item['id_tipe_arsip']?>')" title="Delete" class="btn btn-danger"><span class="fa fa-x">X</span></button>
                                      
                    </td>
						<?php
								}
						}
						?>
                        
                    </tbody>                    
              </table>
            </div>
            </div>
            </div>
           
        </div>										
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<!--VIEW DATA-->
	<form action="" method="post" >
		<div class="col-lg-12">
		
                        <div class="modal fade" id="uiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="H3"><b>FORM TAMBAH TIPE ARSIP</b></h4>
                                        </div>

                                        <div class="modal-body">
										<div class="form-horizontal">
											<div class="form-group">
												<label class="control-label col-lg-3">Tipe Arsip</label>
												<div class="col-lg-9" id="idtxtNama">
													<input class="form-control" type="text" required id="idhtxtNama" autofocus name="txtNama" />
												</div>
											</div>
										</div>
										
										</div>
                                        <div class="modal-footer">
											<div class="form-group">
												<label class="control-label col-lg-4"></label>
												<div class="col-lg-2">
													<input type="submit" name="btnSimpan" id="btnSimpan" class="btn-primary btn" value="Simpan" />
												</div>
											
												
											</div>

										
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </div>
	</form>
		<!--END FORM-->

<!-- DATA TABES SCRIPT -->
<script src="<?php echo $globalPath; ?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo $globalPath; ?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>



<!-- AdminLTE App -->
<script type="text/javascript">
    $(function() {
        $("#example1").dataTable({
            aaSorting: [[0, 'desc']]
        });
		
		<?php
		for($j=1;$j<=$i;$j++){
		?>
		$("#idbtnEdit<?=$j?>").click(function(){
			var id = $("#txtEdit<?=$j?>").val();
			$("#idtxtNama").load("<?php echo $globalPath; ?>jQuery-Edit.php?id="+id+"&tb=tipe");
			$("#btnSimpan").val("Ubah");
		});
		<?php
		}
		?>
		
		$("#idTambah").click(function(){
			$("#idhtxtNama").val("");
			$("#btnSimpan").val("Simpan");
			
		});
		
	});
	
	
	function hapus(a,b){
		var x=window.confirm("Apakah anda yakin ingin menghapus Data  "+a+"?")
		if (x){
				
			
			 $.post("<?php echo $globalPath; ?>deleteMaster.php",
			{
			  id: b,
			  tb: "tbl_tipe_arsip",
			  idTb:"id_tipe_arsip"
			},function(data){
				//$('#idAksiDelete').html(data);
				
				location.href="http://<?php pola('', 'tipeArsip/'); ?>";
			});
			
			//proses log
			
			 $.post("<?php echo $globalPath; ?>prosesLog.php",
			{
			  pesan: "Hapus data tipe arsip "+a,
			  sNama: "<?=$_SESSION['SES_nama']?>"
			},function(data){
				$('#idProsesLog').html(data);
				
				
			});
			
		}	
	}
	
</script>