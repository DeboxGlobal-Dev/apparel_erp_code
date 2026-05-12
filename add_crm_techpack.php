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
$patternAttachment = $editresultstyle['patternAttachment'];
$attachmentFile = $editresultstyle['attachmentFile'];
$techpackdescription = $editresultstyle['techpackdescription'];
$lastId=$editresultstyle['id'];

}

?>
	<div class="page-content">
 <?php include "left.php"; ?>
		 <div class="content-wrapper">
 <div class="content pt-0" style="margin-top:20px;">
  	<?php include "top-style.php"; ?>
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
              <h6 class="card-title">Techpack List</h6>
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
						//echo decode($_GET['styleid']); die();

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
				<div class="card">
									<div class="card-header bg-white">
										<h6 class="card-title">Techpack Information</h6>
									</div>



		<?php
		$i = 0;
		$k1=11111;
		$k2=22222;
		$k3=33333;
		$k4=44444;
		$k5=55555;
		$k6=66666;
		$k7=77777;
        $select22='*';
		$where22=' styleId="'.$lastId.'" order by id asc';
		$rs22=GetPageRecord($select22,'styleTechPackMaster',$where22);
		$count = mysql_num_rows($rs22);
		while($resListing22=mysqli_fetch_array($rs22)){
		$i++; $k1++; $k2++; $k3++; $k4++; $k5++; $k6++; $k7++;

		?>


		<div class="card" style="">
		 	<div id="collapsible-control-right-group<?php echo $i; ?>" class="collapse" style="display:block;">

				<div class="card-body" style="width:50%; float:left;">

					<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
						<li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k2; ?>" class="nav-link active show" data-toggle="tab">Construction</a></li>
						<li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k3; ?>" class="nav-link" data-toggle="tab">Measurement&nbsp;Chart</a></li>
						<li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k4; ?>" class="nav-link" data-toggle="tab">Accessories&nbsp;Artwork</a></li>
						<li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k5; ?>" class="nav-link" data-toggle="tab">BOM</a></li>
						<li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k6; ?>" class="nav-link" data-toggle="tab">Comment</a></li>
						<li class="nav-item"><a href="#highlighted-justified-tab<?php echo $k7; ?>" class="nav-link" data-toggle="tab">Measurement&nbsp;History</a></li>
					</ul>


					<div class="tab-content">
							<div class="tab-pane fade active show" id="highlighted-justified-tab<?php echo $k2; ?>">
							<fieldset class="card-body" style="padding:10px;">
							<div class="row">
							<table width="100%" class="table table-bordered table-responsive">
							<thead style="background-color: #e5fbfa;">
							<tr class="border-top-info">
							<th width="3%">SNO.</th>
							<th width="59%">Operation </th>
							<th width="15%">Type Of Machine</th>
							<th width="23%">Remark</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$sNo = 0;
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' deletestatus=0 order by id asc';
							$rs=GetPageRecord($select,'techPackCategoryMaster',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
							<tr class="border-top-info">
							<td colspan="4" style="font-weight: 500;background-color: #f9f9f9;"><?php echo $resListing['name']; ?>
							<?php
							$select1='*';
							$where1='techpackcategoryid="'.$resListing['id'].'" and deletestatus=0 order by id asc';
							$rs1=GetPageRecord($select1,'techPackSubCategoryMaster',$where1);
							while($resListing1=mysqli_fetch_array($rs1)){

							$select12='*';
							$where12='techPackSubCategoryId="'.$resListing1['id'].'" and styleTechPackId="'.$resListing22['id'].'" and sectionType="construction" order by id desc';
							$rs12=GetPageRecord($select12,'techPackDetailMaster',$where12);
							$resListing12=mysqli_fetch_array($rs12);

							$sNo++;
							?>
							<tr>
							<input type="hidden" name="techPackCategoryId<?php echo $sNo; ?>"  value="<?php echo $resListing1['techpackcategoryid']; ?>" />														                                        <input type="hidden" name="techPackSubCategoryId<?php echo $sNo; ?>"  value="<?php echo $resListing1['id']; ?>" />
							<td><?php echo $sNo; ?></td>
							<td><?php echo $resListing1['name']; ?></td>
							<td align="center"><input name="typeOfMachine<?php echo $sNo; ?>" type="text"  id="typeOfMachine<?php echo $sNo; ?>" value="<?php echo $resListing12['typeOfMachine']; ?>" autocomplete="off"  maxlength="200"></td>
							<td align="center">
							<input name="remark<?php echo $sNo; ?>" type="text"  id="remark<?php echo $sNo; ?>" value="<?php echo $resListing12['remark']; ?>" autocomplete="off"  maxlength="200">
							</td>
							</tr>
							<?php  } ?>
							</td>
							</tr>
							<?php } ?>

							<input type="hidden" name="constructTotalCount" value="<?php echo $sNo; ?>" />
							</tbody>
							</table>
							</div>
							</fieldset>
							</div>
							<div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k3; ?>">
							<fieldset class="card-body" style="padding:10px;">
							<div class="row">
							<table width="100%" class="table table-bordered table-responsive">
							<thead style="background-color: #e5fbfa;">
							<tr class="border-top-info">
							<th width=""><a onclick="addNewRow(1);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a></th>
							<th width="3%">SNO.</th>
							<th >Specifications</th>
							<th width="">XS</th>
							<th width="">Small</th>
							<th width="">Medium</th>
							<th width="">Large</th>
							<th width="">XL</th>
							<th width="">XXL</th>
							<th width="">TOL (+/-)</th>

							</tr>
							</thead>
							<tbody id="addrow">
							</tbody>

							<script>
							function addNewRow(id){
							if(id==1){
							$("#addrow").load('loadmeasurementtable.php?add=1&styleId=<?php echo encode($lastId); ?>&costsheetVersionId=1');
							}else{
							$("#addrow").load('loadmeasurementtable.php?styleId=<?php echo encode($lastId); ?>');
							}

							}
							addNewRow(0);


							function deleteRow(id){
							var checkyes = confirm('Are your sure you you want to delete?');
							if(checkyes==true){
							$('#addrow').load('loadmeasurementtable.php?id='+id+'&deletestatus=yes&styleId=<?php echo encode($lastId); ?>');
							}
							}
							</script>
							</table>

							</div>
							</fieldset>
							</div>
							<div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k4; ?>">
							<fieldset class="card-body" style="padding:10px;">
							<div class="row">
							<table width="100%" class="table table-bordered table-responsive">
							<thead style="background-color: #e5fbfa;">
							<tr class="border-top-info">
							<th width=""><a onclick="addNewAccessrory(1);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a></th>
							<th width="3%">SNO.</th>
							<th >Description</th>
							<th width="">Digital</th>
							<th width="">Image/Artwork</th>
							<th width="">Quality/Material</th>
							<th width="">Color/Finish</th>
							<th width="">Size</th>
							<th width="">Thickness/Shape</th>
							<th width="">Remark</th>
							</tr>
							</thead>

							<tbody id="addNewAccessrory">
							</tbody>

							<script>
							function addNewAccessrory(id){
							if(id==1){
							$("#addNewAccessrory").load('loadaccessoryartwork.php?add=1&styleId=<?php echo encode($lastId); ?>&costsheetVersionId=1');
							}else{
							$("#addNewAccessrory").load('loadaccessoryartwork.php?styleId=<?php echo encode($lastId); ?>');
							}

							}
							addNewAccessrory(0);


							function deleteAccessrory(id){
							var checkyes = confirm('Are your sure you you want to delete?');
							if(checkyes==true){
							$('#addNewAccessrory').load('loadaccessoryartwork.php?id='+id+'&deletestatus=yes&styleId=<?php echo encode($lastId); ?>');
							}
							}
							</script>


							</table>
							</div>
							</fieldset>
							</div>
							<div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k5; ?>">
							<div class="card-body" style="padding:0px;">
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
							<div class="abcspecial-class card-header collapsed" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>">
							<h6 class="card-title ">
							<a data-toggle="collapse" class="text-default collapsed" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" style="color:#000000;">Material List - <strong><?php echo $resListingVer['versionName']; ?></strong></a>
							<a class="text-default collapsed" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" aria-expanded="false" style="text-align: left; color: #000; font-size: 13px; width: 100%;"> -&nbsp;<?php echo date('d M, Y - h:ia',$resListingVer['dateAdded']); ?></a>
							</h6>
							</div>
							<div id="accordion-item-group<?php echo $resListingVer['id']; ?>" class="collapse" data-parent="#accordion-group<?php echo $resListingVer['id']; ?>">
							<div class="card-body" style="padding:0px;">
							<div id="collapsible-control-right-group<?php echo $i; ?>" class="collapse" style="display:block;">
							<div class="card-body">

							<div class="tab-content">
							<div class="card-body" style="padding: 10px;">

							<form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="techPackFormV<?php echo $i; ?>" target="techpackiframe<?php echo $i; ?>" id="techPackFormV<?php echo $i; ?>">
							<input type="hidden" name="action2" value="techpackversion" />
							<input type="hidden" name="versionId" value="<?php echo encode($resListingVer['versionId']); ?>" />
							<input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
							<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">


							<div class="row" id="load_bom_list<?php echo $costsheetVersionId; ?>">  </div>

							<div class="text-right" style="width: 100%;display: block;margin-top: 25px;">

							<button type="button" onclick="delete_material<?php echo $costsheetVersionId; ?>();delete_material_extra<?php echo $costsheetVersionId; ?>();addfinaldata<?php echo $costsheetVersionId; ?>();" class="btn btn-primary" style="margin:0px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>


							</div>

							</form>


							</div>



							<script>
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
							$('#load_bom_list<?php echo $costsheetVersionId; ?>').load("load_bom_list.php?styleId=<?php echo $editresultstyle['id'];?>&subCategoryId=<?php echo $editresultstyle['subCategoryId'];?>&costsheetVersionId=<?php echo $costsheetVersionId; ?>&loginuserprofileId=<?php echo $loginuserprofileId; ?>&page=");
							}

							load_bom_list_fun<?php echo $costsheetVersionId; ?>();

							</script>

							</div>
							</div>
							</div>
							</div>
							</div>
							</div>
							</div>
							<?php } ?> </div>

							</div>
							<div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k6; ?>">
							<div class="row">
							<div class="col-md-12">
							<div class="form-group">
							<label style="background: #e5fbfa; width: 100%; padding: 10px; margin: 0px !important; border: 1px solid #e5fbfa; border-bottom: 0px;">WHITE SEALER</label>
							<textarea name="whitesealer" id="whitesealer" class="form-control" style="height:100px;"></textarea>
							</div>
							</div>
							<div class="col-md-12">
							<div class="form-group">
							<label style="background: #e5fbfa; width: 100%; padding: 10px; margin: 0px !important; border: 1px solid #e5fbfa; border-bottom: 0px;">YELLOW SEALER</label><textarea name="yellowsealer" id="yellowsealer" class="form-control" style="height:100px;"></textarea>
							</div>
							</div>
							<div class="col-md-12">
							<div class="form-group">
							<label style="background: #e5fbfa; width: 100%; padding: 10px; margin: 0px !important; border: 1px solid #e5fbfa; border-bottom: 0px;">GREEN SEALER</label><textarea name="greensealer" id="greensealer" class="form-control" style="height:100px;"></textarea>
							</div>
							</div>
							</div>
							</div>
							<div class="tab-pane fade" id="highlighted-justified-tab<?php echo $k7; ?>">
							<table border="1" cellpadding="4" style="display:none;">
							<thead>
							<th>Sr&nbsp;No#</th>
							<th>&nbsp;</th>
							</thead>
							<tbody>
							<tr>
							<td>1</td>
							<td></td>
							</tr>
							</tbody>
							</table>
							</div>
				   </div>

			    </div>

				<div class="card-body" style="padding: 0px; width: 50%; float: right; border: 1px solid rgba(0,0,0,.125); height: 800px; margin-top: 10px; border-radius: 5px; margin-bottom: 40px;">

