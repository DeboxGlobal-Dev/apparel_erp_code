<?php
//$updatepage='1';
if($_GET['id']!=''){
$select1='*';
$where1='id="'.decode($_GET['id']).'"';
$rs1=GetPageRecord($select1,_SUPPLIERS_MASTER_,$where1);
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
			<input type="hidden" name="action" value="<?php if($_GET['id']!=''){ echo 'editsupplier'; } else { echo 'addsupplier'; } ?>">


			<div class="content pt-0" style="margin-top:20px;">




				<!-- Dashboard content -->
				<div class="row">

				<div class="col-xl-12">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Supplier Information</h6>
							</div>

				<div class="card-body">
				<div class="form-group">
				<div class="row">
					 <div class="col-md-3">
						<div class="form-group">
							<label>Supplier ID</label>
							<input name="supplierid" type="text" class="form-control" id="supplierid" value="<?php echo $editresult['supplierId']; ?>"   maxlength="200">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Supplier Name</label>
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

				<fieldset>
<div class="text-right">
<button type="submit" class="btn btn-primary">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
</div>
</fieldset>


				</div>


						</div>




</div>



			</div>




				<!---supplier category Card Section--->
		<div class="card" style="display:none;">
			<div class="card-header header-elements-inline">
				<h6 class="card-title">Material Type</h6>
			</div>

			<div class="card-body">
				<ul class="nav nav-tabs nav-tabs-highlight nav-justified">

					<li class="nav-item"><a href="#highlighted-justified-tab2" class="nav-link active show" data-toggle="tab">FABRIC</a></li>
					<li class="nav-item"><a href="#highlighted-justified-tab3" class="nav-link" data-toggle="tab">ACCESSORIES</a></li>
					<!--<li class="nav-item"><a href="#highlighted-justified-tab4" class="nav-link" data-toggle="tab">Measurement&nbsp;Chart</a></li>
					<li class="nav-item"><a href="#highlighted-justified-tab5" class="nav-link" data-toggle="tab">Accessories&nbsp;Artwork</a></li>
					<li class="nav-item"><a href="#highlighted-justified-tab6" class="nav-link" data-toggle="tab">BOM</a></li>
					<li class="nav-item"><a href="#highlighted-justified-tab7" class="nav-link" data-toggle="tab">Comment</a></li>
					<li class="nav-item"><a href="#highlighted-justified-tab8" class="nav-link" data-toggle="tab">Measurement&nbsp;History</a></li>-->
				</ul>

				<div class="tab-content">
					<div class="tab-pane fade active show" id="highlighted-justified-tab2">

								<fieldset class="card-body">
									<div class="row">

									<?php
									$select='';
									$where='';
									$rs='';
									$select='*';
									$where='bomCategoryId=1 and deletestatus=0 and status=1 order by name asc';
									$rs=GetPageRecord($select,_BOM_SUB_CATEGORY_MASTER_,$where);
									while($resListing=mysqli_fetch_array($rs)){
									$array =  explode(',', $editresult['bomsubcategoryid']);
									?>

									<div class="col-lg-3">
									<label class="container">
									<input type="checkbox" value="<?php echo $resListing['id']; ?>" name="bomsubcategoryid[]" style="margin-right: 5px;" <?php foreach ($array as $item) { if($resListing['id']==$item){ ?>checked <?php } }?>><?php echo $resListing['name']; ?>
									<span class="checkmark"></span>
									</label>




									</div>
									<?php } ?>
									</div>


								</fieldset>
					</div>


					<div class="tab-pane fade" id="highlighted-justified-tab3">
						<fieldset class="card-body">
									<div class="row">

									<?php
									$select='';
									$where='';
									$rs='';
									$select='*';
									$where='bomCategoryId=2 and deletestatus=0 and status=1 order by name asc';
									$rs=GetPageRecord($select,_BOM_SUB_CATEGORY_MASTER_,$where);
									while($resListing=mysqli_fetch_array($rs)){
									$array =  explode(',', $editresult['bomsubcategoryid']);
									?>

									<div class="col-lg-3">
									<label class="container">
									<input type="checkbox" value="<?php echo $resListing['id']; ?>" name="bomsubcategoryid[]" style="margin-right: 5px;" <?php foreach ($array as $item) { if($resListing['id']==$item){ ?>checked <?php } }?>><?php echo $resListing['name']; ?>
									<span class="checkmark"></span>
									</label>




									</div>
									<?php } ?>
									</div>


								</fieldset>

					</div>

					<fieldset>
								<div class="text-right">
				                     <button type="submit" class="btn btn-primary">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
		                    	</div>
								</fieldset>


				</div>



			</div>
		</div>
		<!---supplier category Section--->


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

function selectbomsubcategory(){
var bomsubcategory = $('#categoryId').val();
$('#subcategoryId').load('loadbomsubcategory.php?id='+bomsubcategory+'&selectId=<?php echo $editresult['bomsubcategoryid']; ?>');
}

<?php
if($_GET['id']!=''){
?>
selectstate();
<?php } ?>

</script>


<style>
/* Hide the browser's default checkbox */
input[type=checkbox] {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 1px;
    left: 0px;
    height: 17px;
    width: 20px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
input[type=checkbox] ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
input[type=checkbox]:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
input[type=checkbox]:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.checkmark:after {
    left: 8px;
    top: 2px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
.container {
    display: block;
    position: relative;
    padding-left: 25px;
    margin-bottom: 10px;
    cursor: pointer;
    font-size: 14px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    font-weight: 400;
 }
</style>