<?php
if($_GET['styleid']!=''){
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

}

?>
	<div class="page-content">


		<!-- Main content -->
		<div class="content-wrapper">
		<!---Save Alert Notification---->
		<?php include "savealert.php"; ?>


			<!-- Content area -->
			<div class="content pt-0" style="margin-top:20px;">




				<!-- Dashboard content -->
				<!---style information section--->
				<?php include "top-style.php"; ?>
				<!---style information section end--->
<?php
$rsC=GetPageRecord('*','techpackPatternMarkerUpload','1 and styleId="'.decode($_GET['styleid']).'" and sectionType="'.$_GET['module'].'" order by id desc');
$resultrsCount=mysql_num_rows($rsC);
?>
 <?php
	  if($resultrsCount>0){
	  ?>
				<div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-white">
              <h6 class="card-title">Marker Information</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
				  <table width="100%" border="1" cellspacing="2" cellpadding="8" style="border:1px solid #ccc;">

					  <thead style="background: #ffffed;">
						<th>Stage</th>
						<th>Date</th>
						<th>Remark</th>
						<th>Attachment</th>
					  </thead>
						<?php
						$no = 1;
						$rs1=GetPageRecord('*','techpackPatternMarkerUpload','1 and styleId="'.decode($_GET['styleid']).'" and sectionType="'.$_GET['module'].'" order by id desc');
						while($result1=mysqli_fetch_array($rs1)){
						?>
					   <tr>
						<td><?php echo $result1['stage']; ?></td>
						<td><?php echo date('d-M-Y',strtotime($result1['uploadDate'])); ?></td>
						<td><?php echo $result1['remark']; ?></td>
						<td><a href="images/<?php echo $result1['attachtp']; ?>" target="blank" ><i class="fa fa-download mr-2"></i>Download</a> </td>
					  </tr>
					  <?php }

					   ?>
					</table>
				  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
		<?php } ?>
				<div class="row">

				<div class="col-xl-12">
				<?php if($patternAttachment!=''){?>
				<div class="card" style="display:none;">
							<div class="card-header bg-white">
								<h6 class="card-title">Attached Pattern  -  <a href="images/<?php echo $patternAttachment; ?>" target="blank"><i class="fa fa-download" aria-hidden="true"></i> Download</a></h6>
							</div>
						</div>
 				<?php } ?>


		<?php
		$i = 0;
		$costsheetVersionId='0';
		$selectversion='*';
		$whereversion='styleId="'.decode($_GET['styleid']).'" order by id desc';
		$rsversion=GetPageRecord($selectversion,'costsheetVersionMaster',$whereversion);
		while($resListingVer=mysqli_fetch_array($rsversion)){
		$costsheetVersionId = $resListingVer['versionId'];
		$i++;
		?>
		<div id="accordion-group<?php echo $resListingVer['id']; ?>" style="margin-bottom: 10px;">


		<div class="card mb-0 rounded-bottom-0">

<style>

.abcspecial-class:hover{
cursor:pointer;
background-color: #d8ff001f !important;
}
</style>
		<div class="abcspecial-class card-header collapsed" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>">
			<h6 class="card-title ">
				<a data-toggle="collapse" class="text-default collapsed" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" style="color:#000000;">Marker - <strong><?php echo $resListingVer['versionName']; ?></strong></a>
				<a class="text-default collapsed" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" aria-expanded="false" style="text-align: left; color: #000; font-size: 13px; width: 100%;">-&nbsp;<?php echo date('d M, Y - h:ia',$resListingVer['dateAdded']); ?></a>

			</h6>

		</div>

		<div id="accordion-item-group<?php echo $resListingVer['id']; ?>" class="collapse" data-parent="#accordion-group<?php echo $resListingVer['id']; ?>">


			<div class="card-body" style="padding:0px;">
		<div id="collapsible-control-right-group<?php echo $i; ?>" class="collapse" style="display:block;">
				<div class="card-body">



				<div class="tab-content">
						<fieldset class="card-body" style="padding: 10px;">

<form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="techPackFormV<?php echo $i; ?>" target="techpackiframe<?php echo $i; ?>" id="techPackFormV<?php echo $i; ?>">
<input type="hidden" name="action2" value="techpackversion" />
<input type="hidden" name="versionId" value="<?php echo encode($resListingVer['versionId']); ?>" />
<input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">
<input type="hidden" name="markeruploaded" id="markeruploaded" value="markeruploaded">

<div class="row" id="load_bom_list<?php echo $costsheetVersionId; ?>">  </div>

<div class="row" style="margin-top:20px;" >
<div class="col-md-6" style="display:none;">
	<div align="center" style="display: flex;">
       <?php   if($resListingVer['attachFile'] != "") {  ?><a href="attachment/<?php echo $resListingVer['attachFile'] ?>" target="_blank" ><span class="badge badge-flat mr-3" style="border-color: #02c681; color: #02c681; position: relative;padding: 7px; font-size: 11px;">View</span></a><?php } ?>
                      <div class="uniform-uploader">
            <input type="file" name="attachmarker<?php echo $resListingVer['versionId'] ?>" id="attachmarker<?php echo $resListingVer['versionId'] ?>" class="form-input-styled" data-fouc="">
            <span class="badge badge-flat mr-2" style="border-color: #ff7043; color: #ff7043; position: relative;padding: 7px; font-size: 11px;">Upload Marker</span>
            <input type="hidden" name="upload<?php echo $resListingVer['versionId'] ?>" id="upload<?php echo $resListingVer['versionId'] ?>" value="<?php echo $resListingVer['attachFile']; ?>"/>
            </div>
          </div>
		<!-- <div class="form-group">
			<label>Attach Marker</label>
				<input name="markerattach" id="markerattach" type="file" class="form-control" value="<?php echo $editresultstyle['markerattach']; ?>" maxlength="200" >
		</div> -->
</div>


<div class="col-md-6" style="display:none;" >
		<div class="form-group">
			<label>Remarks</label>
				<input name="markerdescription" id="markerdescription" type="text" class="form-control" value="<?php echo $editresultstyle['markerDescription']; ?>" maxlength="200" placeholder="Description">
		</div>
</div>
</div>



			<div class="text-right" style="width: 100%;display: block;margin-top: 25px;">

<button type="button" onclick="delete_material<?php echo $costsheetVersionId; ?>();delete_material_extra<?php echo $costsheetVersionId; ?>();savemarkerdescription();savemarkerupload();" class="btn btn-primary" style="margin:0px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>

			</div>






</form>

<div id="markerstatusupload"></div>
<div id="loadmarkerdescription"></div>

<script>
function savemarkerdescription(){
var markerdescription1=$('#markerdescription').val();
var markerdescription =encodeURI(markerdescription1);
$('#loadmarkerdescription').load("newaction.php?action=uploadmarkerdescription&markerdescription="+markerdescription+"&editId=<?php echo encode($lastId); ?>");
}

function savemarkerupload(){
var markeruploaded1=$('#markeruploaded').val();
var markeruploaded =encodeURI(markeruploaded1);
$('#markerstatusupload').load("newaction.php?action=uploadmarkerstatus&markeruploaded="+markeruploaded+"&editId=<?php echo encode($lastId); ?>");
}


function duplicateCostsheet<?php echo $costsheetVersionId; ?>(){
var r = confirm("Are you sure you want to create duplicate?");
if (r == true) {
$('#cvId').val(1);
$( "#techPackFormV<?php echo $i; ?>" ).submit();
}
}
</script>
<script>
function load_bom_list_fun<?php echo $costsheetVersionId; ?>(){
$('#load_bom_list<?php echo $costsheetVersionId; ?>').load("load_bom_list.php?styleId=<?php echo $editresultstyle['id'];?>&subCategoryId=<?php echo $editresultstyle['subCategoryId'];?>&page=marker&costsheetVersionId=<?php echo $costsheetVersionId; ?>");
}

load_bom_list_fun<?php echo $costsheetVersionId; ?>();

 </script>


								</fieldset>
					</div>



			    </div>


</div>







			</div>
		</div>
	</div>



</div>

		<?php } ?>





</div>


					</div>

			</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->



		</div>
		<!-- /main content -->

	</div>


