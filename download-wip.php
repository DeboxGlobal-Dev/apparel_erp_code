<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';

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
$styleRefId = $editresultstyle['styleRefId'];

$lastId=$editresultstyle['id'];

}

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>

                  <h3>Style no: <?php echo $styleRefId; ?></h3>
	              <table class="table wip1" style="width:100%;">
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
					<tr style="background-color:#f5f5f5;color: #000;">
						<td colspan="6" align="left" ><strong>PO Number: </strong><span class="badge badge-warning" style="font-size: 16px;"><?php echo $resultlists['purchaseOrderNo']; ?></span></td>

					 </tr>
					 <tr style="background-color:#ffffcc;color: #000;">
						<td><div style="font-weight: bold">Sno#</div></td>
						<td><div style="font-weight: bold">Destination</div></td>
						<td><div style="font-weight: bold">Color</div></td>
						<td><strong>Size</strong></td>
						<td><strong>Qty</strong></td>
						<td><strong>Qty&nbsp;(Excess)</strong></td>
					</tr>
					<?php
					$rsSizeWise=GetPageRecord('*','purchaseOrderStyleMaster','purchaseOrderId="'.$resultlists['id'].'"');
					while($rsSizeWiseList=mysqli_fetch_array($rsSizeWise)){
					$sno=1;
					$rsSize=GetPageRecord('*','purchaseOrderStyleMaster','parentId="'.$rsSizeWiseList['id'].'"');
					while($rsSizeList=mysqli_fetch_array($rsSize)){

					$rscolor=GetPageRecord('name','colorCardMaster','id="'.$rsSizeList['color'].'"');
					$rscolorname=mysqli_fetch_array($rscolor);

					?>
					<tr>
						<td><div align="left"><?php echo $sno; ?></td>
						<td><div align="left"><?php echo $rsSizeList['finish']; ?></div></td>
						<td><div align="left"><?php echo $rscolorname['name']; ?></div></td>
						<td><div align="left"><?php echo $rsSizeList['size']; ?></div></td>
						<td><div align="left"><?php echo $rsSizeList['gdQty']; ?></div></td>
						<td>
						<div align="left">
						<?php
						$totalallowance=0;
						$totalallow = 0;
						$rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$rsSizeList['gdQty'].'');
						$resultpro=mysqli_fetch_array($rspro);
						$totalallowance = $resultpro['totalallwance'];
						$total = round($rsSizeList['gdQty']+(($rsSizeList['gdQty']*$totalallowance)/100));
						echo $total;
						?> </div>
						</td>
					</tr>
					<?php $sno++; }  } ?>
			  		<?php $no++; } ?>

				</table>


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
						  	<?php

							$where='';
							$where = 'styleId="'.decode($_REQUEST['styleid']).'" and color="'.$rscolorname['name'].'" and size="'.$rsSizeList['size'].'"  and parentId in (select id from chaalanMaster where departmentId="'.$rsDepartmentList['id'].'") ';
							$todaycutt=GetPageRecord('sum(quantity) as todaysewqty,chaalanDate,quantity,receivedQty,receivedDate','chaalanMaster',$where);
							$resulttodaycutt=mysqli_fetch_array($todaycutt);

							if($rsDepartmentList['id']!=13){ ?>
							<td><div style=" width:90px; text-align:center;"><?php echo $resulttodaycutt['receivedQty']; ?></div></td>
							<td><div style=" width:90px; text-align:center;"><?php if($resulttodaycutt['receivedDate']=='0000-00-00' || $resulttodaycutt['receivedDate']==""){ echo '-'; }else{ echo date('d-M-Y',strtotime($resulttodaycutt['receivedDate'])); }  ?></div></td>
							<?php } ?>
							<td><div style=" width:90px; text-align:center;"><?php
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