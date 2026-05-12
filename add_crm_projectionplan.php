<?php
//$updatepage='1';
$rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
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


$rsqty=GetPageRecord('*','buyerPurchaseOrderMaster','styleId="'.$editresultstyle['id'].'"');
$resultqty=mysqli_fetch_array($rsqty);
$totalstylequantity=$resultqty['qtyTotal'];


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
								<h6 class="card-title">Projection Planning</h6>
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

	 	<?php include "savealert.php"; ?>

			<div class="content pt-0" style="margin-top:10px;">

				<div class="row">
				<div class="col-xl-12">

				<form name"search" method="GET" action="">

				<input type="hidden"  name="module" value="<?php echo $_GET['module']; ?>"/>
				<input type="hidden"  name="add" value="yes"/>
				<input type="hidden"  name="styleid" value="<?php echo $_GET['styleid']; ?>"/>

				<div class="row" style="padding:15px 8px;">


<script>
$( function(){
	$( "#startDate" ).datepicker();
} );

$( function(){
	$( "#endDate" ).datepicker();
} );
</script>


							<div class="col-md-1">
							<div class="">
								<select id="buyerId" name="buyerId" class="form-control" displayname="Buyer" onchange="changeBuyer(this.value);">
								<option value="">Buyer</option>
								<option value="100" <?php if('100'==$editresult['buyerId']){ ?>selected="selected"<?php } ?>>Self</option>
								  <?php
									$select='';
									$where='';
									$rs='';
									$select='*';
									$where=' deletestatus=0 and status=1 order by name asc';
									$rs=GetPageRecord($select,_BUYER_MASTER_,$where);
									while($resListing=mysqli_fetch_array($rs)){
									?>
								  <option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$_GET['buyerId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
								  <?php } ?>
								</select>
							</div>
						</div>
						<div class="col-md-1">
							<div class="">
								<select id="brandId" name="brandId" class="form-control" displayname="Brand" onchange="changeBrand(this.value);">
									<option value="">Brand</option>
								</select>
							</div>
						</div>
<script>
function changeBuyer(buyerId){
	$('#brandId').load('loadbrand.php?buyerId='+buyerId+'&selectId=<?php echo $_GET['brandId']; ?>&action=changebrandaction');
}
changeBuyer('<?php echo $_GET['buyerId']; ?>');
</script>
						<div class="col-md-2">
							<div class="">
								<input name="startDate" type="text" class="form-control" id="startDate" value="<?php echo $_GET['startDate']; ?>" placeholder="Line Loading Date" readonly="">
							</div>
						</div>

						<div class="col-md-2" >
							<div class="">
								<input name="endDate" type="text" class="form-control" id="endDate" value="<?php echo $_GET['endDate']; ?>" placeholder="Off Machine Date" readonly="">
							</div>
						</div>

						<!-- <div class="col-md-1" >
							<div class="">
								<input name="sam" type="number" class="form-control" id="sam" value="<?php echo $_GET['sam']; ?>" placeholder="SAM" >
							</div>
						</div> -->

						<div class="col-md-1">
							<div class="">
								<select id="autoManual" name="autoManual" class="form-control" >
									<option value="auto" <?php if($_REQUEST['autoManual']=='auto'){ echo 'selected'; } ?>>Auto</option>
									<option value="manual" <?php if($_REQUEST['autoManual']=='manual'){ echo 'selected'; } ?>>Manual</option>
								</select>
							</div>
						</div>

						<div class="col-md-1">
							<div class="">
								<input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">
							</div>
						</div>

						<div class="col-md-2">

						<div class="" style="text-align: center; background-color: #ffe599; padding: 8px; width: 100%;">Busy Lines - <span style="padding: 2px 10px; border: 2px solid #ff0000;">&nbsp;</span></div>


						</div>

<div class="col-md-2" style="text-align:right;">
<div class="" style="text-align: center; background-color: #ffe599; padding: 8px; width: 100%;">Style Color - <span style="height: 20px; width: 20px; color: #fff; padding: 5px 15px; border: 1px solid #fff;background-color:<?php echo $editresultstyle['styleColor']; ?>"> <?php echo $editresultstyle['styleColor']; ?> </span></div>
						</div>

						<!--<div class="col-md-2" style="text-align:right;">
	<div class="" style="text-align: center; background-color: #ffe599; padding: 8px; width: 100%;">Style Quantity - <?php echo $totalstylequantity; ?></div>
						</div>	-->




				  </div>
				</form>


				</div>

				</div>


				<div class="row">

				<?php if($_GET['startDate']!='' && $_GET['endDate']!=''){ ?>
				<div class="col-xl-12" id="abc">
				<table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-responsive">

				<?php

				if($_REQUEST['factoryId']!=''){
				$f=GetPageRecord('*','factoryMaster',' id="'.$_REQUEST['factoryId'].'" order by id asc');
				} else {
				$f=GetPageRecord('*','factoryMaster','1 order by id asc');

				}




				$no=1;

				while($factoryData=mysqli_fetch_array($f)){

				$finalvalue=0;
				$mainvaluedaywise=0;
				$abcfinalcheck=0;


				?>

				<tbody id="projectionplan<?php echo $factoryData['id']; ?>" style="display:block !important;"></tbody>

			 	<script>
				var setAuto = "<?php echo $_REQUEST['autoManual']; ?>";

				if(setAuto=="auto"){
					$('#projectionplan<?php echo $factoryData['id']; ?>').load('loadprojectionplan.php?id=<?php echo $factoryData['id']; ?>&startDate=<?php echo $_REQUEST['startDate']; ?>&endDate=<?php echo $_REQUEST['endDate']; ?>&styleid=<?php echo $editresultstyle['id']; ?>&factoryId=<?php echo $_REQUEST['factoryId']; ?>&brandId=<?php echo $_REQUEST['brandId']; ?>&buyerId=<?php echo $_REQUEST['buyerId']; ?>&autoManual=<?php echo $_REQUEST['autoManual']; ?>');
				}else{
					$('#projectionplan<?php echo $factoryData['id']; ?>').load('loadprojectionplanmanual.php?id=<?php echo $factoryData['id']; ?>&startDate=<?php echo $_REQUEST['startDate']; ?>&endDate=<?php echo $_REQUEST['endDate']; ?>&styleid=<?php echo $editresultstyle['id']; ?>&factoryId=<?php echo $_REQUEST['factoryId']; ?>&brandId=<?php echo $_REQUEST['brandId']; ?>&buyerId=<?php echo $_REQUEST['buyerId']; ?>&autoManual=<?php echo $_REQUEST['autoManual']; ?>');
				}

				</script>

			    <?php $no++; } ?>
                  </table>
				</div>
				<?php } else{ ?>

				<div class="col-md-12" style="margin-bottom: 20px; padding: 10PX 20PX; font-size: 16px; color: #0288d1; text-align: left;">Select Date Range</div>

				<?php } ?>
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
			 </div>
		 </div>
 <style>
.table td, .table th, .table tr {
    padding: 0px 6px !important;
}
</style>
