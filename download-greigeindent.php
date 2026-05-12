<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';

if($_GET['id']!=''){
$select='*';
$where='id="'.decode($_GET['id']).'"';
$rs=GetPageRecord($select,'greigeRequisition',$where);
$editresultstyle=mysqli_fetch_array($rs);
@extract($editresultstyle);
$lastId=$editresultstyle['id'];
$requisitionNo = $requisitionNo;
}

 if($_GET['module']=='grn'){

     $no = 1;
						$wherenew='parentId="'.$lastId.'" order by id asc';
						$rsnew=GetPageRecord('*','greigeRequisition',$wherenew);
						while($rslistnew=mysqli_fetch_array($rsnew)){


						$tillTotalMaterialQty=0;
						$rsindent=GetPageRecord('SUM(orderQty) as tillorderQty','indentCreationMaster','requisitionNo="'.$requisitionNo.'" and materialId="'.$rslistnew['srinkageId'].'" and bomWidth="'.$rslistnew['greWidth'].'"');
						$resListingIndent1=mysqli_fetch_array($rsindent);
						$resListingIndent1['tillorderQty'];
						$tillTotalMaterialQty= $rslistnew['finalQty']-$resListingIndent1['tillorderQty'];
						}

 }

?>

<div style="margin-top:200px;"></div>

<div style="margin-top:200px;"></div>

	<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                              <td width="16%"></td>
							  <td width="64%" style="text-align:center;"><strong style="font-size:23px;">INDENT</strong></td>
							  <td width="16%" style="text-align:right;"><?php //echo date('d-m-Y h:i:s A'); ?></td>
                            </tr>
                          </tbody>
                        </table>
                        <div style="margin-top:200px;"></div>

<div style="margin-top:200px;"></div>
						<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                              <td width="25%"> <strong>Indent No: </strong><span class="badge badge-warning" style="font-size: 11px;border: 1px solid black; font-size:12px; height:30px; line-height:30px;"><?php echo $indentNumber; ?></span></td>
							  <td width="25%"><strong>Indent Date: </strong><span style="border: 1px solid black; font-size:12px; height:30px; line-height:30px;"> <?php echo date('d-m-Y',strtotime($requisitionDate)); ?></span> </td>
							  <td width="25%"><strong>Requisition No:  </strong><span style="border: 1px solid black; font-size:12px; height:30px; line-height:30px;"> <?php echo $requisitionNo; ?></span></td>
							  <td width="25%"><strong>Greige Style No:  </strong><span style="border: 1px solid black; font-size:12px; height:30px; line-height:30px;"> <?php echo $styleNo; ?></span></td>

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
							<th>Construction</th>
							<th>Width</th>
							<th>Qty.</th>
							<th>UOM</th>
							<th>Process Loss</th>
							<th>Shrinkage</th>
							<th>Pro. Cons.</th>
							<th>Pro. with Width</th>
							<th>Final&nbsp;Qty.</th>
							<th>Supplier</th>
							<th>Price</th>
							<th>Currency</th>
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