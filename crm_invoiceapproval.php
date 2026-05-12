	<div class="page-content">
     <div class="content-wrapper">

		   <div class="content pt-0" style="margin-top: 20px; width: 100%; margin-left: auto; margin-right: auto;">
 	 <div class="row">
			 				<div class="col-xl-12">

							 <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
						 <div class="col-xl-3" style="padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
 						 </div></div>
					</div>
								<div class="card border-left-3 border-left-danger-400 rounded-left-0" style="border: 1px solid #ccc !important;">

								<div class="card-body">

								<div class="row">


								<div class="col-md-12">


 <form name"search" method="GET" action="">
			 	<input type="hidden"  name="module" value="<?php echo $_GET['module']; ?>"/>
				<div class="row" style="padding:15px 0px;">

				<div class="col-md-2">
							<div class="">
								<input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" class="form-control" />
							</div>
						</div>


<script>
$( function(){
	$( "#startDate" ).datepicker();
} );

$( function(){
	$( "#endDate" ).datepicker();
} );
</script>

						<div class="col-md-2">
							<div class="">
								<input name="startDate" type="text" class="form-control" id="startDate" value="<?php echo $_GET['startDate']; ?>" placeholder="From Date" readonly="">
							</div>
						</div>

						<div class="col-md-2" >
							<div class="">
								<input name="endDate" type="text" class="form-control" id="endDate" value="<?php echo $_GET['endDate']; ?>" placeholder="To Date" readonly="">
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



								<div class="col-md-12">
									<table width="100%" border="1" cellpadding="5" cellspacing="0" class="table" style="font-size: 12px !important; width: 100%; border: 1px solid #ccc !important;">

									<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
									  <td align="center">SR</td>
									<td align="center"><div align="left">Date</div></td>
									<td align="center"><div align="left">Company</div></td>
									<td align="center"><div align="left">Invoice&nbsp;No</div></td>
									<td align="center"><div align="left">Buyer Name </div></td>
									<td align="center">Code</td>
									<td align="center"><div align="left">Narration</div></td>
									<td align="center"><div align="left">Inoice&nbsp;Amount </div></td>
									<td align="center"><div align="center">Action</div></td>
									</tr>

									<tbody id="allhotellisting">

									<?php

									if($_REQUEST['voucherType']!=''){
									$voucherTypeQ='and module="'.$_REQUEST['voucherType'].'"';
									}

									if($_REQUEST['startDate']!='' && $_REQUEST['endDate']!=''){
									$dateQ='and accountDate>="'.date('Y-m-d',strtotime($_REQUEST['startDate'])).'" and accountDate<="'.date('Y-m-d',strtotime($_REQUEST['endDate'])).'"';
									}

									$sNo=0;
									$rs=GetPageRecord('*','accountsMaster','1 and module="invoice" and (creditaccounthead!=0 or accountDate!="0000-00-00") '.$voucherTypeQ.' '.$dateQ.' order by dateAdded desc');
									while($VoucherAppData=mysqli_fetch_array($rs)){

									$kkrs=GetPageRecord('name','companyMaster','1 and id="'.$VoucherAppData['companyid'].'"');
									$comName=mysqli_fetch_array($kkrs);

									$kk=GetPageRecord('*','buyerMaster','1 and id="'.$VoucherAppData['creditaccounthead'].'"');
									$buyerData=mysqli_fetch_array($kk);

									?>

									<tr>
									  <td align="center"><?php echo  ++$sNo; ?></td>
									<td align="center"><div align="left"><?php echo date('d-m-Y',strtotime($VoucherAppData['accountDate'])); ?></div></td>
									<td align="center"><div align="left"><?php echo $comName['name']; ?></div></td>

									<td align="center"><div align="left"><a href="<?php echo $fullurl; ?>tcpdf/examples/generateinvoice.php?pageurl=<?php echo $fullurl; ?>invoice.php?s=<?php echo encode($VoucherAppData['styleId']); ?>" target="_blank"><?php echo $VoucherAppData['displayId']; ?></a></div></td>
									<td align="center"><div align="left"><?php echo $buyerData['name']; ?><span style="display:none;"><?php echo $lowerAccName['label']; ?></span></div></td>
									<td align="center"><?php echo $buyerData['buyerId']; ?></td>
									<td align="center"><div align="left">Style Ref. #<?php echo $VoucherAppData['remark']; ?></div></td>
					<td align="center"><div align="left"><?php echo $VoucherAppData['totalamount']; ?></div></td>
 				   <td align="center">
<?php if($VoucherAppData['changeStatus']==0){ ?>
<a onclick="opmodalpop('Invoice Approval','modalpop.php?action=<?php echo $_GET['module']; ?>&id=<?php echo encode($VoucherAppData['id']); ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-warning-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important; padding: 3px 10px; width: 90px; color: #fff; background-color:#e50f14;">Pending</a>
<?php } else{ ?>
<a onclick="opmodalpop('Invoice Approval','modalpop.php?action=<?php echo $_GET['module']; ?>&id=<?php echo encode($VoucherAppData['id']); ?>&approvedStatus=1','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-green-400" style="margin: 0px !important; padding: 3px 10px; width: 90px; color: #fff;"><i class="fa fa-check" aria-hidden="true" style="margin-right:2px;"></i> Approved</a>
<?php } ?></td>
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


<script>
$(document).ready(function(){
$("#filtersearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#allhotellisting tr").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
</script>


