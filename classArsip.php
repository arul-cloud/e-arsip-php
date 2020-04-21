<?php
include $_SERVER['StaticPath']."/repository/arsipRepository.php";

$arsipR = new arsipRepository(); 
$id = $_SESSION['SES_id_user'];echo"id $id";
$dataKini =$arsipR->readDataArsip($id);



$dataArsip = NULL;
?>
<aside class="right-side">
    <section class="content-header">
        <h1>
            Dokumen dan Arsip
            <small>Class Arsip</small>        
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Class Arsip</li>
           
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
			
                <h3 class="box-title">Class Arsip</h3>
				<br />
				
				<div id="idAksiDelete" class="col-lg-10"></div>
            </div><!-- /.box-header -->
            <!-- form start -->
           
            
            <div class="box-body"> 
                    
               <div class="form-group  col-md-4">
                      
						  <button type="submit" id="FormUpload" class="btn btn-primary" data-toggle="modal" data-target="#uiModal"  title="View Data Pendaftaran"><span class="fa fa-plus"></span> Tambah</button>
						   
                    </div>    
					 
                                   
            </div>
			
		<hr />
		
            <div class="box-body table-responsive" style="font-size:12px">   
				<div class="row">
				<div class="col-sm-10">
                <table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info" style="font-size:12px">
                    <thead>
                        <tr>
                            <th align="left" valign="top" width="25">No</th>
                            <th align="left" valign="top">Class Arsip</th>
                            
                            <th align="left" valign="top" class="col-lg-1">Edit</th>
                            <th align="left" valign="top" class="col-lg-1">Delete</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($dataKini != null){$i=0;
                            while ($item = mysqli_fetch_array($dataKini)){$i++;
                                echo "<tr>";
                                    echo "<td nowrap='nowrap'>".$i."</td>";
                                    echo "<td>".$item['nama_class']."</td>";
                                     
                                  
                                    ?>
						
						<td>
										<form action="http://<?php pola('', 'inputarsip/'); ?>" method="POST">
                                            <input type="hidden" name="txtEdit" id="txtEdit" value="<?php echo $item['id_arsip']; ?>">
                                            <button type="submit" title="Edit" class="btn btn-primary"><span class="fa fa-edit"></span></button>
                                        </form>
						</td>
						<td>
                                       
                                         
                                       
                                            <button type="submit" alt="Delete" id="idDelete_<?=$i?>" onclick="hapus('<?=$item['nama_arsip']?>','<?=$item['id_arsip']?>')" title="Delete" class="btn btn-danger"><span class="fa fa-x">X</span></button>
                                      
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
	<form action="" method="post"enctype="multipart/form-data">
		<div class="col-lg-12">
		
                        <div class="modal fade" id="uiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="H3"><b>FORM TAMBAH CLASS ARSIP</b></h4>
                                        </div>

                                        <div class="modal-body">
										
										
										</div>
                                        <div class="modal-footer">
											<div class="form-group">
												<label class="control-label col-lg-4"></label>
												<div class="col-lg-2">
													<input type="submit" name="btnUpload" class="btn-primary btn" value="Upload" />
												</div>
											
												<div class="col-lg-2">
													<input type="submit" name="btnKeluar" class="btn btn-primary" value="Keluar" />
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
		
	});
	
	
	function hapus(a,b){
		var x=window.confirm("Apakah anda yakin ingin menghapus Data Arsip "+a+"?")
		if (x){
				
			
			 $.post("<?php echo $globalPath; ?>delete.php",
			{
			  id: b,
			  tb: "tbl_arsip",
			  idTb:"id_arsip"
			},function(data){
				//$('#idAksiDelete').html(data);
				
				//location.href="http://<?php pola('', 'dataArsip/'); ?>";
			});
			
			
		}	
	}
	
</script>