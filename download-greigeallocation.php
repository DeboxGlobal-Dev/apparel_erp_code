<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';

if($_GET['id']!=''){
$select='*';
$where='id="'.decode($_GET['id']).'"';
$rs=GetPageRecord($select,'greigeAllocation',$where);
$editresultstyle=mysqli_fetch_array($rs);
@extract($editresultstyle);
$lastId=$editresultstyle['id'];
$allocationNo = $allocationNo;
}

if($_GET['id']==''){

deleteRecord('greigeAllocation','tabstatus=0');

$allocationNo = 'G-'.rand();
$namevalue ='addedBy="'.$_SESSION['userid'].'",allocationNo="'.$allocationNo.'"';
$lastId = addlistinggetlastid('greigeAllocation',$namevalue);
}

?>

<div style="margin-top:200px;"></div>

<div style="margin-top:200px;"></div>

	<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                              <td width="16%"></td>
							  <td width="64%" style="text-align:center;"><strong style="font-size:23px;">Greige Allocation</strong></td>
							  <td width="16%" style="text-align:right;"><?php //echo date('d-m-Y h:i:s A'); ?></td>
                            </tr>
                          </tbody>
                        </table>
                        <div style="margin-top:200px;"></div>

<div style="margin-top:200px;"></div>
						<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                              <td width="25%"> <strong>Allocation No: </strong><span class="badge badge-warning" style="font-size: 11px;border: 1px solid black; font-size:12px; height:30px; line-height:30px;"><?php echo $allocationNo; ?></span></td>
							  <td width="25%"><strong>Allocation Date: </strong><span style="border: 1px solid black; font-size:12px; height:30px; line-height:30px;"> <?php if($editresultstyle['allocationDate']!=''){ echo date('d-M-Y', strtotime($editresultstyle['allocationDate'])); }else{ echo date('d-M-Y'); } ?></span> </td>
							  <td width="25%"><strong>Style No:  </strong><span style="border: 1px solid black; font-size:12px; height:30px; line-height:30px;"> 	<?php

						$select='';
						$where='';
						$rs='';
						$select='*';
						$where=' 1 and seasonId!=0 and indentNumber!="" order by id asc';
						$rs=GetPageRecord($select,'greigeRequisition',$where);
						$resListing=mysqli_fetch_array($rs);
						?>
						<?php echo strip($resListing['styleNo']); ?>
						</span></td>
							  <td width="25%"><strong>Transfer From:  </strong><span style="border: 1px solid black; font-size:12px; height:30px; line-height:30px;"> 1</span></td>


							</tr>
							<tr class="card-body">
                              <td width="25%"> <strong>Transfer To Style: </strong><span class="badge badge-warning" style="font-size: 11px;border: 1px solid black; font-size:12px; height:30px; line-height:30px;"><?php
						$select='';
						$where='';
						$rs='';
						$select='*';
						$where=' 1 and deletestatus=0 and sampleStyle="1" order by id desc';
						$rs=GetPageRecord($select,'queryMaster',$where);
						$resListing=mysqli_fetch_array($rs);
						?>
						<?php echo strip($resListing['styleRefId']); ?>
						</span></td>
							  <td width="25%"><strong>For Quarter: </strong><span style="border: 1px solid black; font-size:12px; height:30px; line-height:30px;"> <?php

						$select='';
						$where='';
						$rs='';
						$select='*';
						$where=' 1 and brandId=0 and deletestatus=0 and status=1 order by id asc';
						$rs=GetPageRecord($select,_SEASON_MASTER_,$where);
						$resListing=mysqli_fetch_array($rs);
						?>
						</span>
						<?php echo strip($resListing['name']); ?>
						</td>
							  <td width="25%"><strong>Brand:  </strong><span style="border: 1px solid black; font-size:12px; height:30px; line-height:30px;">
					 <?php
	$select='';
	$where='';
	$rs='';
	$select='*';
	$where=' 1  order by name asc';
	$rs=GetPageRecord($select,'brandMaster',$where);
	$resListing=mysqli_fetch_array($rs);
	?>
	<?php echo $resListing['name']; ?>
						</span>
						</td>
							<td width="25%"><strong>Requested By:  </strong><span style="border: 1px solid black; font-size:12px; height:30px; line-height:30px;">
				Admin
						</span>
						</td>


							</tr>
							<tr class="card-body">
                              <td width="25%"> <strong>Quarter Used&nbsp;In: </strong><span class="badge badge-warning" style="font-size: 11px;border: 1px solid black; font-size:12px; height:30px; line-height:30px;">
                         <?php

				$select='';
				$where='';
				$rs='';
				$select='*';
				$where=' 1 and brandId=0 and deletestatus=0 and status=1 order by id asc';
				$rs=GetPageRecord($select,_SEASON_MASTER_,$where);
				$resListing=mysqli_fetch_array($rs);
				?>
				<?php echo strip($resListing['name']); ?>
						</span></td>



							</tr>

                          </tbody>
     					</table>

     					<div style="margin-top:200px;"></div>

     					<div style="margin-top:200px;"></div>

     					<div style="margin-top:200px;"></div>

