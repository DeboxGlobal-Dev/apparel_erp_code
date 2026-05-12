<?php
if($loginuserprofileId==1 || $loginuserprofileId==93){

$wheresearchassign=' 1 and ';

} else {

if($loginuserprofileId==92){

$wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" and ';
} else{

$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';

$wheresearchassign=' '.$wheresearchassign.' and ';

}

}
if($_GET['styleid']!=''){
$select="*";
$where='styleId="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'buyerPurchaseOrderMaster',$where);
$result=mysqli_fetch_array($rs);

}

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
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px;">
      <?php include "top-style.php" ?>
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-3" style="padding-right: 0px;">
              <div class="btn-group justify-content-center" style="float:right;"> </div>
            </div>
          </div>
                 <div class="card">

		  	    <div class="col-md-12">
			   <div class="row" style=" width:100%; margin:0px; padding:0px;">
			 <style>
			 .wip1 tr td{
			 	 padding:7px; border:1px solid #ccc;
			 }
			  .wip2 tr td{
			 	 padding:7px;
				 border-top:0px;
				 border:1px solid #ccc;
			 }
			 </style>
			 <div style="width:100% ;display:block;">
				<div class="first-div" style="width:100% ;display:block; float:left;">
				<table class="table wip1" style="width:100%;">
					<tr style="background-color:#ffffcc;color: #000;">
						<td><div style="font-weight: bold">Sequence No#</div></td>
						<td><div style="font-weight: bold">Received From</div></td>
						<td><div style="font-weight: bold">Received Qty</div></td>
						<td><div style="font-weight: bold">Added By</div></td>
						<td><div style="font-weight: bold">Transfer To</div></td>
						<td><div style="font-weight: bold">TransferQty</div></td>
					</tr>
				  <?php
					$subtotal = 0;
					$grandpototal = 0;
					$grandpototalper = 0;
					$no=1;
					$select='*';
					$where='';
					$rs='';
					$wheresearch='';
					$totaltransfer=0;
					$limit='25';
					$where='where 1 and styleId="'.decode($_REQUEST['styleid']).'" order by id asc';
					$page=$_GET['page'];
					$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&';
					$rs=GetRecordList($select,'operatorInput',$where,$limit,$page,$targetpage);
					$totalentry=$rs[1];
					$paging=$rs[2];
					while($resultlists=mysqli_fetch_array($rs[0])){
						$totaltransfer += $resultlists['transferQty'];
					?>
					<tr>
						<td><div align="left"><?php echo $resultlists['sequenceNo']; ?></td>
						<td><div align="left"><?php echo getEmployeeName($resultlists['receivedFrom']); ?></div></td>
						<td><div align="left"><?php echo $resultlists['receivedQty']; ?></div></td>
						<td><div align="left"><?php echo getUserName($resultlists['addedBy']); ?></div></td>
						<td><div align="left"><?php echo getEmployeeName($resultlists['transferTo']); ?></div></td>
						<td><div align="left"><?php echo $resultlists['transferQty']; ?></div></td>
					</tr>
					<?php }  ?>
					<tr style="background-color:#e5dede;">
						<td colspan="5" align="right"><b>Total</b></td>
						<td><div align="left"><b><?php echo $totaltransfer; ?></b></div></td>
					</tr>
				</table>
				</div>
				<!-- <div class="second-div" style="width:65% ;display:block; float:left;">
				<table class="table table-responsive wip2" style="width:100%;">
				  	<?php
					$subtotal = 0;
					$grandpototal = 0;
					$grandpototalper = 0;
					$no=1;
					$select='*';
					$where='';
					$rs='';
					$wheresearch='';
					$limit='25';
					$where='where 1 and styleId="'.decode($_REQUEST['styleid']).'" order by id asc';
					$page=$_GET['page'];
					$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&';
					$rs=GetRecordList($select,'buyerPurchaseOrderMaster',$where,$limit,$page,$targetpage);
					$totalentry=$rs[1];
					$paging=$rs[2];
					while($resultlists=mysqli_fetch_array($rs[0])){

					?>
					<tr style="background-color:#f5f5f5;color: #000;" align="center">
						<?php
						$rsDepartment=GetPageRecord('id,name','departmentMaster','1 and id in (13,21,20,14,15,17) order by field(id, 13,21,20,14,15,17)');
						while($rsDepartmentList=mysqli_fetch_array($rsDepartment)){
						?>
						<td><strong><?php echo $rsDepartmentList['name']; ?></strong></td>
						<?php } ?>
					</tr>
					<tr style="background-color:#ffffcc;color: #000;">
						<?php
						$rsDepartment=GetPageRecord('id,name','departmentMaster','1 and id in (13,21,20,14,15,17) order by field(id, 13,21,20,14,15,17)');
						while($rsDepartmentList=mysqli_fetch_array($rsDepartment)){
						?>
						<td align="center" style="padding: 0px; border:0px solid !important;">
						<table width="100%">
						  <tr>
							  <?php if($rsDepartmentList['id']!=13){ ?>
								<td><div style=" width:90px; text-align:center;"><strong>Received&nbsp;Qty</strong></div></td>
								<td><div style=" width:90px; text-align:center;"><strong>Received&nbsp;Date</strong></div></td>
							  <?php } ?>
								<td><div style=" width:90px; text-align:center;"><strong>Dispatch&nbsp;Qty</strong></div></td>
								<td><div style=" width:90px; text-align:center;"><strong>Dispatch&nbsp;Date</strong></div></td>
								<td><div style=" width:50px; text-align:center;"><strong>Balance</strong></div></td>
							  </tr>
						</table>
						</td>
						<?php } ?>
					</tr>
					<?php
					$rsSizeWise=GetPageRecord('*','purchaseOrderStyleMaster','purchaseOrderId="'.$resultlists['id'].'"');
					while($rsSizeWiseList=mysqli_fetch_array($rsSizeWise)){
					$sj=1;
					$rsSize=GetPageRecord('*','purchaseOrderStyleMaster','parentId="'.$rsSizeWiseList['id'].'"');
					while($rsSizeList=mysqli_fetch_array($rsSize)){
						$totalallowance=0;
						$totalallow = 0;
						$totalnew=0;
						$rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$rsSizeList['gdQty'].'');
						$resultpro=mysqli_fetch_array($rspro);
						$totalallowance = $resultpro['totalallwance'];
						$totalnew = round($rsSizeList['gdQty']+(($rsSizeList['gdQty']*$totalallowance)/100));



					$rscolor=GetPageRecord('name','colorCardMaster','id="'.$rsSizeList['color'].'"');
					$rscolorname=mysqli_fetch_array($rscolor);

					?>
					<tr>
						<?php
						$rsDepartment=GetPageRecord('id,name','departmentMaster','1 and id in (13,21,20,14,15,17) order by field(id, 13,21,20,14,15,17)');
						while($rsDepartmentList=mysqli_fetch_array($rsDepartment)){

						//$chaalanTotal=GetPageRecord('*','chaalanMaster','styleId="'.$resultlists['styleId'].'"');
						//$chaalanTotalList=mysqli_fetch_array($chaalanTotal);


						?>
						<td align="center" style="padding: 0px;border:0px solid !important;">
						<table width="100%">
						  <tr>
						  	<?php if($rsDepartmentList['id']!=13){ ?>
							<td><div style=" width:90px; text-align:center;">-</div></td>
							<td><div style=" width:90px; text-align:center;">-</div></td>
							<?php } ?>
							<td><div style=" width:90px; text-align:center;"><?php
							$where='';
							$where = 'styleId="'.decode($_REQUEST['styleid']).'" and color="'.$rscolorname['name'].'" and size="'.$rsSizeList['size'].'"  and parentId in (select id from chaalanMaster where departmentId="'.$rsDepartmentList['id'].'") ';
							$todaycutt=GetPageRecord('sum(quantity) as todaysewqty,chaalanDate','chaalanMaster',$where);
							$resulttodaycutt=mysqli_fetch_array($todaycutt);
						if($resulttodaycutt['todaysewqty']!=''){ 	echo $resulttodaycutt['todaysewqty']; }else{ echo '-';}
						?></div></td>
							<td><div style=" width:90px; text-align:center;"><?php if($resulttodaycutt['todaysewqty']!=''){ echo date('d-M-y',strtotime($resulttodaycutt['chaalanDate']));  } ?></div></td>
							<td><div style=" width:50px; text-align:center;"><?php if($resulttodaycutt['todaysewqty']!=''){ echo $totalnew-$resulttodaycutt['todaysewqty']; } ?></div></td>
						  </tr>
						</table>
						</th>
						<?php } ?>
					</tr>
				<?php $sj++; }  } ?>
				<?php  $no++; } ?>

				</table>
				</div> -->
			</div>

			</div>
			</div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
