<?php
//$updatepage='1';

if($_GET['styleid']!='' && $_GET['editid']!=''){

$select='*';
$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);
$buyerId = $editresultstyle['buyerId'];
$buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];
$subject = $editresultstyle['subject'];
$displayId = $editresultstyle['displayId'];
$seasonId = $editresultstyle['seasonId'];
$categoryId = $editresultstyle['categoryId'];
$subCategoryId = $editresultstyle['subCategoryId'];
$departmentId = $editresultstyle['departmentId'];
$receivedDate = $editresultstyle['receivedDate'];
$patternDescription = $editresultstyle['patternDescription'];
$patternAttachment = $editresultstyle['patternAttachment'];

$lastId=$editresultstyle['id'];

$chaalanLastId = decode($_GET['editid']);

}else{

$select='*';
$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);
$buyerId = $editresultstyle['buyerId'];
$buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];
$subject = $editresultstyle['subject'];
$displayId = $editresultstyle['displayId'];
$seasonId = $editresultstyle['seasonId'];
$categoryId = $editresultstyle['categoryId'];
$subCategoryId = $editresultstyle['subCategoryId'];
$departmentId = $editresultstyle['departmentId'];
$receivedDate = $editresultstyle['receivedDate'];
$patternDescription = $editresultstyle['patternDescription'];
$patternAttachment = $editresultstyle['patternAttachment'];

$lastId=$editresultstyle['id'];

$wheredelete='addedBy="'.$_SESSION['userid'].'" and status=0';
deleteRecord('chaalanMaster',$wheredelete);

$rs1=GetPageRecord('id','chaalanMaster','1 order by id desc');
$lastchaalanid=mysqli_fetch_array($rs1);
$ch=$lastchaalanid['id'];

if($ch==''){
$ch=1;
} else {
$ch=$ch+1;
}


$chaalanno=date('Y-d').'/'.makeQueryId(decode($_GET['styleid'])).'/'.makeQueryId($ch);

$namevalue ='addedBy="'.$_SESSION['userid'].'",chaalanNo="'.$chaalanno.'",dateAdded="'.time().'"';
$chaalanLastId = addlistinggetlastid('chaalanMaster',$namevalue);

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
				<div class="row">
				<div class="col-xl-12">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title"></h6>
							</div>
							<div id="loadchaalan"></div>
					<script>
					function loadchaalan(){
						$('#loadchaalan').load('loadchaalan.php?styleId=<?php echo $_GET['styleid']; ?>&id=<?php echo encode($chaalanLastId); ?>');
					}
					loadchaalan();
					</script>


					<script>
						function addnewline(lastid){
							$('#loadchaalan').load('loadchaalan.php?action=addnewrow&styleId=<?php echo $_GET['styleid']; ?>&addsize=1&id='+lastid);
						}
					</script>

					<script>
					function deleterow(deleteid){
						$('#loadchaalan').load('loadchaalan.php?deletestatus=yes&id=<?php echo encode($chaalanLastId); ?>&styleId=<?php echo $_GET['styleid']; ?>&&rowid='+deleteid);
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