<?php if($editresultstyle['attachmentNewMail']!='') { ?>
<object data="<?php if($editresultstyle['attachmentNewMail']!=''){ echo $fullurl; ?>images/<?php echo $editresultstyle['attachmentNewMail']; } else if($editresultstyle['attachmentNewMail']=='' && $editresultstyle['attachmentFile']!='') { echo $fullurl; ?>images/<?php echo $editresultstyle['attachmentFile']; }  ?>" type="application/pdf" style="height: 100%;width: 100%;display: block;">
</object>
<?php } else { ?>
<div style="width:100%; display:block; text-align:center;">No Tech Pack Found</div>
<?php } ?>
</div>


			</div>
		</div>

	<?php } ?>



	</div>
</div>
</div>
</div></div></div>



<style>
.nav-justified .nav-item {
    text-align: center;
    width: 50% !important;
    display: contents;
    float: left;
}

.nav-tabs-highlight .nav-link {
    width: 50% !important;
    float: left;

}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #333;
    background-color: #fff;
    border-color: #ddd #ddd #fff;
    background-color: #fff178 !important;
    border: 1px solid #ccc;
}
.nav-tabs-highlight .nav-link {
    width: 50% !important;
    float: left;
    border: 1px solid #e9e9e9;
    background-color: #f9f9f9 !important;
}
</style>

<style>
input[type=checkbox], input[type=radio] {

    display: none !important;
}
</style>