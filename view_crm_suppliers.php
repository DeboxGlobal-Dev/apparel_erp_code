<?php
$select='*';
$id=clean(decode($_GET['id']));
$where='id='.$id.'';
$rs=GetPageRecord($select,_SUPPLIERS_MASTER_,$where);
$resultpage=mysqli_fetch_array($rs);

if($_GET['did']!=''){
//delete buyeraddress
deleteRecord(_ADDRESS_MASTER_,'id="'.decode($_GET['did']).'"');
}

?>

<div class="page-content">
		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<div class="content-wrapper">

			<div class="content pt-0" style="margin-top:20px;">

				<div class="row">

				<!--Middle Section-->

				 <div class="col-xl-12" style="padding:0px;">
				 <div class="card">
							 <div class="card-body navbar-green"   >
							<div class="media">
									 <div class="col-xl-6" style="padding:0px;">
									<h6 class="media-title font-weight-semibold">Supplier Details</h6>
									</div>

 									<div class="col-xl-6" style="text-align:right;padding:0px;">
									<div class="d-flex align-items-center" style="float:right;">

<a href="showpage.crm?module=<?php echo $_GET['module']; ?>" class="btn bg-blue-400 btn-labeled btn-labeled-right ml-auto" name="stylemailreply" id=""  style="margin-right: 0px;
    padding: 2px 36px 2px 10px; background-color: #8c8787;">
          <b><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 8px;
    padding: 0px;
    line-height:6px;"></i></b> Back </a>


		                    	</div>

									</div>

							</div>
						</div>

							<div class="card-body">
								<ul class="nav nav-tabs nav-tabs-solid nav-justified rounded border-0" style="font-weight: 600;">

<li class="nav-item"><a href="#solid-rounded-justified-tab1" class="nav-link active show" data-toggle="tab"> Company&nbsp;Information</a></li>

<li class="nav-item"><a href="#solid-rounded-justified-tab3" class="nav-link rounded-left" data-toggle="tab">Financial&nbsp;Information</a></li>
<li class="nav-item"><a href="#solid-rounded-justified-tab4" class="nav-link rounded-left" data-toggle="tab">Supplier PO </a></li>

								</ul>

									<div class="tab-content">

										<div class="tab-pane active show" id="solid-rounded-justified-tab1">

											<div class="row">
												<div class="col-xl-8">

				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Company Information</h6>
							</div>


				<div class="card-body">
				<form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="popid" target="acf" id="popid">
				<div class="form-group">
					<div class="row">

					<div class="col-md-3">
					<div class="form-group">
					<label>Supplier ID</label>
					<input name="supplierid" type="text" class="form-control" id="supplierid" value="<?php echo $resultpage['supplierId']; ?>"   maxlength="200">
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
					<label>Supplier Name</label>
					<input name="suppliername" type="text" class="form-control" id="suppliername" value="<?php echo $resultpage['name']; ?>"   maxlength="200">
					</div>
					</div>
				 	<div class="col-md-3">
					<div class="form-group">
					<label>Email</label>
					<input name="email" type="text" class="form-control" id="email" value="<?php echo $resultpage['email']; ?>" >
					</div>
					</div>
				 	<div class="col-md-3">
					<div class="form-group">
					<label>Phone</label>
					<input name="phone" type="text" class="form-control" id="phone" value="<?php echo $resultpage['phone']; ?>" >
					</div>
					</div>

					</div>

					<div class="row" style="margin-top:20px;">

					 <div class="col-md-3">
					<div class="form-group">
					<label>Default Currency</label>
					<select name="supplierCurrency" class="form-control validate" id="supplierCurrency">
					<option value="">Select</option>
					<?php
					$rs=GetPageRecord('*','queryCurrencyMaster','1 order by name asc');
					while($resListing=mysqli_fetch_array($rs)){ ?>
					<option value="<?php echo $resListing['id']; ?>" <?php if($resultpage['supplierCurrency']==$resListing['id']){ ?> selected="selected" <?php } ?>><?php echo $resListing['name']; ?></option>
					<?php } ?>

					</select>

					</div>
					</div>

					<div class="col-md-3">
					<div class="form-group">
					<label>Company</label>
					<select name="companyId" class="form-control validate" id="companyId">
					<option value="">Select</option>
					<?php
					$rs=GetPageRecord('*','companyMaster','1 order by name asc');
					while($resListing=mysqli_fetch_array($rs)){ ?>
					<option value="<?php echo $resListing['id']; ?>" <?php if($resultpage['companyId']==$resListing['id']){ ?> selected="selected" <?php } ?>><?php echo $resListing['name']; ?></option>
					<?php } ?>

					</select>

					</div>
					</div>

					<div class="col-md-3">
					<div class="form-group">
					<label>Lead Time</label>
					<input name="leadTime" type="text" class="form-control" id="leadTime" value="<?php echo $resultpage['leadTime']; ?>" >
					</div>
					</div>

					<div class="col-md-3">
					<div class="form-group">
					<label>Transit Time</label>
					<input name="transitTime" type="text" class="form-control" id="transitTime" value="<?php echo $resultpage['transitTime']; ?>" >
					</div>
					</div>


					</div>

				</div>
				            <input type="hidden" name="editId" value="<?php echo encode($resultpage['id']); ?>">
							<input type="hidden" name="action" value="editsupplier">
							<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">

							<div class="text-right">
										<button type="button" name="submitbtn" id="submitbtn pnotify-solid-success" class="btn btn-primary" onclick="formValidation('popid','submitbtn','0');" style="margin:0px;" >Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>


									</div>
					</form>
				</div>


