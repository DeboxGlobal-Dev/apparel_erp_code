<?php

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


?>
<div class="page-content">
<style>
.line-report tr td{
 border:1px solid #ccc;
}
</style>

		<div class="content-wrapper">
	 	<?php include "savealert.php"; ?>
	 	<div class="content pt-0" style="margin-top:20px;">
			 	<div class="row">
				<div class="col-xl-12">

				<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
						 <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">

				 		</div></div>
					</div>


<div class="card">

 <form name"search" method="GET" action="">
			 	<input type="hidden"  name="module" value="<?php echo $_GET['module']; ?>"/>
		  	   <input type="hidden"  name="styleid" value="<?php echo $_GET['styleid']; ?>"/>

				<div class="row" style="padding:15px;">
						<div class="col-md-2">
							<div class="">
								<select id="factoryId" name="factoryId" class="form-control" displayname="Factory Id" onchange="loadLines(this.value);">
								 <option value="">Select Factory</option>
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

						<div class="col-md-2">
							<div class="">
								<input name="startDate" type="text" class="newDatePicker form-control" id="startDate" value="<?php echo $_GET['startDate']; ?>" placeholder="Line Loading Date" readonly="">
							</div>
						</div>

						<div class="col-md-2" >
							<div class="">
								<input name="endDate" type="text" class="newDatePicker form-control" id="endDate" value="<?php echo $_GET['endDate']; ?>" placeholder="Off Machine Date" readonly="">
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
				 <div class="row">

				<?php if($_GET['startDate']!='' && $_GET['endDate']!='' && $_GET['factoryId']!=''){ ?>
				<div class="col-xl-12">
				<table width="100%" border="0" cellpadding="5" cellspacing="0" id="abc" class="table table-responsive" style="border:1px solid #ddd; background-color:#fff;">

			       <tr height="17" style="background-color:#ece9e9; font-weight:500; text-align:center;">

                  <td style="background-color: #ffdc5c;">Total</td>

					  <?php

					  foreach($_GET['lines'] as $line){
					  $rs=GetPageRecord('*','factoryLineMaster','1 and id="'.$line.'" order by id desc');
					  $lineName=mysqli_fetch_array($rs);

					   ?>
					  <td colspan="4"><?php echo $lineName['lineName']; ?></td>
                      <?php } ?>
					</tr>

					<tr height="17">

					<td align="center" style="vertical-align: top; padding-left: 0px !important; padding-right: 0px !important; padding:0px !important;">
					  <p style="background-color: #ffdc5c; padding-bottom: 20px !important; margin:0px !important;">&nbsp;</p>

					<table>
					 	<?php

						$startDate=date('Y-m-d',strtotime($_REQUEST['startDate']));
						$endDate=date('Y-m-d',strtotime($_REQUEST['endDate'] . ' +1 day'));

						$begin = new DateTime($startDate);
						$end = new DateTime($endDate);

						$interval = DateInterval::createFromDateString('1 day');
						$period = new DatePeriod($begin, $interval, $end);


						$linename='';
						foreach($_GET['lines'] as $line){
						$linename.=$line.',';
						}
						$linename=rtrim($linename,',');

						foreach ($period as $dt) {

						$abc=date('Y-m-d',strtotime($dt->format("d-m-Y")));

						$vb=GetPageRecord('sum(dateWiseLineInput) as totalValues','linePlanMaster','1 and factoryId="'.$_REQUEST['factoryId'].'" and lineId in ('.$linename.') and uploadInputDate="'.$abc.'"');

$linewisetotal=mysqli_fetch_array($vb);


						?>

						<tr>

<td align="center" style="background-color: #ffdc5c; border-top:1px solid #ddd;"><div style=" min-height:49px;vertical-align: middle;padding-top: 18px; width:50px;"><?php echo $linewisetotal['totalValues']; ?></div></td>
						</tr>
					 	<?php } ?>

					</table>


					</td>


	  			     <?php

					  foreach($_GET['lines'] as $line){
					  $rs=GetPageRecord('*','factoryLineMaster','1 and id="'.$line.'" order by id desc');
					  $lineName=mysqli_fetch_array($rs);
					  ?>

					  <td colspan="4" style="padding:0px !important;">


				   <table  width="100%" class="table-responsive line-report" style="font-size:11px !important;">

<tr style="background-color: #ffebaf;">

<td align="center">Date</td>

<td align="center">Style</td>
<td align="center">Order Qty.</td>
<td align="center">Today</td>
<td align="center">Till&nbsp;Date</td>
<td align="center">Balance&nbsp;To&nbsp;Produce</td>

</tr>


<?php
$startDate=date('Y-m-d',strtotime($_REQUEST['startDate']));
$endDate=date('Y-m-d',strtotime($_REQUEST['endDate'] . ' +1 day'));

$begin = new DateTime($startDate);
$end = new DateTime($endDate);

$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);

foreach ($period as $dt) {

$abc=date('Y-m-d',strtotime($dt->format("d-m-Y")));


$k=GetPageRecord('*','linePlanMaster','1 and factoryId="'.$_REQUEST['factoryId'].'" and lineId="'.$line.'" and uploadInputDate="'.$abc.'"');

$showstylecolor=mysqli_fetch_array($k);

$kkkkkkk=GetPageRecord('*','queryMaster','1 and id="'.$showstylecolor['styleId'].'"');
$queryData=mysqli_fetch_array($kkkkkkk);

$rsqty=GetPageRecord('qtyTotal','buyerPurchaseOrderMaster','styleId="'.$queryData['id'].'" order by id desc');
$resultqty=mysqli_fetch_array($rsqty);

?>

<tr>

<td align="center"><div style="min-height:49px;vertical-align: middle;padding-top: 18px; width:70px;"><?php  echo $dt->format("d-m-Y");  ?></div></td>

<td align="center" style="border: 1px solid #ece9e9; color:#fff;background-color:<?php echo $queryData['styleColor']; ?>"><div style="width:120px;"><?php echo $queryData['subject']; ?></div></td>

<td align="center" style="border: 1px solid #ece9e9;"><div style="width:50px"><?php echo $resultqty['qtyTotal']; ?></div></td>
<td align="center" style="border: 1px solid #ece9e9;"><div style="width:50px"><?php echo $showstylecolor['dateWiseLineInput']; ?></div></td>

<td align="center" style="border: 1px solid #ece9e9;"><div style="width:50px"><?php echo  $showstylecolor['linewiseefficiency']; ?></div></td>
<td align="center" style="border: 1px solid #ece9e9;"><div style="width:50px"><?php echo $resultqty['qtyTotal']-$showstylecolor['linewiseefficiency']; ?></div></td>
</tr>
<?php  } ?>

</table>

  </td>
  <?php } ?>


					</tr>


                  </table>
				</div>

				<?php } else{ ?>
				<div class="col-md-12" style="margin-bottom: 20px; padding: 10PX 20PX; font-size: 16px; color: #0288d1; text-align: left;">Select Filters</div>
				<?php } ?>
				</div>




				</div></div>




				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


			<!-- Footer -->

			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>


