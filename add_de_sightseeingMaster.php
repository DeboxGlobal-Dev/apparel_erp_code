<?php
if($addpermission!=1 && $_GET['id']==''){
header('location:'.$fullurl.'');
}

if($editpermission!=1 && $_GET['id']!=''){
header('location:'.$fullurl.'');
}

if($_GET['id']==''){
$where=' name="" and  updateBy='.$_SESSION['userid'].'';
deleteRecord('sightseeingMaster',$where);

$dateAdded=time();
$namevalue ='name="",updateBy='.$_SESSION['userid'].',updateDate='.$dateAdded.'';
$lastId = addlistinggetlastid('sightseeingMaster',$namevalue);
}


if($_GET['id']!=''){
$id=clean(decode($_GET['id']));
$paymentTerm=1;
$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'sightseeingMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

$editsupplier=clean($editresult['supplier']);
$editname=clean($editresult['name']);
$editcost=clean($editresult['cost']);
$currency=clean($editresult['currency']);
$editcountry=clean($editresult['country']);
$editdestinaton=clean($editresult['destinaton']);
$editduration=clean($editresult['duration']);
$editdescription=clean($editresult['description']);
$editinclusions=clean($editresult['inclusions']);
$editexclusions=clean($editresult['exclusions']);
$lastId=$editresult['id'];
$editVoucherRequirements=clean($editresult['VoucherRequirements']);
$editdepartureTime=clean($editresult['departureTime']);
$editdeparturePoint=clean($editresult['departurePoint']);
$editreturnDetails=clean($editresult['returnDetails']);
$editsalesPoints=clean($editresult['salesPoints']);
$editcategoryTags=clean($editresult['categoryTags']);
$editstarRating=clean($editresult['starRating']);
$editstatus=clean($editresult['status']);
}





?>
		<script src="<?php echo $fullurl; ?>ckeditor/ckeditor.js"></script>
			<div class="content">

				<!-- Select2 selects -->
				<form action="ac.de" method="post" enctype="multipart/form-data" name="addedit" target="acf" id="addedit">

				<div class="row">
					<div class="col-md-12">
					<div class="page-header page-header-light">


				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-1" style="cursor:pointer;"  <?php if($_REQUEST['id']!=''){ ?> onclick="view('<?php echo $_REQUEST['id']; ?>');" <?php } else { ?> onclick="cancel();"<?php  } ?> ></i> 	<?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> Sightseeing </h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
					</div>

					<div class="header-elements d-none"> <button type="button" class="btn btn-primary" onclick="formValidation('addedit','savebutton','0');" >Save&nbsp; <i class="fa fa-floppy-o" aria-hidden="true"></i></button>

					<button <?php if($_REQUEST['id']!=''){ ?> onclick="view('<?php echo $_REQUEST['id']; ?>');" <?php } else { ?> onclick="cancel();" <?php  } ?> type="button" class="btn btn-light btn-ladda btn-ladda-spinner ladda-button" data-style="expand-right" data-spinner-color="#333" data-spinner-size="20" style="margin-left:10px;">
		                        	<span class="ladda-label">Cancel</span>
	                        	<span class="ladda-spinner"></span></button>
					</div>
				</div>
			</div>


						<div class="card">

<div class="card-body">

									<div class="row">

										<div class="col-md-3">
											<div class="form-group">
												<label>Vendor</label>

												<select name="supplier" class="form-control select-search select2-hidden-accessible" id="supplier" tabindex="-1" data-fouc="" aria-hidden="true">

 <?php