<script>

function selectstate(){
var countryId = $('#countryId').val();
$('#stateId').load('loadstate.php?id='+countryId+'&selectId=<?php echo $resultpage['stateId']; ?>');
}

function selectcity(){
var stateId = $('#stateId').val();
$('#cityId').load('loadcity.php?id='+stateId+'&selectId=<?php echo $resultpage['cityId']; ?>');
}

function selectbomsubcategory(){
var bomsubcategory = $('#categoryId').val();
$('#subcategoryId').load('loadbomsubcategory.php?id='+bomsubcategory+'&selectId=<?php echo $resultpage['bomsubcategoryid']; ?>');
}

<?php
if($_GET['id']!=''){
?>
selectstate();
<?php } ?>

</script>

						</div>


</div>

						<div class="col-xl-4">

												<div class="card">
															<div class="card-header bg-white">
																<h6 class="card-title">Address Information <span style=" float:right; font-size: 13px;"> <a href="#" onClick="opmodalpop(' Add Address','modalpop.php?action=addressmaster&parentId=<?php echo encode($resultpage['id']); ?>&type=supplier','500px','auto');" data-toggle="modal" data-target="#modalpop" aria-expanded="false" >+Add New</a></span></h6>

															</div>

													<?php
													$sno=1;
													$rs=GetPageRecord('*',_ADDRESS_MASTER_,'1 and addressParent="'.$resultpage['id'].'" and addressType="supplier"');
													while($resultadd=mysqli_fetch_array($rs)){
													?>

													<div class="card-body border-top-0" id="loadondelete<?php echo $resultadd['id']; ?>">
													<div style="border: 1px solid #ccc;padding: 10px;box-shadow: 5px 6px #d6d6d6;">
													<p style="background-color: #efefef;font-weight: 500;padding: 5px;"><span><?php echo $resultadd['officeType']; ?></span>

													<a href="#" onclick="deletethisaddress('<?php echo encode($resultadd['id']); ?>');"><span style="float:right; color:#FF0000;">Delete</span></a>
													<a href="#" onClick="opmodalpop(' Edit Address','modalpop.php?action=addressmaster&parentId=<?php echo encode($resultpage['id']); ?>&id=<?php echo encode($resultadd['id']); ?>&type=supplier','500px','auto');" data-toggle="modal" data-target="#modalpop" aria-expanded="false"><span style="float:right; margin-right: 7px;">Edit</span></a>
													</p>
													<div class="d-sm-flex flex-sm-wrap mb-0">
														<div class="font-weight-semibold">Country:</div>
														<div class="ml-sm-auto mt-2 mt-sm-0"><?php echo getCountryName($resultadd['countryId']); ?></div>
													</div>

													<div class="d-sm-flex flex-sm-wrap mb-0">
														<div class="font-weight-semibold">State:</div>
														<div class="ml-sm-auto mt-2 mt-sm-0"><?php echo getStateName($resultadd['stateId']); ?></div>
													</div>

													<div class="d-sm-flex flex-sm-wrap mb-0">
														<div class="font-weight-semibold">City:</div>
														<div class="ml-sm-auto mt-2 mt-sm-0"><?php echo getCityName($resultadd['cityId']); ?></div>
													</div>

													<div class="d-sm-flex flex-sm-wrap mb-0">
														<div class="font-weight-semibold">Address:</div>
														<div class="ml-sm-auto mt-2 mt-sm-0"><?php echo $resultadd['address']; ?></div>
													</div>
													<div class="d-sm-flex flex-sm-wrap mb-0">
														<div class="font-weight-semibold">Primary</div>
														<div class="ml-sm-auto mt-2 mt-sm-0"><?php if($resultadd['primaryAddress']==1){ echo 'Yes'; }else{ echo  'No'; } ?></div>
													</div>
												</div>
												</div>
													<?php $sno++; }
													if($sno==1){
													 ?>
													<div style="padding: 5px; background: #f1f1f1; color: #9a9a9a;" align="center">No Address Found</div>
													<?php } ?>

												</div>

							</div>


											</div>

											<div class="card" style="width:100%">
							<div class="card-body listc">
								<div style="padding: 5px;font-weight: 500; color: #524f4f; width:100%"><span style="">Contact Information</span> <span style=" float:right;"><a href="#" onclick="opmodalpop(' Add Contact','modalpop.php?action=contactdetailmaster&buyerId=<?php echo $resultpage['id'] ?>&type=supplier','600px','auto');" data-toggle="modal" data-target="#modalpop"  aria-expanded="false">+Add New</a></span></div>

								<table class="table table-bordered ">
							<thead style="background-color: #dfffef;">
								<tr class="border-top-info">
									<th>Name</th>
									<th>Designation</th>
									<th>Email </th>
									<th>Phone</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$sr=1;
							$rs2=GetPageRecord('*','contactPersonMaster','buyerId="'.$resultpage['id'].'" and type="supplier" order by id desc');
							while($userss=mysqli_fetch_array($rs2)){
							?>
							<tr class="border-top-info">
								<td><?php echo $userss['contactPerson']; ?></td>
								<td><?php echo $userss['designation']; ?></td>
								<td><?php echo $userss['email']; ?></td>
								<td><?php echo $userss['phone']; ?></td>
								<td><div class="btn-group">
								<a href="#" onclick="opmodalpop(' Edit Contact','modalpop.php?action=contactdetailmaster&buyerId=<?php echo $resultpage['id'] ?>&id=<?php echo encode($userss['id']); ?>&type=supplier','600px','auto');" data-toggle="modal" data-target="#modalpop"  aria-expanded="false"><button type="button" class="btn btn-primary" style="padding:5px;"><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1;   font-size: 16px; "></i></button></a>								</div>								</td>
							</tr>
							<?php $sr++; } ?>
							</tbody>
						</table>

						<?php if($sr==1){ ?>
						<div align="center" style="padding: 5px; background: #f1f1f1; color: #9a9a9a;">No Record Found.</div>
						<?php } ?>
							</div>

						</div>
										</div>
						   <div class="tab-pane fade" id="solid-rounded-justified-tab3">
											<div id="">
											<div class="card" style="width:100%">
							<div class="card-body listc">
								<div style="padding: 5px;font-weight: 500; color: #524f4f; width:100%"><span>Financial Information</span> <span style=" float:right;"><a href="#" onClick="opmodalpop(' Add Details','modalpop.php?action=bankdetailmaster&masterId=<?php echo encode($resultpage['id']); ?>&type=supplier','700px','auto');" data-toggle="modal" data-target="#modalpop" aria-expanded="false" >+Add New</a></span></div>
								<table class="table table-bordered">
							<thead style="background-color: #dfffef;">
								<tr class="border-top-info">
									<th>Bank Name</th>
									<th>Account Type</th>
									<th>Account Number</th>
									<th>IFSC Code</th>
									<th>Beneficiary Name</th>
									<th>Overdraft Limit</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$sr=1;
							$rsBank=GetPageRecord('*','bankDetailsMaster','masterId="'.$resultpage['id'].'" and type="supplier" order by id desc');
							while($bankdetail=mysqli_fetch_array($rsBank)){
							?>
							<tr class="border-top-info">

								<td><?php echo $bankdetail['bankName']; ?></td>
								<td><?php if($bankdetail['accountType']==1){ echo 'Current'; }if($bankdetail['accountType']==2){ echo 'Corporate'; }  ?></td>
								<td><?php echo $bankdetail['accountNumber']; ?></td>
								<td><?php echo $bankdetail['IFSCCode']; ?></td>
								<td><?php echo $bankdetail['beneficiary']; ?></td>
								<td><?php echo $bankdetail['overdraftLimit']; ?></td>
								<td><div class="btn-group">
								<a href="#" onclick="opmodalpop(' Edit Details','modalpop.php?action=bankdetailmaster&masterId=<?php echo encode($resultpage['id']) ?>&id=<?php echo encode($bankdetail['id']); ?>&type=supplier','700px','auto');" data-toggle="modal" data-target="#modalpop"  aria-expanded="false"><button type="button" class="btn btn-primary" style="padding:5px;"><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1;   font-size: 16px; "></i></button></a>								</div>								</td>
							</tr>
							<?php $sr++; } ?>
							</tbody>
						</table>

						<?php if($sr==1){ ?>
						<div align="center" style="padding: 5px; background: #f1f1f1; color: #9a9a9a;">No Record Found.</div>
						<?php } ?>
							</div>

						</div>

											<div class="card" style="width:100%">
							<div class="card-body listc">
								<div style="padding: 5px;font-weight: 500; color: #524f4f; width:100%"><span>Document Management</span> <span style=" float:right;"><a href="#" onClick="opmodalpop(' Add Details','modalpop.php?action=addbuyerdocuments&masterId=<?php echo encode($resultpage['id']); ?>&type=supplier','700px','auto');" data-toggle="modal" data-target="#modalpop" aria-expanded="false" >+Add New</a></span></div>
								<table class="table table-bordered">
							<thead style="background-color: #dfffef;">
								<tr class="border-top-info">
									<th>Document&nbsp;Type</th>
									<th>Document&nbsp;No.</th>
									<th>Issue&nbsp;Date</th>
									<th>Expiry&nbsp;Date</th>
									<th>Issue Country </th>
									<th>Attchment</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$sr=1;
							$kkkk=GetPageRecord('*','documentMaster','masterId="'.$resultpage['id'].'" and type="supplier" order by id desc');
							while($documentname=mysqli_fetch_array($kkkk)){
							?>
							<tr class="border-top-info">
							 	<td>
								<?php
							 	$pp=GetPageRecord('*','documentCategoryMaster','id="'.$documentname['docType'].'"');
								$doccategory=mysqli_fetch_array($pp);
								echo $doccategory['name'];
								 ?> </td>
								<td><?php echo $documentname['documentNo']; ?> </td>
								<td><?php if($documentname['issueDate']!='1970-01-01'){ echo date('d-m-Y',strtotime($documentname['issueDate'])); } ?></td>
								<td><?php if($documentname['issueDate']!='1970-01-01'){ echo date('d-m-Y',strtotime($documentname['expiryDate'])); } ?></td>
								<td><?php
							 	$qq=GetPageRecord('*','countryMaster','id="'.$documentname['countryId'].'"');
								$countryName=mysqli_fetch_array($qq);
								echo $countryName['name'];
								 ?></td>
								<td>
								<?php if($documentname['attachment']!=''){ ?>

								<a href="<?php echo $fullurl; ?>images/<?php echo $documentname['attachment']; ?>" target="blank" class="btn bg-teal-400" aria-expanded="false"  style="background-color: #e61a20; font-size: 12px;"><i class="fa fa-download mr-2"></i>Download Attachment</a>
								<?php } ?>

								</td>
								<td><div class="btn-group">
								<a href="#" onclick="opmodalpop(' Edit Details','modalpop.php?action=addbuyerdocuments&masterId=<?php echo encode($resultpage['id']) ?>&id=<?php echo encode($documentname['id']); ?>&type=supplier','700px','auto');" data-toggle="modal" data-target="#modalpop"  aria-expanded="false"><button type="button" class="btn btn-primary" style="padding:5px;"><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1;   font-size: 16px; "></i></button></a>								</div>								</td>
							</tr>
							<?php $sr++; } ?>
							</tbody>
						</table>

						<?php if($sr==1){ ?>
						<div align="center" style="padding: 5px; background: #f1f1f1; color: #9a9a9a;">No Record Found.</div>
						<?php } ?>
							</div>

						</div>
											</div>
										</div>

										<div class="tab-pane fade" id="solid-rounded-justified-tab4">
											<div id="">
											<div class="card">
					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover no-footer">
                    <thead style="background-color: #f5f5f5;">
                      <tr role="row">

								<th>PO&nbsp;Number</th>
								<th>Supplier Name</th>
								<th>Supplier&nbsp;Id</th>
								<th>Generated&nbsp;Date</th>
								<th><div align="center">Status</div></th>
								<th><div align="center">Actions</div></th>
					  </tr>
                    </thead>
                    <tbody id="allhotellisting">
                      <?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
