<?php
if($addpermission!=1 && $_GET['id']==''){
header('location:'.$fullurl.'');
}

if($editpermission!=1 && $_GET['id']!=''){
header('location:'.$fullurl.'');
}

if($_GET['id']==''){
$where=' firstName="" and  addedBy='.$_SESSION['userid'].'';
deleteRecord(_CONTACT_MASTER_,$where);

$dateAdded=time();
$namevalue ='firstName="",addedBy='.$_SESSION['userid'].',dateAdded='.$dateAdded.'';
$lastId = addlistinggetlastid(_CONTACT_MASTER_,$namevalue);
}


if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_CONTACT_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);

$editassignTo=clean($editresult['assignTo']);
$editcontacttitleId=clean($editresult['contacttitleId']);
$editfirstName=clean($editresult['firstName']);
$editlastName=clean($editresult['lastName']);
$editdesignationId=clean($editresult['designationId']);
$editbirthDate=clean($editresult['birthDate']);
$editanniversaryDate=clean($editresult['anniversaryDate']);
$editcompanyTypeId=clean($editresult['companyTypeId']);
$editcountryId=clean($editresult['countryId']);
$editstateId=clean($editresult['stateId']);
$editcityId=clean($editresult['cityId']);
$edittitle=clean($editresult['title']);
$addedBy=clean($editresult['addedBy']);
$dateAdded=clean($editresult['dateAdded']);
$modifyBy=clean($editresult['modifyBy']);
$modifyDate=clean($editresult['modifyDate']);

$editaddress1=clean($editresult['address1']);
$editaddress2=clean($editresult['address2']);
$editaddress3=clean($editresult['address3']);
$editpinCode=clean($editresult['pinCode']);
$editfacebook=clean($editresult['facebook']);
$edittwitter=clean($editresult['twitter']);
$editlinkedIn=clean($editresult['linkedIn']);
$accountId=clean($editresult['accountId']);
$lastId=$editresult['id'];
}

?>

			<div class="content">

				<!-- Select2 selects -->
				<form action="ac.de" method="post" enctype="multipart/form-data" name="addedit" target="acf" id="addedit">

				<div class="row">
					<div class="col-md-8">
					<div class="page-header page-header-light">


				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-1" style="cursor:pointer;"  <?php if($_REQUEST['id']!=''){ ?> onclick="view('<?php echo $_REQUEST['id']; ?>');"<?php } else { ?> onclick="cancel();"<?php  } ?> ></i> 	<?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> Contact </h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
					</div>

					<div class="header-elements d-none"> <button type="button" class="btn btn-primary" onclick="formValidation('addedit','savebutton','0');" >Save&nbsp; <i class="fa fa-floppy-o" aria-hidden="true"></i></button>

					<button <?php if($_REQUEST['id']!=''){ ?> onclick="view('<?php echo $_REQUEST['id']; ?>');"<?php } else { ?> onclick="cancel();"<?php  } ?> type="button" class="btn btn-light btn-ladda btn-ladda-spinner ladda-button" data-style="expand-right" data-spinner-color="#333" data-spinner-size="20" style="margin-left:10px;">
		                        	<span class="ladda-label">Cancel</span>
	                        	<span class="ladda-spinner"></span></button>
					</div>
				</div>
			</div>


						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Business Card</h5>

							</div>
<div class="card-body">

									<div class="row">
										 <div class="col-md-2">
											<div class="form-group">
												<label>Salutation</label>
												<select id="contacttitleId" name="contacttitleId" class="form-control select-search select2-hidden-accessible validate" displayname="Salutation" autocomplete="off" >

 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' deletestatus=0 and status=1 order by id asc';
