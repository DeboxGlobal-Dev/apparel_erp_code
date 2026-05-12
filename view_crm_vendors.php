<?php
$select='*';
$id=clean(decode($_GET['id']));
$where='id='.$id.'';
$rs=GetPageRecord($select,_VENDOR_MASTER_,$where);
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
									<h6 class="media-title font-weight-semibold">Vendor Details</h6>
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
<li class="nav-item"><a href="#solid-rounded-justified-tab4" class="nav-link rounded-left" data-toggle="tab">Vendor Purchase Order </a></li>

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
					<label>Vendor ID</label>
					<input name="supplierid" type="text" class="form-control" id="supplierid" value="<?php echo $resultpage['supplierId']; ?>"   maxlength="200">
					</div>
					</div>
					<div class="col-md-3">
					<div class="form-group">
					<label>Vendor Name</label>
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


					</div>

				</div>
				            <input type="hidden" name="editId" value="<?php echo encode($resultpage['id']); ?>">
							<input type="hidden" name="action" value="editvendor">
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
																<h6 class="card-title">Address Information <span style=" float:right; font-size: 13px;"> <a href="#" onClick="opmodalpop(' Add Address','modalpop.php?action=addressmaster&parentId=<?php echo encode($resultpage['id']); ?>&type=vendors','500px','auto');" data-toggle="modal" data-target="#modalpop" aria-expanded="false" >+Add New</a></span></h6>

															</div>

													<?php
													$sno=1;
													$rs=GetPageRecord('*',_ADDRESS_MASTER_,'1 and addressParent="'.$resultpage['id'].'" and addresstype="vendors"');
													while($resultadd=mysqli_fetch_array($rs)){
													?>

													<div class="card-body border-top-0" id="loadondelete<?php echo $resultadd['id']; ?>">
													<div style="border: 1px solid #ccc;padding: 10px;box-shadow: 5px 6px #d6d6d6;">
													<p style="background-color: #efefef;font-weight: 500;padding: 5px;"><span><?php echo $resultadd['officeType']; ?></span>

													<a href="#" onclick="deletethisaddress('<?php echo encode($resultadd['id']); ?>');"><span style="float:right; color:#FF0000;">Delete</span></a>
													<a href="#" onClick="opmodalpop(' Edit Address','modalpop.php?action=addressmaster&parentId=<?php echo encode($resultpage['id']); ?>&id=<?php echo encode($resultadd['id']); ?>&type=vendors','500px','auto');" data-toggle="modal" data-target="#modalpop" aria-expanded="false"><span style="float:right; margin-right: 7px;">Edit</span></a>
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
								<div style="padding: 5px;font-weight: 500; color: #524f4f; width:100%"><span style="">Contact Information</span> <span style=" float:right;"><a href="#" onclick="opmodalpop(' Add Contact','modalpop.php?action=contactdetailmaster&buyerId=<?php echo $resultpage['id'] ?>&type=vendors','600px','auto');" data-toggle="modal" data-target="#modalpop"  aria-expanded="false">+Add New</a></span></div>

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
							$rs2=GetPageRecord('*','contactPersonMaster','buyerId="'.$resultpage['id'].'" and type="vendors" order by id desc');
							while($userss=mysqli_fetch_array($rs2)){
							?>
							<tr class="border-top-info">
								<td><?php echo $userss['contactPerson']; ?></td>
								<td><?php echo $userss['designation']; ?></td>
								<td><?php echo $userss['email']; ?></td>
								<td><?php echo $userss['phone']; ?></td>
								<td><div class="btn-group">
								<a href="#" onclick="opmodalpop(' Edit Contact','modalpop.php?action=contactdetailmaster&buyerId=<?php echo $resultpage['id'] ?>&id=<?php echo encode($userss['id']); ?>&type=vendors','600px','auto');" data-toggle="modal" data-target="#modalpop"  aria-expanded="false"><button type="button" class="btn btn-primary" style="padding:5px;"><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1;   font-size: 16px; "></i></button></a>								</div>								</td>
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
								<div style="padding: 5px;font-weight: 500; color: #524f4f; width:100%"><span>Financial Information</span> <span style=" float:right;"><a href="#" onClick="opmodalpop(' Add Details','modalpop.php?action=bankdetailmaster&masterId=<?php echo encode($resultpage['id']); ?>&type=vendors','700px','auto');" data-toggle="modal" data-target="#modalpop" aria-expanded="false" >+Add New</a></span></div>
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
							$rsBank=GetPageRecord('*','bankDetailsMaster','masterId="'.$resultpage['id'].'" and type="vendors" order by id desc');
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
								<a href="#" onclick="opmodalpop(' Edit Details','modalpop.php?action=bankdetailmaster&masterId=<?php echo encode($resultpage['id']) ?>&id=<?php echo encode($bankdetail['id']); ?>&type=vendors','700px','auto');" data-toggle="modal" data-target="#modalpop"  aria-expanded="false"><button type="button" class="btn btn-primary" style="padding:5px;"><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1;   font-size: 16px; "></i></button></a>								</div>								</td>
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
								<div style="padding: 5px;font-weight: 500; color: #524f4f; width:100%"><span>Document Management</span> <span style=" float:right;"><a href="#" onClick="opmodalpop(' Add Details','modalpop.php?action=addbuyerdocuments&masterId=<?php echo encode($resultpage['id']); ?>&type=vendors','700px','auto');" data-toggle="modal" data-target="#modalpop" aria-expanded="false" >+Add New</a></span></div>
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
							$kkkk=GetPageRecord('*','documentMaster','masterId="'.$resultpage['id'].'" and type="vendors" order by id desc');
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
								<a href="#" onclick="opmodalpop(' Edit Details','modalpop.php?action=addbuyerdocuments&masterId=<?php echo encode($resultpage['id']) ?>&id=<?php echo encode($documentname['id']); ?>&type=vendors','700px','auto');" data-toggle="modal" data-target="#modalpop"  aria-expanded="false"><button type="button" class="btn btn-primary" style="padding:5px;"><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1;   font-size: 16px; "></i></button></a>								</div>								</td>
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
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead style="background-color: #f5f5f5;">
						   <tr role="row">
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Ref.&nbsp;Id</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Name</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Category</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="padding:5px;" align="center">Days</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Assign&nbsp;To</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="padding:5px;" align="center">Priority</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Task&nbsp;Progress(%)</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Status</th>
							 	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="display:none;">Accept/Reject</th>
								<th class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 100px; display:none;" aria-label="Actions">Actions</th>

								<?php if($loginuserprofileId==92){ ?>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">&nbsp; </th>
								<?php } ?>

							</tr>
						</thead>
						<tbody>
						<?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='20000';

if($_GET['stylestatus']!=''){
$stylestatus = 'and finalstatus="'.$_GET['stylestatus'].'"';
}

$assignTo='';
if($_GET['assignTo']!=''){
$assignTo = 'and assignTo="'.decode($_GET['assignTo']).'"';
}

if($_GET['assignToMerchant']!=''){
$assignToMerchant = 'and assignTo in (select id from userMaster where empId in (select id from employeeMaster where reportingTo in (select empId from userMaster where id="'.decode($_GET['assignToMerchant']).'")))';
}
if($_GET['a']=='1' && $loginuserprofileId==92){
$wheresearchassign = '';
}


if($loginuserprofileId==92){
$where='where '.$wheresearchassign.'  subject!=""  '.$stylestatus.' '.$assignTo .' '.$assignToMerchant.' '.$categoryId.' and buyerId="'.$resultpage['id'].'" and deletestatus=0 order by id desc';
}else{
$where='where '.$wheresearchassign.' subject!="" '.$stylestatus.' '.$categoryId.' and buyerId="'.$resultpage['id'].'" and deletestatus=0 order by id desc';
}
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];

while($resultlists=mysqli_fetch_array($rs[0])){




$selectimg='*';
$whereimg='parentId="'.$resultlists['id'].'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);


$selectdays='*';
$wheredays='styleId="'.$resultlists['id'].'" and statusId=2';
$rsdays=GetPageRecord($selectdays,'styleAssignmentMaster',$wheredays);
$resultdays=mysqli_fetch_array($rsdays);


?>

							<tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>
								<td>
								<div class="liststyleimg"><a href="showpage.crm?module=style&view=yes&id=<?php echo encode($resultlists['id']); ?>">
								<img src="images/<?php if($imgresult['attachmentImage']!=''){?><?php echo $imgresult['attachmentImage']; ?><?php }else{ ?>noimage.png<?php } ?>" width="100%" style="height: 58px;"></a></div></td>
								<td><a href="showpage.crm?module=style&view=yes&id=<?php echo encode($resultlists['id']); ?>"><?php echo '#'.$resultlists['styleRefId']; ?><?php if(countQueryunreadMails($resultlists['id'])!=0){ ?><div class="numberbubbol"><?php echo countQueryunreadMails($resultlists['id']); ?></div><?php } ?></a>

								<?php if($loginuserprofileId==92 || $loginuserprofileId=='1'){	?>
								<?php if($resultlists['styleTypeId']=='2'){ ?>
								<span class="badge badge-warning" style="width: auto; display: block;">Outsource</span>
								<?php } ?>
								<?php if($resultlists['styleTypeId']=='3'){ ?>
								<span class="badge badge-primary" style="width: auto; display: block;">Inhouse & Outsource</span>
								<?php } ?>
								<?php } ?>							 	</td>
							    <td><?php echo $resultlists['subject']; ?></td>
								<td><?php echo getCategoryName($resultlists['categoryId']).' - '.getSubCategoryName($resultlists['subCategoryId']); ?>								</td>

								</td>
								<td style="padding:5px;">

							<?php if($resultdays['dateAdded']!=''){ ?>	<a href="#" class="list-icons-item flex-fill p-2" data-popup="tooltip" data-container="body" title="" data-original-title="<?php echo date('d M, Y - h:i A',$resultdays['dateAdded']); ?>"> <?php } ?>
		                    	<?php
								if($resultdays['dateAdded']!=''){
								$assignDate = date('Y-m-d',$resultdays['dateAdded']);
								$currDate =date('Y-m-d');
								$datetime1 = date_create($assignDate);
									$datetime2 = date_create($currDate);
									$interval = date_diff($datetime1, $datetime2);
									$durationcount = $interval->days;
									if($durationcount>=0){ echo $durationcount."&nbsp;day"; } else{ echo "-"; }

								}else{ echo '-'; }  ?>
	                    		</a>								</td>

								<td style="padding:5px;" align="center"><?php echo getUserName($resultlists['assignTo']); ?></td>

								<td><?php if($resultlists['queryPriority']=='1'){ ?><span class="badge badge-secondary" style="width: 47px;">Low</span><?php } if($resultlists['queryPriority']=='2'){ ?><span class="badge badge-primary" style="width: 47px;">Medium</span><?php } if($resultlists['queryPriority']=='3'){ ?><span class="badge badge-danger" style="width: 47px;">High</span><?php }?></td>

								<!--<td>
								<?php
								if($resultlists['styleType']==1){ echo 'Inhouse';}if($resultlists['styleType']==2){ echo 'Outsource';}if($resultlists['styleType']==3){ echo 'Partial Outsource';}if($resultlists['styleType']=='0'){ echo '-';}
								 ?>
								</td>-->

								<td id="progressbarhover">
								<?php
								$selectstatus='*';
								$wherestatus='styleId="'.$resultlists['id'].'" and statusId!=0 order by id desc';
								$rsstatus=GetPageRecord($selectstatus,'styleAssignmentMaster',$wherestatus);
								$result=mysqli_fetch_array($rsstatus);

								$select1='*';
								$where1='id="'.$result['statusId'].'" order by id desc';
								$rs1=GetPageRecord($select1,'statusMaster',$where1);
								$result1=mysqli_fetch_array($rs1);

								$selecttotaltask='*';
								$wheretotaltask='styleId="'.$resultlists['id'].'"';
								$rstotal=GetPageRecord($selecttotaltask,'styleSubCategoryMaster',$wheretotaltask);

								$selectqty='*';
								$whereqty='styleId="'.$resultlists['id'].'" and qtyStatus=1';
								$rsqty=GetPageRecord($selectqty,'styleSubCategoryMaster',$whereqty);
								$totalqty = mysqli_num_rows($rsqty);

								$selectprice='*';
								$whereprice='styleId="'.$resultlists['id'].'" and priceStatus=1';
								$rsprice=GetPageRecord($selectprice,'styleSubCategoryMaster',$whereprice);
								$totalprice = mysqli_num_rows($rsprice);

								$selectvendor='*';
								$wherevendor='styleId="'.$resultlists['id'].'" and vendorStatus=1';
								$rsvendor=GetPageRecord($selectvendor,'styleSubCategoryMaster',$wherevendor);
								$totalvendor = mysqli_num_rows($rsvendor);

								//$totalTask = mysqli_num_rows($rstotal);




								$totalTask = $totalqty+$totalprice+$totalvendor;

								$selecttaskComplet='*';
								$wheretaskComplet='styleId="'.$resultlists['id'].'" and approvedStatus=1';
								$rswheretaskComplet=GetPageRecord($selecttaskComplet,'materialCostChatMaster',$wheretaskComplet);
								$completed = mysqli_num_rows($rswheretaskComplet);



								$persent = round($completed*100/$totalTask);

								$selectfurther='*';
								$wherefurther='styleId="'.$resultlists['id'].'" and approvedStatus=2 and materialFinalStatus=1';
								$rsfurther=GetPageRecord($selectfurther,'materialCostChatMaster',$wherefurther);
								$furtherassign = mysqli_num_rows($rsfurther);

								$selectwaiting='*';
								$wherewaiting='styleId="'.$resultlists['id'].'" and approvedStatus=3 and materialFinalStatus=1';
								$rswaiting=GetPageRecord($selectwaiting,'materialCostChatMaster',$wherewaiting);
								$waiting = mysqli_num_rows($rswaiting);

								$selectreject='*';
								$wherereject='styleId="'.$resultlists['id'].'" and approvedStatus=4 and materialFinalStatus=1';
								$rsreject=GetPageRecord($selectreject,'materialCostChatMaster',$wherereject);
								$reject = mysqli_num_rows($rsreject);


								$pending = $completed+$furtherassign+$waiting+$reject;
								?>

<div class="progress">
	<div class="progress-bar bg-primary" style="width: <?php echo $persent; ?>%">
		<span style="padding: 10px; font-weight: 800;"><?php echo round($persent); ?>%</span>	</div>
</div>
<?php if($resultlists['analyzeMaterialListSave']==1){ ?>
<div class="card card-body text-center tblcontent" id="statusreport">
  <h6 class="font-weight-semibold mb-0 mt-1" style="width: 100%; text-align: center; font-weight: 600; font-size: 11px; margin-bottom: 10px !important;">Total Task (<?php echo $totalTask; ?>)</h6>

	<table width="100%" border="1" cellspacing="0" cellpadding="5">
	<tr>
	<td align="left">Approved</td>
	<td align="left">Pending</td>
	<td align="left">Waiting&nbsp;For&nbsp;Approval</td>
	<td align="left">Further&nbsp;Assigned</td>
	<td align="left">Rejected</td>
	</tr>
	<tr>
	<td align="left"><?php echo $completed; ?></td>
	<td align="left"><?php echo $totalTask-$pending; ?></td>
	<td align="left"><?php echo $waiting; ?></td>
	<td align="left"><?php echo $furtherassign; ?></td>
	<td align="left"><?php echo $reject; ?></td>
	</tr>
	</table>
						</div>
<?php } ?>

<style>
#progressbarhover{
cursor:pointer;
}
#statusreport {
    width: 420px;
    position: absolute;
    right: 204px;
    padding-bottom: 25px;
     border-radius: 0px;
    background: #fff;
    display: none;
	z-index: 9;
}
#progressbarhover:hover #statusreport{
display:block;
}
#statusreport table tr td {
    font-weight: 500;
    font-size: 10px;
    padding: 2px;
    width: 50px;
    text-align: center;
}
</style>

								<?php
								$selecttat='*';
								$wheretat='departmentId=2 and categoryId="'.$resultlists['categoryId'].'" and subCategoryId="'.$resultlists['subCategoryId'].'"';
								$rstat=GetPageRecord($selecttat,'departmentTimelineMaster',$wheretat);
								$resulttat=mysqli_fetch_array($rstat);
								$tatDays = $resulttat['duration'];

								//echo $assignDays = $tatDays-$durationcount.' Days Left';
								?>								</td>

								<td align="left">

						<?php if($resultlists['stylestatus']!='0'){ ?>


								<?php if($resultlists['stylestatus']!='0' && $resultlists['finalstatus']!='2'){ ?>
								<span class="badge" style="cursor:pointer;background-color:<?php echo $result1['statusColor']; ?>; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;" <?php if($resultlists['stylestatus']!='0' && $resultlists['finalstatus']!='2'){ ?> onclick="opmodalpop('Change Status','modalpop.php?action=acceptreject&styleId=<?php echo encode($resultlists['id']); ?>&styleTypeId=<?php echo $resultlists['styleTypeId']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" <?php } ?>><?php echo $result1['name']; ?></span>
								<?php } else {  ?>


								<span class="badge badge-flat" style="border:1.5px solid <?php echo $result1['statusColor']; ?>; background-color:#fff; color:black; position: relative;width: 142px; font-size: 11px; padding: 6px;"><?php echo $result1['name']; ?></span>
								<?php } ?>

								<?php } ?>

								<?php if($resultlists['stylestatus']=='0'){ ?>
								<span class="badge badge-flat" style="border-color:#ff0000;; color:#ff0000; position: relative; width:108px;width: 142px; font-size: 11px; padding: 6px;" >Rejected</span>





								<?php } ?>
								<br>								</td>



								<td align="center" style="display:none;">

								<?php if($resultlists['stylestatus']!='0' && $resultlists['finalstatus']!='2'){ ?>
									<span class="badge list-group-item list-group-item-action" style="background-color: #33cc33;color: #FFFFFF; position: relative;padding: 7px; font-size: 11px;background: #ff7043;cursor:pointer;" onclick="opmodalpop('Change Status','modalpop.php?action=acceptreject&styleId=<?php echo encode($resultlists['id']); ?>','400px','auto');" data-toggle="modal" data-target="#modalpop">Accept/Reject</span>
								<?php } ?>

									<?php if($resultlists['stylestatus']=='0' && $resultlists['stylestatus']!='2'){ ?>
		<span class="badge badge-flat" style="border-color: #ff7043;color: #ff7043; position: relative;padding: 7px; font-size: 11px;">Rejected</span>
									<?php } ?>


									<?php if($resultlists['stylestatus']=='1' && $resultlists['finalstatus']=='2'){ ?>
		<span class="badge badge-flat" style="border-color: #02c681; color: #02c681; position: relative;padding: 7px; font-size: 11px;">Accepted</span>
									<?php } ?>								</td>

								<td style="display:none;"></td>

							<?php if($loginuserprofileId==92){ ?>
							<td><span style="width: 90px; display: block; background-color: #0288d1; color: #fff; text-align: center; padding: 4px; cursor:pointer;" onClick="opmodalpop('Action','modalpop.php?action=changestyletype&id=<?php echo encode($resultlists['id']); ?>','500px','auto');" data-toggle="modal" data-target="#modalpop">Change Type</span></td>
							<?php } ?>
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
