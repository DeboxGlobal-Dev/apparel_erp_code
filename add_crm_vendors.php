<?php
//$updatepage='1';
if($_GET['id']!=''){
$select1='*';
$where1='id="'.decode($_GET['id']).'"';
$rs1=GetPageRecord($select1,_VENDOR_MASTER_,$where1);
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
			<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
			<input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
			<input type="hidden" name="action" value="<?php if($_GET['id']!=''){ echo 'editvendor'; } else { echo 'addvendor'; } ?>">


			<div class="content pt-0" style="margin-top:20px;">

				<!-- Dashboard content -->
				<div class="row">

				<div class="col-xl-12">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Vendor Information</h6>
							</div>

				<div class="card-body">
				<div class="form-group">
				<div class="row">
					 <div class="col-md-3">
						<div class="form-group">
							<label>Vendor ID</label>
							<input name="supplierid" type="text" class="form-control" id="supplierid" value="<?php echo $editresult['supplierId']; ?>"   maxlength="200">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Vendor Name</label>
							<input name="suppliername" type="text" class="form-control" id="suppliername" value="<?php echo $editresult['name']; ?>"   maxlength="200">
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>Email</label>
							<input name="email" type="text" class="form-control" id="email" value="<?php echo $editresult['email']; ?>" >
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Phone</label>
							<input name="phone" type="text" class="form-control" id="phone" value="<?php echo $editresult['phone']; ?>" >
						</div>
					</div>

				</div>

				<div class="row" style="margin-top:20px;">
				<div class="col-md-3">
				<div class="form-group">
				<label>Address</label>
				<input name="address" type="text" class="form-control" id="address" displayname="Address" value="<?php echo $editresult['address']; ?>" />
				</div>
				</div>

				<div class="col-md-3">
				<div class="form-group">
				<label>Country</label>
				<select id="countryId" name="countryId" class="form-control" displayname="State" autocomplete="off" onchange="selectstate();" >
				<option value="">Select</option>
				<?php
				$select='';
				$where='';
				$rs='';
				$select='*';
				$where=' deletestatus=0 and status=1 order by name asc';
				$rs=GetPageRecord($select,_COUNTRY_MASTER_,$where);
				while($resListing=mysqli_fetch_array($rs)){
				?>
				<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['countryId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
				<?php } ?>
				</select>
				</div>
				</div>

				<div class="col-md-3">
				<div class="form-group">
				<label>State</label>
				<select id="stateId" name="stateId" class="form-control" displayname="State" autocomplete="off" onchange="selectcity();" >
				</select>
				</div>
				</div>

				<div class="col-md-3">
				<div class="form-group">
				<label>City</label>
				<select id="cityId" name="cityId" class="form-control" autocomplete="off">

				</select>
				</div>
				</div>

				</div>



				  </div>

		  <div class="text-right">
			<button type="submit" class="btn btn-primary">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
			</div>




				</div>
						</div>

</div>

			</div>





			</div>

			</form>

		</div>
	</div>

<script>
function selectstate(){
var countryId = $('#countryId').val();
$('#stateId').load('loadstate.php?id='+countryId+'&selectId=<?php echo $editresult['stateId']; ?>');
}

function selectcity(){
var stateId = $('#stateId').val();
$('#cityId').load('loadcity.php?id='+stateId+'&selectId=<?php echo $editresult['cityId']; ?>');
}

<?php
if($_GET['id']!=''){
?>
selectstate();
<?php } ?>

</script>