$rs=GetPageRecord($select,_NAME_TITLE_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editcontacttitleId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>

			                                </div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>First Name</label>
												<input name="firstName" type="text" class="form-control validate" id="firstName" value="<?php echo $editfirstName; ?>" displayname="First Name" maxlength="100" />
			                                </div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Last Name</label>
				                                <input name="lastName" type="text" class="form-control validate" id="lastName" value="<?php echo $editlastName; ?>" displayname="Last Name" maxlength="100" />
			                                </div>
										</div>
									</div>






<div class="row">



<div class="col-md-3">
											<div class="form-group">
												<label>Country</label>

												<select name="countryId" class="form-control select-search select2-hidden-accessible" id="countryId" tabindex="-1" data-fouc="" aria-hidden="true">

 <?php
$select='';
$where='';
$rs='';
$select='name,id';
$where=' deletestatus=0  order by name asc';
$rs=GetPageRecord($select,_COUNTRY_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editcountryId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>
			                                </div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label>City</label>

												<select name="cityId" class="form-control select-search select2-hidden-accessible" id="cityId" tabindex="-1" data-fouc="" aria-hidden="true">

 <?php
$select='';
$where='';
$rs='';
$select='name,id';
$where=' deletestatus=0  order by name asc';
$rs=GetPageRecord($select,_CITY_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editcityId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>
			                                </div>
										</div>



											<div class="col-md-3">
											<div class="form-group">
												<label>Account</label>

												<select name="accountId" class="form-control select-search select2-hidden-accessible" id="accountId" tabindex="-1" data-fouc="" aria-hidden="true">
												<option value="0" <?php if($resListing['id']==$editassignTo){ ?>selected="selected"<?php } ?>>No Account</option>

 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' deletestatus=0 and name!="" order by name asc';
$rs=GetPageRecord($select,_CORPORATE_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$accountId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>
			                                </div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label>Assigned To</label>

												<select name="assignTo" class="form-control select-search select2-hidden-accessible" id="assignTo" tabindex="-1" data-fouc="" aria-hidden="true">

 <?php
$select='';
$where='';
$rs='';
$select='firstName,id';
$where=' deletestatus=0  order by firstName asc';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editassignTo){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['firstName']); ?></option>
<?php } ?>
</select>
			                                </div>
										</div>

									</div>







						    </div>


						</div>


						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Contact Info </h5>

							</div>

							<div class="card-body">

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label> Mobile</label>
				                                <input name="phone" type="text" class="form-control validate" id="phone" value="<?php echo stripslashes($editresult['phone']); ?>" maxlength="14"  data-mask="+99-99-9999-9999" aria-invalid="false"  displayname="Phone 1 " >
			                                </div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Office Phone </label>
				                                <input name="phone2" type="text" class="form-control" id="phone2" value="<?php echo stripslashes($editresult['phone2']); ?>" maxlength="14"  data-mask="+99-99-9999-9999" aria-invalid="false">
			                                </div>
										</div>
									</div>


	<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Email 1 </label>
				                                <input name="email" id="email"  displayname="Email 1 " type="text" class="form-control validate " value="<?php echo stripslashes($editresult['email']); ?>" maxlength="60" placeholder="" aria-invalid="true">
			                                </div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Email 2 </label>
				                                <input name="email2" type="text" class="form-control required" id="email2" value="<?php echo stripslashes($editresult['email2']); ?>" maxlength="60" placeholder="" aria-invalid="true">
			                                </div>
										</div>


									</div>



<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Address 1  </label>
				                                <textarea name="address1" rows="3" class="form-control" id="address1"><?php echo stripslashes($editresult['address1']); ?></textarea>
			                                </div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Address 2  </label>
				                                <textarea name="address2" rows="3" class="form-control" id="address2"><?php echo stripslashes($editresult['address2']); ?></textarea>
			                                </div>
										</div>


									</div>

<div class="text-right">
										<button id="savebutton" type="button" onclick="formValidation('addedit','savebutton','0');" class="btn btn-primary">Save&nbsp; <i class="fa fa-floppy-o" aria-hidden="true"></i></button> <button <?php if($_REQUEST['id']!=''){ ?> onclick="view('<?php echo $_REQUEST['id']; ?>');"<?php } else { ?> onclick="cancel();"<?php  } ?> type="button" class="btn btn-light btn-ladda btn-ladda-spinner ladda-button" data-style="expand-right" data-spinner-color="#333" data-spinner-size="20" style="margin-left:10px;"><span class="ladda-label">Cancel</span>
	                        	<span class="ladda-spinner"></span></button>
									</div>


						    </div>


						</div>
					</div>

					<div class="col-md-4">
						<div class="alert alert-info bg-white alert-styled-left alert-arrow-left alert-dismissible">

					<h6 class="alert-heading font-weight-semibold mb-1">Hint</h6>
					Enter your Contact's name and email address and hint will search for additional data.</div>
					</div>
				</div>

<input name="editId" type="hidden" id="editId" value="<?php echo encode($lastId); ?>" /><?php
		if($_GET['id']!=''){
		?>
		<input name="editedityes" type="hidden" id="editedityes" value="1" />
		<?php } ?>

		<input name="action" type="hidden" id="action" value="editcontacts" />
  <input name="savenew" type="hidden" id="savenew" value="0" />
			</form>
			</div>

