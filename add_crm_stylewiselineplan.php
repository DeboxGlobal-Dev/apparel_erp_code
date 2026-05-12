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

?>
	<div class="page-content">

	 <?php include "left.php"; ?>
	 	<div class="content-wrapper">


 	<div class="content pt-0" style="margin-top:20px; overflow:hidden;">
			 	<?php include "top-style.php"; ?>


				<div class="row">

				<div class="col-xl-12">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Style wise Line Allocation</h6>
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

						<div class="col-md-2">
							<div class="">
								<input name="startDate" disabled="disabled" type="text" class="form-control" id="startDate" value="<?php echo $_GET['startDate']; ?>" placeholder="Line Loading Date" readonly="">
							</div>
						</div>

						<div class="col-md-2" >
							<div class="">
								<input name="endDate" disabled="disabled" type="text" class="form-control" id="endDate" value="<?php echo $_GET['endDate']; ?>" placeholder="Off Machine Date" readonly="">
							</div>
						</div>


						<div class="col-md-4">&nbsp;</div>

<div class="col-md-2" style="text-align:right;">
<div class="" style="text-align: center; background-color: #ffe599; padding: 8px; width: 100%;">Style Color - <span style="height: 20px; width: 20px; color: #fff; padding: 5px 15px; border: 1px solid #fff;background-color:<?php echo $editresultstyle['styleColor']; ?>"> <?php echo $editresultstyle['styleColor']; ?> </span></div>
						</div>

						<div class="col-md-2" style="text-align:right;">
	<div class="" style="text-align: center; background-color: #ffe599; padding: 8px; width: 100%;">Style Quantity - <?php echo $totalstylequantity; ?></div>
						</div>

				  </div>
				</form>


				</div>

				</div>





				<div class="row">

				<div class="col-xl-12" id="abc">

				 <?php
					$f=GetPageRecord('*','factoryMaster',' id="'.$_REQUEST['factoryId'].'"');
					$factoryData=mysqli_fetch_array($f);
				 ?>
		<div style="padding:10px; font-size:16px; font-weight:600; background-color:#F8F8F8; margin-top:10px; position: relative;"><?php echo $factoryData['name']; ?></div>


				<table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-responsive">

<tr style="background-color:#ece9e9; font-weight:500; text-align:center;">

<?php

$lineQ=GetPageRecord('*','linePlanMaster','1 and styleId="'.$editresultstyle['id'].'" and uploadInputDate between "'.date('Y-m-d',strtotime($_GET['startDate'])).'" and "'.date('Y-m-d',strtotime($_GET['endDate'])).'" group by lineId');

while($lineplanData=mysqli_fetch_array($lineQ)){

$ld=GetPageRecord('*','factoryLineMaster','1 and id="'.$lineplanData['lineId'].'"');
$lineData=mysqli_fetch_array($ld);
 	 ?>

<td colspan="4"><div style="padding:5px;"><?php echo $lineData['lineName']; ?></div></td>

   <?php }?>

 </tr>




<tr>


<?php
$lineQ='';
$lineplanData='';
$ld='';
$lineData='';


$lineQ=GetPageRecord('*','linePlanMaster','1 and styleId="'.$editresultstyle['id'].'" and uploadInputDate between "'.date('Y-m-d',strtotime($_GET['startDate'])).'" and "'.date('Y-m-d',strtotime($_GET['endDate'])).'" group by lineId');

while($lineplanData=mysqli_fetch_array($lineQ)){  ?>


<td align="center" valign="middle" colspan="4">

<table  width="100%" class="table-responsive" style="font-size:11px !important;">

<?php
$startDate=date('Y-m-d',strtotime($_GET['startDate']));
$endDate=date('Y-m-d',strtotime($_GET['endDate'] . ' +1 day'));

$begin = new DateTime($startDate);
$end = new DateTime($endDate);

$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);

foreach ($period as $dt) {

$abc=date('Y-m-d',strtotime($dt->format("d-m-Y")));

$k=GetPageRecord('*','linePlanMaster','1 and styleId="'.$editresultstyle['id'].'"  and factoryId="'.$factoryData['id'].'" and lineId="'.$lineplanData['lineId'].'" and uploadInputDate="'.$abc.'"');

$showstylecolor=mysqli_fetch_array($k);


$kkkkkkk=GetPageRecord('*','queryMaster','1 and id="'.$showstylecolor['styleId'].'"');
$queryData=mysqli_fetch_array($kkkkkkk);


?>

<tr>

<td><div style="min-height:49px;vertical-align: middle;padding-top: 18px; width:70px;"><?php if($queryData['subject']!=''){ ?> <?php  echo $dt->format("d-m-Y");  ?> <?php } ?></div></td>

<td <?php if($queryData['subject']!=''){ ?> style="background-color:<?php echo $editresultstyle['styleColor']; ?>; color:#ffffff;" <?php } ?>><div style="width:120px;"><?php echo $queryData['subject']; ?></div></td>
<td><?php echo $showstylecolor['dateWiseLineInput']; ?></td>
<td><?php echo round($showstylecolor['linewiseefficiency']); ?></td>

</tr>

<?php    } ?>

</table>
</td>
<?php } ?>
 </tr>





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
 </div>
			 </div>
		 </div>

 <style>
.table td, .table th, .table tr {
    padding: 0px 6px !important;
}
</style>