<div style="margin-top:200px;"></div>

<div style="margin-top:200px;"></div>


     						    <table width="100%" class="table table-bordered table-responsive forbom" id="tableid11" style="display:block;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body" style="background-color: #fff7b3;;" style="background-color:black; color:white;font-size:10px; line-height:20px; height:20px;">
							<!-- <th width="15%" align="center"><strong></strong><input  name="materialCheckAll" type="checkbox" class="checkalldeletematerial" id="materialCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></th>-->
                              <th>Item</th>
						<th>Initial Width</th>
                        <th>Proc.&nbsp;Width</th>
						<th>Initial&nbsp;Cons.</th>
                        <th>Proc.&nbsp;Cons.</th>
						<th>Ready&nbsp;Fabric</th>
						<th>Ready&nbsp;Fabric Consu.</th>
						<th>Greige&nbsp;Consu.</th>
						<th>Color</th>
						<th>Order&nbsp;Qty.</th>
						<th>Greige&nbsp;Available</th>
                        <th style="display:none;">Quantity Available</th>
                        <th>Quantity Transferred</th>
                        <th>UOM</th>
						  </tr>
						  <tr class="card-body">
							<?php
						$no = 1;
						$wherenew='parentId="'.$lastId.'" order by id asc';
						$rsnew=GetPageRecord('*','greigeRequisition',$wherenew);
						while($rslistnew=mysqli_fetch_array($rsnew)){


						$tillTotalMaterialQty=0;
						$rsindent=GetPageRecord('SUM(orderQty) as tillorderQty','indentCreationMaster','requisitionNo="'.$requisitionNo.'" and materialId="'.$rslistnew['srinkageId'].'" and bomWidth="'.$rslistnew['greWidth'].'"');
						$resListingIndent1=mysqli_fetch_array($rsindent);
						$resListingIndent1['tillorderQty'];
						$tillTotalMaterialQty= $rslistnew['finalQty']-$resListingIndent1['tillorderQty'];

						?>
                        <tr style="border: 1px solid black;">
						<!--<td><label class="analyselistclass">
						   	<input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php echo $rslistnew['id']; ?>" name="analysemateriallistdelete[]" class="deletematerial" />

							</label>
							</td>-->
							<td style="border: 1px solid black;"><div style="border: 1px solid black;height:15px; line-height:15px;text-align:center;">
							<?php
							$wherethis='id="'.$rslistnew['srinkageId'].'"';
							$rss=GetPageRecord('name','materialMaster',$wherethis);
							$resListing1s=mysqli_fetch_array($rss);
							echo stripslashes($resListing1s['name']);
							?></div></td>
							<td style="border: 1px solid black;"><div style="border: 1px solid black;height:30px; line-height:30px;text-align:center;"><?php echo $rslistnew['construction']; ?></div></td>
							<td style="border: 1px solid black;"><div style="border: 1px solid black;height:30px; line-height:30px;text-align:center;"><?php echo $rslistnew['greWidth']; ?></div></td>
							<td style="border: 1px solid black;"><div style="border: 1px solid black;height:30px; line-height:30px;text-align:center;"><?php echo $rslistnew['qty']; ?></div></td>
							<td style="border: 1px solid black;"><div style="border: 1px solid black;height:30px; line-height:30px;text-align:center;"><?php echo $rslistnew['uom']; ?></div></td>
							<td style="border: 1px solid black;"><div style="border: 1px solid black;height:30px; line-height:30px;text-align:center;"><?php echo $rslistnew['processLoss']; ?></div></td>
							<td style="border: 1px solid black;"><div style="border: 1px solid black;height:30px; line-height:30px;text-align:center;"><?php echo $rslistnew['shrinkage']; ?></div></td>
							<td style="border: 1px solid black;"><div style="border: 1px solid black;height:30px; line-height:30px;text-align:center;"><?php echo $rslistnew['processCons']; ?></div></td>
							<td style="border: 1px solid black;"><div style="border: 1px solid black;height:30px; line-height:30px;text-align:center;"><?php echo $rslistnew['processWidth']; ?></div></td>
							<td style="border: 1px solid black;"><div style="border: 1px solid black;height:30px; line-height:30px;text-align:center;"><?php echo $rslistnew['finalQty']; ?></div></td>
							<td style="border: 1px solid black;"><div style="border: 1px solid black;height:30px; line-height:30px;text-align:center;"><?php echo getSupplierName($rslistnew['supplier']); ?></div></td>
							<td style="border: 1px solid black;"><div style="border: 1px solid black;height:30px; line-height:30px;text-align:center;"><?php echo $rslistnew['price']; ?></div></td>
							<td style="border: 1px solid black;"><div style="border: 1px solid black;height:30px; line-height:30px;text-align:center;"><?php echo $rslistnew['currency']; ?></div></td>
						</tr>
						<?php } ?>
                            </tr>
						  </tbody>
                        </table>