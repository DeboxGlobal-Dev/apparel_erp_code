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

if($_GET['so']!=''){

$update = updatelisting('queryMaster','requestSo="'.$_GET['so'].'"','id="'.decode($_GET['styleid']).'"');
?>
<script>

</script>
<?php
}

?>
	<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<!--/main sidebar -->

		<!-- Main content -->



			<div class="content pt-0" style="margin-top:20px;">



			  <?php include "top-style.php"; ?>

			<?php if($_GET['pdoutsource']=='yes' && $_GET['styleid']!=''){ ?>

			<?php if($editresultstyle['styleTypeId']=='3'){ ?>


			<div class="row">

			<?php
			$cvid =1;
			$rsv=GetPageRecord('*','materialSendToVendor','styleId="'.decode($_GET['styleid']).'" and pd=2 group by cvId desc');
			while($resV=mysqli_fetch_array($rsv)){
			?>

				<div class="col-xl-12">
					<div id="accordion-default">
						<div class="card">
									<div class="card-header" style="background-color: white;">
										<h6 class="card-title">
											<a data-toggle="collapse" class="collapsed" href="#accordion-item-default<?php echo $cvid; ?>" aria-expanded="false" style="width: 70%; display: block; float: left;"><i class="fa fa-files-o" aria-hidden="true" style="position: relative;float: left;margin-right: 9px;font-size: 19px;"></i>Comparison Sheet <span>Version - <?php echo $cvid; ?></span></a>
											<?php if($loginuserprofileId=='156' || $loginuserprofileId=='90'){ ?>
											<?php if($editresultstyle['requestSo']!=$cvid){ ?>
											<a  href="#" onclick="requestForSo('<?php echo $cvid; ?>');"  style="right: 0px; float: right; position: relative;"><span class="btn btn-primary"><i class="fa fa-telegram" aria-hidden="true" style="position: relative;float: left;margin-right: 9px;font-size: 19px; "></i>Request SO</span></a>
											<?php  }else{ ?>
											<a  href="#" style="right: 0px; float: right; position: relative;"><span class="btn btn-success"><i class="fa fa-telegram" aria-hidden="true" style="position: relative;float: left;margin-right: 9px;font-size: 19px; "></i>Requested</span></a>
											<?php } ?>
											<?php } ?>
											<?php if($loginuserprofileId=='1' || $loginuserprofileId=='93'){ ?>
											<a  href="#"   style="right: 0px; float: right; position: relative;"><span class="btn btn-success">Approve</span></a>
											<a  href="#"   style="right: 0px; float: right; position: relative;"><span class="btn btn-warning">Re-Assign</span></a>
											<?php  } ?>

										</h6>
									</div>
								<form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="popid" target="acf" id="popid">

									<div id="accordion-item-default<?php echo $cvid; ?>" class="collapse" data-parent="#accordion-default" style="">
										<div class="card-body">
											<div class="card mb-0 rounded-bottom-0" style="padding:15px;">
				 	<div class="panel panel-flat">
					<div style="width:33%; float:left;">
					<div class="headingcss"><strong>Inhouse Cost</strong></div>
					 <div class="table-responsive">
					    <table width="100%" class="table table-bordered" style="display:block;" id="inhousecost">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
							  <td width="18%" align="left"><strong>Material</strong></td>
                              <td width="18%" align="left"><strong>Description</strong></td>
							  <td width="8%" align="left"><strong>Avg.</strong></td>
							  <td width="8%" align="left"><strong>Unit</strong></td>
							  <td width="8%" align="left"><strong>Rate</strong></td>
							  <td width="8%" align="left"><strong>Value</strong></td>


                            </tr>

							<?php
							$sNo1 = 0;
							$rowno=0;
						    $rstype=GetPageRecord('*','materialTypeMaster','1 order by id asc');
							while($resListingtype=mysqli_fetch_array($rstype)){
                         	?>
							<tr class="card-body">
							<td width="100%" align="left" colspan="20" style="background-color: #e5fbfa;text-transform: uppercase;font-size: 9px;"><strong><?php echo $resListingtype['name']; ?></strong></td>
							</tr>

							<?php
							$totalfinalval = 0;
							$totalbomrate=0;
						    $rs1=GetPageRecord('*','styleSubCategoryMaster','materialType="'.$resListingtype['id'].'" and styleId="'.decode($_REQUEST['styleid']).'" and costsheetVersionId=1 order by sr asc');
							$rs2=GetPageRecord('*','styleSubCategoryMaster','styleId="'.decode($_REQUEST['styleid']).'" and costsheetVersionId=1 order by sr asc');
							$rowcount=mysqli_num_rows($rs2);
							while($resListing1=mysqli_fetch_array($rs1)){
							$rowno++;
							$sNo1=$rowno;
							$rs121=GetPageRecord('*','techPackDetailMaster',' bomSerialNo="'.$sNo1.'" and sectionType="bom" and styleId="'.decode($_REQUEST['styleid']).'" and costsheetVersionId=1 order by id asc');
							$resListing12=mysqli_fetch_array($rs121);
							$totalfinalval = $totalfinalval+$resListing12['bomvalueonepc'];
							$totalbomrate = $totalbomrate+$resListing12['bomRate'];
							?>
							<tr>
							 	<td align="left" ><?php echo $resListing1['name']; ?></td>
								<td align="left" ><?php echo $resListing1['newmaterialdescription']; ?></td>
								<td align="center" ><input type="checkbox" name="avg[]" value="<?php echo $resListing12['bomAvg']; ?>,<?php echo $resListing1['materialType']; ?>,<?php echo $resListing1['materialid']; ?>,<?php echo $resListing12['bomRate']; ?>" /><?php echo $resListing12['bomAvg']; ?></td>
								<td align="center" ><?php echo $resListing12['bomUnit']; ?></td>
							<td align="center" ><input type="checkbox" name="rate[]" value="<?php echo $resListing12['bomRate']; ?>" /><?php echo $resListing12['bomRate']; ?></td>
								<td align="center" ><?php echo $resListing12['bomvalueonepc']; ?></td>
							</tr>


						  <?php }  ?>

						  <tr>
							 	<td align="center"></td>
								<td align="center"></td>
								<td align="center"></td>
								<td align="center"><strong>Total</strong></td>
								<td align="center"><?php echo $totalbomrate; ?></td>
								<td align="center"><?php echo $totalfinalval; ?></td>
							</tr>

						  <?php  }  ?>
							<input type="hidden" name="styleId" value="<?php echo $_GET['styleid']; ?>" />

						</tbody>

                        </table>
					  </div>
					 </div>


<?php
$totalCost=0;
$where='styleId="'.decode($_GET['styleid']).'" and pd=2 group by vendorId asc';
$rs=GetPageRecord('*','materialSendToVendor',$where);
while($resListing=mysqli_fetch_array($rs)){
?>

<?php
$sr=1;

if($_REQUEST['module']=="style"){
$where11='styleid='.$resListing['styleId'].' order by id desc';
}
if($_REQUEST['module']=="comparevendorcost"){
$where11='styleid='.$resListing['styleId'].' and vendorid="'.$resListing['vendorId'].'" and pd="'.$resListing['pd'].'" and status=1 order by id asc';
}

$rs11=GetPageRecord('*','vendorPurchasemail',$where11);
while($supplierlisting=mysqli_fetch_array($rs11)){


$rs12=GetPageRecord('*','vendorMaster','id="'.$resListing['vendorId'].'"');
$resListing12=mysqli_fetch_array($rs12);

$rsk=GetPageRecord('sum(valueOnePiece) as totalCost','materialSendToVendor','vendorPurchaseEmailId="'.$supplierlisting['id'].'"');
$rkdm=mysqli_fetch_array($rsk);
$totalCost=$rkdm['totalCost'];

?>

					 <div style="width:22%; float:left; margin-left:10px;">
					 <div class="headingcss"><strong><?php echo $resListing12['name']; ?></strong> - <span style="font-size: 11px;"><?php echo date('d-M-Y h:i A',$supplierlisting['adddate']); ?></span></div>
					 <div class="table-responsive">
					    <table width="100%" class="table table-bordered" style="display:block;" id="inhousecost">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
							  <td width="12%" align="left"><strong>Avg.</strong></td>
							  <td width="12%" align="left"><strong>Unit</strong></td>
							  <td width="12%" align="left"><strong>Rate</strong></td>
							  <td width="12%" align="left"><strong>Value</strong></td>
                              <td width="12%" align="left"><strong>Remark</strong></td>
                            </tr>

							<?php
							$sNo1 = 0;
							$rowno=0;
						    $rstype=GetPageRecord('*','materialTypeMaster','1 order by id asc');
							while($resListingtype=mysqli_fetch_array($rstype)){
                         	?>
							<tr class="card-body">
							<td width="100%" align="left" colspan="20" style="background-color: #e5fbfa;text-transform: uppercase;font-size: 9px;"><strong><?php echo $resListingtype['name']; ?></strong></td>
							</tr>

							<?php
							$totalvendorbom=0;
							$totalvendorfinal=0;

						  	$rs1=GetPageRecord('*','materialSendToVendor','styleId="'.decode($_REQUEST['styleid']).'" and costsheetVersionId=1 and materialTypeId="'.$resListingtype['id'].'" and vendorPurchaseEmailId="'.$supplierlisting['id'].'" order by id asc');
							while($resListing1=mysqli_fetch_array($rs1)){

							$totalvendorbom=$totalvendorbom+$resListing1['valueOnePiece'];
							$totalvendorfinal=$totalvendorfinal+$resListing1['avg']*$resListing1['valueOnePiece'];

							?>
							<tr>
							 	<td align="center" ><input type="checkbox" name="avg[]" value="<?php echo $resListing1['avg']; ?>,<?php echo $resListing1['materialTypeId']; ?>,<?php echo $resListing1['materialId']; ?>,<?php echo $resListing1['valueOnePiece']; ?>" /><?php  echo $resListing1['avg']; ?></td>
								<td align="center"><?php  echo $resListing1['unitName']; ?></td>
								<td align="center"><input type="checkbox" name="rate[]" value="<?php echo $resListing1['valueOnePiece']; ?>" /><?php echo $resListing1['valueOnePiece']; ?></td>
								<td align="center"><?php echo $resListing1['avg']*$resListing1['valueOnePiece']; ?></td>
								<td align="left"><?php echo $resListing1['vendorRemark']; ?></td>
							</tr>
						  <?php } ?>
						  <tr>

								<td align="center"></td>
								<td align="center"><strong>Total</strong></td>
								<td align="center"><?php echo $totalvendorbom; ?></td>
								<td align="center"><?php echo $totalvendorfinal; ?></td>
								<td align="center"></td>
							</tr>

						  <?php   } ?>

						</tbody>

                        </table>
					  </div>
					 </div>


<?php  } ?>



<?php } ?>


	<div style="width:20%; float:left; margin-left:10px;">
					 <div class="headingcss"><strong>Tight Cost</strong></div>
					 <div class="table-responsive">
					    <table width="100%" class="table table-bordered" style="display:block;" id="inhousecost">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
							  <td width="12%" align="left"><strong>Avg.</strong></td>
							  <td width="12%" align="left"><strong>Unit</strong></td>
							  <td width="12%" align="left"><strong>Rate</strong></td>
							  <td width="12%" align="left"><strong>Value</strong></td>
                             </tr>

							<?php
							$sNo1 = 0;
							$rowno=0;
						    $rstype=GetPageRecord('*','materialTypeMaster','1 order by id asc');
							while($resListingtype=mysqli_fetch_array($rstype)){


                         	?>
							<tr class="card-body">
							<td width="100%" align="left" colspan="20" style="background-color: #e5fbfa;text-transform: uppercase;font-size: 9px;"><strong><?php echo $resListingtype['name']; ?></strong></td>
							</tr>

							<?php
							$totalvendorbom=0;
							$totalvendorfinal=0;
							$rs12=GetPageRecord('*','tightCostMaster','styleId="'.decode($_REQUEST['styleid']).'" and materialTypeId="'.$resListingtype['id'].'" order by id asc');
							while($resListing12=mysqli_fetch_array($rs12)){

							$rss1=GetPageRecord('*','materialSendToVendor','styleId="'.decode($_REQUEST['styleid']).'" and materialId="'.$resListing12['materialId'].'" and costsheetVersionId=1 and materialTypeId="'.$resListingtype['id'].'" order by id desc');
							$rss=mysqli_fetch_array($rss1);


							$totalvendorbom=$totalvendorbom+$resListing12['rate'];
							$totalvendorfinal=$totalvendorfinal+$resListing12['avg']*$resListing12['rate'];
							?>
							<tr>
							 	<td align="left"><?php  echo $resListing12['avg']; ?></td>
								<td align="left"><?php  echo $rss['unitName']; ?></td>
								<td align="left"><?php  echo $resListing12['rate']; ?></td>
								<td align="left"><?php  echo $resListing12['avg']*$resListing12['rate']; ?></td>

							</tr>
						  <?php } ?>
						  <tr>

								<td align="left"></td>
								<td align="left"><strong>Total</strong></td>
								<td align="left"><?php echo $totalvendorbom; ?></td>
								<td align="left"><?php echo $totalvendorfinal; ?></td>

							</tr>

						  <?php   } ?>

						</tbody>

                        </table>
					  </div>
					 </div>


					</div>


</div>

					<?php if($loginuserprofileId=='156' || $loginuserprofileId=='90'){ ?>
					<div class="text-left" style="margin: 20px 0px; width: 70%; float: left;">
								<button type="button" class="btn bg-danger" onclick="createDuplicate();">  Create New Version  </button>
					</div>

					<div class="text-right" style="width: 30%; float: right; margin: 20px 0px;">
								<input type="hidden" name="action" value="savetightcost" />
								<button type="submit" class="btn bg-info">  Save  </button>
					</div>
					<?php } ?>
										</div>



									</div>


									</form>
								</div>
					 </div>
				</div>

			<?php $cvid++;  } ?>



<?php
$totalCost=0;
$select='*';
$where='styleId="'.decode($_GET['styleid']).'" and pd=2 group by vendorId asc';
$rs=GetPageRecord($select,'materialSendToVendor',$where);
while($resListing=mysqli_fetch_array($rs)){

$select12='*';
$where12='id="'.$resListing['vendorId'].'"';
$rs12=GetPageRecord($select12,'vendorMaster',$where12);
$resListing12=mysqli_fetch_array($rs12);


$rsk=GetPageRecord('sum(valueOnePiece) as totalCost','materialSendToVendor','styleId="'.decode($_GET['styleid']).'" and vendorId="'.$resListing12['id'].'" order by id desc');
$rkdm=mysqli_fetch_array($rsk);
$totalCost=$rkdm['totalCost'];

?>

<div class="col-xl-12" style="">
				 <div class="card">
							 <div class="card-body navbar-green"   >
							<div class="media">
									 <div class="col-xl-4" style="padding:0px;">
									<h6 class="media-title font-weight-semibold">
<i class="fa fa-user" aria-hidden="true" style="position: relative;float: left;margin-right: 9px;font-size: 19px;color: #0d7544;"></i>
<div style="font-size: 15px;color: #0d7545;font-weight: 600;text-transform: uppercase;"><?php echo $resListing12['name']; ?></div>

									</h6>
									</div>

									<!--<div class="col-xl-8" style="padding:0px;">

									<div style="width: 40%; float: left; display: block; text-align: center;">

<div style="font-size: 15px; color: #000; float: left; width: 100%; display: block; text-align: center; background-color: #c1e0f3; padding: 2px 5px;">
<span>Final Cost: <?php echo $totalCost; ?></span>
<input type="checkbox" class="form-input-styled" id="defaultVendor<?php echo $resListing['id']; ?>"  data-fouc="">
</div>

									</div>

									<div>
<?php if($resListing['attachment']!=''){ ?>
<button class="btn btn-success" style="padding: 5px; margin-left:70px; float:right;"><i class="fa fa-download"></i> <a href="<?php echo $fullurl.'images/'.$resListing['attachment']; ?>" target="_blank" style="font-size: 12px; color: #FFFFFF; padding: 0PX 5PX;">Download File</a></button>
<?php } ?>


									</div>
									</div>-->
							  </div>
						</div>

							<div class="card-body">
								<div class="tab-content">

									<div class="tab-pane active show" id="solid-rounded-justified-tab1" >
										<div id="loadvendorcommunication<?php echo $resListing['id']; ?>"></div>
									</div>
								</div>
							</div>
						</div>
				 </div>
<script>
 function loadvendorcommunication<?php echo $resListing['id']; ?>(){
 $('#loadvendorcommunication<?php echo $resListing['id']; ?>').load('loadvendorcommunication.php?id=<?php echo decode($_GET['styleid']); ?>&vendorId=<?php echo $resListing12['id']; ?>&module=<?php echo $_GET['module']; ?>&pd=2');
 }
 loadvendorcommunication<?php echo $resListing['id']; ?>();

</script>
<?php } ?>

<script>
function showView(){
$(".showhide").text("View Cost");
}
</script>


					</div>
		<?php	}else{	?>

			<div class="row">

				<div class="col-xl-12">


</div>

<?php
$select='*';
$where='styleId="'.decode($_GET['styleid']).'" and pd=1 group by vendorId asc';
$rs=GetPageRecord($select,'materialSendToVendor',$where);
while($resListing=mysqli_fetch_array($rs)){

$select12='*';
$where12='id="'.$resListing['vendorId'].'"';
$rs12=GetPageRecord($select12,'vendorMaster',$where12);
$resListing12=mysqli_fetch_array($rs12);
?>

<div class="col-xl-6" style="margin-top:20px;">
				 <div class="card">
							 <div class="card-body navbar-green"   >
							<div class="media">
									 <div class="col-xl-5" style="padding:0px;">
									<h6 class="media-title font-weight-semibold">
<i class="fa fa-user" aria-hidden="true" style="position: relative;float: left;margin-right: 9px;font-size: 19px;color: #0d7544;"></i>
<div style="font-size: 15px;color: #0d7545;font-weight: 600;text-transform: uppercase;"><?php echo $resListing12['name']; ?></div>

									</h6>
									</div>

									<div class="col-xl-7" style="padding:0px;">

									<h6 class="media-title font-weight-semibold">

<div style="font-size: 15px;color: #2546e4;float:left;"><span>Final Cost:</span> <span><?php echo $resListing['valueOnePiece']; ?></span>
<input type="checkbox" class="form-input-styled" id="defaultVendor<?php echo $resListing['id']; ?>"  data-fouc="">
</div>
<?php if($resListing['attachment']!=''){ ?>
<button class="btn btn-success" style="padding: 5px; margin-left:70px; float:right;"><i class="fa fa-download"></i> <a href="<?php echo $fullurl.'images/'.$resListing['attachment']; ?>" target="_blank" style="font-size: 11px; color: #FFFFFF; padding: 0px 5px;">Download File</a></button>
<?php } ?>
									</h6>
									</div>
							 </div>
						</div>

							<div class="card-body">
								<div class="tab-content">

									<div class="tab-pane active show" id="solid-rounded-justified-tab1" >
										<div id="loadvendorcommunication<?php echo $resListing['id']; ?>"></div>
									</div>
								</div>
							</div>
						</div>
				 </div>
<script>
 function loadvendorcommunication<?php echo $resListing['id']; ?>(){
 $('#loadvendorcommunication<?php echo $resListing['id']; ?>').load('loadvendorcommunication.php?id=<?php echo decode($_GET['styleid']); ?>&vendorId=<?php echo $resListing12['id']; ?>&module=<?php echo $_GET['module']; ?>&pd=1');
 }
 loadvendorcommunication<?php echo $resListing['id']; ?>();

</script>
<?php } ?>

<script>
function showView(){
$(".showhide").text("View Cost");
}
</script>


					</div>

			<?php } } ?>
                </div>
			 </div>
			 </div>
		 </div>

<style>
#inhousecost tr td{
padding: 2px;
font-size: 10px;
position: relative;
height: 36px;
vertical-align: middle;
}
.headingcss {
    padding: 5px 5px;
    color: #fff;
    font-size: 11px;
    background-color: #0cd87f;
}
input[type=checkbox], input[type=radio] {
    box-sizing: border-box;
    padding: 0;
    height: 12px;
    width: 12px;
    position: absolute;
    left: 0px;
    top: 12px;
}
</style>
<script>

function createDuplicate(){
var conf = confirm('Confirm are you sure you want to duplicate?');

if(conf==true){
alert('Yes');
}

}

function requestForSo(cvid){

var conf = confirm('Are you sure you want to Send?');

if(conf==true){
window.location.href="<?php echo $fullurl; ?>showpage.crm?module=comparevendorcost&view=yes&styleid=<?php echo $_GET['styleid']; ?>&pdoutsource=yes&so="+cvid;
}


}
</script>
