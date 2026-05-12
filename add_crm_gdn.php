<?php
//$updatepage='1';

//$chaalanno=date('Y-d').'/'.makeQueryId(decode($_GET['styleid'])).'/'.makeQueryId($ch);
if($_GET['id']==''){

deleteRecord('grnMaster','styleId=0 and factoryId=0 and supplierId=0');

$namevalue ='addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'"';
$grnLastId = addlistinggetlastid('grnMaster',$namevalue);
}

if($_GET['id']!=''){
$rs=GetPageRecord('*','grnMaster','id="'.decode($_GET['id']).'"');
$editresult=mysqli_fetch_array($rs);
$grnLastId = $editresult['id'];
}

?>
	<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">



			<!-- Content area -->
			<div class="content pt-0" style="margin-top:20px;">

				<!-- Dashboard content -->

				<!---style information section--->

				<!---style information section end--->


				<div class="row">
				<div class="col-xl-12">
				<div class="card">
					<div class="card-header bg-white">
						<h6 class="card-title">Material Issue to Factory</h6>
					</div>
					<div id="loadgrn"></div>
					<script>
					function loadgrn(){
					$('#loadgrn').load('loadgdn.php?id=<?php echo encode($grnLastId); ?>');
					}
					loadgrn();
					</script>

					  <script>
						function addnewline(lastid){
							$('#loadgrn').load('loadgdn.php?action=addnewrow&addsize=1&id='+lastid);
						}

					 </script>
					<script>
					function deleterow(deleteid){
						$('#loadgrn').load('loadgdn.php?deletestatus=yes&id=<?php echo encode($grnLastId); ?>&rowid='+deleteid);
					}
					</script>
					</div>
				</div>

					</div>

			</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


		</div>
		<!-- /main content -->

	</div>

