<?php
if($addpermission!=1 && $_GET['id']==''){
header('location:'.$fullurl.'');
}

if($editpermission!=1 && $_GET['id']!=''){
header('location:'.$fullurl.'');
}

if($_GET['id']==''){
$where=' name="" and  addedBy='.$_SESSION['userid'].'';
deleteRecord('destinationMaster',$where);

$dateAdded=time();
$namevalue ='name="",addedBy='.$_SESSION['userid'].',dateAdded='.$dateAdded.',status="1"';
$lastId = addlistinggetlastid('destinationMaster',$namevalue);
}


if($_GET['id']!=''){
$id=clean(decode($_GET['id']));
$paymentTerm=1;
$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'destinationMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

$editcountryId=clean($editresult['countryId']);
$editname=clean($editresult['name']);
$editstatus=clean($editresult['status']);
$addedBy=clean($editresult['addedBy']);
$dateAdded=clean($editresult['dateAdded']);
$modifyBy=clean($editresult['modifyBy']);
$modifyDate=clean($editresult['modifyDate']);
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
						<h4><i class="icon-arrow-left52 mr-1" style="cursor:pointer;"  <?php if($_REQUEST['id']!=''){ ?> onclick="view('<?php echo $_REQUEST['id']; ?>');"<?php } else { ?> onclick="cancel();"<?php  } ?> ></i> 	<?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> Destination </h4>
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
										<div class="col-md-6">
											<div class="form-group">
												<label>Country</label>
												<select name="countryId" size="1"  class="form-control select select2-hidden-accessible validate" id="countryId" displayname="Type" autocomplete="off" >

 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' 1 order by id asc';
$rs=GetPageRecord($select,'countryMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>"  <?php if($editcountryId == $resListing['id']){ echo 'selected="selected"';  } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>


			                                </div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Name</label>
				                                <input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editname; ?>" >
			                                </div>
										</div>
									</div>
						    </div>
						</div>
					</div>

					<div class="col-md-4">
					  <div class="alert alert-info bg-white alert-styled-left alert-arrow-left alert-dismissible">

					<h6 class="alert-heading font-weight-semibold mb-1">Hint</h6>
					Enter your Vendor's  name  and hint will search for additional data.			    </div>
					</div>
				</div>

<input name="editId" type="hidden" id="editId" value="<?php echo encode($lastId); ?>" /><?php
		if($_GET['id']!=''){
		?>
		<input name="editedityes" type="hidden" id="editedityes" value="1" />
		<?php } ?>

		<input name="action" type="hidden" id="action" value="editdestination" />
  <input name="savenew" type="hidden" id="savenew" value="0" />
			</form>
			</div>