//$limit='20000';
$limit=clean($_GET['records']);

$where='where 1 and supplierId="'.decode($_GET['id']).'" and  bomPoStatus=1 group By poNumber order by id desc';

$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['url'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';

$rs=GetRecordList($select,'indentCreationMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
if($totalentry=1){
$totalentry=2;
}
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

?>
                      <tr role="row">

					 <td><a href="showpage.crm?module=posupplier&view=yes&id=<?php echo encode($resultlists['supplierId']); ?>&po=<?php echo $resultlists['poNumber']; ?>"><?php echo $resultlists['poNumber']; ?></a>					 </td>
					<td><a><?php echo getSupplierName($resultlists['supplierId']); ?></a></td>
					<td><?php echo getSupplierCode($resultlists['supplierId']); ?></td>
					<td><?php echo date('d-M-Y',strtotime($resultlists['createdDate'])); ?></td>
					<td align="center">-</td>

					<td align="center">
					-				</td>
					  </tr>

                      <?php } ?>
                    </tbody>
                  </table>
					</div>
					</div>


					</div>
											</div>
										</div>
									</div>

								</div>
							</div>


						</div>


				 </div>




				</div>
				<!-- /dashboard content -->
			</div>
			</div>
			<!-- /content area -->


			<!-- Footer -->

			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>

 <style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}

.btn-float i {
    display: block;
    top: 0;
    font-size: 20px;
}

.card-group-control-right .card-body{width:100%;}

 </style>
 <script>
 function deletethisaddress(id){
 	var confirmFirst = confirm("Are you sure you want to delete this address?");
	if(confirmFirst==true){
		var buyerid= '<?php echo encode($resultpage['id']); ?>';
		window.location.href = 'showpage.crm?module=buyermaster&view=yes&id='+buyerid+'&did='+id; //delete address
	}
 }

 </script>
