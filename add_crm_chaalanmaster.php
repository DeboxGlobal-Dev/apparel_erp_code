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


$rscheck=GetPageRecord('id','chaalanMaster','chaalanNo!="" and styleId=0');
while($rscheckData=mysqli_fetch_array($rs1)){
	deleteRecord('chaalanMaster','chaalanNo!="" and styleId=0');
	deleteRecord('chaalanMaster','parentId="'.$rscheckData['id'].'"');
}


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

			<div class="row" style="margin-bottom:10px;">
					<div class="col-xl-12">
						<div class="card mb-0 rounded-bottom-0" style="padding:15px;">
							<div class="col-xl-3">
								<div class="panel panel-flat">
							       <select id="styleId" name="styleId" class="form-control" onChange="selectStyle();">
										<option value="">Select Style</option>
										<?php
										$styleId = decode($_GET['styleid']);
										$rs=GetPageRecord($select,'queryMaster','1 and deletestatus=0 and subject!="" order by id DESC');
										while($resultStyle=mysqli_fetch_array($rs)){
										?>
										<option value="<?php echo encode($resultStyle['id']); ?>" <?php if($styleId==$resultStyle['id']){ echo 'selected'; } ?>><?php echo '#'.$resultStyle['styleRefId']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
		     				</div>
						</div>
					</div>
				<script>
				function selectStyle(){
				var styleId = $('#styleId').val()
					if(styleId!=''){
						 window.location.href = '<?php echo $fullurl; ?>showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&styleid='+styleId;
					}
				}
				</script>

				<?php
				if($_GET['styleid']!=''){
					include "top-style.php";
				}
				?>


				<div class="row">
				<div class="col-xl-12">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Challan Information</h6>
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