$select='';
$where='';
$rs='';
$select='name,id';
$where=' deletestatus=0  order by id asc';
$rs=GetPageRecord($select,'vendorMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($editsupplier==$resListing['id']){ ?> selected="selected" <?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Name</label>
				                                <input name="name" type="text" class="form-control" id="name" value="<?php echo $editname; ?>" >
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Cost</label>
												<input name="cost" type="text" class="form-control" id="cost" value="<?php echo $editcost; ?>" >
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group" style="display:none;">
												<label>Currency</label>
												<select name="currency" size="1" class="form-control select select2-hidden-accessible" id="currency" displayname="Type" autocomplete="off" >
													<option value="1" >INR</option>
													</select>
			                                </div>
										</div>
									</div>

									 <div class="row">

										<div class="col-md-3">
										<div class="form-group">
										<label>Country</label>

										<select name="country" class="form-control select-search select2-hidden-accessible" id="country" tabindex="-1" data-fouc="" aria-hidden="true">

										<?php
										$select='';
										$where='';
										$rs='';
										$select='name,id';
										$where=' deletestatus=0  order by id asc';
										$rs=GetPageRecord($select,_COUNTRY_MASTER_,$where);
										while($resListing=mysqli_fetch_array($rs)){
										?>
										<option value="<?php echo strip($resListing['id']); ?>" <?php if($editcountry==$resListing['id']){ ?> selected="selected" <?php } ?>><?php echo strip($resListing['name']); ?></option>
										<?php } ?>
										</select>
										</div>
										</div>

										<div class="col-md-3">
										<div class="form-group">
										<label>Destination</label>
										<select name="destinaton" class="form-control select-search select2-hidden-accessible" id="destinaton" tabindex="-1" data-fouc="" aria-hidden="true">
										<?php
										$select='';
										$where='';
										$rs='';
										$select='name,id';
										$where=' status=0  order by id asc';
										$rs=GetPageRecord($select,'destinationMaster',$where);
										while($resListing=mysqli_fetch_array($rs)){
										?>
										<option value="<?php echo strip($resListing['id']); ?>" <?php if($editdestinaton==$resListing['id']){ ?> selected="selected" <?php } ?>><?php echo strip($resListing['name']); ?></option>
										<?php } ?>
										</select>
										</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Duration</label>
				                                <input name="duration" type="text" class="form-control" id="duration" value="<?php echo $editduration; ?>" >
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Departure Time</label>
				                                <input name="departureTime" type="text" class="form-control" id="departureTime" value="<?php echo $editdepartureTime; ?>" >
			                                </div>
										</div>
									</div>

									<div class="row">

										<div class="col-md-3">
											<div class="form-group">
												<label>Category Tags</label>
												<select name="categoryTags[]" size="1" multiple="multiple" class="form-control select select2-hidden-accessible" id="categoryTags" displayname="Type" autocomplete="off" >

 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' 1 and categoryType="sightseeing" order by id asc';
$rs=GetPageRecord($select,'categoryTypeMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
$newdata = explode(',', $editcategoryTags);

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php foreach ($newdata as $key => $value) { if($value == $resListing['id']){ echo 'selected="selected"'; } }?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>


			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Status</label>
												<select name="status" size="1"  class="form-control select select2-hidden-accessible" id="status" displayname="Type" autocomplete="off" >
													<option value="0"<?php if($editstatus==0){ ?> selected="selected" <?php } ?>>Active</option>
													<option value="1"<?php if($editstatus==1){ ?> selected="selected" <?php } ?>>InActive</option>
													</select>
			                                </div>
										</div>


										<div class="col-md-3">
											<div class="form-group">
												<label>Sales Points</label>
												<select name="salesPoints[]" size="1" multiple="multiple" class="form-control select select2-hidden-accessible" id="salesPoints" displayname="Type" autocomplete="off" >

 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' 1 and sectionType="sightseeing" order by id asc';
$rs=GetPageRecord($select,'salesPointsMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
$newdata = explode(',', $editsalesPoints);

?>
<option value="<?php echo strip($resListing['id']); ?>"  <?php foreach ($newdata as $key => $value) { if($value == $resListing['id']){ echo 'selected="selected"'; } }?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>


			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Star Rating</label>
												<select name="starRating" size="1" class="form-control select select2-hidden-accessible" id="starRating" displayname="Type" autocomplete="off" >
													<option value="1"<?php if($editstarRating==1){ ?> selected="selected" <?php } ?>>1 Star</option>
													<option value="2"<?php if($editstarRating==2){ ?> selected="selected" <?php } ?>>2 Star</option>
													<option value="3"<?php if($editstarRating==3){ ?> selected="selected" <?php } ?>>3 Star</option>
													<option value="4"<?php if($editstarRating==4){ ?> selected="selected" <?php } ?>>4 Star</option>
													<option value="5"<?php if($editstarRating==5){ ?> selected="selected" <?php } ?>>5 Star</option>
													</select>
			                                </div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Voucher Requirements</label>
				                                <textarea name="VoucherRequirements" rows="3" class="form-control" id="VoucherRequirements"><?php echo $editVoucherRequirements; ?></textarea>
			                                </div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Departure Point</label>
				                                <textarea name="departurePoint" rows="3" class="form-control" id="departurePoint"><?php echo $editdeparturePoint; ?></textarea>
			                                </div>
										</div>

									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Inclusions</label>
												<select name="inclusions[]" size="1" multiple="multiple" class="form-control select select2-hidden-accessible" id="inclusions" displayname="Inclusions" autocomplete="off" >

 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' 1 and sectionType="sightseeing" order by id asc';
$rs=GetPageRecord($select,'inclusionsMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
$newdata = explode(',', $editinclusions);

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php foreach ($newdata as $key => $value) { if($value == $resListing['id']){ echo 'selected="selected"'; } }?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>


			                                </div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Exclusions</label>
												<select name="exclusions[]" size="1" multiple="multiple" class="form-control select select2-hidden-accessible" id="exclusions" displayname="Type" autocomplete="off" >

 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' 1 and sectionType="sightseeing" order by id asc';
$rs=GetPageRecord($select,'exclusionsMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
$newdata = explode(',', $editexclusions);

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php foreach ($newdata as $key => $value) { if($value == $resListing['id']){ echo 'selected="selected"'; } }?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>


			                                </div>
										</div>



									</div>
	 								 <div class="row">


										<div class="col-md-6">
										<div class="form-group">
										<label>Description</label>
									    <textarea name="description" class="form-control" id="description"><?php echo stripslashes($editdescription); ?></textarea>
										</div>
										</div>
										<script>
										 ClassicEditor
    .create( document.querySelector( '#description' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
										 </script>

										<div class="col-md-6">
										<div class="form-group">
										<label>Return Details</label>
										<textarea name="returnDetails" class="form-control" id="returnDetails"><?php echo stripslashes($editreturnDetails); ?></textarea>
										</div>
										</div>
										 <script>
										 ClassicEditor
    .create( document.querySelector( '#returnDetails' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
										 </script>
									</div>









						    </div>


						</div>



					</div>


				</div>

<input name="editId" type="hidden" id="editId" value="<?php echo encode($lastId); ?>" /><?php
		if($_GET['id']!=''){
		?>
		<input name="editedityes" type="hidden" id="editedityes" value="1" />
		<?php } ?>

		<input name="action" type="hidden" id="action" value="editsightseeing" />
  <input name="savenew" type="hidden" id="savenew" value="0" />
			</form>
			</div>

