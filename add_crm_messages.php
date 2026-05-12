<?php
//$updatepage='1';

if($_GET['id']==''){
$where=' subject="" and  addedBy='.$_SESSION['userid'].'';
deleteRecord('queryMaster',$where);

$dateAdded=time();
$namevalue ='subject="",addedBy='.$_SESSION['userid'].',dateAdded='.$dateAdded.'';
$lastId = addlistinggetlastid('queryMaster',$namevalue);
}

if($_GET['id']!=''){
$select1='*';
$where1='id="'.decode($_GET['id']).'"';
$rs1=GetPageRecord($select1,'queryMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
$editId=clean($editresult['id']);
$lastId=$editresult['id'];
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
				<div class="row">

				<div class="col-xl-12">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Broadcast Information</h6>
							</div>

			<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
				<div class="card-body">
				<?php if($updatepage=='1'){ ?>
				<span class="badge d-block badge-info form-text text-center" style="margin-bottom: 20px; font-size: 12px; padding: 10px;">Successfully Updated</span>
				<?php } ?>
				<div class="form-group">
				<div class="row">

					<div class="col-md-3">
						<div class="form-group">
							<label>Subject</label>
							<input name="subject" type="text" class="form-control" id="subject" value="<?php echo $editresult['subject']; ?>"   maxlength="200">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Broadcast Date</label>
							<input name="broadcastDate" type="text" class="form-control" id="broadcastDate" value="<?php if($editresult['broadcastDate']!=''){ echo date('d-m-Y', strtotime($editresult['broadcastDate'])); }else{ echo date('d-m-Y'); } ?>">
						</div>
					</div>

				</div>
				<div class="row" style="margin-top:20px;">
					<div class="col-md-3">
						<div class="form-group">
							<label>Category</label>
							<select id="categoryId" name="categoryId" class="form-control" displayname="Category" onchange="selectsubcategory();">
							 <option value="">Select</option>
							 <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' deletestatus=0 and status=1 order by name asc';
							$rs=GetPageRecord($select,_CATEGORY_MASTER_,$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
							<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['categoryId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Sub Category</label>
							<select id="subCategoryId" name="subCategoryId" class="form-control" displayname="Sub Category">
							</select>
							<script>
							function selectsubcategory(){
							var categoryId = $('#categoryId').val();
							$('#subCategoryId').load('loadsubcategory.php?id='+categoryId+'&selectId=<?php echo $editresult['subCategoryId']; ?>');
							}
							<?php
							if($_GET['id']!=''){
							?>
							selectsubcategory();
							<?php } ?>
							</script>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Season</label>
							<select id="seasonId" name="seasonId" class="form-control" displayname="Season">
							 <option value="">Select</option>
							 <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' deletestatus=0 and status=1 order by name asc';
							$rs=GetPageRecord($select,_SEASON_MASTER_,$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
							<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['seasonId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Division</label>
							<select id="divisionId" name="divisionId" class="form-control" displayname="Division">
							 <option value="">Select</option>
							 <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' deletestatus=0 and status=1 order by name asc';
							$rs=GetPageRecord($select,'divisionMaster',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
							<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['divisionId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
						</div>
				<div class="row" style="margin-top:20px;">
				<div class="col-md-3">
						<div class="form-group">
							<label>Division</label>
							<select id="departmentId" name="departmentId" class="form-control" displayname="Division">
							 <option value="">Select</option>
							 <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' deletestatus=0 and status=1 order by name asc';
							$rs=GetPageRecord($select,'departmentMaster',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
							<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['departmentId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
							<?php } ?>
							</select>
						</div>
					</div>

					<!--<div class="col-md-3">
						<div class="form-group">
						<label>Attach File</label>
						<div class="uniform-uploader">
						<input type="file" name="attachmentFile" id="attachmentFile" class="form-input-styled" data-fouc="" multiple="multiple"><span class="filename" style="user-select: none;">No file selected</span><span class="action btn bg-pink-400" style="user-select: none;"><i class="icon-plus2"></i></span>
						</div>
						</div>
					</div>-->

					<div class="col-md-3">
						<div class="form-group">
							<label>Assign To</label>
							<select id="assignTo" name="assignTo" class="form-control" displayname="Assign To">
							 <option value="">Select</option>
							 <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' deletestatus=0 and status=1 order by firstName asc';
							$rs=GetPageRecord($select,'userMaster',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
							<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['assignTo']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['firstName']).' '.strip($resListing['lastName']); ?></option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				  </div>

				<input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
				<input type="hidden" name="action" value="<?php if($_GET['id']!=''){ echo 'editquery'; } else { echo 'addquery'; } ?>">
				<?php if($_GET['id']=='' && $_GET['incomingid']!=''){ ?>
			 	<input name="incomingqueryId" type="hidden" id="incomingqueryId" value="<?php echo $_GET['incomingid']; ?>" />
				<?php } ?>
				<input name="mailId" type="hidden" id="mailId" value="<?php echo decode($_REQUEST['incomingid']); ?>" />
				<?php
				if($_GET['id']!=''){
				?>
				<input name="editedityes" type="hidden" id="editedityes" value="1" />
				<?php } ?>

				<div class="text-right">
					<button type="submit" class="btn btn-primary" onclick="convertquerymaildata();">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>

					<script>
					function convertquerymaildata(){
					var maildatadiv = $('#maildatadiv').html();
					$('#maildata').val(maildatadiv);
					}
					</script>
				    <label>
				    <textarea   id="maildata" name="maildata" style="display:none;"></textarea>
					<input type="hidden" name="maildate" id="maildate" value="<?php echo $maildate; ?>">
				    </label>
				</div>
				</div>

				</form>
						</div>


</div>


<?php if($mailid!=''){ ?>
	<div class="col-xl-5">

		<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Mail</h6>
							</div>
							<div class="card-body navbar-light">
									<div class="media flex-column flex-md-row">
										<a href="#" class="d-none d-md-block mr-md-3 mb-3 mb-md-0">
											<span class="btn bg-teal-400 btn-icon btn-lg rounded-round">
												<span class="letter-icon"><?php echo substr($mailUserName,0,1); ?></span>
											</span>
										</a>

										<div class="media-body">
											<h6 class="mb-0"><?php echo stripslashes($mailUserName); ?></h6>
											<div class="letter-icon-title font-weight-semibold"><?php if($email!=''){ echo 'From: '.$email; } else {  echo stripslashes($mailUserName); } ?>

											</div>
										</div>


									</div>
								</div>


<div id="maildatadiv">
<div class="card-body">
<?php echo stripslashes(imap_qprint($message)); ?>

</div>
<?php if($filenames!=''){ ?>
<div class="card-body border-top">
<h6 class="mb-0">Attachment</h6>

<ul class="list-inline mb-0">
<?php
if($filenames!=''){
$string = rtrim($filenames,',');
$string = preg_replace('/\.$/', '', $string);
$array = explode(',', $string);
foreach($array as $value)
{ ?>
<li class="list-inline-item">
<div class="card bg-light py-2 px-3 mt-3 mb-0">
<div class="media my-1">
<div class="mr-3 align-self-center"><i class="fa fa-file-text" aria-hidden="true" style="font-size:30px;"></i></div>
<div class="media-body">
<div class="font-weight-semibold"><?php echo $value; ?></div>

<ul class="list-inline list-inline-condensed mb-0">
<li class="list-inline-item"><a href="<?php echo $fullurl; ?>attachment/<?php echo date('d-m-Y-H:i:s',$timestamp) ; ?>-<?php echo $value; ?>" target="_blank">Download</a></li>
</ul>
</div>
</div>
</div>
</li>

<?php } } ?>

</ul>
</div>
<?php } ?>
		</div>					</div>

 </div>

 <?php } ?>

					</div>



			</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


			<!-- Footer -->

			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
<script>
$( function(){
	$( "#broadcastDate" ).datepicker();
} );


  </script>
