<?php
//$updatepage='1';

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

//echo '<pre>'; print_r($_SESSION);
?>
	<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">



			<!-- Content area -->
			<div class="content pt-0" style="margin-top:20px; overflow:hidden;">
				<!-- Dashboard content -->

				<!---style information section--->
				<?php include "top-style.php"; ?>
				<!---style information section end--->


				<div class="row">

				<div class="col-xl-12">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Line Plan</h6>
							</div>


				<div class="card-body">
				<div class="form-group">
				<div class="row">


					<div class="page-content">
<style>
.even{
background-color: #0097a71a;
}
</style>

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<div class="content-wrapper">

		<!---Save Alert Notification---->
		<?php include "savealert.php"; ?>



			<div class="content pt-0" style="margin-top:10px;">

				<div class="row">
				<div class="col-xl-12">

				<form name"search" method="GET" action="">

				<input type="hidden"  name="module" value="<?php echo $_GET['module']; ?>"/>
				<input type="hidden"  name="add" value="yes"/>
				<input type="hidden"  name="styleid" value="<?php echo $_GET['styleid']; ?>"/>

				<div class="row" style="padding:15px 0px;">
						<div class="col-md-2">
							<div class="">
								<select id="factoryId" name="factoryId" class="form-control" displayname="Factory Id" onchange="loadLines(this.value);">
								 <option value="">Select</option>
								 <?php
								$select='';
								$where='';
								$rs='';
								$select='*';
								$where=' deletestatus=0 and status=1 order by name asc';
								$rs=GetPageRecord($select,'factoryMaster',$where);
								while($resListing=mysqli_fetch_array($rs)){
								?>
								<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$_GET['factoryId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
								<?php } ?>
								</select>
							</div>
						</div>


						<div class="col-md-2">
							<div id="loadlines">
							<select id="lines" multiple="multiple" name="lines[]" class="form-control">

							</select>
							  </div>
						</div>
<script>

<?php
if($_GET['factoryId']!=''){ ?>
$factoryid=$('#factoryId').val();
loadLines($factoryid);


<?php } ?>

function loadLines(id){
$('#loadlines').load('loadlines.php?id='+id+'&selectId=<?php echo $lines; ?>');
}

$(function() {
$('#lines').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});
</script>

<script>
$( function(){
	$( "#startDate" ).datepicker();
} );

$( function(){
	$( "#endDate" ).datepicker();
} );
</script>
						<!--<div class="col-md-3">
							<div class="">
								<input name="qty" type="number" class="form-control" id="qty" value="<?php echo $editresult['qty']; ?>" placeholder="Quantity">
							</div>
						</div>-->

						<div class="col-md-2">
							<div class="">
								<input name="startDate" type="text" class="form-control" id="startDate" value="<?php echo $_GET['startDate']; ?>" placeholder="Line Loading Date">
							</div>
						</div>

						<div class="col-md-2" >
							<div class="">
								<input name="endDate" type="text" class="form-control" id="endDate" value="<?php echo $_GET['endDate']; ?>" placeholder="Off Machine Date">
							</div>
						</div>

						<div class="col-md-2">
							<div class="">
								<input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">
							</div>
						</div>

				  </div>
				</form>


				</div>

				</div>

				<div class="row">
				<div class="col-xl-12">
				<table width="100%" border="1" cellpadding="5" cellspacing="0" class="table-responsive" style="max-width: 1265px;float: left;overflow-x: scroll;">
                    <tr height="17" style="background-color:#ece9e9; font-weight:500; text-align:center;">
                      <td width="10%">Date</td>
                      <?php
					  $i=1;
					  foreach($_GET['lines'] as $line){ ?>
					  <td colspan="3" width="112">Line <?php echo $i; ?></td>
                      <?php $i++;  } ?>
					</tr>
					<?php
					$total=0;
					$startDate = $_GET['startDate'];
					$startDate = date('d',strtotime($startDate));
					$endDate = $_GET['endDate'];
					$endDate = date('d',strtotime($endDate));
					for($i=$startDate; $i<=$endDate; $i++){
					?>
                    <tr height="17">
						<td height="17"><?php echo $startDate.'-'.date('M'); ?></td>
						<?php foreach($_GET['lines'] as $line11){ ?>
						<td rowspan="" bgcolor="#F8FFC1"><?php echo $editresultstyle['subject']; ?></td>
						<td><?php echo $total = $total+100; ?></td>
						<td><?php echo $total = $total+100; ?></td>
						<?php } ?>
					</tr>
				    <?php $startDate++; } ?>
                  </table>
				</div>
				</div>

				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


			<!-- Footer -->

			<!-- /footer -->

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
			<!-- /content area -->



		</div>
		<!-- /main content -->

